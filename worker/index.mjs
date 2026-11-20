import { ASSESSMENT_VERSION, scoreAssessment, validAnswers } from '../src/assessment.mjs';

const PATH = '/api/assessment';
const MAX_BODY_BYTES = 2048;
const VALID_HOSTS = new Set(['tayloredai.com', 'www.tayloredai.com']);
const LOCAL_HOSTS = new Set(['localhost', '127.0.0.1', '[::1]']);

function json(body, status, extraHeaders = {}) {
  return Response.json(body, {
    status,
    headers: { 'Cache-Control': 'no-store', 'X-Content-Type-Options': 'nosniff', ...extraHeaders },
  });
}

async function readPayload(request) {
  const reader = request.body?.getReader();
  if (!reader) return;
  const bytes = new Uint8Array(MAX_BODY_BYTES);
  let size = 0;
  try {
    while (true) {
      const { done, value } = await reader.read();
      if (done) return JSON.parse(new TextDecoder('utf-8', { fatal: true }).decode(bytes.subarray(0, size)));
      if (size + value.length > MAX_BODY_BYTES) {
        await reader.cancel();
        return;
      }
      bytes.set(value, size);
      size += value.length;
    }
  } catch {
    return;
  } finally {
    reader.releaseLock();
  }
}

async function archiveAssessment(request, env, url) {
  if (request.method !== 'POST') return json({ error: 'method' }, 405, { Allow: 'POST' });
  const live = url.protocol === 'https:' && VALID_HOSTS.has(url.hostname);
  const local = env.ASSESSMENT_LOCAL_DEV === '1' && LOCAL_HOSTS.has(url.hostname);
  if ((!live && !local) || request.headers.get('Origin') !== url.origin) {
    return json({ error: 'origin' }, 403);
  }
  if (request.headers.get('Content-Type')?.split(';')[0].trim().toLowerCase() !== 'application/json') {
    return json({ error: 'content_type' }, 415);
  }
  if (Number(request.headers.get('Content-Length')) > MAX_BODY_BYTES) {
    return json({ error: 'size' }, 413);
  }

  try {
    const ip = request.headers.get('CF-Connecting-IP') || 'local';
    const { success } = await env.ASSESSMENT_RATE.limit({ key: ip });
    if (!success) return json({ error: 'rate' }, 429, { 'Retry-After': '60' });

    const body = await readPayload(request);
    if (!body || !validAnswers(body.answers)
        || typeof body.id !== 'string'
        || !/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(body.id)
        || body.website !== '') {
      return json({ error: 'submission' }, 400);
    }
    if (body.version !== ASSESSMENT_VERSION) return json({ error: 'version' }, 409);
    const email = typeof body.email === 'string' ? body.email.trim() : '';
    if (email.length > 254 || !/^[^\s@]{1,64}@[^\s@]+\.[^\s@]+$/u.test(email)) {
      return json({ error: 'email' }, 400);
    }

    const result = scoreAssessment(body.answers);
    // Identical retries share a key. The opaque digest keeps email out of KV key names.
    const digest = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(
      JSON.stringify([body.id, ASSESSMENT_VERSION, email, body.answers]),
    ));
    const key = 'assessment:' + Array.from(new Uint8Array(digest), byte => byte.toString(16).padStart(2, '0')).join('');
    if (!await env.ASSESSMENT_ARCHIVE.get(key)) {
      await env.ASSESSMENT_ARCHIVE.put(key, JSON.stringify({
        assessmentVersion: ASSESSMENT_VERSION,
        submittedAt: new Date().toISOString(),
        email,
        ...result,
      }));
    }
    return json(result, 200);
  } catch {
    // Do not send submitted data or provider errors to logs or the browser.
    console.error('Assessment archive unavailable');
    return json({ error: 'unavailable' }, 503);
  }
}

export default {
  fetch(request, env) {
    const url = new URL(request.url);
    if (url.pathname === PATH || url.pathname === `${PATH}/`) {
      return archiveAssessment(request, env, url);
    }
    return env.ASSETS.fetch(request);
  },
};

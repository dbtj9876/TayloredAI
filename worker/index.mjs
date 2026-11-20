import { ASSESSMENT_VERSION, scoreAssessment, validAnswers } from '../src/assessment.mjs';
import { DIAGNOSTIC_VERSION, makeBrief, validProfile } from '../src/diagnostic.mjs';

const PATH = '/api/assessment';
const DIAGNOSTIC_PATH = '/api/diagnostic';
const DIAGNOSTIC_FIELDS = new Set(['id', 'version', 'email', 'profile', 'website']);
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

async function archiveAssessment(request, env, url, diagnostic = false) {
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
    const responseData = diagnostic ? body?.profile : body?.answers;
    if (!body || !(diagnostic ? validProfile(responseData) : validAnswers(responseData))
        || (diagnostic && Object.keys(body).some(key => !DIAGNOSTIC_FIELDS.has(key)))
        || typeof body.id !== 'string'
        || !/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(body.id)
        || body.website !== '') {
      return json({ error: 'submission' }, 400);
    }
    const version = diagnostic ? DIAGNOSTIC_VERSION : ASSESSMENT_VERSION;
    if (body.version !== version) return json({ error: 'version' }, 409);
    const email = typeof body.email === 'string' ? body.email.trim() : '';
    if (email.length > 254 || !/^[^\s@]{1,64}@[^\s@]+\.[^\s@]+$/u.test(email)) {
      return json({ error: 'email' }, 400);
    }

    const result = diagnostic ? makeBrief(responseData) : scoreAssessment(responseData);
    const stableData = diagnostic ? Object.entries(responseData).sort(([a], [b]) => a.localeCompare(b)) : responseData;
    // Identical retries share a key. The opaque digest keeps email out of KV key names.
    const digest = await crypto.subtle.digest('SHA-256', new TextEncoder().encode(
      JSON.stringify([body.id, version, email, stableData]),
    ));
    const key = (diagnostic ? 'diagnostic:' : 'assessment:') + Array.from(new Uint8Array(digest), byte => byte.toString(16).padStart(2, '0')).join('');
    if (!await env.ASSESSMENT_ARCHIVE.get(key)) {
      const base = { submittedAt: new Date().toISOString(), email };
      const record = diagnostic
        ? { ...base, diagnosticVersion: version, profile: responseData, worksheet: result.worksheet }
        : { ...base, assessmentVersion: version, ...result };
      await env.ASSESSMENT_ARCHIVE.put(key, JSON.stringify(record));
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
    if (url.pathname === DIAGNOSTIC_PATH || url.pathname === `${DIAGNOSTIC_PATH}/`) {
      return archiveAssessment(request, env, url, true);
    }
    return env.ASSETS.fetch(request);
  },
};

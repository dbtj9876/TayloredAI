import assert from 'node:assert/strict';
import test from 'node:test';
import { randomUUID } from 'node:crypto';
import { ASSESSMENT_VERSION, scoreAssessment } from '../src/assessment.mjs';
import worker from '../worker/index.mjs';

const url = 'https://tayloredai.com/api/assessment';
const origin = 'https://tayloredai.com';

function fixture() {
  const records = new Map();
  const env = {
    ASSESSMENT_ARCHIVE: {
      get: async (key) => records.get(key),
      put: async (key, value) => records.set(key, value),
    },
    ASSESSMENT_RATE: { limit: async () => ({ success: true }) },
  };
  const body = {
    id: randomUUID(),
    version: ASSESSMENT_VERSION,
    email: 'synthetic@example.com',
    answers: [...Array(11).fill(0), 2],
    website: '',
  };
  const submit = (payload = body, options = {}) => worker.fetch(new Request(options.url ?? url, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', Origin: origin, ...options.headers },
    body: JSON.stringify(payload),
  }), env);
  return { records, env, body, submit };
}

test('computes readiness without counting the bottleneck answer', () => {
  for (const [answer, score, band] of [[0, 100, 'AI-Ready'], [1, 67, 'Emerging'], [3, 0, 'Foundations First']]) {
    const high = scoreAssessment([...Array(11).fill(answer), 0]);
    const low = scoreAssessment([...Array(11).fill(answer), 3]);
    assert.equal(high.score, score);
    assert.equal(high.band, band);
    assert.equal(high.score, low.score);
    assert.notEqual(high.bottleneck, low.bottleneck);
  }
});

test('saves the server-computed result privately and makes repeat submissions idempotent', async () => {
  const { records, body, submit } = fixture();
  const result = await submit({ ...body, score: 0, band: 'fake' });
  assert.equal(result.status, 200);
  assert.equal(result.headers.get('Cache-Control'), 'no-store');
  assert.deepEqual(await result.json(), { score: 100, band: 'AI-Ready', bottleneck: 'Data and insight gaps' });
  const entries = Array.from(records);
  assert.equal(entries.length, 1);
  assert.match(entries[0][0], /^assessment:[0-9a-f]{64}$/);
  const { submittedAt, ...record } = JSON.parse(entries[0][1]);
  assert.ok(Number.isFinite(Date.parse(submittedAt)));
  assert.deepEqual(record, {
    assessmentVersion: ASSESSMENT_VERSION, email: body.email, score: 100,
    band: 'AI-Ready', bottleneck: 'Data and insight gaps',
  });
  assert.equal((await submit()).status, 200);
  assert.deepEqual(Array.from(records), entries);
});

test('rejects invalid emails, answers, versions, unwanted origins and honeypot submissions', async () => {
  const { records, body, submit } = fixture();
  for (const patch of [
    { email: '' }, { email: 'not-an-address' }, { answers: [0] },
    { answers: [...Array(11).fill(4), 0] }, { website: 'bot' }, { id: 'invalid' },
  ]) {
    assert.equal((await submit({ ...body, ...patch })).status, 400);
  }
  assert.equal((await submit({ ...body, version: 0 })).status, 409);
  assert.equal((await submit({ ...body, email: 'x'.repeat(2500) })).status, 400);
  assert.equal((await submit(body, { headers: { Origin: 'https://other.example' } })).status, 403);
  assert.equal((await submit(body, {
    url: 'https://preview.workers.dev/api/assessment', headers: { Origin: 'https://preview.workers.dev' },
  })).status, 403);
  assert.equal((await submit(body, { headers: { 'Content-Type': 'text/plain' } })).status, 415);
  assert.equal(records.size, 0);
});

test('never lists records and reports rate-limit and storage failures', async (t) => {
  const { env, records, submit } = fixture();
  assert.equal((await worker.fetch(new Request(url), env)).status, 405);
  env.ASSESSMENT_RATE.limit = async () => ({ success: false });
  const limited = await submit();
  assert.equal(limited.status, 429);
  assert.equal(limited.headers.get('Retry-After'), '60');
  env.ASSESSMENT_RATE.limit = async () => ({ success: true });
  env.ASSESSMENT_ARCHIVE.put = async () => { throw new Error('synthetic'); };
  t.mock.method(console, 'error', () => {});
  const unavailable = await submit();
  assert.equal(unavailable.status, 503);
  assert.deepEqual(await unavailable.json(), { error: 'unavailable' });
  assert.equal(records.size, 0);
});

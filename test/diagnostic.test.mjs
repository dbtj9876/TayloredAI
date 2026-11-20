import assert from 'node:assert/strict';
import test from 'node:test';
import { randomUUID } from 'node:crypto';
import { DIAGNOSTIC_VERSION, STEPS, makeBrief, suggestAnswer, validProfile } from '../src/diagnostic.mjs';
import worker from '../worker/index.mjs';

const manual = { tools: 'microsoft', data: 'internal', bottleneck: 'manual', outcome: 'time' };
const sensitive = { tools: 'google', data: 'restricted', bottleneck: 'customers', outcome: 'speed' };
const endpoint = 'https://tayloredai.com/api/diagnostic';

test('manual work and sensitive customer workflows get distinct guidance', () => {
  const a = makeBrief(manual);
  const b = makeBrief(sensitive);
  assert.match(a.approach, /Microsoft 365/);
  assert.match(a.insight, /time five runs/);
  assert.equal(a.worksheet, 'manual');
  assert.match(b.insight, /synthetic examples/);
  assert.match(b.risk, /Keep real customer/);
  assert.match(b.actions[2], /approved handoff/);
  assert.equal(b.worksheet, 'customers');
  assert.equal(b.governance.length, 3);
});

test('classifies a short phrase without claiming a match on ambiguous input', () => {
  assert.equal(suggestAnswer(STEPS[0], 'We use Outlook'), 'microsoft');
  assert.equal(suggestAnswer(STEPS[0], 'Google and Microsoft'), null);
  assert.equal(suggestAnswer(STEPS[1], 'Internal notes and some customer data'), 'restricted');
  assert.equal(suggestAnswer(STEPS[2], 'Not sure yet'), 'unknown');
  assert.equal(suggestAnswer(STEPS[2], ''), null);
  assert.equal(validProfile({ ...manual, tools: 'constructor' }), false);
  assert.equal(validProfile({ ...manual, freeText: 'must not be accepted' }), false);
});

test('diagnostic uses separate private keys, rejects malformed profiles and does not expose reads', async () => {
  const records = new Map();
  const env = {
    ASSESSMENT_ARCHIVE: {
      get: async key => records.get(key),
      put: async (key, value) => { records.set(key, value); },
    },
    ASSESSMENT_RATE: { limit: async () => ({ success: true }) },
  };
  const body = { id: randomUUID(), version: DIAGNOSTIC_VERSION, email: 'example@example.com', profile: manual, website: '' };
  const submit = patch => worker.fetch(new Request(endpoint, {
    method: 'POST', headers: { Origin: 'https://tayloredai.com', 'Content-Type': 'application/json' },
    body: JSON.stringify({ ...body, ...patch }),
  }), env);
  assert.equal((await submit({ profile: { ...manual, text: 'private sample' } })).status, 400);
  assert.equal((await submit({ text: 'private sample' })).status, 400);
  assert.equal((await submit({ email: 'invalid' })).status, 400);
  assert.equal((await submit({ version: DIAGNOSTIC_VERSION + 1 })).status, 409);
  const first = await submit();
  assert.equal(first.status, 200);
  assert.equal(first.headers.get('Cache-Control'), 'no-store');
  assert.deepEqual(await first.json(), makeBrief(manual));
  assert.equal((await submit({ profile: Object.fromEntries(Object.entries(manual).reverse()) })).status, 200);
  assert.equal(records.size, 1);
  const [[key, value]] = records;
  assert.match(key, /^diagnostic:[0-9a-f]{64}$/);
  const { submittedAt, ...saved } = JSON.parse(value);
  assert.ok(Date.parse(submittedAt));
  assert.deepEqual(saved, { email: body.email, diagnosticVersion: DIAGNOSTIC_VERSION, profile: manual, worksheet: 'manual' });
  assert.equal((await worker.fetch(new Request(endpoint), env)).status, 405);
});

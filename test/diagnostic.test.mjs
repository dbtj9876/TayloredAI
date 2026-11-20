import assert from 'node:assert/strict';
import test from 'node:test';
import { randomUUID } from 'node:crypto';
import { DIAGNOSTIC_VERSION, STEPS, makeBrief, suggestAnswer, validProfile } from '../src/diagnostic.mjs';
import worker from '../worker/index.mjs';

const manual = { tools: 'microsoft', data: 'internal', bottleneck: 'manual', outcome: 'time' };
const sensitive = { tools: 'google', data: 'restricted', bottleneck: 'customers', outcome: 'speed' };
const privateSearch = { tools: 'onprem', data: 'private', bottleneck: 'insight', outcome: 'time' };
const endpoint = 'https://tayloredai.com/api/diagnostic';

test('manual work and sensitive customer workflows get distinct guidance', () => {
  const a = makeBrief(manual);
  const b = makeBrief(sensitive);
  assert.match(a.approach, /Microsoft 365/);
  assert.match(a.insight, /time five runs/);
  assert.match(a.approach, /synthetic examples into a structured list/);
  assert.match(a.approach, /verify the fields before anything is written/);
  assert.match(a.actions[1], /missed handoffs/);
  assert.equal(a.worksheet, 'manual');
  assert.match(b.insight, /synthetic examples/);
  assert.match(b.risk, /Keep real customer/);
  assert.match(b.actions[2], /approved handoff/);
  assert.equal(b.worksheet, 'customers');
  assert.equal(b.governance.length, 3);
});

test('classifies a short phrase without claiming a match on ambiguous input', () => {
  assert.equal(suggestAnswer(STEPS[0], 'We use Outlook'), 'microsoft');
  assert.equal(suggestAnswer(STEPS[0], 'SharePoint and Microsoft 365, with Excel for tracking'), 'microsoft');
  assert.equal(suggestAnswer(STEPS[0], 'On premise SQL and a mix of spreadsheets'), 'onprem');
  assert.equal(suggestAnswer(STEPS[0], 'Google and Microsoft'), null);
  assert.equal(suggestAnswer(STEPS[0], 'Microsoft 365 and on-premises SQL'), null);
  assert.equal(suggestAnswer(STEPS[1], 'Internal notes and some customer data'), 'restricted');
  assert.equal(suggestAnswer(STEPS[1], 'Customer records must stay inside our approved network'), 'private');
  assert.equal(suggestAnswer(STEPS[1], 'Private customer records'), 'restricted');
  assert.equal(suggestAnswer(STEPS[2], 'Finding earlier notes takes forever'), 'insight');
  assert.equal(suggestAnswer(STEPS[3], 'Cut admin time in half'), 'time');
  assert.equal(suggestAnswer(STEPS[2], 'Not sure yet'), 'unknown');
  assert.equal(suggestAnswer(STEPS[2], ''), null);
  assert.equal(validProfile({ ...manual, tools: 'constructor' }), false);
  assert.equal(validProfile({ ...manual, freeText: 'must not be accepted' }), false);
});

test('private-only retrieval honors the boundary, permissions, and verification', () => {
  const brief = makeBrief(privateSearch);
  assert.match(brief.insight, /synthetic examples inside your approved private environment/);
  assert.match(brief.approach, /approved on-premises environment/);
  assert.match(brief.approach, /record permissions at retrieval/);
  assert.match(brief.approach, /verify each summary against exact source references/);
  assert.match(brief.risk, /outputs, logs, and telemetry/);
  assert.match(brief.actions[1], /two users with different access/);
  assert.match(brief.actions[2], /including review time/);
  assert.match(brief.governance[1], /citations respect the same access controls/);
  assert.equal(brief.worksheet, 'insight');
  const other = makeBrief({ ...privateSearch, tools: 'microsoft', bottleneck: 'manual' });
  assert.doesNotMatch(other.approach, /Microsoft 365/);
  assert.match(other.approach, /Do not send records, prompts, or outputs to external services/);
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

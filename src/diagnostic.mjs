export const DIAGNOSTIC_VERSION = 1;

export const STEPS = [
  {
    id: 'tools', label: 'Current tools',
    question: 'Where does your team do most of its day-to-day work?',
    example: 'For example: “We use Microsoft 365 and a shared inbox.”',
    options: {
      microsoft: 'Microsoft 365', google: 'Google Workspace', mixed: 'Several tools or spreadsheets',
      unknown: 'Not sure yet',
    },
    hints: { microsoft: /\b(microsoft|m365|outlook|teams|sharepoint|copilot|365)\b/i, google: /\b(google|gmail|workspace|g suite)\b/i, mixed: /\b(spreadsheets?|excel|crm|slack|quickbooks|several|mixed|multiple)\b/i },
  },
  {
    id: 'data', label: 'Data sensitivity',
    question: 'What kind of information would this workflow touch?',
    example: 'Describe the category only, such as “customer contact information.” Don’t paste actual records.',
    options: {
      public: 'Public or non-sensitive material', internal: 'Internal business information',
      restricted: 'Customer, employee, or restricted records', unknown: 'Not sure yet',
    },
    hints: { restricted: /\b(customers?|clients?|employee|payroll|patient|medical|financial|personal|pii|restricted|confidential|contracts?)\b/i, internal: /\b(internal|staff|intranet|procedures?|sops?)\b/i, public: /\b(public|published|non.sensitive|marketing|synthetic)\b/i },
  },
  {
    id: 'bottleneck', label: 'Bottleneck',
    question: 'Where does the work get stuck most often?',
    example: 'Think of one recurring task, not a company-wide transformation.',
    options: {
      manual: 'Repetitive manual work', customers: 'Slow customer responses',
      insight: 'Hard-to-find information', quality: 'Inconsistent quality or adoption', unknown: 'Not sure yet',
    },
    hints: { customers: /\b(inbox|replies|reply|responses?|tickets?|support|customer service)\b/i, manual: /\b(copy|paste|repetitive|manual|data entry|rekey|invoice|typing)\b/i, insight: /\b(search|find|reports?|insights?|knowledge|scattered|documents?)\b/i, quality: /\b(quality|inconsistent|errors?|training|adoption|rework)\b/i },
  },
  {
    id: 'outcome', label: 'Desired outcome',
    question: 'What would tell you that a small pilot worked?',
    example: 'Choose the one improvement your team would notice first.',
    options: {
      time: 'Less time spent on each task', accuracy: 'Fewer errors or corrections',
      speed: 'Faster turnaround', adoption: 'More consistent use by staff', unknown: 'Not sure yet',
    },
    hints: { time: /\b(save time|less time|minutes?|hours?|time spent)\b/i, accuracy: /\b(errors?|accuracy|mistakes?|corrections?|rework)\b/i, speed: /\b(faster|turnaround|wait|speed|respond|response time)\b/i, adoption: /\b(adoption|consistent|consistency|staff use|team use)\b/i },
  },
];

export const WORKSHEETS = {
  manual: {
    title: 'Workflow Audit Worksheet',
    example: 'Example: staff copy invoice totals into a spreadsheet three times a week.',
    prompts: ['Name the workflow, its owner, and what starts it.', 'Write the steps from input to handoff. Mark each manual transfer.', 'Time five runs and note errors or exceptions.', 'Choose one repeatable step and name who checks its output.'],
  },
  customers: {
    title: 'Customer Response Pilot Planner',
    example: 'Example: draft an answer to a common scheduling question using an approved template.',
    prompts: ['Pick one inquiry type and an owner for the pilot.', 'Find an approved answer and remove personal details from test examples.', 'Name the reviewer and define when to escalate rather than reply.', 'Track time to approved reply and how often drafts need correction.'],
  },
  insight: {
    title: 'AI Data Readiness Worksheet',
    example: 'Example: staff need to find the current returns policy without searching three folders.',
    prompts: ['Write one business question the pilot should answer.', 'Identify the authoritative document, version, and owner.', 'List who may see the source and test that access before connecting anything.', 'Test sample questions and check whether each answer points to the right source.'],
  },
  quality: {
    title: 'Team AI Practice Worksheet',
    example: 'Example: two staff members turn the same meeting notes into an action list.',
    prompts: ['Choose one task and provide an approved example of a good output.', 'Define a short rubric for accuracy, completeness, and tone.', 'Have two people try the same instructions using sample material.', 'Compare outputs and revise the rubric or training before expanding.'],
  },
};

const PATTERNS = {
  manual: {
    insight: 'Map one repetitive workflow and time five runs before automating it. Look for a repeatable handoff rather than replacing the whole process.',
    pilot: 'Keep the current workflow and test AI assistance on one predictable step. Have its owner compare outputs with the original process.',
  },
  customers: {
    insight: 'Pick one common customer request and measure response time. Pilot drafts with a person approving every reply.',
    pilot: 'Use approved response templates and sample inquiries to test a draft-only workflow. Do not send replies automatically.',
  },
  insight: {
    insight: 'Pick one question people struggle to answer. Identify the authoritative document, its owner, and who should be able to see it.',
    pilot: 'Test a small set of approved documents and require each answer to point back to the source. Check permissions before connecting live content.',
  },
  quality: {
    insight: 'Give two colleagues the same example and a short quality checklist. Compare the outputs before buying or rolling out another tool.',
    pilot: 'Run one guided practice session with approved sample material. Compare whether colleagues can finish the same task to the same standard.',
  },
  unknown: {
    insight: 'Pick one recurring task and note where it slows down. Time five runs before deciding whether AI or a simpler process change would help.',
    pilot: 'Use an observation-only trial until you know which step creates the most delay or rework.',
  },
};

const ENVIRONMENT = {
  microsoft: 'Start in your existing Microsoft 365 environment. Confirm the pilot workspace, license, and access settings before connecting content.',
  google: 'Start in your existing Google Workspace environment. Confirm the shared drive, administrators, and access settings before connecting content.',
  mixed: 'Choose one source system and one owner first. Avoid a cross-tool integration until a small pilot proves useful.',
  unknown: 'Inventory the tools and owners behind this workflow before choosing a platform or buying a license.',
};

const RISKS = {
  public: 'Verify the sample really is public or cleared for this use, and check outputs for accuracy before anyone relies on them.',
  internal: 'Verify who can already see the internal material and whether the chosen AI tool preserves that access. Start with approved samples.',
  restricted: 'Keep real customer, employee, or restricted records out of the pilot until approved tools, access, and retention are verified. Start with synthetic examples.',
  unknown: 'Treat the data as sensitive until an owner confirms its classification and approved use. Start with synthetic examples.',
};

const METRICS = {
  time: 'Record median minutes per task before and during the pilot, including review time.',
  accuracy: 'Count outputs that need correction against the same checklist before and during the pilot.',
  speed: 'Compare time from request to approved handoff before and during the pilot.',
  adoption: 'Track how many pilot participants complete the workflow unaided and ask what still causes friction.',
  unknown: 'Record both time per task and corrections for five runs. Choose a primary measure before inviting pilot users.',
};

export function suggestAnswer(step, text) {
  const clean = text.trim();
  if (/^(?:i(?:’|')?m )?(?:not sure|unknown|no idea|unsure)\b/i.test(clean)) return 'unknown';
  const matches = Object.entries(step.hints).filter(([, pattern]) => pattern.test(clean));
  if (step.id === 'data' && matches.some(([id]) => id === 'restricted')) return 'restricted';
  return matches.length === 1 ? matches[0][0] : null;
}

export function validProfile(profile) {
  return !!profile && typeof profile === 'object' && !Array.isArray(profile)
    && Object.keys(profile).length === STEPS.length
    && STEPS.every(({ id, options }) => Object.hasOwn(profile, id)
      && typeof profile[id] === 'string' && Object.hasOwn(options, profile[id]));
}

export function makeBrief(profile) {
  const pattern = PATTERNS[profile.bottleneck];
  const worksheet = profile.bottleneck === 'unknown' ? 'manual' : profile.bottleneck;
  return {
    insight: ['restricted', 'unknown'].includes(profile.data)
      ? `${pattern.insight} Use synthetic examples until the data owner approves a real-data pilot.`
      : pattern.insight,
    approach: `${ENVIRONMENT[profile.tools]} ${pattern.pilot}`,
    risk: RISKS[profile.data],
    actions: [pattern.insight, 'Run a small trial with approved sample data, a named owner, and a human reviewer.', METRICS[profile.outcome]],
    governance: [
      'Use only approved tools and data; never bypass existing access controls.',
      'Name the reviewer and define when to stop or escalate the workflow.',
      'Agree how pilot data and outputs are stored, retained, and deleted.',
    ],
    worksheet,
  };
}

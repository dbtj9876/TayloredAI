// ============ Service offerings ============
// Edit services here; pages, homepage cards, and assessment recommendations all read from this.

export interface ServiceSection {
  heading: string;
  body: string;
  bullets?: string[];
}

export interface Service {
  slug: string;
  tag: string;
  title: string;
  short: string;
  intro: string;
  sections: ServiceSection[];
  deliverables: string[];
  faq: { q: string; a: string }[];
}

export const services: Service[] = [
  {
    slug: 'governance',
    tag: 'Govern',
    title: 'AI Governance',
    short: 'Practical guardrails that keep you compliant and your data safe — without a 60-page policy nobody reads.',
    intro:
      'Your team is already using AI — the only question is whether it is safe, consistent, and visible to you. We put lightweight governance in place that protects customer data, sets clear rules your team will actually follow, and gives you a defensible answer when a client or auditor asks "how do you handle AI?"',
    sections: [
      {
        heading: 'What we do',
        body: 'We work with how your business actually runs — not a template policy binder.',
        bullets: [
          'Acceptable-use guidelines written in plain English',
          'Data-access and privacy guardrails (what can go into AI tools, and what never can)',
          'Vendor and tool evaluation standards for new AI purchases',
          'Incident and escalation paths when something goes wrong',
        ],
      },
      {
        heading: 'Why it matters for SMBs',
        body:
          'Enterprise governance is built for enterprises — committees, review boards, quarterly audits. You need the same protection at a tenth of the weight. That is exactly what we build: right-sized governance that a 10–200 person company can run without hiring a compliance officer.',
      },
    ],
    deliverables: [
      'AI acceptable-use policy (2–3 pages, plain English)',
      'Data classification quick-reference for AI tools',
      'Vendor evaluation checklist',
      'Team briefing session (recorded for future hires)',
    ],
    faq: [
      {
        q: 'Is this just for companies in regulated industries?',
        a: 'No. If you handle customer data, financial records, or contracts — which is every business — you have exposure. Most SMB governance engagements take 2–3 weeks.',
      },
      {
        q: 'Will this slow my team down?',
        a: 'It should speed them up. Clear rules remove hesitation — people use AI more, not less, once they know what is allowed.',
      },
    ],
  },
  {
    slug: 'agents',
    tag: 'Build',
    title: 'Agentic AI Solutions',
    short: 'Agents and automations that handle real work — inbox triage, quoting, reporting — built around how your team already operates.',
    intro:
      'Chatbots answer questions. Agents do work. We build AI agents that complete multi-step tasks in the tools you already use — drafting quotes from your inbox, reconciling invoices, chasing follow-ups, assembling weekly reports — so your team spends its hours on the parts of the business that need a human.',
    sections: [
      {
        heading: 'What we do',
        body: 'Every agent starts from a specific, measurable task — never a demo looking for a use case.',
        bullets: [
          'Workflow agents that work across email, your CRM, accounting, and documents',
          'RAG: let staff (or customers) get instant answers from your own documents and knowledge base',
          'Custom Copilots and skills tuned to your workflows',
          'Human-in-the-loop design: agents draft, your team approves',
        ],
      },
      {
        heading: 'What it looks like in practice',
        body: 'A 12-person equipment rental company had a dispatcher copying details from emails into their booking system 40 times a day. An agent now drafts the entry from the email; the dispatcher confirms in one click. Same staff, half the data entry, fewer errors.',
      },
    ],
    deliverables: [
      'Working agent(s) running in your environment',
      'Documentation and runbook you own outright',
      'Monitoring so you know it is doing what it should',
      'Handover training for your team',
    ],
    faq: [
      {
        q: 'Do we need to change our systems?',
        a: 'Rarely. Agents work best when they meet your tools where they are — Outlook, QuickBooks, your CRM, spreadsheets. Rip-and-replace is almost never the answer.',
      },
      {
        q: 'What about errors or hallucinations?',
        a: 'Agents are scoped to narrow, verifiable tasks, grounded in your own data, and designed with human checkpoints wherever the cost of a mistake is real.',
      },
    ],
  },
  {
    slug: 'audits',
    tag: 'Focus',
    title: 'AI Process Audits',
    short: 'A structured sweep of your operations to find where AI saves real hours and dollars — ranked by impact, effort, and risk.',
    intro:
      'You have read the listicle of "50 AI ideas for your business." You do not need 50 ideas — you need to know the two or three worth doing, in what order, and what to skip. An AI Process Audit maps how work actually flows through your business and returns a ranked, costed plan you can execute with or without us.',
    sections: [
      {
        heading: 'What we do',
        body: 'A structured look under the hood, sized for SMB budgets.',
        bullets: [
          'Workflow mapping across sales, delivery, admin, and finance',
          'Time-and-error analysis: where hours and mistakes actually concentrate',
          'Impact vs. effort vs. risk prioritization matrix',
          'Build / buy / skip recommendations for each candidate use case',
        ],
      },
      {
        heading: 'The honest part',
        body:
          'Most audits find that one or two opportunities are genuinely worth pursuing — and several expensive-sounding ones are not. Telling you what to skip is often the most valuable deliverable.',
      },
    ],
    deliverables: [
      'Opportunity inventory scored by impact, effort, and risk',
      '90-day action plan sequenced for quick wins first',
      'Cost estimates and tool recommendations',
      'Executive readout for you (and your leadership team, if any)',
    ],
    faq: [
      {
        q: 'How much does it disrupt our operations?',
        a: 'Minimal — a few interviews, access to some reports, and observation. Most audits complete within two weeks.',
      },
      {
        q: 'What if the audit says we are not ready?',
        a: 'Then that is the finding, and we will tell you exactly what has to be true first. We would rather lose an engagement than sell you a failure.',
      },
    ],
  },
  {
    slug: 'education',
    tag: 'Enable',
    title: 'AI Education',
    short: 'Hands-on training that turns AI skepticism into daily usage — advanced prompting, tool and skill building for real workloads.',
    intro:
      'The best AI strategy fails if the team will not use the tools. We train your people on your actual work — their emails, their reports, their spreadsheets — not generic examples from a webinar. Sessions are practical, fast, and built around your existing tools (with deep expertise across Microsoft Copilot and the broader AI landscape).',
    sections: [
      {
        heading: 'What we do',
        body: 'Training built around your real work, delivered in half-day sessions your team will not sleep through.',
        bullets: [
          'Executive briefings: what AI means for your business and industry, no hype',
          'Advanced prompting workshops — structured techniques for real tasks',
          'Tool and skill building: custom GPTs, Copilot skills, prompt libraries for your workflows',
          'Adoption programs that make usage stick after the trainer leaves',
        ],
      },
      {
        heading: 'Who it is for',
        body:
          'Skeptical teams benefit most. Sessions are safe, hands-on, and honest about what AI does badly — which, counterintuitively, is what earns trust and drives adoption.',
      },
    ],
    deliverables: [
      'Customized workshop curriculum for your roles',
      'Prompt library and skill library for your workflows',
      'Post-training proficiency checkpoints',
      'Recorded sessions for onboarding future hires',
    ],
    faq: [
      {
        q: 'Our team is not technical. Is that a problem?',
        a: 'No — sessions are designed for operational staff, not engineers. If you can write an email, you can do this.',
      },
      {
        q: 'Do you train on tools other than Microsoft Copilot?',
        a: 'Yes. Copilot is a specialty, but we work across the tools your team will actually use — including the free ones.',
      },
    ],
  },
];

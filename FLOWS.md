# Website edit QA

## Existing flows
- Home displays the four pillar cards and service links.
- Services overview links to each of the four pillar pages.
- Every service page displays its title, deliverables, FAQ disclosure, and sidebar.
- Header/footer navigate to About, Assessment, Insights, Contact, Resources, and Case Studies.
- Contact form fields remain available; do not submit live inquiries during testing.
- Assessment start and answer buttons should advance questions. Record any pre-existing failure without expanding this change.
- Booking link remains a known placeholder pending scheduler setup.

## Requested change
- /services/private-ai-custom-models/ renders a dedicated branded service page.
- Copy explicitly covers open-source models, company-data fine-tuning, local hardware, validation, governance, and handover.
- Distinguish fine-tuning from document retrieval and make privacy/deployment scope conditional.
- Preserve four pillars, with this offering under Agentic AI Solutions.
- Link from Home, Services overview, Agentic AI page, and service sidebars.
- New page CTA goes to contact, not the unresolved booking placeholder.
- Desktop and 375px: no horizontal overflow; FAQ and links work.
- No external form submission, main-branch push, or production publication during QA.

## Results
- Static build passes with 14 generated pages.
- All 12 checked existing page routes return 200 and retain their headings.
- Home and Agentic AI links open the new page; Services overview pillar link opens the correct nested route.
- New FAQ disclosure opens and project CTA navigates to Contact; contact fields accept input without submission.
- New page fits desktop and 375px; no mobile horizontal overflow.
- Corrected two adjacent existing link issues: Services overview pillar URLs and service-sidebar assessment URLs.
- Existing assessment emits `Unexpected identifier 'as'`; the current production assessment also has no rendered Start button. This predates this addition and is not repaired here.
- Existing booking placeholder and missing form-service configuration remain outside scope.

## Assessment script repair
- From the home page or header, open AI Assessment. Expect the Start the assessment button to render without a browser script error.
- Select Start the assessment. Expect Question 1 of 12, four answers, and a disabled Back button.
- Select an answer, use Back, and change the answer. Expect one question advance per selection and the latest answer to count toward the score.
- Complete all 12 questions. Expect a score, readiness band, tailored bottleneck note and three recommendations. The final answer should change the bottleneck note, not the score.
- Verify the start, question and results screens on desktop and at 375px. The optional email request must not appear when its form service is unconfigured. Do not submit anything to a live form service.

Repair QA: The static build passed. Desktop and 375px Chromium runs reached results with no script errors or horizontal overflow. Back and answer replacement worked; 100/100 and 0/100 mapped to the expected bands, and changing the last answer changed only the bottleneck note. Thirteen site routes, seven navigation links, five service FAQs, and contact inputs passed without sending any live submissions.

## Required assessment email and archive
- After answering question 12, expect a single required email field, a short archive disclosure and a See my results button. No score is displayed before saving.
- Blank and malformed emails do not submit. Back returns to question 12 and preserves the email draft during this visit.
- A successful, same-origin submission saves the email, computed result and timestamp, then shows the score and recommendations without waiting for an email.
- A failed save keeps answers and email in the form and offers a retry. Repeating an identical request does not create a second archive record.
- No public endpoint lists or reads archived submissions. Use synthetic addresses only in local QA. The review-only demo does not submit or archive email.
- Verify desktop and 375px layout and rerun site navigation, FAQ, and contact input checks.

Archive QA: Four automated tests and the Wrangler dry-run deployment passed. Desktop and 375px Chromium finished the form through the local Worker, blocked empty/malformed input, and preserved the draft through Back and a simulated save failure. Direct local KV inspection showed exactly two synthetic records after a duplicate request; GET returned 405. Thirteen routes, the 404 page, seven site navigation links, five service FAQs, and contact fields passed.

## Guided AI Diagnostic
- Open from the home page or existing assessment. Complete four questions by choosing options or typing and confirming a suggested category. Back preserves the choices; later prompts reflect earlier choices.
- Get a tailored first action before entering email. Blank emails cannot unlock the full brief; a failed save preserves the draft. A successful save shows a printable/downloadable brief and a direct, ungated worksheet link.
- Verify a manual-work scenario and a sensitive-data scenario have different actions and risk checks. Verify unrecognized or uncertain text can be classified manually and is not sent or archived.
- Confirm archive requests contain only category IDs and the required email, use a separate `diagnostic:` record prefix, and preserve the existing quiz flow and record format. The hosted demo saves nothing.
- Test desktop and 375px, keyboard controls, real download, the worksheet link, and existing route regressions without submitting to production.

Verification for the first version:

- Node 22: all seven tests passed, including the existing quiz tests. The production and preview Astro builds and the Wrangler dry run passed.
- Local Wrangler, Chromium desktop: home CTA, typed suggestion and keyboard confirmation, Back and draft preservation, first action before email, required email, simulated 503 and retry, actual Markdown download, copyable text, print layout and worksheet navigation passed.
- Hosted private demo, Chromium at 375 px: manual correction of a suggestion, sensitive-data guidance, sample email, brief, worksheet and quiz fallback passed. No horizontal overflow or POST requests were observed.
- Local KV: synthetic submissions yielded separate `assessment:` and `diagnostic:` keys. The diagnostic record contained only email, timestamp, version, category IDs and worksheet ID. No production submissions were made.

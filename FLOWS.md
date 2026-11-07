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

# Assessment archive

After question 12, visitors enter one required email address. The Cloudflare Worker checks the submission, computes the score, saves the result in a private Workers KV namespace, and then returns the score to the browser. No assessment email is sent, and there is no public archive URL or read API.

## Publish

- Cloudflare Worker: `tayloredai`. Keep the build command `npm run build` and deploy command `npx wrangler deploy`; `wrangler.jsonc` supplies the asset directory and Worker entry point. An existing `--assets ./dist` argument is compatible. The first successful Cloudflare deploy provisions or reuses the `ASSESSMENT_ARCHIVE` binding through [Wrangler automatic provisioning](https://developers.cloudflare.com/changelog/post/2025-10-24-automatic-resource-provisioning/).
- The Workers Builds API token needs **Workers KV Storage Edit**. If provisioning fails for lack of permission, update the build token in the Worker’s [build configuration](https://developers.cloudflare.com/workers/ci-cd/builds/configuration/) before retrying. Do not place credentials in source or in a public build variable.
- Keep `PUBLIC_ASSESSMENT_DEMO` unset in the production build. `PUBLIC_ASSESSMENT_DEMO=1 npm run build` creates a private review build where the sample address is neither transmitted nor saved. Production writes are limited to `tayloredai.com` and `www.tayloredai.com`; other hostnames, including Cloudflare branch previews, cannot write to the live archive.

## Find submitted results

In Cloudflare, open **Workers & Pages → tayloredai → Bindings** and find the KV namespace shown for `ASSESSMENT_ARCHIVE`. Open that namespace under **Storage & databases → Workers KV**. Records start with `assessment:` and contain a UTC timestamp, email, score, readiness band, bottleneck and assessment version. Answer-by-answer responses, IP addresses and user-agent strings are not included in the stored records. Limit namespace access to authorized account members.

The Guided AI Diagnostic uses the same namespace with a separate `diagnostic:` prefix. Its records contain the email, UTC timestamp, four selected category IDs, matched worksheet ID, and diagnostic version. Optional free text is matched in the browser and never sent. The Worker generates the brief from the same versioned content as the browser; it does not send email or store the brief or a transcript. Update `src/diagnostic.mjs` when refining recommendations, prompts, or worksheet copy. Bump `DIAGNOSTIC_VERSION` when changing category meanings or brief rules so archived submissions can be interpreted accurately.

## Test without production data

```sh
npm ci
node --test
npm run build
npx wrangler dev --var ASSESSMENT_LOCAL_DEV:1
```

Submit a synthetic `example.com` address and view the record with `npx wrangler kv key list --binding ASSESSMENT_ARCHIVE --local`. Wrangler uses local storage for this test; do not add `--remote`. No database migration is required.

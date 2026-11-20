import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';
import { assessmentPreview } from './scripts/assessment-preview.mjs';

export default defineConfig({
  site: 'https://tayloredai.com',
  base: './',
  integrations: [sitemap(), ...(process.env.PUBLIC_ASSESSMENT_DEMO === '1' ? [assessmentPreview()] : [])],
  build: {
    inlineStylesheets: 'always',
  },
});

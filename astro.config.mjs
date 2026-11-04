import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

export default defineConfig({
  site: 'https://tayloredai.com',
  base: './',
  integrations: [sitemap()],
  build: {
    inlineStylesheets: 'always',
  },
});
import { defineCollection, z } from 'astro:content';
import { glob } from 'astro/loaders';

const blog = defineCollection({
  loader: glob({ pattern: '**/*.md', base: './src/content/blog' }),
  schema: z.object({
    title: z.string(),
    description: z.string(),
    pubDate: z.coerce.date(),
    tags: z.array(z.string()).default([]),
    draft: z.boolean().default(false),
  }),
});

const caseStudies = defineCollection({
  loader: glob({ pattern: '**/*.md', base: './src/content/case-studies' }),
  schema: z.object({
    client: z.string(),
    industry: z.string(),
    summary: z.string(),
    challenge: z.string(),
    results: z.array(z.string()),
    services: z.array(z.string()).default([]),
    draft: z.boolean().default(false),
  }),
});

export const collections = { blog, caseStudies };
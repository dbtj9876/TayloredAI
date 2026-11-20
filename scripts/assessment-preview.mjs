import { readdir, readFile, writeFile } from 'node:fs/promises';
import { dirname, join, relative, sep } from 'node:path';
import { fileURLToPath } from 'node:url';

// The private review host serves individual files below a path prefix, without
// directory indexes. Keep its generated URL changes out of the production build.
export function assessmentPreview() {
  return {
    name: 'assessment-review-paths',
    hooks: {
      'astro:build:done': async ({ dir }) => {
        const root = fileURLToPath(dir);
        for (const entry of await readdir(root, { recursive: true, withFileTypes: true })) {
          if (!entry.isFile() || !entry.name.endsWith('.html')) continue;
          const file = join(entry.parentPath, entry.name);
          const depth = relative(root, dirname(file)).split(sep).filter(Boolean).length;
          const prefix = '../'.repeat(depth) || './';
          const html = await readFile(file, 'utf8');
          const portable = html
            .replace(/(<script\b[^>]*\bsrc=")\/(?:\.\/)?_astro\//g, `$1${prefix}_astro/`)
            .replace(/\bhref="((?:\.{1,2}\/)[^"?#]*?\/?)([?#][^"]*)?"/g, (match, path, suffix) =>
              path.endsWith('/') ? `href="${path}index.html${suffix ?? ''}"` : match,
            );
          if (portable !== html) await writeFile(file, portable);
        }
      },
    },
  };
}

import { describe, expect, test } from 'bun:test';
import { readFileSync } from 'node:fs';

// .htaccess caches JavaScript for 60 h, so every local script tag needs a
// ?v= cache-buster or visitors keep running the old file after a deploy.
const SHARED_INCLUDES = [
    'webSyS/includes/script.php',
    'webSyS/includes/superweek-overlay.php',
];

function localScriptSrcs(file) {
    const html = readFileSync(new URL(`../../${file}`, import.meta.url), 'utf8');
    return [...html.matchAll(/<script[^>]*\bsrc="([^"]+)"/g)]
        .map(match => match[1])
        .filter(src => !/^(https?:)?\/\//.test(src));
}

describe('local script tags carry a cache-busting version', () => {
    for (const file of SHARED_INCLUDES) {
        test(file, () => {
            const srcs = localScriptSrcs(file);
            expect(srcs.length).toBeGreaterThan(0);
            expect(srcs.filter(src => !/\?v=/.test(src))).toEqual([]);
        });
    }
});

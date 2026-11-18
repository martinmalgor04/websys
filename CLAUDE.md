# websys — agent contract

## What this is
Public website of Servicios y Sistemas: plain PHP (no framework) in `webSyS/`, plus the static `api-tango/` landing and `demo/`. No build step and no package manager.
Hosted on cPanel. Copy is Spanish and follows the `sys-brand` skill.

## Commands
- Install: none (`bash scripts/agent-setup.sh` only checks tooling).
- Test: `bun test tests/js` (front-end JS helpers; tests live outside `webSyS/` so they are never deployed). Manual check: `php -S localhost:8000 -t webSyS webSyS/router.php` and open the changed page.
- Lint/typecheck: `find webSyS demo -name '*.php' -print0 | xargs -0 -n1 php -l` (needs php-cli; may be missing on gen8).
- Build: none.
- Dev: the built-in PHP server command above; no Docker or database needed.

## Rules
- Work on a branch, never directly on main. One Conventional Commit per work unit, tests and docs in the same commit, no AI attribution lines.
- TDD: write the failing test first, then the implementation, then refactor. Never skip or delete tests to go green.
- Open a PR when done. Merge to main only if tests and lint pass and the PR has no unresolved review comments.
- Deploy only to Martín's own environments (gen8, Oracle/Dokploy). Never deploy to a client environment.
- Never read or print .env files, keys or credentials. Use fixtures for tests.
- If blocked or unsure about product intent, stop and ask; do not guess.
- Keep changes under ~400 changed lines per PR; split larger work.

## Do not touch
- `webSyS/config/*.php` and `webSyS/includes/superweek-config.php` (may hold credentials; never print values), `logs/`, `private/`.
- `api-tango/` assets are generated from `~/Developer/sys/tango-api`: never hand-edit. `webSyS/sysdesk/assets/downloads/` holds binaries.
- Server-only dirs excluded from deploy (`ecommerce/`, `php/`, `Mpago/`, `soporte/`, `photos/`, ...). Never run `scripts/deploy-api-docs.sh` (needs FTP credentials).
- `CLAUDE.md` is listed in `.gitignore`; commit it with `git add -f`.

## Deploy
Every push to `main`/`master` runs `.github/workflows/deploy-cpanel.yml` (FTPS) and publishes `webSyS/` to the live site. There are no tests, so do NOT merge: Martín reviews and merges.

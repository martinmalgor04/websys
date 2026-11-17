#!/usr/bin/env bash
# Idempotent setup for unattended agents (Orca). Safe to re-run.
set -euo pipefail
cd "$(dirname "${BASH_SOURCE[0]}")/.."

# No dependencies to install: plain PHP site, no package manager, no .env.example.
if command -v php >/dev/null; then
  echo "php found: $(php -r 'echo PHP_VERSION;')"
else
  echo "warning: php-cli not found; the syntax check below cannot run" >&2
fi

echo "Setup done. No automated tests. Syntax check:"
echo "  find webSyS demo -name '*.php' -print0 | xargs -0 -n1 php -l"

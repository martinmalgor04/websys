#!/usr/bin/env bash
# Tests for is_safe_remote_dir (scripts/lib/remote-dir.sh).
# deploy-api-docs.sh runs `lftp mirror -R --delete` against REMOTE_DIR, so any
# value that resolves to the FTP root or outside it would wipe public_html.
# Run: bash scripts/tests/remote-dir.test.sh
set -uo pipefail

# shellcheck source=../lib/remote-dir.sh
source "$(dirname "${BASH_SOURCE[0]}")/../lib/remote-dir.sh"

failures=0

expect_safe() {
    if is_safe_remote_dir "$1"; then
        printf 'ok    safe   %q\n' "$1"
    else
        printf 'FAIL  expected safe:   %q\n' "$1"; failures=$((failures + 1))
    fi
}

expect_unsafe() {
    if is_safe_remote_dir "$1"; then
        printf 'FAIL  expected unsafe: %q\n' "$1"; failures=$((failures + 1))
    else
        printf 'ok    unsafe %q\n' "$1"
    fi
}

expect_safe   "/api-tango"
expect_safe   "/public_html/api-tango"
expect_safe   "/api.docs"

expect_unsafe ""
expect_unsafe "/"
expect_unsafe "//"
expect_unsafe "api-tango"
expect_unsafe "/api-tango/"
expect_unsafe "/.."
expect_unsafe "/."
expect_unsafe "/api-tango/.."
expect_unsafe "/api-tango/../.."
expect_unsafe "/api-tango/./x"
expect_unsafe "/a//b"
expect_unsafe "/a*b"
expect_unsafe "/a?b"
expect_unsafe "/api tango"
expect_unsafe $'/api-tango\n/'

if [[ "$failures" -gt 0 ]]; then
    echo "$failures failure(s)"; exit 1
fi
echo "all passed"

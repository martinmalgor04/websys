# shellcheck shell=bash
# is_safe_remote_dir DIR — succeeds only when DIR is an absolute subfolder that
# `lftp mirror -R --delete` can target without touching the FTP root:
# one or more "/segment" parts, each made of [A-Za-z0-9._-], none equal to
# "." or "..", no trailing slash, no globs, no whitespace.
is_safe_remote_dir() {
    local dir="$1" segment segments
    [[ "$dir" =~ ^(/[A-Za-z0-9._-]+)+$ ]] || return 1
    IFS='/' read -ra segments <<< "${dir#/}"
    for segment in "${segments[@]}"; do
        [[ "$segment" != "." && "$segment" != ".." ]] || return 1
    done
}

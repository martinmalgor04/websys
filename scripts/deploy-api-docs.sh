#!/usr/bin/env bash
# =============================================================================
# deploy-api-docs.sh — Publica la documentación NO oficial de la API de Tango
# Connect en public_html/api-tango/ (subdominio api.serviciosysistemas.com.ar).
#
# Fuente de verdad: ~/Developer/sys/tango-api (se regenera con ./build.sh).
# NUNCA editar los artefactos generados desde websys.
#
# Uso:
#   FTP_HOST=... FTP_USERNAME=... FTP_PASSWORD=... ./scripts/deploy-api-docs.sh
#   ./scripts/deploy-api-docs.sh --dry-run      # todo menos la subida (sin credenciales)
#   ./scripts/deploy-api-docs.sh --skip-build   # no regenerar en tango-api
#
# Credenciales: SOLO por variables de entorno. Nunca en archivos, commits ni
# salida. La contraseña viaja a lftp por stdin (no aparece en ps ni en disco).
#
# Escaneo de seguridad: obligatorio antes de cada subida, debe dar 0
# coincidencias (ver odd/tasks/docs-api-tango.md). Si encuentra algo, aborta.
# =============================================================================
set -euo pipefail

# ---------- Config ----------
WEBSYS_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
TANGO_API_DIR="${TANGO_API_DIR:-$HOME/Developer/sys/tango-api}"
SOURCE_DIR="$WEBSYS_ROOT/api-tango"          # landing + .htaccess + assets (lo único versionado)
REMOTE_DIR="${API_DOCS_REMOTE_DIR:-/api-tango}"
SKIP_BUILD=0
DRY_RUN=0

for arg in "$@"; do
    case "$arg" in
        --skip-build) SKIP_BUILD=1 ;;
        --dry-run)    DRY_RUN=1 ;;
        -h|--help)
            sed -n '2,20p' "${BASH_SOURCE[0]}" | sed 's/^# \{0,1\}//'
            exit 0 ;;
        *) echo "Argumento desconocido: $arg (usá --help)" >&2; exit 2 ;;
    esac
done

log()  { printf '\033[1;34m==>\033[0m %s\n' "$*"; }
warn() { printf '\033[1;33m[!]\033[0m %s\n' "$*" >&2; }
die()  { printf '\033[1;31m[X]\033[0m %s\n' "$*" >&2; exit 1; }

# ---------- Validaciones iniciales ----------
[[ -d "$TANGO_API_DIR" ]] || die "No existe TANGO_API_DIR=$TANGO_API_DIR"
[[ -f "$SOURCE_DIR/index.html" ]] || die "Falta la landing en $SOURCE_DIR"

# REMOTE_DIR tiene que ser una subcarpeta (mirror --delete sobre / sería fatal)
# (rechaza también "." y "..": /api-tango/.. resolvería a la raíz)
# shellcheck source=lib/remote-dir.sh
source "$WEBSYS_ROOT/scripts/lib/remote-dir.sh"
is_safe_remote_dir "$REMOTE_DIR" || die "REMOTE_DIR inseguro: '$REMOTE_DIR'"

if [[ "$DRY_RUN" -eq 0 ]]; then
    : "${FTP_HOST:?Falta FTP_HOST (env)}"
    : "${FTP_USERNAME:?Falta FTP_USERNAME (env)}"
    : "${FTP_PASSWORD:?Falta FTP_PASSWORD (env)}"
    command -v lftp >/dev/null || die "Falta lftp (brew install lftp)"
fi

# ---------- 1) Build ----------
if [[ "$SKIP_BUILD" -eq 0 ]]; then
    log "Regenerando documentación en $TANGO_API_DIR (./build.sh, lint Redocly incluido)…"
    (cd "$TANGO_API_DIR" && ./build.sh)
else
    warn "--skip-build: se usa lo ya generado en $TANGO_API_DIR"
fi

# ---------- 2) Staging con allowlist estricta ----------
STAGING="$(mktemp -d /tmp/api-docs-staging.XXXXXX)"
ZIP_SCAN_DIR=""
cleanup() {
    # En dry-run conservamos el staging para inspección/verificación local
    if [[ "$DRY_RUN" -eq 0 ]]; then rm -rf "$STAGING"; fi
    [[ -n "$ZIP_SCAN_DIR" ]] && rm -rf "$ZIP_SCAN_DIR"
}
trap cleanup EXIT

log "Armando staging (allowlist estricta) en $STAGING"

cp "$SOURCE_DIR/index.html" "$SOURCE_DIR/404.html" "$SOURCE_DIR/.htaccess" "$STAGING/"
mkdir -p "$STAGING/assets/img" "$STAGING/general/recursos" "$STAGING/capital-humano"
cp "$SOURCE_DIR/assets/img/"* "$STAGING/assets/img/"

# Spec genérico (raíz de tango-api)
cp "$TANGO_API_DIR/openapi.json" "$TANGO_API_DIR/openapi.yaml" "$STAGING/"

# Índice por módulos + spec consolidado + swagger por recurso + zip
cp "$TANGO_API_DIR/general/index.html" "$STAGING/general/"
cp "$TANGO_API_DIR/general/openapi-general.json" "$STAGING/general/"
cp "$TANGO_API_DIR/general/recursos/swagger.html" "$STAGING/general/recursos/"
cp "$TANGO_API_DIR/general/recursos/openapi-recursos.zip" "$STAGING/general/recursos/"

# 12 módulos (allowlist por patrón: solo swagger/openapi del módulo)
MODULE_COUNT=0
for dir in "$TANGO_API_DIR"/general/*/; do
    m="$(basename "$dir")"
    [[ "$m" == "recursos" || "$m" == "data" ]] && continue
    [[ -f "$dir/swagger-$m.html" ]] || continue
    mkdir -p "$STAGING/general/$m"
    cp "$dir/swagger-$m.html" "$dir/openapi-$m.json" "$dir/openapi-$m.yaml" "$STAGING/general/$m/"
    MODULE_COUNT=$((MODULE_COUNT + 1))
done
[[ "$MODULE_COUNT" -eq 12 ]] || die "Se esperaban 12 módulos, se copiaron $MODULE_COUNT"

# Capital Humano
cp "$TANGO_API_DIR/capital-humano/swagger-capital-humano.html" \
   "$TANGO_API_DIR/capital-humano/openapi-capital-humano.json" \
   "$TANGO_API_DIR/capital-humano/openapi-capital-humano.yaml" \
   "$STAGING/capital-humano/"

FILE_COUNT="$(find "$STAGING" -type f | wc -l | tr -d ' ')"
TOTAL_SIZE="$(du -sh "$STAGING" | cut -f1)"
log "Staging listo: $FILE_COUNT archivos, $TOTAL_SIZE (12 módulos + general + recursos + capital-humano + landing)"

# ---------- 3) Escaneo de seguridad (0 coincidencias o aborta) ----------
log "Escaneo de seguridad sobre staging + contenido del zip…"

ZIP_SCAN_DIR="$(mktemp -d /tmp/api-docs-zip.XXXXXX)"
unzip -q "$STAGING/general/recursos/openapi-recursos.zip" -d "$ZIP_SCAN_DIR"

# API key del .env de tango-api: se lee sin imprimirla jamás
API_KEY=""
if [[ -f "$TANGO_API_DIR/.env" ]]; then
    API_KEY="$(sed -n 's/^TANGO_API_KEY=//p' "$TANGO_API_DIR/.env" | head -1 | tr -d "\"'" | tr -d '[:space:]')"
fi

SCAN_TARGETS=("$STAGING" "$ZIP_SCAN_DIR")
HITS=0

report_hits() { # $1 = etiqueta del patrón (segura de mostrar), $2 = lista de archivos
    local label="$1" files="$2"
    [[ -z "$files" ]] && return 0
    local n
    n="$(printf '%s\n' "$files" | wc -l | tr -d ' ')"
    warn "Patrón $label encontrado en $n archivo(s):"
    printf '%s\n' "$files" | sed 's/^/      - /' >&2
    HITS=$((HITS + n))
}

# Patrones fijos (case-insensitive). La etiqueta es segura de mostrar.
FIXED_PATTERNS=('000109-042' 'S R L Prueba' 'RUBEN' '30708592370' 'MSSQL' 'Uso interno')
for pat in "${FIXED_PATTERNS[@]}"; do
    files="$(grep -R -I -i -l -F -e "$pat" "${SCAN_TARGETS[@]}" 2>/dev/null | sort -u || true)"
    report_hits "'$pat'" "$files"
done

# API key (nunca se imprime el valor, solo la etiqueta)
if [[ -n "$API_KEY" ]]; then
    files="$(grep -R -I -F -l -e "$API_KEY" "${SCAN_TARGETS[@]}" 2>/dev/null | sort -u || true)"
    report_hits "TANGO_API_KEY (valor del .env)" "$files"
else
    warn "No se encontró TANGO_API_KEY en $TANGO_API_DIR/.env — ese chequeo quedó omitido"
fi

# Direcciones de e-mail
files="$(grep -R -I -i -l -E -e '[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}' "${SCAN_TARGETS[@]}" 2>/dev/null | sort -u || true)"
report_hits "e-mail" "$files"

# IPs privadas (10/8, 192.168/16, 172.16–31/12)
files="$(grep -R -I -l -E -e '(^|[^0-9.])(10\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}|192\.168\.[0-9]{1,3}\.[0-9]{1,3}|172\.(1[6-9]|2[0-9]|3[01])\.[0-9]{1,3}\.[0-9]{1,3})([^0-9.]|$)' "${SCAN_TARGETS[@]}" 2>/dev/null | sort -u || true)"
report_hits "IP privada" "$files"

[[ "$HITS" -eq 0 ]] || die "Escaneo de seguridad: $HITS coincidencia(s). No se sube nada. Revisar en tango-api y regenerar."

# ---------- 4) Aviso legal presente en todos los artefactos ----------
log "Verificando aviso «no avalada por Axoft» en HTML/JSON/YAML…"
MISSING=0
while IFS= read -r f; do
    case "$f" in */404.html) continue ;; esac
    if ! grep -q -i 'avalada' "$f"; then
        warn "Falta el aviso en: $f"
        MISSING=$((MISSING + 1))
    fi
done < <(find "$STAGING" \( -name '*.html' -o -name '*.json' -o -name '*.yaml' \) -type f)
[[ "$MISSING" -eq 0 ]] || die "Falta el aviso legal en $MISSING archivo(s). Corregir en tango-api y regenerar."

log "Escaneo OK: 0 coincidencias y aviso presente en todos los artefactos."

# ---------- 5) Sync FTPS ----------
if [[ "$DRY_RUN" -eq 1 ]]; then
    log "DRY-RUN: no se sube nada. Staging conservado en: $STAGING"
    log "Para verificación local:  cd \"$STAGING\" && python3 -m http.server 8642"
    exit 0
fi

log "Sincronizando por FTPS → $FTP_HOST:$REMOTE_DIR (mirror -R --delete)"
lftp <<LFTP_EOF
set ftp:ssl-force true
set ftp:ssl-protect-data true
set ssl:verify-certificate no
set cmd:fail-exit yes
set net:max-retries 2
set net:timeout 30
open -u "${FTP_USERNAME}","${FTP_PASSWORD}" "${FTP_HOST}"
mirror -R --delete --verbose --exclude-glob .DS_Store "${STAGING}/" "${REMOTE_DIR}/"
bye
LFTP_EOF

log "Deploy terminado. Verificar: https://api.serviciosysistemas.com.ar/"

# Feature: publicar documentación API Tango como parte externa de websys

Locator: `odd/tasks/docs-api-tango.md` · Engram mirror: `odd/docs-api-tango/tasks`

## Objective

Publicar la documentación de la API REST de Tango Connect (generada en `~/Developer/sys/tango-api`)
como una **parte externa de websys**, igual que `sysdesk`: carpeta propia en el hosting (`api-tango/`
en `public_html`) que el deploy principal del sitio no toca, con deploy propio por script y, si Martín
lo decide, subdominio propio. Documentación **no oficial** (no avalada por Axoft) para clientes e
integradores.

## Why

La documentación ya existe y está verificada, pero solo vive local (y una copia en el CDN público).
Publicarla bajo el dominio de SyS la hace accesible para clientes/integradores con la estética de
websys, sin arriesgar el deploy principal del sitio ni mezclar ~90 MB de artefactos generados con el
repo git.

## Constraints

- Fuente de verdad: `~/Developer/sys/tango-api` (NO es repo git). Se regenera con `./build.sh`.
  **Nunca editar a mano los generados ni modificarlos desde websys**: los cambios van en tango-api.
- **Allowlist de publicación** (nada más):
  - `general/index.html` (índice por módulos)
  - `general/<módulo>/{swagger-<módulo>.html, openapi-<módulo>.json, openapi-<módulo>.yaml}` (12 módulos)
  - `general/openapi-general.json`
  - `general/recursos/swagger.html` (~11 MB, autocontenido)
  - `general/recursos/openapi-recursos.zip` y, si Martín lo decide, `general/recursos/openapi/*.json` + `index.json`
  - `capital-humano/{swagger-capital-humano.html, openapi-capital-humano.json, .yaml}`
  - `openapi.yaml`, `openapi.json` (spec genérico)
- **Nunca publicar**: `index.html` raíz (interno), `TANGO-API-CLAUDE.md`, `CLAUDE.md`, `procesos*.json`,
  `procesos.md`, `ejemplos/`, `odd/`, `general/data/`, `research_notes/`, `reports/`, `src/`, `prompts/`,
  scripts `.py`/`.sh`, `.env`, `swagger.html` raíz.
- Enlaces relativos: `general/index.html` apunta a `../capital-humano/...` y a `../index.html` (índice
  interno, no se publica) → la raíz publicada necesita **landing propia**. Los swagger de módulo y el de
  recursos apuntan a `../index.html` (→ `general/index.html`). Verificado OK.
- Deploy principal: `.github/workflows/deploy-cpanel.yml` sube todo `webSyS/` por FTPS en push a
  `main`/`master`. Hay que agregar `api-tango/**` al `exclude` para que nunca la pise ni la borre.
- No meter los artefactos generados (~90 MB) en git.
- Credenciales (FTP, Tango) solo por variables de entorno o secrets; nunca en archivos, commits ni salida.
- **No hacer push a `main` sin OK explícito de Martín** (main despliega a producción). Trabajar en rama.
- No tocar carpetas protegidas (`ecommerce/`, `sysdesk/`, `Mpago/`, `soporte/`, etc.).

## Decisiones de Martín (tomadas 2026-10-03)

- [x] D1 · **Subdominio `api.serviciosysistemas.com.ar`** (patrón sysdesk; lo crea Martín en cPanel,
      apuntando a `public_html/api-tango/`).
- [x] D2 · **`noindex`** (meta robots en landing + `X-Robots-Tag: noindex, nofollow, noarchive` en el
      `.htaccess` de la carpeta) hasta revisión legal. Sin bloqueo por robots.txt para que Google
      pueda ver el noindex.
- [x] D3 · **Solo el `.zip`** (`general/recursos/openapi-recursos.zip`); no se publican los 1469 JSON
      sueltos (el Swagger por recurso ya permite descargar cada uno).
- [x] D4 · **Sin enlaces en websys por ahora**: acceso solo por URL directa hasta que Martín apruebe
      salir al público (después: footer "Desarrolladores" y/o sección en `tango-gestion.php`).

## Tasks

- [ ] T1 · Rama de trabajo en websys (sin push a main).
- [ ] T2 · `deploy-cpanel.yml`: agregar `api-tango/**` al `exclude`.
- [ ] T3 · `scripts/deploy-api-docs.sh`: corre/verifica `./build.sh` en tango-api, arma staging solo con
      allowlist + landing, corre escaneo de seguridad (aborta si hay coincidencias), sincroniza por FTPS
      (`lftp mirror -R --delete`) contra `public_html/api-tango/` con credenciales desde env.
- [ ] T4 · Landing `index.html` de la carpeta con estética websys (header, colores, logo de `assets/`):
      qué es, aviso de no oficial, accesos (Swagger por recurso, índice por módulos, Capital Humano,
      descargas zip/OpenAPI genérico) y cómo autenticarse (`ApiAuthorization` + `Company`, sin tokens).
- [ ] T5 · `.htaccess` de la carpeta: caché corta `.html`, larga `.json/.yaml/.zip`, `noindex` según D2;
      si es subdominio, regla en `webSyS/.htaccess` siguiendo patrón sysdesk.
- [ ] T6 · Verificación: `curl` a URLs principales (200 + content-type correcto, ojo `.yaml`);
      navegador: Swagger por recurso abre con `#p=2117` (Clientes), buscador filtra, sin errores de
      consola, aviso "No está avalada ni revisada por Axoft" visible; ningún enlace a archivos no
      publicados.

## Escaneo de seguridad obligatorio antes de cada subida (0 coincidencias)

Sobre todo lo que se sube, incluido el contenido del `.zip`:

- Valor de `TANGO_API_KEY` de `~/Developer/sys/tango-api/.env` (leerlo sin imprimirlo)
- La llave `000109-042`
- Direcciones de e-mail
- `S R L Prueba`, `RUBEN`
- IPs privadas (`10.`, `192.168.`, `172.16–31.`)
- CUIT `30708592370`
- `MSSQL`
- `Uso interno`

Además verificar que el aviso esté presente en `general/index.html`, el Swagger por recurso y los
OpenAPI.

## Progress / evidence

- 2026-10-03: contexto verificado — workflow deploy-cpanel.yml (exclude actual: ecommerce, sysdesk,
  soporte, Mpago, php, etc.), `.htaccess` con patrón sysdesk (subdominio → carpeta, quita `.php`,
  ErrorDocument, caché, `X-Frame-Options DENY`, sin CSP), `router.php` solo dev. tango-api: build.sh
  (lint Redocly incluido), 12 módulos en `general/`, `general/recursos/` (swagger.html 11.9 MB,
  zip 7.7 MB, openapi/ 1469 JSON), `capital-humano/` con sus 3 artefactos, aviso "avalada" presente en
  `general/index.html`, `recursos/swagger.html` y `openapi.yaml`. Precedente: ya se publicó una copia
  client-grade al CDN público bajo `tango-api/` (2026-10-02) tras scrub de datos reales en ejemplos
  oficiales.
- 2026-10-03: task creada. Decisiones D1–D4 tomadas por Martín (ver arriba).
- 2026-10-03: T1–T5 implementados en rama `feat/docs-api-tango`:
  - `deploy-cpanel.yml`: `api-tango/**` agregado al exclude.
  - `webSyS/.htaccess`: regla subdominio `api.serviciosysistemas.com.ar` → `/api-tango/` (patrón sysdesk).
  - `api-tango/` en raíz del repo (solo fuentes versionadas): landing `index.html` (estética SyS:
    hero oscuro, borde superior 6px azul eléctrico, Montserrat, logo blanco de `assets/`, badge
    "Documentación no oficial: no está avalada ni revisada por Axoft", 3 stat cards, 4 cards, sección
    auth con `ApiAuthorization` + `Company` y placeholders, sin emails ni tokens), `404.html`,
    `.htaccess` (Options -Indexes, AddType application/yaml, X-Robots-Tag noindex/nofollow/noarchive,
    caché 600s HTML / 1 semana JSON-YAML / 30 días zip, deflate, ErrorDocument 404), assets (logo w
    png+webp, favicon).
  - `scripts/deploy-api-docs.sh`: build (o --skip-build) → staging allowlist estricta en mktemp →
    escaneo (API key del .env sin imprimir, llave 000109-042, emails, 'S R L Prueba', RUBEN, IPs
    privadas, CUIT 30708592370, MSSQL, 'Uso interno'; zip descomprimido incluido) → check aviso en
    todos los HTML/JSON/YAML → `lftp mirror -R --delete` por stdin (password nunca en ps/disco) contra
    /api-tango. Flags: --dry-run, --skip-build. Guardas: REMOTE_DIR no puede ser /, 12 módulos
    obligatorios, credenciales solo por env.
  - Bug encontrado y corregido en el script: grep sin coincidencias + pipefail abortaba el escaneo, y
    el contador de hits en subshell de pipeline se perdía → reestructurado (resultado por argumento).
- 2026-10-03: T6 verificación local sobre staging (`--dry-run --skip-build`): 51 archivos / 51 MB,
  escaneo 0 coincidencias, aviso presente en los 39 artefactos + landing. curl: 18 URLs 200 con
  content-type correcto (yaml → application/yaml). Enlaces de la landing y de general/index.html: todos
  a archivos publicados. Navegador (subagente): 14/14 OK — #p=2117 abre "Ventas › Clientes 2117" con
  CRUD completo, buscador "proveedores" → 46, aviso visible, consola limpia, landing con todos los
  elementos, /general/ lista 12 módulos y "volver" → landing. Screenshots verificadas.

## Next step

Martín: (1) crear subdominio `api.serviciosysistemas.com.ar` en cPanel apuntando a
`public_html/api-tango`; (2) correr `FTP_HOST=... FTP_USERNAME=... FTP_PASSWORD=...
./scripts/deploy-api-docs.sh` (sin flags: regenera con build.sh antes de subir); (3) verificación
post-deploy con curl contra las URLs reales (content-type de .yaml en Apache) y navegador;
(4) cuando apruebe salir al público: quitar noindex y agregar enlaces (footer "Desarrolladores" /
`tango-gestion.php`). Push de la rama y merge a `main` solo con OK explícito.

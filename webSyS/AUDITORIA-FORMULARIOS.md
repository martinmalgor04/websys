# Auditoría de Formularios — webSyS (serviciosysistemas.com.ar)

> Auditoría en curso vía `/loop`. Este archivo es el estado persistente:
> cada tick del loop lee la sección **Estado**, audita el siguiente ítem
> pendiente y actualiza este archivo. Cuando el checklist esté completo,
> se compila la **Matriz final de formatos** y el loop se detiene.

Iniciada: 2026-10-02 22:30 (UTC-3)

---

## Estado de la auditoría

- [x] Inventario de formularios y mecanismos de envío
- [x] Pipeline A: `index.php` → FormSubmit (hallazgos iniciales)
- [x] Pipeline B: `enviar-datacenter.php` (endpoint PHP `mail()`)
- [x] Componente compartido `includes/components/cult-cta-form.php`
- [x] F2: form inline de `datacenter.php` (línea 353) — comparar campos vs componente
- [x] F3–F9: `asunto_options` de cada `renderCultCtaForm()` (7 páginas relevadas)
- [x] JS de `index.php` líneas 550–660 (fetch a FormSubmit, sin `_next`, mensaje inline)
- [x] Infra parcial: `config/env.php` + `validator.php` auditados
- [x] `sysdesk/*`, `pronto.php`, `deploy-check.html`: sin formularios ✓
- [x] JS de submit de `datacenterForm` en páginas de producto → **H10 (grave)**
- [x] `check-tango.php`: es script de diagnóstico, no una página con form → **H13**
- [x] Infra restante: `csrf.php` ✓, `rate-limiter.php` ✓, `.env` (MAIL_*) → **H11, H12**
- [x] Matriz final de formatos de mail + recomendación de unificación

**AUDITORÍA COMPLETA — loop detenido (2026-10-02 22:40 UTC-3)**

---

## Hallazgos (tick 2)

### H10 — GRAVE: los forms de las 7 páginas de producto no tienen handler JS
El listener de submit de `datacenterForm` existe solo en `datacenter.php`.
`sys-forms.js` define `SysFormHandler` pero nadie llama a `initPHP()`; `cult.js`
y `sys.bundle.min.js` no tocan el form. Consecuencias en tango-*.php y gestion-it.php:
- Submit **HTML nativo** → el endpoint responde JSON → el usuario ve una
  **pantalla en blanco con JSON crudo** (`{"success":true,...}` o el error 400).
- El form tiene `novalidate` → **cero validación client-side**.
- Sin redirect a `gracias.html`.
(Los mails igual se envían — por eso llegan — pero la UX está rota.)

### H11 — Dos casillas destino distintas según el pipeline
`.env` NO define `MAIL_TO` → Pipeline B usa el default hardcodeado
`daniel@serviciosysistemas.com.ar`. FormSubmit (home) manda a
`info@serviciosysistemas.com.ar` (FORMSUBMIT_EMAIL en `config/config.php`).
Las consultas se reparten entre dos casillas sin criterio.

### H12 — Razón social incorrecta en los mails
`.env`: `MAIL_FROM_NAME="Servicios y Sistemas SA"` → la empresa es **SRL**.
Todos los mails del Pipeline B (incluida la auto-respuesta al cliente) llevan
la razón social equivocada en el From.

### H13 — Archivos de debug expuestos en producción
`check-tango.php` (display_errors=1, expone rutas y errores) y
`deploy-check.html` son accesibles públicamente. `APP_ENV=production` pero
estos archivos quedaron del deploy.

### Infra (tick 2)
- `csrf.php`: sesión httponly+secure+samesite=Strict, tokens por acción con
  expiración 1h. Sólido.
- `rate-limiter.php`: basado en archivos en `LOG_DIR/rate_limit` protegido con
  .htaccess; 3 intentos/hora para `contact_form`. Sólido.

---

## Matriz final de formatos de mail

| Origen | Pipeline | Casilla | Asunto | Cuerpo | Auto-resp. | UX post-envío |
|---|---|---|---|---|---|---|
| Home (`index.php`) | FormSubmit | info@ | "Nueva consulta desde Servicios y Sistemas" | Tabla HTML externa (`_template=table`) | ❌ | Mensaje inline |
| `datacenter.php` | PHP `mail()` | daniel@ | `Consulta Datacenter - {asunto} - {nombre}` | Texto plano "NUEVA CONSULTA - DATACENTER" | ✅ | Redirect `gracias.html` |
| 7 páginas producto | PHP `mail()` | daniel@ | idem (prefijo "Datacenter" aunque sea Tango/IT) | Texto plano idem | ✅ | **JSON crudo en pantalla** |

## Recomendaciones (priorizadas)

1. **Unificar todo al pipeline PHP propio.** Migrar `index.php` de FormSubmit a
   `enviar-datacenter.php` (renombrarlo `enviar-consulta.php`). Un solo formato
   de mail, una sola casilla, seguridad y auto-respuesta para todos.
2. **Campo oculto `origen`** en cada form (home / datacenter / tango-gestion / …)
   y usarlo en el subject: `Consulta web - {origen} - {asunto} - {nombre}`.
   Elimina el "Datacenter" hardcodeado.
3. **Inicializar el handler JS en todas las páginas** (una línea por página o
   auto-init en el componente): `SysFormHandler.initPHP('datacenterForm', ...)`.
   Arregla H10 (JSON crudo) y habilita validación + redirect a `gracias.html`.
4. **Fix H6**: agregar `required minlength="10"` al textarea de `datacenter.php`.
5. **Definir `MAIL_TO` en `.env`** (decidir casilla única) y corregir
   `MAIL_FROM_NAME` a "Servicios y Sistemas SRL".
6. **Quitar de producción** `check-tango.php` y `deploy-check.html`.
7. Opcional: plantilla HTML branded para los mails del pipeline unificado
   (hoy son texto plano; los de FormSubmit eran los únicos "lindos").

---

## Inventario (tick 0)

| # | Página / origen | Form ID | Mecanismo | Destino del mail |
|---|---|---|---|---|
| F1 | `index.php` (home, sección contacto) | `contactForm` | **FormSubmit.co** (servicio externo, `_template=table`) | `info@serviciosysistemas.com.ar` (FORMSUBMIT_EMAIL) |
| F2 | `datacenter.php` (form inline propio) | `datacenterForm` | PHP `mail()` vía `enviar-datacenter.php` | `MAIL_TO` (default `daniel@serviciosysistemas.com.ar`) |
| F3–F9 | 8 páginas que usan `renderCultCtaForm()` | `datacenterForm` (mismo ID en todas) | PHP `mail()` vía `enviar-datacenter.php` | idem |

Páginas con el componente compartido: `tango-gestion.php`, `tango-punto-de-venta.php`,
`tango-resto.php`, `tango-estudios-contables.php`, `tango-capital-humano.php`,
`tango-delta.php`, `gestion-it.php`, `check-tango.php`.

## Hallazgos (tick 0)

### H1 — CAUSA RAÍZ de los formatos distintos: dos pipelines de envío conviviendo
- **Pipeline A (FormSubmit)**: el mail lo genera el servicio externo con su plantilla
  HTML "table". Asunto fijo: "Nueva consulta desde Servicios y Sistemas".
- **Pipeline B (PHP `mail()`)**: el mail lo arma `enviar-datacenter.php` en texto plano:
  `NUEVA CONSULTA - DATACENTER` + lista de campos. Asunto: `Consulta Datacenter - {asunto} - {nombre}`.
- Resultado: los mails de la home llegan en HTML con formato tabla de FormSubmit;
  los del resto del sitio llegan en texto plano. Formatos visualmente incompatibles.

### H2 — El asunto del Pipeline B miente sobre el origen
`enviar-datacenter.php` hardcodea "Consulta Datacenter" y "NUEVA CONSULTA - DATACENTER"
aunque el form venga de Tango Restó, Gestión IT o Capital Humano. No hay campo oculto
de origen/página → imposible filtrar por producto desde el mail.

### H3 — Seguridad asimétrica entre pipelines
- Pipeline B: CSRF + rate limit (3/hora por IP) + validación + sanitizado + logging. Sólido.
- Pipeline A (FormSubmit): sin CSRF propio, sin rate limit propio, `_captcha=false`,
  solo honeypot `_honey`. Depende 100% de FormSubmit.

### H4 — Doble notificación solo en Pipeline B
`enviar-datacenter.php` manda mail interno + auto-respuesta al cliente.
FormSubmit no manda auto-respuesta (no se configuró `_autoresponse`).

### H5 — `sys-forms.js` es código muerto en la práctica
Provee `initEmailJS` e `initPHP`, pero ningún form del sitio los invoca
(no hay `SysFormHandler.init*` fuera de su propia definición). EmailJS no se usa.
El manejo de ambos forms está inline en cada página (duplicación).

---

## Hallazgos (tick 1)

### H6 — BUG: validación cliente/servidor desalineada en `datacenter.php`
El form inline de `datacenter.php` (línea ~413) tiene el textarea `mensaje`
**sin `required` ni `minlength`**, pero `InputValidator::validateContactForm()`
exige mensaje de 10–2000 caracteres. Resultado: el usuario puede enviar el form
sin mensaje y recibe un 400 "Datos del formulario inválidos" sin haber tenido
ninguna indicación previa. El componente `cult-cta-form.php` sí tiene
`required minlength="10"` → comportamiento inconsistente entre páginas.

### H7 — Redirect post-envío inconsistente
`datacenter.php` redirige a `gracias.html` tras el éxito (línea 564).
`index.php` (FormSubmit) se queda en la página con mensaje inline (no usa `_next`).
Falta verificar qué hacen las 7 páginas de producto (¿tienen JS inline propio?).

### H8 — `asunto` como identificador de producto (frágil)
Cada página de producto setea `asunto_default` (TANGO RESTO, TANGO PUNTO DE VENTA,
TANGO GESTIÓN, TANGO ESTUDIOS CONTABLES, TANGO CAPITAL HUMANO, TANGO DELTA 6,
GESTIÓN IT). El subject del mail queda `Consulta Datacenter - {asunto} - {nombre}`.
El producto solo se identifica si el usuario no cambia el select — y siempre
con el prefijo engañoso "Datacenter".

### H9 — FormSubmit sin auto-respuesta ni redirect branded
`index.php` no configura `_autoresponse` ni `_next`. El cliente que consulta
desde la home no recibe email de confirmación (en Pipeline B sí).

### Infra auditada (tick 1)
- `config/env.php`: carga `.env`, exige `APP_SALT` (≥32 chars, no default),
  `ALLOWED_ORIGINS`, `LOG_DIR`. CORS restrictivo. Bien.
- `validator.php`: validación robusta (nombre, email, teléfono, empresa,
  mensaje), sanitizado anti-XSS y anti-inyección de headers. Bien.
  → Confirma H6: el servidor exige `mensaje` aunque el form inline no.
- `sysdesk/`, `pronto.php`, `deploy-check.html`: sin formularios.
- `gracias.html`: landing de agradecimiento, solo la usa `datacenter.php`.

---

## Matriz final de formatos de mail
_(pendiente — se compila al completar el checklist)_

## Recomendaciones
_(pendiente)_

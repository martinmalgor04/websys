<?php
/**
 * SysDesk - Página de descarga del sistema de soporte remoto
 * Dominio: sysdesk.serviciosysistemas.com.ar
 */

$is_subdomain = (strpos($_SERVER['HTTP_HOST'] ?? '', 'sysdesk.') === 0);

$main_site_url = 'https://serviciosysistemas.com.ar';
$main_assets   = $is_subdomain ? $main_site_url . '/assets/' : '../assets/';
$local_assets  = 'assets/';

$config_path = $is_subdomain ? dirname(__DIR__) . '/' : '../';
require_once $config_path . 'config/config.php';
require_once $config_path . 'includes/functions.php';
require_once $config_path . 'includes/cult-components.php';

$page_title       = 'SysDesk - Sistema de Soporte Remoto';
$meta_description = 'Descargá SysDesk, nuestra herramienta de soporte remoto para asistencia técnica rápida y segura.';
$meta_keywords    = 'sysdesk, soporte remoto, asistencia técnica, servicios y sistemas';
$body_id          = 'sysdesk';
$canonical_url    = 'https://sysdesk.serviciosysistemas.com.ar';
$download_url     = 'download.php';
$og_image         = $canonical_url . '/' . $local_assets . 'img/sysdeskw.webp';

$root             = $is_subdomain ? dirname(__DIR__) : realpath(__DIR__ . '/..');
$cultCssFile      = $root . '/assets/css/cult.css';
$cultJsFile       = $root . '/assets/js/cult.js';
$sysdeskCssFile   = __DIR__ . '/assets/css/sysdesk.css';
$poppinsCssFile   = __DIR__ . '/assets/css/poppins.css';
$cultVer          = file_exists($cultCssFile) ? (int) @filemtime($cultCssFile) : time();
$cultJsVer        = file_exists($cultJsFile) ? (int) @filemtime($cultJsFile) : time();
$sysdeskVer       = file_exists($sysdeskCssFile) ? (int) @filemtime($sysdeskCssFile) : time();
$poppinsVer       = file_exists($poppinsCssFile) ? (int) @filemtime($poppinsCssFile) : time();

if (!function_exists('sd_icon')) {
    function sd_icon(string $name, string $class = ''): string
    {
        $cls = 'sd-icon' . ($class !== '' ? ' ' . htmlspecialchars($class, ENT_QUOTES, 'UTF-8') : '');
        return '<svg class="' . $cls . '" aria-hidden="true"><use href="assets/icons.svg#'
            . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '"></use></svg>';
    }
}

$partner_logos = [
    ['src' => $main_assets . 'img/partners/clients/sanatoriodelnorte.jpeg', 'alt' => 'Sanatorio del Norte', 'width' => 120, 'height' => 40],
    ['src' => $main_assets . 'img/partners/clients/playadito.webp',         'alt' => 'Playadito',           'width' => 120, 'height' => 40],
    ['src' => $main_assets . 'img/partners/clients/bancoctes.webp',         'alt' => 'Banco de Corrientes', 'width' => 120, 'height' => 40],
    ['src' => $main_assets . 'img/partners/clients/shonko-sa_li1.webp',    'alt' => 'Shonko',              'width' => 120, 'height' => 40],
];

header('X-Robots-Tag: noindex, nofollow');
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta name="robots" content="noindex, nofollow">
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">

    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($canonical_url) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($og_image) ?>">

    <link rel="icon" href="<?= $local_assets ?>img/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="<?= $local_assets ?>img/favicon-32.png" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="<?= $local_assets ?>img/apple-touch-icon.png">

    <link rel="preload" href="<?= $local_assets ?>fonts/poppins-latin-400-normal.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="<?= $local_assets ?>img/sysdeskw.webp" as="image" type="image/webp" fetchpriority="high">

    <style>
      @font-face{font-family:'Poppins';font-style:normal;font-weight:400;font-display:swap;src:url('<?= $local_assets ?>fonts/poppins-latin-400-normal.woff2') format('woff2')}
      *,*::before,*::after{box-sizing:border-box}
      body{margin:0;font-family:'Poppins',system-ui,sans-serif;-webkit-font-smoothing:antialiased;background:#fff;color:#212529}
      [data-bs-theme="dark"] body{background:#060e1f;color:#eef0f7}
    </style>

    <link rel="stylesheet" href="<?= $local_assets ?>css/poppins.css?v=<?= $poppinsVer ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $main_assets ?>css/cult.css?v=<?= $cultVer ?>">
    <link rel="stylesheet" href="<?= $local_assets ?>css/sysdesk.css?v=<?= $sysdeskVer ?>">

    <script>
        (function () {
            'use strict';
            var mq = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)');
            var theme = mq && mq.matches ? 'dark' : 'light';
            document.documentElement.setAttribute('data-bs-theme', theme);
            document.documentElement.style.colorScheme = theme;
            document.documentElement.classList.add(theme + '-mode');
            if (mq && mq.addEventListener) {
                mq.addEventListener('change', function (e) {
                    var t = e.matches ? 'dark' : 'light';
                    document.documentElement.setAttribute('data-bs-theme', t);
                    document.documentElement.style.colorScheme = t;
                    document.documentElement.classList.remove('dark-mode', 'light-mode');
                    document.documentElement.classList.add(t + '-mode');
                });
            }
        })();
    </script>
</head>
<body id="<?= htmlspecialchars($body_id) ?>">

<main>

    <!-- Hero -->
    <section class="position-relative overflow-hidden cult-page-header cult-mesh-bg cult-mesh-bg--blue text-white sd-hero">
        <div class="cult-hero-grid" aria-hidden="true"></div>
        <span class="cult-blob" style="top:-15%;right:-10%;opacity:0.3" aria-hidden="true"></span>
        <span class="cult-blob" style="bottom:-20%;left:-15%;width:30rem;height:30rem;background:#fff;opacity:0.08;animation-delay:-6s" aria-hidden="true"></span>

        <div class="sd-container position-relative">
            <div class="text-center mx-auto" style="max-width:40rem">

                    <picture>
                        <source type="image/webp"
                                srcset="<?= $local_assets ?>img/sysdeskw.webp 1x, <?= $local_assets ?>img/sysdeskw@2x.webp 2x">
                        <img src="<?= $local_assets ?>img/sysdeskw.png"
                             alt="SysDesk"
                             class="sd-hero__logo mb-4"
                             width="400"
                             height="400"
                             fetchpriority="high"
                             decoding="async">
                    </picture>

                    <p class="sd-hero__lede mb-5">
                        Soporte remoto rápido y seguro para tu empresa.<br>
                        Conectate con nuestro equipo técnico en segundos.
                    </p>

                    <div class="sd-cta-row mb-4">
                        <a href="<?= htmlspecialchars($download_url) ?>"
                           class="btn cult-btn-primary cult-btn-shimmer btn-lg px-5">
                            <?= sd_icon('download') ?> Descargar SysDesk
                        </a>
                        <a href="#como-usar" class="btn cult-btn-glass btn-lg px-5">
                            <?= sd_icon('info-circle') ?> Cómo usar
                        </a>
                    </div>

                    <div class="sd-hero__meta">
                        <span><?= sd_icon('windows') ?> Windows</span>
                        <span><?= sd_icon('download') ?> Fácil instalación</span>
                        <span><?= sd_icon('check-shield') ?> Soporte seguro</span>
                    </div>
            </div>
        </div>
    </section>

    <!-- Pasos -->
    <section id="como-usar" class="sd-section sd-section--muted">
        <div class="sd-container">
            <header class="sd-section__header sd-reveal">
                <span class="cult-section-eyebrow d-block mb-3">Guía rápida</span>
                <h2 class="cult-display cult-display--lg mb-3">¿Cómo funciona?</h2>
                <p class="text-muted lead mb-0">Conectate con nuestro soporte técnico en cuatro simples pasos</p>
            </header>

            <div class="sd-steps-grid sd-reveal">
                <article class="sd-step-card">
                    <div class="sd-step-card__num">1</div>
                    <h3 class="sd-step-card__title">Descargá el programa</h3>
                    <p class="sd-step-card__text">Hacé clic en el botón de descarga para obtener SysDesk.</p>
                </article>
                <article class="sd-step-card">
                    <div class="sd-step-card__num">2</div>
                    <h3 class="sd-step-card__title">Instalá SysDesk</h3>
                    <p class="sd-step-card__text">Ejecutá el instalador y seguí los pasos. <strong>Es necesario instalar para recibir soporte.</strong></p>
                </article>
                <article class="sd-step-card">
                    <div class="sd-step-card__num">3</div>
                    <h3 class="sd-step-card__title">Abrí SysDesk</h3>
                    <p class="sd-step-card__text">Una vez instalado, abrí el programa desde el escritorio o menú inicio.</p>
                </article>
                <article class="sd-step-card">
                    <div class="sd-step-card__num">4</div>
                    <h3 class="sd-step-card__title">Compartí tu código</h3>
                    <p class="sd-step-card__text">Se mostrará un código en pantalla. Pasáselo a nuestro técnico.</p>
                </article>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="sd-section sd-section--white">
        <div class="sd-container">
            <div class="sd-features sd-reveal">
                <div class="sd-feature">
                    <div class="sd-feature__icon"><?= sd_icon('lock-alt', 'sd-icon--lg') ?></div>
                    <h3 class="sd-feature__title">Conexión segura</h3>
                    <p class="sd-feature__text">Encriptación de extremo a extremo</p>
                </div>
                <div class="sd-feature">
                    <div class="sd-feature__icon"><?= sd_icon('timer', 'sd-icon--lg') ?></div>
                    <h3 class="sd-feature__title">Rápido</h3>
                    <p class="sd-feature__text">Conexión instantánea sin esperas</p>
                </div>
                <div class="sd-feature">
                    <div class="sd-feature__icon"><?= sd_icon('check-shield', 'sd-icon--lg') ?></div>
                    <h3 class="sd-feature__title">Fácil de usar</h3>
                    <p class="sd-feature__text">Instalación simple y rápida</p>
                </div>
                <div class="sd-feature">
                    <div class="sd-feature__icon"><?= sd_icon('support', 'sd-icon--lg') ?></div>
                    <h3 class="sd-feature__title">Soporte experto</h3>
                    <p class="sd-feature__text">Equipo técnico certificado</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA + Partners -->
    <section class="sd-section sd-section--muted">
        <div class="sd-container">
            <div class="text-center sd-reveal">
                <span class="cult-section-eyebrow d-block mb-3">Confianza</span>
                <p class="sd-partners-label">Empresas que confían en nuestro soporte</p>
                <div class="sd-partners-wrap">
                    <?= cultMarquee($partner_logos, 'partners') ?>
                </div>
            </div>

            <div class="text-center sd-reveal">
                <h2 class="cult-display cult-display--md mb-3">¿Listo para recibir soporte?</h2>
                <p class="lead text-muted mb-4 mx-auto" style="max-width:32rem">
                    Descargá SysDesk ahora y conectate con nuestro equipo técnico en segundos.
                </p>
                <a href="<?= htmlspecialchars($download_url) ?>"
                   class="btn cult-btn-primary cult-btn-shimmer btn-lg px-5">
                    <?= sd_icon('download') ?> Descargar SysDesk
                </a>
            </div>
        </div>
    </section>

</main>

<footer class="sd-footer sd-section">
    <div class="sd-container">
        <div class="sd-footer__inner">
            <div>
                <picture>
                    <source type="image/webp" srcset="<?= $local_assets ?>img/sysdes.webp">
                    <img src="<?= $local_assets ?>img/sysdes.png"
                         alt="SysDesk"
                         class="sd-footer__logo mb-2"
                         width="120"
                         height="120"
                         loading="lazy"
                         decoding="async">
                </picture>
                <p class="text-muted small mb-0">
                    Una herramienta de <a href="https://serviciosysistemas.com.ar" target="_blank" rel="noopener">Servicios y Sistemas</a>
                </p>
            </div>
            <div class="sd-footer__contact">
                <p class="mb-1">
                    <?= sd_icon('phone') ?>
                    <a href="tel:+543794260022">+54 379 426-0022</a>
                </p>
                <p class="text-muted small mb-0">&copy; <?= date('Y') ?> Servicios y Sistemas SRL</p>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="sd-to-top" aria-label="Volver arriba" hidden>
    <?= sd_icon('chevron-up') ?>
</a>

<script src="<?= $main_assets ?>js/cult.js?v=<?= $cultJsVer ?>" defer></script>
<script defer>
(function () {
    'use strict';

    /* Reveal on scroll */
    var els = document.querySelectorAll('.sd-reveal');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (!e.isIntersecting) return;
                e.target.classList.add('is-visible');
                io.unobserve(e.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        els.forEach(function (el) { io.observe(el); });
    } else {
        els.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* Back to top */
    var topBtn = document.querySelector('.sd-to-top');
    if (topBtn) {
        topBtn.removeAttribute('hidden');
        window.addEventListener('scroll', function () {
            topBtn.classList.toggle('is-visible', window.scrollY > 400);
        }, { passive: true });
        topBtn.addEventListener('click', function (e) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
})();
</script>
</body>
</html>

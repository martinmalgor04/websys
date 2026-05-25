<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/config/site.php';
require_once __DIR__ . '/config/seo.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/icon.php';
require_once __DIR__ . '/includes/components.php';

$product = $tango_products['gestion'];

$page_title = $product['name'];
$meta_description = $product['meta_desc'];
$meta_keywords = 'tango gestion, erp, software gestion empresarial, facturacion, stock, contabilidad';
$body_id = 'product-gestion';
$canonical_url = SITE_URL . '/tango-gestion';

$schemas = [
    generateProductSchema(
        $product['name'],
        $product['meta_desc'],
        $canonical_url,
        SITE_URL . '/assets/img/productos/logogestion.png'
    ),
    generateBreadcrumbSchema([
        ['name' => 'Inicio', 'url' => SITE_URL],
        ['name' => 'Productos', 'url' => SITE_URL . '/#product'],
        ['name' => $product['name']],
    ]),
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

<main id="main-content">

    <!-- ═══════ HERO PRODUCTO ═══════ -->
    <section class="hero hero--product" aria-label="<?= e($product['name']) ?>">
        <div class="hero-grid-bg" aria-hidden="true"></div>
        <div class="container">
            <nav class="breadcrumb reveal" aria-label="Breadcrumb">
                <a href="index.php">Inicio</a>
                <span class="breadcrumb__sep" aria-hidden="true">/</span>
                <a href="index.php#product">Productos</a>
                <span class="breadcrumb__sep" aria-hidden="true">/</span>
                <span aria-current="page"><?= e($product['name']) ?></span>
            </nav>

            <div class="split">
                <div class="hero__content">
                    <span class="hero__badge hero__badge--animated reveal">
                        <?= icon('briefcase', 14) ?>
                        ERP <span class="shimmer-text">Integral</span>
                    </span>
                    <h1 class="hero__title reveal" style="font-size: var(--text-4xl);">
                        <?= e($product['name']) ?>
                    </h1>
                    <p class="hero__subtitle reveal">
                        <?= e($product['short_desc']) ?>
                        Administrá ventas, compras, stock, contabilidad, tesorería y sueldos
                        en una sola plataforma integrada.
                    </p>
                    <div class="hero__actions reveal">
                        <a href="<?= generateWhatsAppLink('Hola, me interesa Tango Gestión. ¿Podrían darme más información?') ?>"
                           class="btn btn--primary btn--lg btn--shimmer"
                           target="_blank"
                           rel="noopener noreferrer">
                            Solicitar demo
                        </a>
                        <a href="#modulos" class="btn btn--ghost btn--lg">
                            Ver módulos
                        </a>
                    </div>
                </div>
                <div class="reveal text-center">
                    <motion-tilt max-tilt="6" speed="400">
                        <img src="<?= asset('img/productos/logogestion.png') ?>"
                             alt="Logo <?= e($product['name']) ?>"
                             width="320" height="120"
                             loading="eager" decoding="async"
                             style="max-width: 20rem; margin-inline: auto;">
                    </motion-tilt>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ MÓDULOS ═══════ -->
    <section id="modulos" class="section" aria-label="Módulos de <?= e($product['name']) ?>">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="reveal">Todo lo que necesitás, integrado</h2>
                <p class="reveal text-lg text-secondary mx-auto" style="max-width: 45ch;">
                    Cada módulo trabaja en conjunto para darte una visión completa de tu negocio
                </p>
            </div>
            <div class="grid grid--3 stagger modules-snap">
                <?php foreach ($product['modules'] as $module): ?>
                <motion-tilt max-tilt="4" speed="400">
                    <div class="module-card reveal">
                        <div class="module-card__icon">
                            <?= icon($module['icon'], 20) ?>
                        </div>
                        <h3 class="module-card__title"><?= e($module['name']) ?></h3>
                        <p class="module-card__desc"><?= e($module['desc']) ?></p>
                    </div>
                </motion-tilt>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- ═══════ EDITORIAL ═══════ -->
    <section class="section section--warm content-auto" aria-label="Por qué Tango Gestión">
        <div class="container container--narrow">
            <div class="stack stack--xl text-center">
                <h2 class="reveal font-display">
                    El software que eligen miles de empresas argentinas
                </h2>
                <p class="reveal text-lg leading-relaxed mx-auto text-secondary" style="max-width: 55ch;">
                    Tango Gestión es la plataforma ERP más utilizada en Argentina. Con más de 30 años
                    de desarrollo continuo, ofrece la robustez y flexibilidad que tu empresa necesita
                    para competir en el mercado actual.
                </p>
                <div class="grid grid--3 stagger" style="margin-top: var(--space-8);">
                    <?= renderStatNumber('100', 'Legislación argentina', '', '%', true) ?>
                    <?= renderStatNumber('6',   'Módulos integrados',   '', '', true) ?>
                    <?= renderStatNumber('24/7','Soporte técnico',      '', '', false) ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ FEATURES ═══════ -->
    <section class="section content-auto" aria-label="Características">
        <div class="container">
            <div class="split">
                <div class="stack stack--lg">
                    <h2 class="reveal">¿Por qué elegir Tango Gestión?</h2>
                    <div class="stack stack--md">
                        <?php
                        $benefits = [
                            ['icon' => 'check', 'title' => 'Facturación electrónica AFIP', 'desc' => 'Integración nativa con los servicios de facturación electrónica de AFIP.'],
                            ['icon' => 'check', 'title' => 'Multi-empresa y multi-sucursal', 'desc' => 'Administrá múltiples empresas y sucursales desde una sola instalación.'],
                            ['icon' => 'check', 'title' => 'Reportes en tiempo real', 'desc' => 'Tableros de control con información actualizada para la toma de decisiones.'],
                            ['icon' => 'check', 'title' => 'Integraciones', 'desc' => 'Conectá con Mercado Pago, Tienda Nube, y más plataformas de e-commerce.'],
                        ];
                        foreach ($benefits as $i => $b): ?>
                        <div class="cluster reveal reveal-delay-<?= $i + 1 ?>" style="gap: var(--space-4); align-items: flex-start;">
                            <div class="pulse-icon"
                                 style="flex-shrink: 0; width: 2rem; height: 2rem; display: flex; align-items: center; justify-content: center; background: var(--color-primary-light); border-radius: var(--radius-sm); color: var(--color-primary);">
                                <?= icon($b['icon'], 16) ?>
                            </div>
                            <div>
                                <strong style="display: block; margin-bottom: var(--space-1);"><?= e($b['title']) ?></strong>
                                <span class="text-sm text-secondary"><?= e($b['desc']) ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="reveal text-center">
                    <motion-tilt max-tilt="5" speed="400">
                        <img src="<?= asset('img/productos/logogestionw.png') ?>"
                             alt="<?= e($product['name']) ?> interfaz"
                             width="400" height="300"
                             loading="lazy" decoding="async"
                             class="img-rounded"
                             style="max-width: 22rem; margin-inline: auto; background: var(--color-bg-dark); padding: var(--space-8); border-radius: var(--radius-xl);">
                    </motion-tilt>
                </div>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

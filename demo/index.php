<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');

require_once __DIR__ . '/config/site.php';
require_once __DIR__ . '/config/seo.php';
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/icon.php';
require_once __DIR__ . '/includes/product-card.php';
require_once __DIR__ . '/includes/components.php';

$page_title = 'Inicio';
$meta_description = SITE_NAME . ' — Soluciones tecnológicas integrales para empresas en Corrientes, Argentina. Distribuidores oficiales de Tango Software, Datacenter y Gestión IT. Más de ' . SITE_YEARS_EXPERIENCE . ' años de experiencia.';
$meta_keywords = 'servicios y sistemas, tango software, erp, datacenter, gestion it, corrientes, argentina';
$body_id = 'home';
$canonical_url = SITE_URL;
$lcp_image = asset('img/slider/1.webp');

$schemas = [
    generateLocalBusinessSchema(),
    generateFAQSchema($home_faqs),
];

require __DIR__ . '/includes/head.php';
require __DIR__ . '/includes/header.php';
?>

<main id="main-content">

    <!-- ═══════ HERO ═══════ -->
    <section class="hero" aria-label="Presentación">
        <div class="hero-grid-bg" aria-hidden="true"></div>
        <div class="container">
            <div class="split">
                <div class="hero__content">
                    <span class="hero__badge hero__badge--animated reveal">
                        <?= icon('zap', 14) ?>
                        Más de <span class="stat-count"
                                     data-target="<?= SITE_YEARS_EXPERIENCE ?>"
                                     data-suffix=" años"><?= SITE_YEARS_EXPERIENCE ?> años</span> de experiencia
                    </span>
                    <h1 class="hero__title reveal">
                        Tecnología que hace <span class="shimmer-text">crecer</span> tu empresa
                    </h1>
                    <p class="hero__subtitle reveal">
                        Soluciones integrales de software, infraestructura y soporte para que tu negocio evolucione.
                        Distribuidores oficiales de Tango Software en el NEA.
                    </p>
                    <div class="hero__actions reveal">
                        <a href="<?= generateWhatsAppLink('Hola, me gustaría recibir asesoramiento sobre soluciones para mi empresa.') ?>"
                           class="btn btn--primary btn--lg btn--shimmer"
                           target="_blank"
                           rel="noopener noreferrer">
                            Hablá con un asesor
                        </a>
                        <a href="#product" class="btn btn--ghost btn--lg">
                            Ver productos
                        </a>
                    </div>
                </div>
                <div class="reveal" style="text-align: center;">
                    <motion-tilt max-tilt="6" speed="400">
                        <picture>
                            <source srcset="<?= asset('img/slider/1.webp') ?>" type="image/webp">
                            <img src="<?= asset('img/slider/1.jpg') ?>"
                                 alt="Soluciones tecnológicas Servicios y Sistemas"
                                 class="img-rounded"
                                 width="600" height="400"
                                 fetchpriority="high"
                                 decoding="async">
                        </picture>
                    </motion-tilt>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ PARTNERS ═══════ -->
    <section class="partners" aria-label="Partners tecnológicos">
        <div class="container">
            <?= renderLogoMarquee($partners) ?>
        </div>
    </section>

    <!-- ═══════ PRODUCTOS ═══════ -->
    <section id="product" class="section" aria-label="Productos">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="reveal">Nuestros Productos</h2>
                <p class="reveal text-lg text-secondary mx-auto" style="max-width: 40ch;">
                    Plataformas de gestión empresarial para cada necesidad
                </p>
            </div>
            <div class="grid grid--3 stagger">
                <?php
                $delay = 0;
                foreach ($product_display_order as $productKey) {
                    if (isset($tango_products[$productKey])) {
                        echo renderProductCard($productKey, $tango_products[$productKey], $delay);
                        $delay += 80;
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <!-- ═══════ DATACENTER ═══════ -->
    <section id="datacenter" class="section section--dark content-auto bg-animated-gradient" aria-label="Servicios de Datacenter">
        <div class="container text-center">
            <h2 class="reveal mb-6">Servicios de Datacenter</h2>
            <p class="reveal text-lg mx-auto mb-12" style="max-width: 48ch; opacity: 0.85;">
                Alojá tu servidor en nuestra infraestructura de alta disponibilidad y olvidate de los problemas técnicos.
                Seguridad 24/7, respaldo continuo y soporte especializado.
            </p>

            <!-- Stats -->
            <div class="datacenter-stats">
                <?= renderStatNumber('99.9', 'Uptime garantizado', '', '%', true, 'stat-block--light') ?>
                <?= renderStatNumber('24/7', 'Monitoreo continuo', '', '', false, 'stat-block--light') ?>
                <?= renderStatNumber('5', 'Latencia máx.', '<', 'ms', false, 'stat-block--light') ?>
                <?= renderStatNumber((string) SITE_YEARS_EXPERIENCE, 'Años de experiencia', '', '', true, 'stat-block--light') ?>
            </div>

            <div class="grid grid--4 stagger mb-12">
                <div class="feature feature--glass reveal">
                    <div class="feature__icon"><?= icon('shield', 28) ?></div>
                    <h3 class="feature__title">Máxima Seguridad</h3>
                    <p class="feature__desc">Protección avanzada 24/7</p>
                </div>
                <div class="feature feature--glass reveal">
                    <div class="feature__icon"><?= icon('server', 28) ?></div>
                    <h3 class="feature__title">Alta Disponibilidad</h3>
                    <p class="feature__desc">99.9% uptime garantizado</p>
                </div>
                <div class="feature feature--glass reveal">
                    <div class="feature__icon"><?= icon('headphones', 28) ?></div>
                    <h3 class="feature__title">Soporte Experto</h3>
                    <p class="feature__desc">Asistencia especializada</p>
                </div>
                <div class="feature feature--glass reveal">
                    <div class="feature__icon"><?= icon('dollar-sign', 28) ?></div>
                    <h3 class="feature__title">Ahorro de Costos</h3>
                    <p class="feature__desc">Sin inversión en equipos</p>
                </div>
            </div>
            <a href="<?= generateWhatsAppLink('Hola, me interesa conocer más sobre los servicios de Datacenter.') ?>"
               class="btn btn--neumorph-dark btn--lg reveal"
               target="_blank"
               rel="noopener noreferrer">
                Conocer más
            </a>
        </div>
    </section>

    <!-- ═══════ NOSOTROS ═══════ -->
    <section id="nosotros" class="section section--warm content-auto" aria-label="Sobre nosotros">
        <div class="container">
            <div class="sticky-split">

                <!-- Imagen sticky (desktop) / normal (mobile) -->
                <div class="sticky-split__media reveal">
                    <picture>
                        <img src="<?= asset('img/about.webp') ?>"
                             alt="Equipo de <?= e(SITE_NAME) ?>"
                             class="about-img"
                             width="600" height="400"
                             loading="lazy" decoding="async">
                    </picture>
                </div>

                <!-- Bloques de contenido que avanzan -->
                <div class="sticky-split__content">

                    <div class="sticky-split__block reveal">
                        <span class="sticky-split__eyebrow">
                            <?= icon('calendar', 14) ?>
                            Desde 1993
                        </span>
                        <h2 style="margin-bottom: var(--space-4);">Más de <?= SITE_YEARS_EXPERIENCE ?> años transformando empresas</h2>
                        <p class="leading-relaxed">
                            Somos <strong><?= e(SITE_NAME) ?></strong>, una empresa que busca revolucionar
                            negocios a través de soluciones tecnológicas creativas. Nuestro equipo se forma
                            continuamente para brindar el mejor servicio del nordeste argentino.
                        </p>
                    </div>

                    <div class="sticky-split__block reveal">
                        <span class="sticky-split__eyebrow">
                            <?= icon('map-pin', 14) ?>
                            Pioneros en el NEA
                        </span>
                        <h3 style="margin-bottom: var(--space-4);">Referentes regionales</h3>
                        <p class="leading-relaxed text-secondary">
                            Nos hemos posicionado como pioneros en la incorporación de soluciones innovadoras
                            en Corrientes y toda la región del nordeste argentino, con presencia y soporte local.
                        </p>
                    </div>

                    <div class="sticky-split__block reveal">
                        <span class="sticky-split__eyebrow">
                            <?= icon('award', 14) ?>
                            Distribuidores oficiales
                        </span>
                        <h3 style="margin-bottom: var(--space-4);">Partners certificados</h3>
                        <p class="leading-relaxed text-secondary">
                            Distribuidores oficiales de Tango Software y Business Partner de HPE, Lenovo, Dell y Sophos.
                            Nuestra propuesta abarca desde hardware y software hasta infraestructura de red completa.
                        </p>
                    </div>

                    <div class="sticky-split__block reveal">
                        <span class="sticky-split__eyebrow">
                            <?= icon('users', 14) ?>
                            Equipo
                        </span>
                        <h3 style="margin-bottom: var(--space-4);">Capacitación continua</h3>
                        <p class="leading-relaxed text-secondary">
                            Cada miembro del equipo se certifica y actualiza permanentemente. Cuando tu empresa
                            necesita soporte, hay una persona real del NEA al otro lado.
                        </p>
                        <div class="cluster" style="margin-top: var(--space-6);">
                            <a href="<?= generateWhatsAppLink('Hola, me gustaría saber más sobre Servicios y Sistemas.') ?>"
                               class="btn btn--primary"
                               target="_blank"
                               rel="noopener noreferrer">
                                Contactanos
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ═══════ FAQ ═══════ -->
    <section id="faq" class="section content-auto" aria-label="Preguntas frecuentes">
        <div class="container container--narrow">
            <h2 class="text-center reveal mb-12">Preguntas frecuentes</h2>
            <div class="faq--smooth" x-data="{ active: null }">
                <?php foreach ($home_faqs as $i => $faq): ?>
                <div class="faq reveal">
                    <button class="faq__trigger"
                            @click="active = active === <?= $i ?> ? null : <?= $i ?>"
                            :aria-expanded="(active === <?= $i ?>).toString()"
                            aria-controls="faq-<?= $i ?>">
                        <span><?= e($faq['question']) ?></span>
                        <?= icon('chevron-down', 20, 'faq__chevron') ?>
                    </button>
                    <div class="faq__content"
                         id="faq-<?= $i ?>"
                         role="region"
                         :data-open="(active === <?= $i ?>).toString()">
                        <div class="faq__content-inner">
                            <p class="faq__answer"><?= e($faq['answer']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php require __DIR__ . '/includes/footer.php'; ?>

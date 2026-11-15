<?php
/**
 * Página de Tango Delta 6 — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SA
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs + stats
 *   2. Intro IA (cult-callout-card)
 *   3. Novedades agrupadas (7 funcionalidades en 3 áreas)
 *   4. Comparativa Tango clásico vs Delta 6 (cult-vs)
 *   5. CTA + formulario (renderCultCtaForm)
 *   6. FAQ específico
 *   7. Navegación a otros productos
 *
 * Color de marca: #000000 (config.php)
 */

header('Content-Type: text/html; charset=utf-8');

require_once('config/config.php');
require_once('includes/functions.php');
require_once('includes/security-init.php');
initSecurity();

require_once('includes/components/cult-hero-product.php');
require_once('includes/components/cult-modules-detailed.php');
require_once('includes/components/cult-cta-form.php');

// ─── Identidad del producto ─────────────────────────────────────────────
$product_key = 'delta';
$product     = $tango_products[$product_key];
$img_base    = 'assets/img/productos/' . $product['slug'] . '/';

$body_id = 'tango-delta';

$meta_keywords = 'tango delta 6, software empresarial, ia, inteligencia artificial, erp, tango ventas mobile, tango ecommerce, tango bi, cash flow, transformacion digital, corrientes, argentina';

$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink(
    'Hola, me interesa Tango Delta 6. ¿Podrían enviarme más información y coordinar una demo?'
);

$delta_hero_decoration = <<<'HTML'
<span class="cult-ai-sparkle cult-ai-sparkle--sm" style="top:16%; right:34%; animation-delay:0.4s;" aria-hidden="true"><i class="bx bxs-star"></i></span>
<span class="cult-ai-sparkle cult-ai-sparkle--sm" style="top:76%; right:12%; animation-delay:1.6s;" aria-hidden="true"><i class="bx bxs-star"></i></span>
HTML;


ob_start();
renderCultProductHero([
    'eyebrow_text'  => 'Nueva versión · IA integrada',
    'eyebrow_icon'  => 'bx bx-chip',
    'title'         => 'La evolución total de tu negocio con',
    'shimmer'       => 'inteligencia artificial',
    'subtitle'      => 'Evolución digital, inteligencia y conectividad total para tu negocio. Movilidad, eCommerce, tableros de BI y cobros integrados, con IA que automatiza tareas y potencia tus decisiones — sin perder el control de tu información.',
    'ctas'          => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo, 'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver novedades',  'href' => '#novedades',   'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'      => $img_base . 'delta6isow.webp',
    'logo_alt'      => $product['name'] . ' — Logo',
    'logo_width'    => 260,
    'logo_height'   => 246,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',  'label' => 'Años en Tango',  'prefix' => '+'],
        ['value' => '7',   'label' => 'Novedades clave'],
        ['value' => '24/7','label' => 'Disponible',     'animate' => false],
    ],
    'decoration_html' => $delta_hero_decoration,
]);
$hero_html = ob_get_clean();

// ─── Intro IA ───────────────────────────────────────────────────────────
ob_start(); ?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <span class="cult-section-eyebrow" data-aos="fade-up">Inteligencia Artificial</span>
                <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                    IA en Tango, <span class="cult-shimmer-text">con propósito</span>
                </h2>
                <p class="lead text-muted mx-auto mb-6" data-aos="fade-up" data-aos-delay="100" style="max-width: 50rem;">
                    Sumamos AI para que analices datos en lenguaje natural, automatices tareas y ejecutes acciones,
                    obteniendo respuestas más rápidas, incluso a partir de información cruzada entre módulos y datos no uniformes.
                </p>
                <div class="cult-callout-card text-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="cult-callout-card__icon">
                        <i class="bx bx-shield-quarter" aria-hidden="true"></i>
                    </div>
                    <h3 class="h4 fw-bold mb-3">Más simple, más fácil, más rápido.</h3>
                    <p class="mb-3">
                        Todo bajo un principio clave: <strong>la soberanía de tus datos</strong>. Vos elegís con qué proveedor trabajar;
                        ellos pueden analizarlos, pero nunca resguardarlos. La información siempre es tuya.
                    </p>
                    <p class="mb-0 fw-semibold" style="color: var(--cult-product-accent, var(--cult-product-color, var(--cult-blue)));">
                        Tecnología con propósito, sin perder el control.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$intro_html = ob_get_clean();

// ─── Novedades (7 funcionalidades, ficha numerada estilo axoft.com) ─────
$delta_features = [
    [
        'number'      => '01',
        'title'       => 'Tango Ventas Mobile',
        'eyebrow'     => 'Movilidad & Ventas',
        'icon'        => 'bx bx-mobile-alt',
        'description' => 'La nueva app permite gestionar pedidos y promociones, consultar información comercial y registrar cobranzas desde cualquier lugar, con integración en tiempo real con Tango para una experiencia de venta más ágil, moderna y eficiente.',
        'features'    => ['Pedidos y promociones', 'Información comercial', 'Registro de cobranzas', 'Integración en tiempo real'],
    ],
    [
        'number'      => '02',
        'title'       => 'Tango eCommerce',
        'eyebrow'     => 'Movilidad & Ventas',
        'icon'        => 'bx bx-store-alt',
        'description' => 'Una nueva plataforma de comercio electrónico totalmente integrada con Tango que permite administrar publicaciones, sincronizar productos y stock, gestionar promociones y optimizar la operatoria de tus canales de venta digitales desde un único lugar.',
        'features'    => ['Publicaciones unificadas', 'Sincronización de productos y stock', 'Gestión de promociones', 'Canales digitales integrados'],
    ],
    [
        'number'      => '03',
        'title'       => 'Tango BI',
        'eyebrow'     => 'Finanzas & Clientes',
        'icon'        => 'bx bx-bar-chart-alt-2',
        'description' => 'Un nuevo módulo orientado al análisis y visualización de información de negocio mediante tableros interactivos y personalizables. Diseñá y administrá tableros con consultas Live y externas, organizalos en solapas y favoritos, y compartilos con tu equipo.',
        'features'    => ['Tableros interactivos', 'Diseñador y Visor', 'Consultas Live y externas', 'Gestión de favoritos'],
    ],
    [
        'number'      => '04',
        'title'       => 'Cash Flow',
        'eyebrow'     => 'Finanzas & Clientes',
        'icon'        => 'bx bx-line-chart',
        'description' => 'Planificá el futuro financiero de tu empresa desde cualquier lugar: proyectá distintos escenarios, comparalos entre sí y analizá la evolución del flujo de fondos para tomar decisiones con mayor información y confianza.',
        'features'    => ['Planificación desde donde estés', 'Proyección de escenarios', 'Comparación de alternativas', 'Evolución del flujo de fondos'],
    ],
    [
        'number'      => '05',
        'title'       => 'Gestión de Clientes',
        'eyebrow'     => 'Finanzas & Clientes',
        'icon'        => 'bx bx-user-circle',
        'description' => 'Un nuevo historial integral que centraliza comprobantes, actividades e interacciones comerciales, brindando una visión 360° de cada cliente en un único lugar.',
        'features'    => ['Historial integral unificado', 'Centralización de comprobantes', 'Registro de actividades e interacciones', 'Visión 360° del cliente'],
    ],
    [
        'number'      => '06',
        'title'       => 'Cobros Integrados',
        'eyebrow'     => 'Movilidad & Ventas',
        'icon'        => 'bx bx-credit-card',
        'description' => 'Permite procesar cobros con Mercado Pago, Clover, Payway, Nave y GetNet, con registración automática en Tesorería para agilizar la operatoria y mantener toda la información integrada.',
        'features'    => ['Mercado Pago, Clover y Payway', 'Nave y GetNet', 'Registración automática en Tesorería', 'Operatoria 100% integrada'],
    ],
    [
        'number'      => '07',
        'title'       => 'Inteligencia Artificial',
        'eyebrow'     => 'Inteligencia Artificial',
        'icon'        => 'bx bx-brain',
        'description' => 'La IA potencia la gestión comercial y contable mediante nuevas herramientas que agilizan la búsqueda de información, automatizan procesos y simplifican las tareas diarias. Incorpora también Fórmulas AI, que interpreta requerimientos en lenguaje natural y propone fórmulas de liquidación de Sueldos ajustadas a la Ley de Contrato de Trabajo.',
        'features'    => ['Gestión comercial y contable', 'Búsqueda ágil de información', 'Automatización de procesos', 'Fórmulas AI de sueldos'],
    ],
];

ob_start();
renderCultModulesDetailed($delta_features, [
    'eyebrow'       => '7 innovaciones clave',
    'title'         => 'Todo lo nuevo en',
    'shimmer'       => 'Delta 6',
    'subtitle'      => 'Evolución digital, inteligencia y conectividad total: movilidad, eCommerce, BI, Cash Flow, cobros integrados e IA en una experiencia renovada.',
    'section_id'    => 'novedades',
    'product_color' => $product['color'],
    'show_number'   => true,
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: Comparativa Tango clásico vs Delta 6 ─────────────────
$vs_rows = [
    [
        'icon'  => 'bx bx-mobile-alt',
        'label' => 'Ventas en movilidad',
        'sin'   => 'Solo desde la oficina',
        'con'   => 'Pedidos y cobranzas con Tango Ventas Mobile',
    ],
    [
        'icon'  => 'bx bx-store-alt',
        'label' => 'Canales de venta digitales',
        'sin'   => 'Publicaciones y stock gestionados manualmente',
        'con'   => 'Tango eCommerce sincronizado en tiempo real',
    ],
    [
        'icon'  => 'bx bx-bar-chart-alt-2',
        'label' => 'Análisis de negocio',
        'sin'   => 'Reportes estáticos predefinidos',
        'con'   => 'Tableros interactivos con Tango BI',
    ],
    [
        'icon'  => 'bx bx-line-chart',
        'label' => 'Planificación financiera',
        'sin'   => 'Sin proyección de escenarios',
        'con'   => 'Cash Flow con comparación de alternativas',
    ],
    [
        'icon'  => 'bx bx-credit-card',
        'label' => 'Cobros con medios de pago',
        'sin'   => 'Registración manual en Tesorería',
        'con'   => 'Cobros integrados y automáticos',
    ],
    [
        'icon'  => 'bx bx-brain',
        'label' => 'Fórmulas de liquidación',
        'sin'   => 'Configuración manual y técnica',
        'con'   => 'Fórmulas AI en lenguaje natural',
    ],
];

ob_start(); ?>
<section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue">
    <div class="cult-hero-grid" aria-hidden="true"></div>
    <div class="container position-relative py-9 py-lg-11" style="z-index:2;">
        <div class="cult-vs">
            <div class="cult-vs__header text-white">
                <span class="cult-section-eyebrow cult-section-eyebrow--light" data-aos="fade-up">Comparativa</span>
                <h2 class="cult-display cult-display--xl mb-2 text-white" data-aos="fade-up" data-aos-delay="50">
                    Tango clásico vs <span class="cult-shimmer-text--bright">Delta 6</span>
                </h2>
                <p class="lead mx-auto mb-0" style="max-width:36rem; opacity:0.8;" data-aos="fade-up" data-aos-delay="100">
                    Descubrí qué cambia cuando actualizás a la nueva generación de software empresarial con IA integrada
                </p>
                <div class="cult-vs__chip" aria-hidden="true">VS</div>
            </div>

            <?php foreach ($vs_rows as $i => $row): ?>
            <div class="cult-vs__row" data-aos="fade-up" data-aos-delay="<?= 50 + ($i * 40) ?>">
                <div class="cult-vs__label">
                    <i class="<?= htmlspecialchars($row['icon'], ENT_QUOTES, 'UTF-8') ?> text-info" aria-hidden="true"></i>
                    <?= htmlspecialchars($row['label'], ENT_QUOTES, 'UTF-8') ?>
                </div>
                <div class="cult-vs__side cult-vs__side--bad">
                    <i class="bx bx-x-circle text-danger" aria-hidden="true"></i>
                    <span><?= htmlspecialchars($row['sin'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
                <div class="cult-vs__divider" aria-hidden="true">·</div>
                <div class="cult-vs__side cult-vs__side--good">
                    <i class="bx bx-check-circle text-success" aria-hidden="true"></i>
                    <span><?= htmlspecialchars($row['con'], ENT_QUOTES, 'UTF-8') ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
$post_modules_html = ob_get_clean();

// ─── CTA + formulario ───────────────────────────────────────────────────
ob_start();
renderCultCtaForm([
    'section_id'     => 'contacto',
    'origin'         => 'tango-delta',
    'eyebrow'        => 'Hablemos',
    'title'          => '¿Listo para experimentar el',
    'shimmer'        => 'futuro',
    'title_after'    => ' de la gestión empresarial?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Delta 6 —con movilidad, eCommerce, BI e inteligencia artificial— puede transformar tu negocio. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO DELTA 6',
    'asunto_options' => [
        'TANGO DELTA 6'      => 'Tango Delta 6 — Consulta general',
        'DEMO TANGO DELTA 6' => 'Solicitar demo Delta 6',
        'MIGRACION DELTA 6'  => 'Migración a Delta 6',
        'CAPACITACION IA'    => 'Capacitación en IA',
        'PRESUPUESTO'        => 'Pedir presupuesto',
        'SOPORTE'            => 'Soporte técnico',
    ],
    'mensaje_ph'     => 'Contanos qué versión de Tango usás hoy, cuántos usuarios tenés y qué funcionalidades de Delta 6 te interesan (Mobile, eCommerce, BI, IA)…',
    'bg_variant'     => 'mesh-product',
    'product_color'  => $product['color'],
    'logo_src'       => $img_base . $product['logo_dark'],
    'logo_alt'       => $product['name'] . ' — Logo',
    'logo_height'    => 80,
]);
$cta_html = ob_get_clean();

// ─── FAQ específico de Tango Delta 6 ────────────────────────────────────
$faq_items = [
    [
        'question' => '¿Qué es Tango Delta 6 y en qué se diferencia de Tango Gestión?',
        'answer'   => 'Tango Delta 6 es la nueva generación del software empresarial Tango. Suma movilidad con Tango Ventas Mobile, una plataforma de Tango eCommerce, el nuevo módulo de Tango BI, Cash Flow, cobros integrados con múltiples pasarelas e inteligencia artificial. Es la evolución natural de Tango Gestión, con las mismas bases contables y operativas pero potenciadas con nuevas herramientas de conectividad y análisis.',
        'icon'     => 'bx bx-chip',
    ],
    [
        'question' => '¿Cómo migro mi empresa desde Tango clásico a Delta 6?',
        'answer'   => 'Como distribuidores oficiales, acompañamos todo el proceso de actualización: relevamiento de tu instalación actual, plan de migración de datos, validación de módulos activos, capacitación del equipo y go-live. La migración respeta tu información histórica y minimiza la interrupción operativa.',
        'icon'     => 'bx bx-transfer',
    ],
    [
        'question' => '¿Qué es Tango Ventas Mobile y Tango eCommerce?',
        'answer'   => 'Tango Ventas Mobile es la nueva app para gestionar pedidos, promociones y cobranzas desde cualquier lugar, integrada en tiempo real con Tango. Tango eCommerce es la plataforma para administrar publicaciones, sincronizar stock y gestionar tus canales de venta digitales, todo conectado a tu gestión central.',
        'icon'     => 'bx bx-store-alt',
    ],
    [
        'question' => '¿Qué hace la IA con mis datos? ¿Son seguros?',
        'answer'   => 'La IA de Tango Delta 6 opera bajo el principio de soberanía de datos: vos elegís con qué proveedor de IA trabajar. Los proveedores pueden analizar tus datos para responder consultas o automatizar tareas, pero nunca los resguardan ni los usan para entrenar modelos. La información siempre permanece bajo tu control.',
        'icon'     => 'bx bx-shield-quarter',
    ],
    [
        'question' => '¿Qué requisitos técnicos necesito para instalar Delta 6?',
        'answer'   => 'Tango Delta 6 funciona sobre Windows con base de datos SQL Server. Podés instalarlo en tu servidor propio o en nuestro Datacenter en modalidad cloud. Te ayudamos a definir la infraestructura adecuada según la cantidad de usuarios, módulos activos y el uso de funcionalidades de movilidad, eCommerce e IA.',
        'icon'     => 'bx bx-server',
    ],
    [
        'question' => '¿Cuánto cuesta actualizar a Delta 6?',
        'answer'   => 'El costo depende de tu instalación actual, cantidad de módulos, usuarios y si incluís servicios de migración y capacitación. Coordiná una llamada con nosotros y armamos una propuesta a medida para tu empresa.',
        'icon'     => 'bx bx-dollar-circle',
    ],
    [
        'question' => '¿Incluye capacitación en las nuevas funcionalidades?',
        'answer'   => 'Sí. Ofrecemos capacitación específica para que tu equipo aproveche al máximo las novedades de Delta 6: Tango Ventas Mobile, Tango eCommerce, Tango BI, Cash Flow, cobros integrados y las herramientas de inteligencia artificial. Incluye material de referencia y sesiones de seguimiento.',
        'icon'     => 'bx bx-book-open',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Delta 6';
$faq_subtitle = 'Las dudas más comunes antes de dar el salto a la nueva generación de Tango.';
$faq_use_cult = true;
$render_faq   = true;

// ─── Schemas: producto + breadcrumb + FAQ ──────────────────────────────
$schema_markup = [
    generateProductSchema($product),
    generateBreadcrumbSchema([
        ['label' => 'Productos', 'url' => SITE_URL . '/index.php#product'],
        ['label' => $product['name']],
    ]),
    generateFAQSchema($faq_items),
];

// ─── Cargar template unificado ──────────────────────────────────────────
include('templates/tango-product-template.php');

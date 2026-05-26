<?php
/**
 * Página de Tango Estudios Contables — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs + stats
 *   2. Pilares (Eficiente / Flexible / Conectado)
 *   3. Módulos zigzag (Contabilidad / IVA / Sueldos)
 *   4. Tango Reportes
 *   5. Conectividad (Tango Connect + TangoNet)
 *   6. Integración con Tango Gestión
 *   7. CTA + formulario
 *   8. FAQ
 *   9. Navegación a otros productos
 *
 * Color de marca: #F47D30 (config.php)
 */

header('Content-Type: text/html; charset=utf-8');

require_once('config/config.php');
require_once('includes/functions.php');
require_once('includes/security-init.php');
initSecurity();

require_once('includes/components/cult-hero-product.php');
require_once('includes/components/cult-modules-detailed.php');
require_once('includes/components/cult-cta-form.php');
require_once('includes/components/card-hover-2.php');
require_once('includes/components/reportes-slider.php');

// ─── Identidad del producto ─────────────────────────────────────────────
$product_key = 'estudios-contables';
$product     = $tango_products[$product_key];
$img_base    = 'assets/img/productos/' . $product['slug'] . '/';

$intro_text = 'Tango Estudios Contables te facilita y potencia el trabajo. Funciona de manera eficiente, sin importar el tamaño de la empresa de tu cliente. Podés trabajar en línea y tener la tranquilidad de que siempre está actualizado con toda la reglamentación vigente. Además, se integra a la perfección con Tango Gestión, el software que elige la mayoría de tus clientes.';

$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink(
    'Hola, me interesa Tango Estudios Contables. ¿Podrían enviarme más información y coordinar una demo?'
);

ob_start();
renderCultProductHero([
    'eyebrow_text'  => 'Para estudios contables · 30+ años',
    'eyebrow_icon'  => 'bx bx-calculator',
    'title'         => 'El software que potencia tu',
    'shimmer'       => 'estudio contable',
    'subtitle'      => 'Facilitá y potenciá el trabajo de tu estudio. Trabajá en línea con todos tus clientes, con la reglamentación argentina siempre actualizada e integración directa con Tango Gestión.',
    'ctas'          => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo, 'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver módulos',    'href' => '#modulos',     'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'      => $img_base . $product['logo_dark'],
    'logo_alt'      => $product['name'] . ' — Logo',
    'logo_width'    => 320,
    'logo_height'   => 120,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',    'label' => 'Años acompañando contadores', 'prefix' => '+'],
        ['value' => '3',     'label' => 'Módulos integrados'],
        ['value' => '100',   'label' => 'Normativa AR cubierta', 'suffix' => '%'],
        ['value' => 'Multi', 'label' => 'Empresas por estudio', 'animate' => false],
    ],
]);
$hero_html = ob_get_clean();

// ─── Pilares de valor (pre-módulos) ─────────────────────────────────────
$pillars = [
    [
        'title'       => 'Eficiente',
        'icon'        => 'bx bx-tachometer',
        'description' => 'Obtené el mejor resultado, de forma integrada en el menor tiempo posible.',
    ],
    [
        'title'       => 'Flexible',
        'icon'        => 'bx bx-shuffle',
        'description' => 'Se adapta a cualquier tamaño de empresa cliente: desde una microempresa hasta un gran holding.',
    ],
    [
        'title'       => 'Conectado',
        'icon'        => 'bx bx-globe',
        'description' => 'Trabajá en línea desde cualquier lugar y mantené siempre actualizada la información.',
    ],
];

ob_start(); ?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="text-center mb-7 mb-lg-9">
            <span class="cult-section-eyebrow" data-aos="fade-up">Por qué elegirlo</span>
            <h2 class="cult-display cult-display--xl mb-3" data-aos="fade-up" data-aos-delay="50">
                Diseñado para el <span class="cult-shimmer-text">día a día</span> del contador
            </h2>
            <p class="lead text-muted mx-auto" style="max-width: 46rem;" data-aos="fade-up" data-aos-delay="100">
                <?= htmlspecialchars($intro_text, ENT_QUOTES, 'UTF-8') ?>
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($pillars as $i => $pillar): ?>
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="<?= 80 + ($i * 60) ?>">
                <article class="cult-pillar-card h-100 text-center">
                    <i class="cult-pillar-card__icon <?= htmlspecialchars($pillar['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                    <h3 class="cult-pillar-card__title"><?= htmlspecialchars($pillar['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p class="cult-pillar-card__text mb-0"><?= htmlspecialchars($pillar['description'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
$pre_modules_html = ob_get_clean();
$show_intro       = false;

// ─── Módulos zigzag ─────────────────────────────────────────────────────
$detailed_modules = [
    [
        'eyebrow'     => 'Módulo 01',
        'title'       => 'Contabilidad',
        'icon'        => 'bx bx-calculator',
        'image'       => $img_base . 'Contabilidad.jpg',
        'description' => 'Sistema contable completo para llevar la registración de todas las empresas de tu cartera con reportes gerenciales y cumplimiento normativo.',
        'features'    => [
            'Plan de cuentas personalizable por cliente',
            'Asientos automáticos desde otros módulos',
            'Conversión de moneda y ajuste por inflación',
            'Reportes gerenciales y balances',
        ],
    ],
    [
        'eyebrow'     => 'Módulo 02',
        'title'       => 'IVA',
        'icon'        => 'bx bx-receipt',
        'image'       => $img_base . 'liquidador_iva.jpg',
        'description' => 'Liquidación automática de IVA con generación de libros, declaraciones juradas y presentación ante organismos.',
        'features'    => [
            'Liquidación automática del impuesto',
            'Libros IVA Compras y Ventas',
            'Declaraciones juradas y presentaciones',
            'Integración con webservices AFIP',
        ],
    ],
    [
        'eyebrow'     => 'Módulo 03',
        'title'       => 'Sueldos',
        'icon'        => 'bx bx-money',
        'image'       => $img_base . 'sueldos_1.png',
        'description' => 'Liquidación de sueldos y jornales con cálculo de aportes, contribuciones y conexión con organismos oficiales.',
        'features'    => [
            'Cálculo de aportes y contribuciones',
            'Presentaciones ante organismos',
            'Recibos digitales para empleados',
            'Todos los convenios de trabajo vigentes',
        ],
    ],
];

ob_start();
renderCultModulesDetailed($detailed_modules, [
    'section_id'    => 'modulos',
    'eyebrow'       => '3 módulos integrados',
    'title'         => 'Todo lo que incluye',
    'shimmer'       => 'tu estudio',
    'subtitle'      => 'Contabilidad, IVA y Sueldos trabajan en conjunto para que gestiones toda la cartera de clientes desde una sola plataforma.',
    'product_color' => $product['color'],
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: Reportes + Conectividad + Integración Gestión ────────
ob_start();

renderCultTangoReportes([
    'eyebrow'       => 'Tango Reportes',
    'title'         => 'La información de tus clientes',
    'shimmer'       => 'desde donde estés',
    'subtitle'      => 'Centralizá indicadores contables, liquidaciones y sueldos de todas las empresas de tu cartera. Compartí informes con socios del estudio en un par de clics.',
    'image'         => $img_base . 'IMAGEN NEXO.png',
    'size'          => 'large',
    'product_color' => $product['color'],
    'features'      => [
        'Informes de Contabilidad, IVA y Sueldos de Tango Estudios Contables.',
        'Análisis por empresa cliente o por grupo de empresas.',
        'Indicadores, grillas e informes pivot multidimensional.',
        'Exportación directa a Excel.',
        'Compartí informes con permisos granulares.',
        'Acceso desde cualquier navegador y dispositivo.',
    ],
    'systems'       => [
        ['name' => 'TANGO ESTUDIOS CONTABLES', 'class' => 'bg-warning text-dark'],
        ['name' => 'TANGO GESTIÓN',           'class' => 'bg-primary'],
        ['name' => 'TANGO PUNTO DE VENTA',    'class' => 'bg-primary'],
        ['name' => 'TANGO RESTÔ',             'class' => 'bg-danger'],
    ],
]);

renderCultConnectivitySection(
    'Trabajá con tus clientes desde donde estés',
    'Conectividad total',
    'Accedé a la información de tu estudio y de tus clientes desde cualquier dispositivo. Mantené los datos sincronizados y actualizados sin depender de una sola PC.',
    $product['color']
);
?>
<section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue text-white">
    <div class="cult-hero-grid" aria-hidden="true"></div>
    <span class="cult-blob cult-blob--cyan" style="bottom:-20%; right:-10%; opacity:0.35;" aria-hidden="true"></span>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-up">
                <span class="cult-eyebrow cult-eyebrow--light">Integración nativa</span>
                <h2 class="cult-display cult-display--xl mb-4">
                    Tus clientes usan Tango Gestión. <span class="cult-shimmer-text cult-shimmer-text--bright">Tomá sus datos directo.</span>
                </h2>
                <p class="lead mb-4 opacity-90">
                    La mayoría de tus clientes ya operan con Tango Gestión. Estudios Contables se conecta para importar movimientos, comprobantes y saldos sin volver a cargar información a mano.
                </p>
                <ul class="list-unstyled cult-check-list cult-check-list--light mb-5">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Sin re-carga manual de comprobantes</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Sin errores de transcripción entre sistemas</span>
                    </li>
                    <li class="d-flex align-items-start mb-0">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Datos en tiempo real desde la gestión del cliente</span>
                    </li>
                </ul>
                <a href="tango-gestion.php" class="btn btn-light btn-lg rounded-pill hover-lift">
                    <i class="bx bx-link-external me-1" aria-hidden="true"></i>
                    Conocer Tango Gestión
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="cult-feature-glass p-4 p-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Estudios Contables</span>
                        <i class="bx bx-transfer-alt fs-3 opacity-75" aria-hidden="true"></i>
                        <span class="badge bg-primary px-3 py-2 rounded-pill">Tango Gestión</span>
                    </div>
                    <p class="mb-0 opacity-90">
                        Importá ventas, compras, stock y tesorería directamente al módulo contable. Tu estudio gana velocidad y tus clientes mantienen un solo sistema operativo en el día a día.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$post_modules_html = ob_get_clean();

// ─── CTA + formulario ───────────────────────────────────────────────────
ob_start();
renderCultCtaForm([
    'section_id'     => 'contacto',
    'eyebrow'        => 'Hablemos',
    'title'          => '¿Listo para',
    'shimmer'        => 'potenciar',
    'title_after'    => ' tu estudio?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Estudios Contables puede agilizar tu cartera de clientes. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO ESTUDIOS CONTABLES',
    'asunto_options' => [
        'TANGO ESTUDIOS CONTABLES' => 'Tango Estudios Contables — Consulta general',
        'DEMO ESTUDIOS CONTABLES'  => 'Solicitar demo',
        'MIGRACION CONTABLE'       => 'Migración contable',
        'MULTI ESTUDIO'            => 'Multi-estudio / multi-cliente',
        'PRESUPUESTO'              => 'Pedir presupuesto',
        'SOPORTE'                  => 'Soporte técnico',
    ],
    'mensaje_ph'    => 'Contanos cuántas empresas cliente gestionás, qué módulos necesitás y si tus clientes usan Tango Gestión…',
    'bg_variant'    => 'mesh-product',
    'product_color' => $product['color'],
]);
$cta_html = ob_get_clean();

// ─── FAQ ────────────────────────────────────────────────────────────────
$faq_items = [
    [
        'question' => '¿Qué incluye Tango Estudios Contables?',
        'answer'   => 'Incluye los tres módulos integrados para la gestión contable de tu cartera: Contabilidad (plan de cuentas, asientos automáticos y reportes gerenciales), IVA (liquidación, libros y DDJJ) y Sueldos (liquidación, aportes y presentaciones). Además, se integra nativamente con Tango Gestión para importar datos de tus clientes.',
        'icon'     => 'bx bx-help-circle',
    ],
    [
        'question' => '¿Funciona en la nube?',
        'answer'   => 'Sí. Podés trabajar en línea desde cualquier ubicación con datos siempre actualizados, respaldo automático y múltiples usuarios simultáneos en el estudio. También ofrecemos hosting en nuestro Datacenter si preferís no administrar servidores propios.',
        'icon'     => 'bx bx-cloud',
    ],
    [
        'question' => '¿Puedo administrar varias empresas cliente desde un solo estudio?',
        'answer'   => 'Sí. Tango Estudios Contables está pensado para estudios que manejan decenas o cientos de empresas. Cada cliente tiene su propia configuración contable, plan de cuentas y liquidaciones, con acceso centralizado para todo el equipo del estudio.',
        'icon'     => 'bx bx-buildings',
    ],
    [
        'question' => '¿Cumple con las normativas de AFIP y ARBA?',
        'answer'   => 'Sí. El software se actualiza permanentemente ante cambios regulatorios de AFIP, ARBA y demás organismos. Incluye libros IVA, presentaciones electrónicas y las validaciones necesarias para operar con tranquilidad en Argentina.',
        'icon'     => 'bx bx-receipt',
    ],
    [
        'question' => '¿Puedo presentar declaraciones juradas desde el sistema?',
        'answer'   => 'Sí. El módulo de IVA genera la liquidación, los libros de compras y ventas y las declaraciones juradas correspondientes, con integración a los webservices de AFIP para la presentación electrónica.',
        'icon'     => 'bx bx-file',
    ],
    [
        'question' => '¿Cómo se integra con Tango Gestión?',
        'answer'   => 'Si tus clientes operan con Tango Gestión, Estudios Contables importa comprobantes, movimientos y saldos de forma automática, sin re-carga manual ni errores de transcripción. Los datos llegan en tiempo real desde la gestión del cliente a tu módulo contable.',
        'icon'     => 'bx bx-link',
    ],
    [
        'question' => '¿Qué necesito para instalarlo?',
        'answer'   => 'Funciona sobre Windows con base de datos SQL Server. Podés instalarlo en tu servidor o en modalidad cloud en nuestro Datacenter. Te asesoramos sobre la infraestructura según la cantidad de usuarios y empresas cliente que administres.',
        'icon'     => 'bx bx-server',
    ],
    [
        'question' => '¿Cuánto cuesta? ¿Incluyen capacitación y migración?',
        'answer'   => 'El precio depende de la cantidad de empresas cliente, usuarios y modalidad (perpetuo o suscripción). Como distribuidores oficiales, acompañamos la migración desde otro sistema contable y ofrecemos capacitación para tu equipo. Coordiná una llamada y armamos una propuesta a medida.',
        'icon'     => 'bx bx-dollar-circle',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Estudios Contables';
$faq_subtitle = 'Las dudas más comunes que nos hacen los estudios contables antes de contratar.';
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

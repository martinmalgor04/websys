<?php
/**
 * Página de Tango Delta 5 — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs + stats
 *   2. Intro IA (cult-callout-card)
 *   3. Novedades agrupadas (6 funcionalidades en 3 áreas)
 *   4. Comparativa Tango clásico vs Delta 5 (cult-vs)
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
require_once('includes/components/cult-modules-grouped.php');
require_once('includes/components/cult-cta-form.php');

// ─── Identidad del producto ─────────────────────────────────────────────
$product_key = 'delta';
$product     = $tango_products[$product_key];
$img_base    = 'assets/img/productos/' . $product['slug'] . '/';

$body_id = 'tango-delta';

$meta_keywords = 'tango delta 5, software empresarial, ia, inteligencia artificial, erp, transformacion digital, corrientes, argentina';

$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink(
    'Hola, me interesa Tango Delta 5. ¿Podrían enviarme más información y coordinar una demo?'
);

$delta_hero_decoration = <<<'HTML'
<span class="cult-ai-sparkle cult-ai-sparkle--lg" style="top:22%; right:14%; animation-delay:0s;" aria-hidden="true"><i class="bx bxs-star"></i></span>
<span class="cult-ai-sparkle" style="top:48%; right:8%; animation-delay:0.6s;" aria-hidden="true"><i class="bx bxs-star"></i></span>
<span class="cult-ai-sparkle cult-ai-sparkle--sm" style="top:70%; right:22%; animation-delay:1.2s;" aria-hidden="true"><i class="bx bxs-star"></i></span>
<span class="cult-ai-sparkle cult-ai-sparkle--sm" style="top:30%; right:30%; animation-delay:1.8s;" aria-hidden="true"><i class="bx bxs-star"></i></span>
HTML;

ob_start();
renderCultProductHero([
    'eyebrow_text'  => 'Nueva versión · IA integrada',
    'eyebrow_icon'  => 'bx bx-chip',
    'title'         => 'La evolución de tu negocio con',
    'shimmer'       => 'inteligencia artificial',
    'subtitle'      => 'Tecnología avanzada y una plataforma cada vez más abierta y flexible. Analizá datos en lenguaje natural, automatizá tareas y ejecutá acciones con IA integrada — sin perder el control de tu información.',
    'ctas'          => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo, 'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver novedades',  'href' => '#novedades',   'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'      => $img_base . $product['logo_dark'],
    'logo_alt'      => $product['name'] . ' — Logo',
    'logo_width'    => 320,
    'logo_height'   => 120,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',  'label' => 'Años en Tango',  'prefix' => '+'],
        ['value' => '6',   'label' => 'Áreas con IA'],
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

// ─── Novedades agrupadas (6 funcionalidades) ────────────────────────────
$module_groups = [
    'Inteligencia Artificial' => [
        [
            'title'       => 'Compras más rápidas',
            'icon'        => 'bx bx-brain',
            'description' => 'Importación de comprobantes por AI. Simplificá y acelerá la gestión de compras con la importación automática de comprobantes en formato PDF, gracias a la inteligencia artificial que automatiza su registración en el módulo, ahorrándote tiempo y reduciendo errores.',
        ],
        [
            'title'       => 'Tango Empleados',
            'icon'        => 'bx bx-group',
            'description' => 'Nuevo módulo de Formularios + AI para responder consultas de RRHH. Dentro del circuito de Gestión Documental, contás con formularios personalizables para gestionar trámites y solicitudes de forma más ágil. Centralizá toda la documentación de Recursos Humanos para que la AI la interprete y responda de forma inmediata a las consultas más frecuentes de tus colaboradores.',
        ],
    ],
    'Productividad & UX' => [
        [
            'title'       => 'Diseñá tus comprobantes',
            'icon'        => 'bx bx-palette',
            'description' => 'Nueva herramienta gráfica para diseñar intuitivamente tus formularios. Definí colores, incluí fórmulas para mostrar datos del comprobante según una condición, definí comportamientos, trabajá por secciones y agregá imágenes. Contás con modelos predefinidos para agilizar el armado del formulario.',
        ],
        [
            'title'       => 'Visión total del cliente',
            'icon'        => 'bx bx-user-circle',
            'description' => 'Gestión de Clientes: toda la información, en una sola vista. Ofrece una visión integral y ágil de cada cliente, con indicadores claves en formato tablero, acceso a su situación financiera actualizada desde el BCRA y consultas dinámicas por ventas, cuentas corrientes, pedidos y cotizaciones. Todo adaptado al perfil del usuario y con acceso directo a fichas live y comprobantes.',
        ],
    ],
    'Automatización & Sueldos' => [
        [
            'title'       => 'Automatizá tus pedidos',
            'icon'        => 'bx bx-package',
            'description' => 'Seguimos ampliando las posibilidades de integración de Tango. Ahora en Ventas también podés modificar pedidos desde Excel o mediante API, respetando todas las validaciones del sistema y utilizando los datos por defecto del perfil seleccionado.',
        ],
        [
            'title'       => 'Sueldos, fácil y flexible',
            'icon'        => 'bx bx-calculator',
            'description' => 'Editor avanzado de fórmulas y pago de sueldos a múltiples cuentas bancarias. Además del asistente, contás con un nuevo editor de Fórmulas de liquidación que te permite buscar variables rápidamente, con sugerencias automáticas y parámetros completados de manera sencilla. Registrá múltiples cuentas bancarias por empleado y distribuí la acreditación del sueldo por importe o porcentaje.',
        ],
    ],
];

ob_start();
renderCultModulesGrouped($module_groups, [
    'eyebrow'       => '6 innovaciones clave',
    'title'         => 'Todo lo nuevo en',
    'shimmer'       => 'Delta 5',
    'subtitle'      => 'Funcionalidades que transforman la forma de trabajar con Tango: IA integrada, automatización avanzada y una experiencia de usuario renovada.',
    'section_id'    => 'novedades',
    'product_color' => $product['color'],
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: Comparativa Tango clásico vs Delta 5 ─────────────────
$vs_rows = [
    [
        'icon'  => 'bx bx-cog',
        'label' => 'Procesos operativos',
        'sin'   => 'Manuales y repetitivos',
        'con'   => 'Automatizados con IA',
    ],
    [
        'icon'  => 'bx bx-file',
        'label' => 'Importación de facturas',
        'sin'   => 'Carga manual de comprobantes',
        'con'   => 'Lectura automática de PDF por IA',
    ],
    [
        'icon'  => 'bx bx-bar-chart-alt-2',
        'label' => 'Análisis de datos',
        'sin'   => 'Reportes estáticos predefinidos',
        'con'   => 'Consultas en lenguaje natural',
    ],
    [
        'icon'  => 'bx bx-layout',
        'label' => 'Diseño de formularios',
        'sin'   => 'Configuración técnica compleja',
        'con'   => 'Editor visual drag-and-drop',
    ],
    [
        'icon'  => 'bx bx-wallet',
        'label' => 'Pago de sueldos',
        'sin'   => 'Una sola cuenta bancaria por empleado',
        'con'   => 'Múltiples bancos por importe o porcentaje',
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
                    Tango clásico vs <span class="cult-shimmer-text--bright">Delta 5</span>
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
    'eyebrow'        => 'Hablemos',
    'title'          => '¿Listo para experimentar el',
    'shimmer'        => 'futuro',
    'title_after'    => ' de la gestión empresarial?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Delta 5 y la inteligencia artificial pueden transformar tu negocio. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO DELTA 5',
    'asunto_options' => [
        'TANGO DELTA 5'      => 'Tango Delta 5 — Consulta general',
        'DEMO TANGO DELTA 5' => 'Solicitar demo Delta 5',
        'MIGRACION DELTA 5'  => 'Migración a Delta 5',
        'CAPACITACION IA'    => 'Capacitación en IA',
        'PRESUPUESTO'        => 'Pedir presupuesto',
        'SOPORTE'            => 'Soporte técnico',
    ],
    'mensaje_ph'     => 'Contanos qué versión de Tango usás hoy, cuántos usuarios tenés y qué procesos querés automatizar con IA…',
    'bg_variant'     => 'mesh-product',
    'product_color'  => $product['color'],
    'logo_src'       => $img_base . $product['logo_dark'],
    'logo_alt'       => $product['name'] . ' — Logo',
    'logo_height'    => 80,
]);
$cta_html = ob_get_clean();

// ─── FAQ específico de Tango Delta 5 ────────────────────────────────────
$faq_items = [
    [
        'question' => '¿Qué es Tango Delta 5 y en qué se diferencia de Tango Gestión?',
        'answer'   => 'Tango Delta 5 es la nueva generación del software empresarial Tango. Incorpora inteligencia artificial integrada, una plataforma más abierta y flexible, y herramientas de automatización avanzada. Es la evolución natural de Tango Gestión, con las mismas bases contables y operativas pero potenciadas con IA, editor visual de formularios y nuevas capacidades de integración.',
        'icon'     => 'bx bx-chip',
    ],
    [
        'question' => '¿Cómo migro mi empresa desde Tango clásico a Delta 5?',
        'answer'   => 'Como distribuidores oficiales, acompañamos todo el proceso de actualización: relevamiento de tu instalación actual, plan de migración de datos, validación de módulos activos, capacitación del equipo y go-live. La migración respeta tu información histórica y minimiza la interrupción operativa.',
        'icon'     => 'bx bx-transfer',
    ],
    [
        'question' => '¿Qué hace la IA con mis datos? ¿Son seguros?',
        'answer'   => 'La IA de Tango Delta 5 opera bajo el principio de soberanía de datos: vos elegís con qué proveedor de IA trabajar. Los proveedores pueden analizar tus datos para responder consultas o automatizar tareas, pero nunca los resguardan ni los usan para entrenar modelos. La información siempre permanece bajo tu control.',
        'icon'     => 'bx bx-shield-quarter',
    ],
    [
        'question' => '¿Qué requisitos técnicos necesito para instalar Delta 5?',
        'answer'   => 'Tango Delta 5 funciona sobre Windows con base de datos SQL Server. Podés instalarlo en tu servidor propio o en nuestro Datacenter en modalidad cloud. Te ayudamos a definir la infraestructura adecuada según la cantidad de usuarios, módulos activos y el uso de funcionalidades de IA.',
        'icon'     => 'bx bx-server',
    ],
    [
        'question' => '¿Cuánto cuesta actualizar a Delta 5?',
        'answer'   => 'El costo depende de tu instalación actual, cantidad de módulos, usuarios y si incluís servicios de migración y capacitación. Coordiná una llamada con nosotros y armamos una propuesta a medida para tu empresa.',
        'icon'     => 'bx bx-dollar-circle',
    ],
    [
        'question' => '¿Incluye capacitación en las nuevas funcionalidades de IA?',
        'answer'   => 'Sí. Ofrecemos capacitación específica para que tu equipo aproveche al máximo las funcionalidades de IA: consultas en lenguaje natural, importación automática de comprobantes, formularios inteligentes y el módulo Tango Empleados. Incluye material de referencia y sesiones de seguimiento.',
        'icon'     => 'bx bx-book-open',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Delta 5';
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

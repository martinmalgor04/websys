<?php
/**
 * Página de Tango Gestión — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs (WhatsApp + scroll a módulos)
 *   2. Stats animados integrados en el hero (fondo azul)
 *   3. Promesa / introducción
 *   4. Módulos (los 12 originales, agrupados en 4 áreas funcionales)
 *   5. Video demo (lazy-load por click)
 *   6. Tango Reportes (split + features + sistemas compatibles)
 *   7. Conectividad (TangoNet + Tango Connect)
 *   8. Integraciones (marquee infinito)
 *   9. CTA principal con formulario de contacto (vía enviar-datacenter.php)
 *  10. FAQ específico
 *  11. Navegación a otros productos
 */

header('Content-Type: text/html; charset=utf-8');

require_once('config/config.php');
require_once('includes/functions.php');
require_once('includes/security-init.php');
initSecurity();

require_once('includes/components/cult-hero-product.php');
require_once('includes/components/cult-modules-grouped.php');
require_once('includes/components/cult-cta-form.php');
require_once('includes/components/card-hover-2.php');
require_once('includes/components/reportes-slider.php');
require_once('includes/components/video-embed.php');

// ─── Identidad del producto ─────────────────────────────────────────────
$product_key = 'gestion';
$product     = $tango_products[$product_key];

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink('Hola, me interesa Tango Gestión. ¿Podrían enviarme más información y coordinar una demo?');

ob_start();
renderCultProductHero([
    'eyebrow_text' => 'ERP integral · 30+ años en el mercado',
    'eyebrow_icon' => 'bx bx-briefcase',
    'title'        => 'Gestioná tu empresa',
    'shimmer'      => 'de punta a punta',
    'subtitle'     => 'Tango Gestión integra ventas, stock, compras, contabilidad, tesorería y sueldos en una sola plataforma. Conectá sucursales, depósitos y puntos de venta de forma segura, y acompañá el crecimiento de tu negocio con la última tecnología.',
    'ctas'         => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo,  'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver módulos',    'href' => '#modulos',      'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'    => 'assets/img/productos/tango-gestion/' . $product['logo_dark'],
    'logo_alt'    => $product['name'] . ' — Logo',
    'logo_width'    => 360,
    'logo_height'   => 180,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',  'label' => 'Años en el mercado', 'prefix' => '+'],
        ['value' => '12',  'label' => 'Módulos integrados'],
        ['value' => '100', 'label' => 'Compatible AFIP',    'suffix' => '%'],
        ['value' => '24/7','label' => 'Soporte oficial',    'animate' => false],
    ],
]);
$hero_html = ob_get_clean();

// ─── Intro ─────────────────────────────────────────────────────────────
$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';

ob_start(); ?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <span class="cult-section-eyebrow" data-aos="fade-up">La solución integral</span>
                <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                    Una plataforma. <span class="cult-shimmer-text">Todo tu negocio.</span>
                </h2>
                <p class="lead text-muted mx-auto" data-aos="fade-up" data-aos-delay="100" style="max-width: 50rem;">
                    Tango Gestión ofrece una visión completa de tu empresa y agiliza tus procesos en el menor tiempo posible.
                    Gracias a su diseño escalable, se adapta a cualquier situación y acompaña el crecimiento de tu negocio.
                    Con más de 30 años de experiencia, incorpora las últimas tendencias del mercado y cumple con toda la
                    normativa argentina. Conectá sucursales, depósitos y puntos de venta de forma transparente y segura
                    a través de TangoNet.
                </p>
            </div>
        </div>
    </div>
</section>
<?php
$intro_html = ob_get_clean();

// ─── Módulos: los 12 originales agrupados en 4 áreas funcionales ───────
$module_groups = [
    'Ventas y comercial' => [
        [
            'title'       => 'Ventas',
            'icon'        => 'bx bx-store-alt',
            'description' => 'Facturá, administrá pedidos y clientes, generá automáticamente el libro IVA y los asientos contables correspondientes. Asigná perfiles distintos por tarea dentro de la facturación, evitando errores y facilitando el control.',
        ],
        [
            'title'       => 'Stock',
            'icon'        => 'bx bx-package',
            'description' => 'Ingresá artículos, administrá precios, manejá múltiples depósitos, controlá saldos, valorizá tu stock y realizá armado de productos. Conocé no solo el stock actual sino el comprometido en pedidos.',
        ],
        [
            'title'       => 'Importaciones',
            'icon'        => 'bx bx-world',
            'description' => 'Generá carpetas de importación, registro de embarques, facturas FOB, despachos y costos. Administrá el circuito completo desde la orden hasta el ingreso del despacho.',
        ],
    ],
    'Compras y logística' => [
        [
            'title'       => 'Compras',
            'icon'        => 'bx bx-cart',
            'description' => 'Generá y autorizá solicitudes y órdenes de compra, emití comprobantes de recepción y cargá facturas de proveedores. Manejá cuentas corrientes acreedoras y la confección del libro I.V.A. Compras.',
        ],
        [
            'title'       => 'Proveedores',
            'icon'        => 'bx bx-group',
            'description' => 'Cargá facturas de compra (sin manejo de stock), manejá cuentas corrientes acreedoras y generá el libro I.V.A. y los asientos contables correspondientes en forma automática.',
        ],
        [
            'title'       => 'Central',
            'icon'        => 'bx bx-network-chart',
            'description' => 'Tené a tu alcance toda la información de tus sucursales. Consolidá la información entre la administración central y tus sucursales mediante el servicio Tango Net.',
        ],
        [
            'title'       => 'Activo Fijo',
            'icon'        => 'bx bx-building',
            'description' => 'Ingresá el alta de bienes en forma automática desde Compras y generá automáticamente los asientos de altas, amortizaciones, ajustes por inflación, revalúos y baja de bienes.',
        ],
    ],
    'Finanzas y contabilidad' => [
        [
            'title'       => 'Tesorería',
            'icon'        => 'bx bx-wallet',
            'description' => 'Administrá caja, bancos y tarjetas de crédito. Generá la conciliación bancaria automática, administrá e imprimí cheques, y generá todos los asientos correspondientes en forma automática.',
        ],
        [
            'title'       => 'Contabilidad',
            'icon'        => 'bx bx-calculator',
            'description' => 'Cubrí todos los requerimientos en materia de registración contable, incluyendo conversión a otra moneda, ajuste por inflación y resultado por tenencia.',
        ],
        [
            'title'       => 'I.V.A.',
            'icon'        => 'bx bx-receipt',
            'description' => 'Generá los libros de I.V.A. Compras y Ventas y la liquidación mediante la carga de comprobantes en forma individual o en lote. Generación de asientos para el pasaje a contabilidad.',
        ],
    ],
    'Recursos humanos' => [
        [
            'title'       => 'Sueldos',
            'icon'        => 'bx bx-money',
            'description' => 'La manera más rápida y segura de liquidar sueldos. Liquidá todos los convenios de trabajo cubriendo el circuito completo desde el ingreso del empleado hasta la conexión con organismos oficiales.',
        ],
        [
            'title'       => 'Control de Personal',
            'icon'        => 'bx bx-user-check',
            'description' => 'Obtené toda la información sobre tu personal. Información detallada de desempeño, estadísticas de ausentismo, llegadas tarde y salidas tempranas.',
        ],
    ],
];

ob_start();
renderCultModulesGrouped($module_groups, [
    'eyebrow'       => '12 módulos integrados',
    'title'         => 'Todo lo que necesitás,',
    'shimmer'       => 'integrado',
    'subtitle'      => 'Cada módulo trabaja en conjunto para darte una visión 360° de tu negocio. Activá los que necesites hoy y sumá el resto cuando tu empresa crezca.',
    'section_id'    => 'modulos',
    'product_color' => $product['color'],
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: Video + Reportes + Conectividad + Integraciones ─────
ob_start();

// Video
renderCultYouTubeEmbed([
    'video_id' => 'mgRFUxznwHs',
    'title'    => 'Tango Gestión en acción',
    'eyebrow'  => 'Video demo',
    'subtitle' => 'Mirá cómo se ve trabajar día a día con Tango Gestión integrado.',
    'bg'       => 'bg-body',
]);

// Reportes
renderCultTangoReportes([
    'eyebrow'       => 'Tango Reportes',
    'title'         => 'La información de tus empresas',
    'shimmer'       => 'desde donde estés',
    'subtitle'      => 'Centralizá indicadores, ventas, sueldos y stock de todas tus empresas. Compartí informes con socios y contadores en un par de clics.',
    'product_color' => $product['color'],
]);

// Conectividad
renderCultConnectivitySection(
    'Tu Tango, conectado',
    'Conectividad total',
    'Operá desde cualquier lugar y mantené sincronizadas sucursales, depósitos y puntos de venta. Acceso seguro desde web y móvil.',
    $product['color']
);

// Integraciones (marquee infinito)
$integraciones = [
    ['src' => 'assets/img/productos/integracion/logo_mercadolibre.jpg', 'alt' => 'Mercado Libre'],
    ['src' => 'assets/img/productos/integracion/logo_tiendanube.jpg',   'alt' => 'Tienda Nube'],
    ['src' => 'assets/img/productos/integracion/logo_benfersoft.jpg',   'alt' => 'Benfersoft'],
    ['src' => 'assets/img/productos/integracion/logo_mercadopago.jpg',  'alt' => 'Mercado Pago'],
    ['src' => 'assets/img/productos/integracion/logo_posnet.jpg',       'alt' => 'PosNet'],
    ['src' => 'assets/img/productos/integracion/logo_whatsapp.jpg',     'alt' => 'WhatsApp'],
];
?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center mb-6">
            <div class="col-lg-9 text-center">
                <span class="cult-section-eyebrow" data-aos="fade-up">Integraciones</span>
                <h2 class="cult-display cult-display--xl mb-3" data-aos="fade-up" data-aos-delay="50">
                    Conectado con <span class="cult-shimmer-text">los mejores</span>
                </h2>
                <p class="lead text-muted mx-auto" data-aos="fade-up" data-aos-delay="100" style="max-width: 42rem;">
                    Tango Gestión se integra de forma nativa con las plataformas de e-commerce, pagos y comunicación más usadas del país.
                </p>
            </div>
        </div>
        <div data-aos="fade-up" data-aos-delay="150">
            <?= cultMarquee($integraciones, 'partners') ?>
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
    'shimmer'        => 'integrar',
    'title_after'    => ' tu negocio?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Gestión puede potenciar tu empresa. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO GESTIÓN',
    'asunto_options' => [
        'TANGO GESTIÓN'      => 'Tango Gestión — Consulta general',
        'DEMO TANGO GESTIÓN' => 'Solicitar demo',
        'PRESUPUESTO'        => 'Pedir presupuesto',
        'MIGRACION'          => 'Migración desde otro ERP',
        'IMPLEMENTACION'     => 'Implementación y capacitación',
        'SOPORTE'            => 'Soporte técnico',
    ],
    'mensaje_ph'      => 'Contanos qué rubro tiene tu empresa, cuántos usuarios, y qué procesos necesitás resolver…',
    'bg_variant'      => 'mesh-product',
    'product_color'   => $product['color'],
]);
$cta_html = ob_get_clean();

// ─── FAQ específico de Tango Gestión ────────────────────────────────────
$faq_items = [
    [
        'question' => '¿Tango Gestión emite facturación electrónica AFIP?',
        'answer'   => 'Sí. Tango Gestión cuenta con integración nativa con los webservices de AFIP para facturación electrónica (factura A, B, C, M, E), notas de crédito y débito. Cumple con todas las normativas vigentes y se actualiza automáticamente ante cambios regulatorios.',
        'icon'     => 'bx bx-receipt',
    ],
    [
        'question' => '¿Puedo manejar varias empresas con una sola instalación?',
        'answer'   => 'Sí, Tango Gestión es multiempresa y multisucursal. Podés administrar varias empresas, sucursales y depósitos desde una misma instalación y consolidar la información mediante el módulo Central + TangoNet.',
        'icon'     => 'bx bx-buildings',
    ],
    [
        'question' => '¿Cómo migro mi información desde otro ERP?',
        'answer'   => 'Como distribuidores oficiales, acompañamos todo el proceso de migración: relevamiento de datos, importación masiva de clientes, proveedores, artículos y saldos, validación y go-live. Te asesoramos sobre el plan de capacitación para el equipo.',
        'icon'     => 'bx bx-import',
    ],
    [
        'question' => '¿Se integra con tiendas online y Mercado Pago?',
        'answer'   => 'Sí. Tango Gestión se integra de forma nativa con Tienda Nube, Mercado Libre, Mercado Pago, PosNet y WhatsApp, entre otras plataformas. Toda la operación queda automáticamente reflejada en stock, ventas y tesorería.',
        'icon'     => 'bx bx-link',
    ],
    [
        'question' => '¿Qué necesito para instalarlo?',
        'answer'   => 'Tango Gestión funciona sobre Windows con base de datos SQL Server. Podés instalarlo en tu servidor propio o en nuestro Datacenter en modalidad cloud. Te ayudamos a definir la infraestructura adecuada según la cantidad de usuarios y sucursales.',
        'icon'     => 'bx bx-server',
    ],
    [
        'question' => '¿Incluye soporte y actualizaciones?',
        'answer'   => 'Sí. Como cliente nuestro recibís soporte técnico oficial, actualizaciones permanentes ante cambios normativos (AFIP, ARBA, etc.) y mejoras del software. Atendemos consultas por teléfono, email y WhatsApp en horario comercial extendido.',
        'icon'     => 'bx bx-support',
    ],
    [
        'question' => '¿Puedo acceder a Tango Gestión desde el celular?',
        'answer'   => 'Sí, mediante Tango Connect podés acceder a tu Tango desde cualquier navegador y dispositivo, sin instalación local. Ideal para responsables que necesitan consultar indicadores o aprobar comprobantes fuera de la oficina.',
        'icon'     => 'bx bx-mobile-alt',
    ],
    [
        'question' => '¿Cuánto cuesta Tango Gestión?',
        'answer'   => 'El precio depende de la cantidad de módulos, usuarios concurrentes y modalidad (perpetuo o suscripción anual). Coordiná una llamada con nosotros y armamos una propuesta a medida para tu empresa.',
        'icon'     => 'bx bx-dollar-circle',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Gestión';
$faq_subtitle = 'Las dudas más comunes que nos hacen las empresas antes de elegir el ERP.';
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

// ─── Título personalizado del intro (legacy, no usado al haber $intro_html)
$intro_title = 'La solución para la gestión integral de su empresa';

// ─── Cargar template unificado ──────────────────────────────────────────
include('templates/tango-product-template.php');

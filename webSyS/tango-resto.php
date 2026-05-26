<?php
/**
 * Página de Tango Restô — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs (WhatsApp + scroll a módulos)
 *   2. Stats animados integrados en el hero (fondo rojo #E31937)
 *   3. Promesa / introducción
 *   4. Módulos (10 oficiales, agrupados en 4 áreas funcionales)
 *   5. Video demo (lazy-load por click) — pendiente video_id oficial
 *   6. Tango Reportes (split + features + sistemas compatibles)
 *   7. Conectividad (TangoNet + Tango Connect)
 *   8. Integraciones (marquee infinito)
 *   9. CTA principal con formulario de contacto (vía enviar-datacenter.php)
 *  10. FAQ específico
 *  11. Navegación a otros productos
 *
 * Color de marca: #E31937 (config.php)
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
$product_key = 'resto';
$product     = $tango_products[$product_key];
$img_base    = 'assets/img/productos/' . $product['slug'] . '/';

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink(
    'Hola, me interesa Tango Restô. ¿Podrían enviarme más información y coordinar una demo?'
);

ob_start();
renderCultProductHero([
    'eyebrow_text'  => 'Software gastronómico · 30+ años',
    'eyebrow_icon'  => 'bx bx-restaurant',
    'title'         => 'Llevá tu gastronomía',
    'shimmer'       => 'al siguiente nivel',
    'subtitle'      => 'Tango Restô integra salón, comandas, cocina, delivery, stock, compras y caja en una sola plataforma. Se adapta a restaurantes, bares, parrillas, pizzerías, heladerías, fast food, delivery y franquicias de cualquier tamaño.',
    'ctas'          => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo, 'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver módulos',    'href' => '#modulos',     'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'      => $img_base . 'rangorestov1.svg',
    'logo_alt'      => $product['name'] . ' — Logo',
    'logo_width'    => 360,
    'logo_height'   => 50,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',  'label' => 'Años en el mercado', 'prefix' => '+'],
        ['value' => '10',  'label' => 'Módulos integrados'],
        ['value' => '100', 'label' => 'Compatible AFIP',    'suffix' => '%'],
        ['value' => '24/7','label' => 'Soporte oficial',    'animate' => false],
    ],
]);
$hero_html = ob_get_clean();

// ─── Intro ─────────────────────────────────────────────────────────────
$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';

$intro_copy = 'Tango Restô es un software gastronómico que se adapta a cualquier tipo y tamaño de negocio: restaurantes, bares/discos, parrillas, pizzerías, heladerías, cafeterías, fast food, delivery, franquicias y más. Es un sistema totalmente escalable que acompaña tu crecimiento, conecta sucursales y centraliza la operación de tu cadena gastronómica.';

ob_start(); ?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <span class="cult-section-eyebrow" data-aos="fade-up">La solución para tu negocio gastronómico</span>
                <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                    Un sistema. <span class="cult-shimmer-text">Toda tu cadena gastronómica.</span>
                </h2>
                <p class="lead text-muted mx-auto" data-aos="fade-up" data-aos-delay="100" style="max-width: 50rem;">
                    <?= htmlspecialchars($intro_copy, ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php
$intro_html = ob_get_clean();

// ─── Módulos: 10 oficiales agrupados en 4 áreas funcionales ─────────────
$module_groups = [
    'Salón y ventas' => [
        [
            'title'       => 'Salón / Mesas y Comandas',
            'icon'        => 'bx bx-restaurant',
            'description' => 'Administrá mesas, comandas y estados del salón en tiempo real. Tomá pedidos, dividí cuentas, aplicá descuentos y controlá la rotación de mesas con una operación ágil y sin errores.',
        ],
        [
            'title'       => 'Mostrador / Fast Food',
            'icon'        => 'bx bx-store-alt',
            'description' => 'Facturación rápida al mostrador para locales de alta rotación. Conexión con impresoras y controladores fiscales, manejo de medios de pago y generación automática del libro I.V.A. Ventas.',
        ],
        [
            'title'       => 'Delivery',
            'icon'        => 'bx bx-cycling',
            'description' => 'Gestioná pedidos a domicilio con circuito completo: toma de pedido, preparación, despacho y facturación. Integración con plataformas de delivery y seguimiento de repartidores.',
        ],
        [
            'title'       => 'Mozo Mobile',
            'icon'        => 'bx bx-mobile-alt',
            'description' => 'Comanda en mano desde dispositivos móviles. Los mozos toman pedidos en la mesa, envían comandas a cocina y barra al instante, reduciendo tiempos de espera y errores de carga.',
        ],
    ],
    'Cocina y operaciones' => [
        [
            'title'       => 'Cocina / KDS y Bumpbar',
            'icon'        => 'bx bx-food-menu',
            'description' => 'Pantallas de cocina (KDS) y bumpbar para organizar la producción por estación. Priorizá pedidos, controlá tiempos de preparación e impresión por sector (cocina caliente, fría, barra, postres).',
        ],
        [
            'title'       => 'Recetas y Costos',
            'icon'        => 'bx bx-pie-chart-alt-2',
            'description' => 'Definí recetas con insumos y mermas, calculá el costo por plato y analizá la rentabilidad de tu carta. Actualizá precios de venta en base a variaciones de costo de materia prima.',
        ],
    ],
    'Abastecimiento y finanzas' => [
        [
            'title'       => 'Stock',
            'icon'        => 'bx bx-package',
            'description' => 'Control de insumos y productos con múltiples depósitos, actualización automática al facturar o remitir, impresión de etiquetas y artículos con escalas (tamaño, sabor, etc.).',
        ],
        [
            'title'       => 'Compras',
            'icon'        => 'bx bx-cart',
            'description' => 'Generá y autorizá órdenes de compra, emití comprobantes de recepción y cargá facturas de proveedores. Manejá cuentas corrientes acreedoras y el libro I.V.A. Compras en forma automática.',
        ],
        [
            'title'       => 'Caja / Tesorería',
            'icon'        => 'bx bx-wallet',
            'description' => 'Administrá caja, bancos y tarjetas de crédito. Control de arqueos, conciliación bancaria automática, cierre de turno y generación de asientos contables de forma automática.',
        ],
    ],
    'Multi-sucursal y central' => [
        [
            'title'       => 'Central + Tango Net',
            'icon'        => 'bx bx-network-chart',
            'description' => 'Consolidá la información de todas tus sucursales desde la administración central. Sincronizá artículos, precios, clientes y parámetros mediante Tango Net con respaldo de datos en el lugar que designes.',
        ],
    ],
];

ob_start();
renderCultModulesGrouped($module_groups, [
    'eyebrow'       => '10 módulos integrados',
    'title'         => 'Todo lo que necesitás,',
    'shimmer'       => 'para tu gastronomía',
    'subtitle'      => 'Cada módulo trabaja en conjunto para que operes salón, cocina, delivery y administración desde un solo lugar. Activá los que necesites hoy y sumá el resto cuando tu negocio crezca.',
    'section_id'    => 'modulos',
    'product_color' => $product['color'],
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: Video + Reportes + Conectividad + Integraciones ─────
ob_start();

// TODO: Agregar video demo oficial cuando esté disponible el video_id de YouTube de Tango Restô.
// renderCultYouTubeEmbed([
//     'video_id' => '',
//     'title'    => 'Tango Restô en acción',
//     'eyebrow'  => 'Video demo',
//     'subtitle' => 'Mirá cómo se ve trabajar día a día con Tango Restô integrado.',
//     'bg'       => 'bg-body',
// ]);

renderCultTangoReportes([
    'eyebrow'       => 'Tango Reportes',
    'title'         => 'La información de tus locales gastronómicos',
    'shimmer'       => 'desde donde estés',
    'subtitle'      => 'Consultá ventas, comandas, stock y rentabilidad de todos tus locales desde cualquier dispositivo. Compartí informes con socios y contadores en un par de clics.',
    'product_color' => $product['color'],
    'features'      => [
        'Informes de los módulos Ventas, Stock y Comandas de Tango Restô.',
        'Indicadores, informes de tipo grilla y pivot multidimensional.',
        'Análisis individual por sucursal o por grupo de locales.',
        'Rentabilidad por plato, sector y turno.',
        'Exportación directa a Excel.',
        'Compartí informes con permisos granulares.',
    ],
    'systems'       => [
        ['name' => 'TANGO RESTÔ',             'class' => 'bg-danger'],
        ['name' => 'TANGO GESTIÓN',           'class' => 'bg-primary'],
        ['name' => 'TANGO PUNTO DE VENTA',    'class' => 'bg-primary'],
        ['name' => 'TANGO ESTUDIOS CONTABLES','class' => 'bg-warning text-dark'],
    ],
]);

renderCultConnectivitySection(
    'Tu gastronomía, conectada',
    'Conectividad total',
    'Operá desde cualquier lugar y mantené sincronizadas sucursales, cocinas y puntos de venta. Acceso seguro desde web y móvil con Tango Connect.',
    $product['color']
);

$integraciones = [
    ['src' => 'assets/img/productos/integracion/logo_mercadopago.jpg',  'alt' => 'Mercado Pago'],
    ['src' => 'assets/img/productos/integracion/logo_posnet.jpg',       'alt' => 'PosNet'],
    ['src' => 'assets/img/productos/integracion/logo_mercadolibre.jpg', 'alt' => 'Mercado Libre'],
    ['src' => 'assets/img/productos/integracion/logo_tiendanube.jpg',   'alt' => 'Tienda Nube'],
    ['src' => 'assets/img/productos/integracion/logo_whatsapp.jpg',     'alt' => 'WhatsApp'],
    ['src' => 'assets/img/productos/integracion/logo_benfersoft.jpg',   'alt' => 'Benfersoft'],
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
                    Tango Restô se integra con plataformas de pagos, e-commerce y comunicación para que cobros, delivery y operación queden reflejados en stock, ventas y tesorería.
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
    'shimmer'        => 'modernizar',
    'title_after'    => ' tu negocio gastronómico?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Restô puede potenciar tu restaurante o cadena. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO RESTO',
    'asunto_options' => [
        'TANGO RESTO'      => 'Tango Restô — Consulta general',
        'DEMO TANGO RESTO' => 'Solicitar demo',
        'PRESUPUESTO'      => 'Pedir presupuesto',
        'MIGRACION'        => 'Migración desde otro sistema',
        'IMPLEMENTACION'   => 'Implementación y capacitación',
        'SOPORTE'          => 'Soporte técnico',
    ],
    'mensaje_ph'    => 'Contanos qué tipo de negocio gastronómico tenés, cuántas sucursales, y si necesitás salón, delivery, cocina KDS o multi-sucursal…',
    'bg_variant'    => 'mesh-product',
    'product_color' => $product['color'],
]);
$cta_html = ob_get_clean();

// ─── FAQ específico de Tango Restô ──────────────────────────────────────
$faq_items = [
    [
        'question' => '¿Qué tipos de negocio gastronómico cubre Tango Restô?',
        'answer'   => 'Restaurantes, bares, discos, parrillas, pizzerías, heladerías, cafeterías, fast food, delivery y franquicias. El sistema es escalable: funciona desde un local único hasta cadenas con administración central.',
        'icon'     => 'bx bx-restaurant',
    ],
    [
        'question' => '¿Emite facturación electrónica y cumple con AFIP?',
        'answer'   => 'Sí. Tango Restô se conecta con impresoras y controladores fiscales, emite comprobantes según normativa vigente y genera el libro I.V.A. Ventas. Como distribuidores oficiales, te acompañamos ante cambios regulatorios.',
        'icon'     => 'bx bx-receipt',
    ],
    [
        'question' => '¿Cómo funciona el manejo de Salón, mesas y comandas?',
        'answer'   => 'Podés administrar mesas, tomar pedidos con Mozo Mobile (comanda en mano), enviar comandas a cocina y barra al instante, dividir cuentas y controlar estados del salón en tiempo real.',
        'icon'     => 'bx bx-food-menu',
    ],
    [
        'question' => '¿Tiene pantallas de cocina (KDS) e impresión por estación?',
        'answer'   => 'Sí. El módulo de Cocina incluye KDS y bumpbar para organizar la producción por sector (cocina caliente, fría, barra, postres), priorizar pedidos y controlar tiempos de preparación.',
        'icon'     => 'bx bx-dish',
    ],
    [
        'question' => '¿Puedo conectar múltiples sucursales o franquicias?',
        'answer'   => 'Sí. El módulo Central y Tango Net permiten consolidar información, sincronizar artículos, precios y parámetros entre locales, y mantener respaldo de datos en el lugar físico que designes.',
        'icon'     => 'bx bx-network-chart',
    ],
    [
        'question' => '¿Cómo calculo la rentabilidad de mi carta?',
        'answer'   => 'Con el módulo Recetas y Costos definís insumos, mermas y costo por plato. Analizás la rentabilidad de cada ítem de la carta y actualizás precios de venta según variaciones de materia prima.',
        'icon'     => 'bx bx-pie-chart-alt-2',
    ],
    [
        'question' => '¿Qué soporte y capacitación incluye?',
        'answer'   => 'Ofrecemos capacitación inicial para mozos, cajeros y administración, soporte técnico especializado en gastronomía, configuración de impresoras y estaciones, migración desde otros sistemas y mesa de ayuda en horario comercial extendido.',
        'icon'     => 'bx bx-support',
    ],
    [
        'question' => '¿Cuánto cuesta Tango Restô?',
        'answer'   => 'El precio depende de la cantidad de sucursales, usuarios, módulos activos y modalidad (perpetuo o suscripción). Coordiná una llamada con nosotros y armamos una propuesta a medida para tu negocio gastronómico.',
        'icon'     => 'bx bx-dollar-circle',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Restô';
$faq_subtitle = 'Las dudas más comunes que nos hacen los negocios gastronómicos antes de elegir el sistema.';
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

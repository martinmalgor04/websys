<?php
/**
 * Página de Tango Punto de Venta — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs (WhatsApp + scroll a módulos)
 *   2. Stats animados integrados en el hero
 *   3. Introducción / promesa
 *   4. Módulos (7 originales, agrupados en 4 áreas funcionales)
 *   5. Mercado Pago QR + Facturador Touchscreen + Vende Online
 *   6. Tango Reportes
 *   7. Conectividad (TangoNet + Tango Connect)
 *   8. Integraciones (marquee infinito)
 *   9. CTA principal con formulario de contacto
 *  10. FAQ específico
 *  11. Navegación a otros productos
 *
 * Color de marca: #00A8E1 (config.php)
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

// ─── Identidad del producto ─────────────────────────────────────────────
$product_key = 'punto-venta';
$product     = $tango_products[$product_key];
$img_base    = 'assets/img/productos/' . $product['slug'] . '/';

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink(
    'Hola, me interesa Tango Punto de Venta. ¿Podrían enviarme más información y coordinar una demo?'
);

ob_start();
renderCultProductHero([
    'eyebrow_text'  => 'Para comercios y cadenas · 30+ años',
    'eyebrow_icon'  => 'bx bx-store-alt',
    'title'         => 'Vendé más, gestioná mejor',
    'shimmer'       => 'tu comercio',
    'subtitle'      => 'Tango Punto de Venta integra facturación al mostrador, stock, compras, tesorería y multisucursal en una sola plataforma. Fácil de usar, con controles de seguridad y conexión con impresoras fiscales, Mercado Pago y tu cadena de locales.',
    'ctas'          => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo, 'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver módulos',    'href' => '#modulos',     'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'      => $img_base . 'LogoPDV.png',
    'logo_alt'      => $product['name'] . ' — Logo',
    'logo_width'    => 360,
    'logo_height'   => 180,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',  'label' => 'Años en el mercado', 'prefix' => '+'],
        ['value' => '7',   'label' => 'Módulos integrados'],
        ['value' => '100', 'label' => 'Compatible fiscal AR', 'suffix' => '%'],
        ['value' => '24/7','label' => 'Soporte oficial',    'animate' => false],
    ],
]);
$hero_html = ob_get_clean();

// ─── Intro ─────────────────────────────────────────────────────────────
$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';

$intro_copy = 'Tango Punto de Venta administra todas las necesidades de tu negocio. Te ayuda a decidir. Te ayuda a vender. Podés tener información centralizada y por sucursal. Desde la administración central podés dar alta instantánea de precios, promociones, artículos y más. Es sumamente fácil de usar y cuenta con permisos y controles que te dan una total seguridad.';

ob_start(); ?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <span class="cult-section-eyebrow" data-aos="fade-up">La solución para tu comercio</span>
                <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                    Un sistema. <span class="cult-shimmer-text">Toda tu cadena.</span>
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

// ─── Módulos: 7 originales agrupados en 4 áreas funcionales ─────────────
$module_groups = [
    'Ventas y mostrador' => [
        [
            'title'       => 'Ventas Punto de Venta',
            'icon'        => 'bx bx-store-alt',
            'description' => 'Facturador rápido y fácil de usar, que tiene una conexión automática con impresoras y controladores fiscales. Cuenta con el manejo de cuentas corrientes, emisión de libro de I.V.A. Ventas, y generación de información contable disponible para enviarla a tu contador.',
        ],
        [
            'title'       => 'Stock Punto de Venta',
            'icon'        => 'bx bx-package',
            'description' => 'Control de stock de los productos, generación e impresión de etiquetas, manejo de múltiples depósitos y actualización automática del saldo de stock cuando se factura o remite. Preparado para trabajar con productos o servicios, artículos con escalas o niveles (color, talle, etc.).',
        ],
    ],
    'Abastecimiento' => [
        [
            'title'       => 'Compras',
            'icon'        => 'bx bx-cart',
            'description' => 'Ingreso de facturas de compras con detalle de productos para actualización automática del stock y de las cuentas corrientes acreedoras. Permite la generación y autorización de solicitudes y órdenes de compra, emisión de comprobantes de recepción, confección del Libro de I.V.A. Compras y generación de asientos contables de forma automática.',
        ],
        [
            'title'       => 'Proveedores',
            'icon'        => 'bx bx-group',
            'description' => 'Carga de facturas de compra sin detalle de productos para manejar las cuentas corrientes acreedoras sin llevar el control del stock. Permite crear conceptos de gastos y compras (gastos bancarios, alquiler, etc.), generar el Libro de IVA Compras y los asientos contables en forma automática.',
        ],
    ],
    'Finanzas' => [
        [
            'title'       => 'Tesorería',
            'icon'        => 'bx bx-wallet',
            'description' => 'Administra caja, bancos y tarjetas de crédito. Actualiza automáticamente el saldo de las cuentas cuando se generan movimientos de los módulos de ventas y compras. Genera la conciliación bancaria en forma automática importando el extracto electrónico. Administra e imprime cheques. Genera todos los asientos contables automáticamente.',
        ],
    ],
    'Multi-sucursal' => [
        [
            'title'       => 'Central',
            'icon'        => 'bx bx-network-chart',
            'description' => 'Permite obtener información consolidada y conectar sus negocios. Puede obtener rankings de Ventas y Compras, realizar actualizaciones automáticas de artículos, clientes, proveedores, parámetros, etc. La información es transferida por el servicio de Tango Net o bien de forma manual mediante archivos que se exportan e importan en cada negocio.',
        ],
        [
            'title'       => 'Tango Net',
            'icon'        => 'bx bx-wifi',
            'description' => 'Tango Net es un servicio de conexión entre sus distintas soluciones Tango. Puede intercambiar información dentro de los distintos escenarios de su negocio. Un actor (sucursales, casa central, depósitos, etc.) puede ser emisor o receptor de información. Resguardo total de datos con espejo de información de sucursales en el lugar físico que usted designe.',
        ],
    ],
];

ob_start();
renderCultModulesGrouped($module_groups, [
    'eyebrow'       => '7 módulos integrados',
    'title'         => 'Todo lo que necesitás,',
    'shimmer'       => 'en el mostrador',
    'subtitle'      => 'Cada módulo trabaja en conjunto para que factures rápido, controles el stock y administres varias sucursales desde un solo lugar.',
    'section_id'    => 'modulos',
    'product_color' => $product['color'],
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: diferenciadores + Reportes + Conectividad + Integraciones
$mesh_class = function_exists('cultProductMeshClass')
    ? cultProductMeshClass()
    : 'cult-mesh-bg cult-mesh-bg--product text-white';

ob_start();
?>
<section class="position-relative overflow-hidden cult-page-header <?= htmlspecialchars($mesh_class, ENT_QUOTES, 'UTF-8') ?>"
         <?= $product_color_style ? 'style="' . $product_color_style . '"' : '' ?>>
    <div class="cult-hero-grid" aria-hidden="true"></div>
    <span class="cult-blob cult-blob--cyan" style="bottom:-20%; right:-10%; opacity:0.35;" aria-hidden="true"></span>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 text-white" data-aos="fade-up">
                <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex">Cobros electrónicos</span>
                <h2 class="cult-display cult-display--xl mb-4" style="line-height: 1.15;">
                    Cobrá tus ventas con <span class="cult-shimmer-text cult-shimmer-text--bright">Mercado Pago</span>
                </h2>
                <p class="lead mb-4 opacity-90">Utilizá el código QR de Mercado Pago y ofrecé cobro seguro sin contacto físico de tarjetas ni efectivo.</p>
                <ul class="list-unstyled cult-check-list cult-check-list--light mb-0">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Los cobros de Mercado Pago ingresan automáticamente al Facturador de Tango</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Cobro electrónico seguro sin contacto físico</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Tu cliente paga directamente desde su celular</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Recibís tus pagos al instante</span>
                    </li>
                    <li class="d-flex align-items-start mb-0">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Informes de ventas detallados por medios de pago</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="cult-feature-glass text-center p-5 p-lg-6">
                    <i class="bx bx-qr display-1 mb-3" aria-hidden="true"></i>
                    <h3 class="h4 text-white mb-2">Código QR</h3>
                    <p class="text-white-50 mb-0">Mercado Pago integrado al facturador</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-up" data-aos-delay="50">
                <div class="cult-modules-detailed__media rounded-4 overflow-hidden">
                    <img src="<?= htmlspecialchars($img_base . 'screenshots/Dispositivos desde cPanel.png', ENT_QUOTES, 'UTF-8') ?>"
                         alt="Facturador Touchscreen de Tango Punto de Venta"
                         class="img-fluid w-100"
                         loading="lazy"
                         decoding="async">
                </div>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-up">
                <span class="cult-section-eyebrow">Ágil y amigable</span>
                <h2 class="cult-display cult-display--xl mb-3">
                    Facturador <span class="cult-shimmer-text">Touchscreen</span>
                </h2>
                <p class="lead text-muted mb-4">
                    Facturación intensiva al mostrador de forma rápida con terminales touchscreen, compatible también con teclado o mouse.
                </p>
                <ul class="list-unstyled cult-check-list mb-5">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Interfaz táctil intuitiva</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Compatible con teclado y mouse</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Facturación rápida al mostrador</span>
                    </li>
                    <li class="d-flex align-items-start mb-0">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Diseñado para comercios de alta rotación</span>
                    </li>
                </ul>
                <a href="#contacto" class="btn btn-outline-primary btn-lg rounded-pill hover-lift">
                    <i class="bx bx-touch me-1" aria-hidden="true"></i>
                    Solicitar demo del facturador
                </a>
            </div>
        </div>
    </div>
</section>

<section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue text-white cult-page-header">
    <div class="cult-hero-grid" aria-hidden="true"></div>
    <span class="cult-blob cult-blob--cyan" style="top:-15%; left:-8%; opacity:0.25;" aria-hidden="true"></span>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center text-center">
            <div class="col-lg-9 d-flex flex-column align-items-center gap-0" data-aos="fade-up">
                <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex">E-commerce integrado</span>
                <h2 class="cult-display cult-display--xl cult-display--stacked mb-5 w-100">
                    <span class="d-block">Vendé online con</span>
                    <span class="d-block cult-shimmer-text cult-shimmer-text--bright pb-1">Tango Tiendas</span>
                </h2>
                <p class="lead mx-auto mb-5 opacity-90 mt-1" style="max-width: 42rem;">
                    La flexibilidad de Tango Punto de Venta permite integrar otros sistemas y potenciar tus procesos. Conectá tu comercio físico con canales digitales sin duplicar la carga de datos.
                </p>
                <a href="https://www.tangonexo.com/"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="btn cult-btn-glass cult-btn-shimmer btn-lg rounded-pill d-inline-flex align-items-center">
                    <i class="bx bx-store me-2" aria-hidden="true"></i>
                    <span>Conocer Tango Tiendas</span>
                </a>
            </div>
        </div>
    </div>
</section>
<?php

renderCultTangoReportes([
    'eyebrow'       => 'Tango Reportes',
    'title'         => 'La información de tus locales',
    'shimmer'       => 'desde donde estés',
    'subtitle'      => 'Consultá el estado de tus ventas y los movimientos de stock de todos tus negocios desde cualquier dispositivo. Analizá por sucursal o por grupo de locales.',
    'size'          => 'compact',
    'product_color' => $product['color'],
    'features'      => [
        'Informes de los módulos Ventas y Stock de Tango Punto de Venta.',
        'Indicadores, informes de tipo grilla y pivot multidimensional.',
        'Definición de grupos de empresas según tu necesidad de información.',
        'Análisis individual por sucursal o por grupo de sucursales.',
        'Envío de todos tus informes a Excel.',
        'Invitá a otras personas a acceder a tu información con permisos.',
    ],
    'systems'       => [
        ['name' => 'TANGO PUNTO DE VENTA',    'class' => 'bg-primary'],
        ['name' => 'TANGO GESTIÓN',           'class' => 'bg-primary'],
        ['name' => 'TANGO ESTUDIOS CONTABLES','class' => 'bg-warning text-dark'],
        ['name' => 'TANGO RESTÔ',             'class' => 'bg-danger'],
    ],
]);

renderCultConnectivitySection(
    'Tu comercio, conectado',
    'Conectividad total',
    'Operá desde cualquier lugar y mantené sincronizadas sucursales, depósitos y puntos de venta. Acceso seguro desde web y móvil.',
    $product['color']
);

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
                    Tango Punto de Venta se integra de forma nativa con e-commerce, pagos y comunicación para que tu operación quede reflejada en stock, ventas y tesorería.
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
    'title_after'    => ' tu comercio?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Punto de Venta puede potenciar tu negocio. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO PUNTO DE VENTA',
    'asunto_options' => [
        'TANGO PUNTO DE VENTA'      => 'Tango Punto de Venta — Consulta general',
        'DEMO TANGO PUNTO DE VENTA' => 'Solicitar demo',
        'PRESUPUESTO'               => 'Pedir presupuesto',
        'MIGRACION'                 => 'Migración desde otro sistema',
        'IMPLEMENTACION'            => 'Implementación y capacitación',
        'SOPORTE'                   => 'Soporte técnico',
    ],
    'mensaje_ph'    => 'Contanos qué tipo de comercio tenés, cuántas sucursales, y si necesitás facturador touchscreen o integración con Mercado Pago…',
    'bg_variant'    => 'mesh-product',
    'product_color' => $product['color'],
]);
$cta_html = ob_get_clean();

// ─── FAQ específico de Tango Punto de Venta ─────────────────────────────
$faq_items = [
    [
        'question' => '¿Qué tipos de comercio pueden usar Tango Punto de Venta?',
        'answer'   => 'Es ideal para comercios minoristas, cadenas de sucursales, franquicias, farmacias y cualquier negocio que facture al mostrador. Se adapta desde un local único hasta redes con administración central.',
        'icon'     => 'bx bx-store-alt',
    ],
    [
        'question' => '¿Emite facturación electrónica y cumple con AFIP?',
        'answer'   => 'Sí. El facturador se conecta con impresoras y controladores fiscales, emite comprobantes según normativa vigente y genera el libro I.V.A. Ventas. Como distribuidores oficiales, te acompañamos ante cambios regulatorios.',
        'icon'     => 'bx bx-receipt',
    ],
    [
        'question' => '¿Cómo funciona la integración con Mercado Pago?',
        'answer'   => 'Los cobros con código QR de Mercado Pago ingresan automáticamente al Facturador de Tango. Tu cliente paga desde el celular, recibís el pago al instante y contás con informes detallados por medio de pago.',
        'icon'     => 'bx bx-qr',
    ],
    [
        'question' => '¿Puedo conectar múltiples sucursales?',
        'answer'   => 'Sí. El módulo Central y Tango Net permiten información centralizada y por sucursal, alta instantánea de precios y promociones, y respaldo de datos con espejo en el lugar físico que designes.',
        'icon'     => 'bx bx-network-chart',
    ],
    [
        'question' => '¿Cómo maneja el control de stock?',
        'answer'   => 'El módulo Stock actualiza automáticamente al facturar o remitir, permite múltiples depósitos, impresión de etiquetas y artículos con escalas (color, talle, etc.).',
        'icon'     => 'bx bx-package',
    ],
    [
        'question' => '¿El facturador touchscreen es fácil para el equipo?',
        'answer'   => 'Sí. Está pensado para facturación intensiva al mostrador con interfaz táctil intuitiva, compatible con teclado y mouse, permisos por usuario y controles de seguridad para evitar errores.',
        'icon'     => 'bx bx-touch',
    ],
    [
        'question' => '¿Qué soporte y capacitación incluye?',
        'answer'   => 'Ofrecemos capacitación inicial, soporte técnico especializado en POS, configuración de impresoras fiscales, migración desde otros sistemas y mesa de ayuda en horario comercial extendido.',
        'icon'     => 'bx bx-support',
    ],
    [
        'question' => '¿Cuánto cuesta Tango Punto de Venta?',
        'answer'   => 'El precio depende de la cantidad de sucursales, usuarios, módulos y modalidad (perpetuo o suscripción). Coordiná una llamada con nosotros y armamos una propuesta a medida para tu comercio.',
        'icon'     => 'bx bx-dollar-circle',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Punto de Venta';
$faq_subtitle = 'Las dudas más comunes que nos hacen los comercios antes de elegir el sistema.';
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

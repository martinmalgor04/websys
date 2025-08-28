<?php
/**
 * Configuración central del sitio
 * Servicios y Sistemas SRL
 */

// Información de la empresa
define('SITE_NAME', 'Servicios y Sistemas');
define('SITE_URL', 'https://serviciosysistemas.com.ar');
define('SITE_EMAIL', 'info@serviciosysistemas.com.ar');
define('SITE_EMAIL_VENTAS', 'daniel@serviciosysistemas.com.ar');
define('SITE_PHONE', '+54 3794 426022');
define('SITE_ADDRESS', 'San Martín 1180, Corrientes, Argentina');
define('SITE_YEAR_FOUNDED', 1993);
define('SITE_YEARS_EXPERIENCE', date('Y') - SITE_YEAR_FOUNDED);

// URLs de servicios externos
define('ECOMMERCE_URL', 'https://tienda.serviciosysistemas.com.ar/public/home.php');
define('SUPPORT_URL', 'https://soporte.serviciosysistemas.com.ar/upload/');

// Meta tags por defecto
define('DEFAULT_META_DESCRIPTION', 'Soluciones tecnológicas integrales para empresas. Distribuidores oficiales de Tango Software. Más de 30 años de experiencia en el NEA.');
define('DEFAULT_META_KEYWORDS', 'tango software, sistemas, erp, punto de venta, gestion empresarial, corrientes, argentina');

// Orden de productos para mostrar en la página principal
$product_display_order = ['gestion', 'punto-venta', 'estudios-contables', 'resto', 'capital-humano'];

// Productos Tango - Array con toda la información
$tango_products = [
    'gestion' => [
        'name' => 'Tango Gestión',
        'slug' => 'tango-gestion',
        'color' => '#00A8E1',
        'logo' => 'logogestion.png',
        'logo_dark' => 'logogestionw.png',
        'icon' => 'icon-Business',
        'short_desc' => 'Software integral para PyMEs y grandes empresas, diseñado para maximizar resultados de forma sencilla y en el menor tiempo posible.',
        'meta_desc' => 'Tango Gestión - Software de gestión empresarial integral. ERP completo para PyMEs y grandes empresas.',
        'modules' => ['Ventas', 'Compras', 'Stock', 'Contabilidad', 'Tesorería', 'Sueldos']
    ],
    'punto-venta' => [
        'name' => 'Tango Punto de Venta',
        'slug' => 'tango-punto-de-venta',
        'color' => '#00A8E1',
        'logo' => 'logopdv.png',
        'logo_dark' => 'logopdv.png', 
        'icon' => 'icon-Shopping-Cart',
        'short_desc' => 'La solución ideal para comercios minoristas, sucursales y franquicias. Es fácil de usar y cuenta con permisos y controles que garantizan máxima seguridad.',
        'meta_desc' => 'Tango Punto de Venta - La solución para tu comercio o cadena de comercios. Facturación rápida, control de stock y gestión integral.'
    ],
    'estudios-contables' => [
        'name' => 'Tango Estudios Contables',
        'slug' => 'tango-estudios-contables',
        'color' => '#F47D30',
        'logo' => 'logoecw.png',
        'logo_dark' => 'logoecw.png',
        'icon' => 'icon-Calculator',
        'short_desc' => 'Desarrollado para agilizar y potenciar el trabajo del contador, sin importar el tamaño de la empresa cliente: desde microemprendimientos hasta grandes holdings.',
        'meta_desc' => 'Tango Estudios Contables - Software para contadores y estudios contables. Gestión integral de clientes.'
    ],
    'resto' => [
        'name' => 'Tango Restô',
        'slug' => 'tango-resto',
        'color' => '#E31937',
        'logo' => 'logoTR.png',
        'logo_dark' => 'logoTR.png',
        'icon' => 'icon-Restaurant',
        'short_desc' => 'El software adaptable a todo tipo de negocio (pequeño, mediano o grande), que ofrece una gestión integrada para cualquier formato gastronómico.',
        'meta_desc' => 'Tango Restô - Software para restaurantes, bares y gastronomía. Sistema completo de gestión gastronómica.'
    ],
    'capital-humano' => [
        'name' => 'Tango Capital Humano',
        'slug' => 'tango-capital-humano',
        'color' => '#00A8E1',
        'logo' => 'tangocaphumano.png',
        'logo_dark' => 'tangocaphumano.png',
        'icon' => 'icon-Users',
        'short_desc' => 'Sistema integral de gestión de recursos humanos. Administra personal, sueldos, capacitación y evaluación de desempeño.',
        'meta_desc' => 'Tango Capital Humano - Software de RRHH integral. Gestión completa de recursos humanos.'
    ],
    'delta' => [
        'name' => 'Tango Delta 5',
        'slug' => 'tango-delta',
        'color' => '#000000',
        'logo' => 'delta5iso.webp',
        'logo_dark' => 'delta5isow.webp',
        'icon' => 'icon-Technology',
        'short_desc' => 'La nueva versión de Tango ofrece una plataforma personalizable, abierta y conectada, diseñada para acompañar la transformación digital de tu negocio con inteligencia artificial integrada.',
        'meta_desc' => 'Tango Delta 5 - La nueva generación de software empresarial con IA integrada. Transformación digital para tu negocio.',
        'features' => ['Inteligencia Artificial', 'API Abierta', 'Personalización Total', 'Conectividad Avanzada']
    ]
];

// Partners y certificaciones
$partners = [
    'hp' => ['name' => 'HP Business Partner', 'logo' => 'hp.png'],
    'lenovo' => ['name' => 'Lenovo Partner', 'logo' => 'lenovo.png'],
    'sophos' => ['name' => 'Sophos Authorized Partner', 'logo_light' => 'sophosdark.webp', 'logo_dark' => 'sophos.png'],
    'tango' => ['name' => 'Tango Software Partner', 'logo' => 'tango.png']
];

// Funciones auxiliares
function getProductBySlug($slug) {
    global $tango_products;
    foreach ($tango_products as $key => $product) {
        if ($product['slug'] === $slug) {
            return array_merge(['key' => $key], $product);
        }
    }
    return null;
}

function getCurrentYear() {
    return date('Y');
}

// Función getWhatsAppLink removida - usar generateWhatsAppLink() de functions.php
?> 
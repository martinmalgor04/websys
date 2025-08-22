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

// Productos Tango - Array con toda la información
$tango_products = [
    'gestion' => [
        'name' => 'Tango Gestión',
        'slug' => 'tango-gestion',
        'color' => '#00A8E1',
        'logo' => 'logo_gestion_w.png',
        'icon' => 'icon-Business',
        'short_desc' => 'Software integral para PyMEs y grandes empresas, diseñado para maximizar resultados de forma sencilla y en el menor tiempo posible.',
        'meta_desc' => 'Tango Gestión - Software de gestión empresarial integral. ERP completo para PyMEs y grandes empresas.',
        'modules' => ['Ventas', 'Compras', 'Stock', 'Contabilidad', 'Tesorería', 'Sueldos']
    ],
    'punto-venta' => [
        'name' => 'Tango Punto de Venta',
        'slug' => 'tango-punto-de-venta',
        'color' => '#3FAE2A',
        'logo' => 'LogoPDV.png',
        'icon' => 'icon-Shopping-Cart',
        'short_desc' => 'Tango Punto de Venta administra todas las necesidades de tu negocio. Te ayuda a decidir. Te ayuda a vender. Podés tener información centralizada y por sucursal.',
        'meta_desc' => 'Tango Punto de Venta - La solución para tu comercio o cadena de comercios. Facturación rápida, control de stock y gestión integral.'
    ],
    'estudios-contables' => [
        'name' => 'Tango Estudios Contables',
        'slug' => 'tango-estudios-contables',
        'color' => '#FF8300',
        'logo' => 'logo_ec-blanco01.png',
        'icon' => 'icon-Calculator',
        'short_desc' => 'Desarrollado para agilizar y potenciar el trabajo del contador, sin importar el tamaño de la empresa cliente.',
        'meta_desc' => 'Tango Estudios Contables - Software para contadores y estudios contables. Gestión integral de clientes.'
    ],
    'resto' => [
        'name' => 'Tango Restô',
        'slug' => 'tango-resto',
        'color' => '#E31937',
        'logo' => 'Logo TR.png',
        'icon' => 'icon-Restaurant',
        'short_desc' => 'El software adaptable a todo tipo de negocio gastronómico, que ofrece una gestión integrada.',
        'meta_desc' => 'Tango Restô - Software para restaurantes, bares y gastronomía. Sistema completo de gestión gastronómica.'
    ],
    'capital-humano' => [
        'name' => 'Tango Capital Humano',
        'slug' => 'tango-capital-humano',
        'color' => '#28A745',
        'logo' => 'tangocaphumano.png',
        'icon' => 'icon-Users',
        'short_desc' => 'Sistema integral de gestión de recursos humanos. Administra personal, sueldos, capacitación y evaluación de desempeño.',
        'meta_desc' => 'Tango Capital Humano - Software de RRHH integral. Gestión completa de recursos humanos.'
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

function getWhatsAppLink($message = '') {
    $phone = str_replace(['+', ' ', '-'], '', SITE_PHONE);
    $msg = $message ? '&text=' . urlencode($message) : '';
    return "https://wa.me/{$phone}{$msg}";
}
?> 
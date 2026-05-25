<?php
declare(strict_types=1);

define('SITE_NAME', 'Servicios y Sistemas');
define('SITE_URL', 'https://serviciosysistemas.com.ar');
define('SITE_EMAIL', 'info@serviciosysistemas.com.ar');
define('SITE_EMAIL_VENTAS', 'daniel@serviciosysistemas.com.ar');
define('SITE_PHONE', '+54 3794 426022');
define('SITE_PHONE_DISPLAY', '(0379) 4426022');
define('SITE_ADDRESS', 'San Martín 1180, Corrientes, Argentina');
define('SITE_YEAR_FOUNDED', 1993);
define('SITE_YEARS_EXPERIENCE', (int) date('Y') - SITE_YEAR_FOUNDED);
define('SITE_WHATSAPP', '5493794426022');

define('ECOMMERCE_URL', 'https://tienda.serviciosysistemas.com.ar/public/home.php');
define('SUPPORT_URL', 'https://soporte.serviciosysistemas.com.ar/upload/');

define('DEFAULT_META_DESCRIPTION', 'Soluciones tecnológicas integrales para empresas. Distribuidores oficiales de Tango Software. Más de ' . SITE_YEARS_EXPERIENCE . ' años de experiencia en el NEA.');
define('DEFAULT_META_KEYWORDS', 'tango software, sistemas, erp, punto de venta, gestion empresarial, corrientes, argentina');

$product_display_order = ['gestion', 'punto-venta', 'estudios-contables', 'resto', 'capital-humano'];

$tango_products = [
    'gestion' => [
        'name' => 'Tango Gestión',
        'slug' => 'tango-gestion',
        'color' => '#0d6efd',
        'logo' => 'logogestion.png',
        'logo_dark' => 'logogestionw.png',
        'icon' => 'briefcase',
        'short_desc' => 'Software integral para PyMEs y grandes empresas, diseñado para maximizar resultados de forma sencilla y en el menor tiempo posible.',
        'meta_desc' => 'Tango Gestión - Software de gestión empresarial integral. ERP completo para PyMEs y grandes empresas.',
        'modules' => [
            ['name' => 'Ventas', 'icon' => 'trending-up', 'desc' => 'Facturación electrónica, presupuestos, remitos y gestión de clientes.'],
            ['name' => 'Compras', 'icon' => 'shopping-bag', 'desc' => 'Órdenes de compra, recepción de mercadería y control de proveedores.'],
            ['name' => 'Stock', 'icon' => 'package', 'desc' => 'Control de inventario multi-depósito, trazabilidad y valorización.'],
            ['name' => 'Contabilidad', 'icon' => 'book-open', 'desc' => 'Plan de cuentas, asientos automáticos, balances y reportes contables.'],
            ['name' => 'Tesorería', 'icon' => 'credit-card', 'desc' => 'Gestión de cobros, pagos, bancos, cheques y flujo de fondos.'],
            ['name' => 'Sueldos', 'icon' => 'users', 'desc' => 'Liquidación de haberes, cargas sociales y reportes laborales.'],
        ],
    ],
    'punto-venta' => [
        'name' => 'Tango Punto de Venta',
        'slug' => 'tango-punto-de-venta',
        'color' => '#0d6efd',
        'logo' => 'logopdv.png',
        'logo_dark' => 'logopdv.png',
        'icon' => 'shopping-cart',
        'short_desc' => 'La solución ideal para comercios minoristas, sucursales y franquicias. Fácil de usar con máxima seguridad.',
        'meta_desc' => 'Tango Punto de Venta - La solución para tu comercio.',
    ],
    'estudios-contables' => [
        'name' => 'Tango Estudios Contables',
        'slug' => 'tango-estudios-contables',
        'color' => '#F47D30',
        'logo' => 'logoecw.png',
        'logo_dark' => 'logoecw.png',
        'icon' => 'calculator',
        'short_desc' => 'Desarrollado para agilizar y potenciar el trabajo del contador, sin importar el tamaño de la empresa cliente.',
        'meta_desc' => 'Tango Estudios Contables - Software para contadores y estudios contables.',
    ],
    'resto' => [
        'name' => 'Tango Restô',
        'slug' => 'tango-resto',
        'color' => '#E31937',
        'logo' => 'logoTR.png',
        'logo_dark' => 'logoTR.png',
        'icon' => 'coffee',
        'short_desc' => 'Software adaptable a todo tipo de negocio gastronómico, con gestión integrada para cualquier formato.',
        'meta_desc' => 'Tango Restô - Software para restaurantes, bares y gastronomía.',
    ],
    'capital-humano' => [
        'name' => 'Tango Capital Humano',
        'slug' => 'tango-capital-humano',
        'color' => '#0d6efd',
        'logo' => 'tangocaphumano.png',
        'logo_dark' => 'tangocaphumano.png',
        'icon' => 'users',
        'short_desc' => 'Sistema integral de gestión de recursos humanos. Administra personal, sueldos, capacitación y evaluación.',
        'meta_desc' => 'Tango Capital Humano - Software de RRHH integral.',
    ],
];

$partners = [
    ['name' => 'HP Business Partner', 'logo' => 'hp.png'],
    ['name' => 'Lenovo Partner', 'logo' => 'lenovo.png'],
    ['name' => 'Sophos Authorized Partner', 'logo' => 'sophos.png'],
    ['name' => 'Tango Software Partner', 'logo' => 'tango.png'],
];

$home_faqs = [
    [
        'question' => '¿Quiénes somos y cuál es nuestra trayectoria?',
        'answer' => 'Somos una empresa con más de ' . SITE_YEARS_EXPERIENCE . ' años de experiencia en soluciones tecnológicas para la gestión empresarial. Innovamos y nos adaptamos a negocios de distintos tamaños, integrando sistemas de gestión, ventas, contabilidad y más.',
    ],
    [
        'question' => '¿Qué soluciones y servicios ofrecemos?',
        'answer' => 'Ofrecemos una amplia gama de soluciones: Plataforma Tango (Gestión, Punto de Venta, Estudios Contables, Restô), Insumos Informáticos y Hosting de Servidores con alta disponibilidad.',
    ],
    [
        'question' => '¿Cómo garantizamos la calidad y seguridad?',
        'answer' => 'Trabajamos con altos estándares y tecnología de punta. Nuestros sistemas cuentan con cifrado, autenticación robusta y se alojan en Data Centers con monitoreo 24/7.',
    ],
    [
        'question' => '¿Qué soporte técnico ofrecen?',
        'answer' => 'Nuestro equipo de soporte está disponible de forma personalizada. Brindamos asesoría técnica, capacitación en implementación y seguimiento continuo.',
    ],
    [
        'question' => '¿Cómo es el proceso de implementación?',
        'answer' => 'El proceso se realiza en etapas: diagnóstico y asesoría, diseño y configuración, migración e integración, y capacitación con soporte continuo.',
    ],
    [
        'question' => '¿Qué alianzas estratégicas respaldan nuestras soluciones?',
        'answer' => 'Contamos con alianzas con HP, Lenovo, Sophos y Tango Software. Nuestras soluciones cumplen con normativas y certificaciones internacionales.',
    ],
];

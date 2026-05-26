<?php
/**
 * Funciones reutilizables para el sitio
 * Servicios y Sistemas SRL
 */

// Cult UI helpers (cultStatNumber, cultMarquee, cultFamilyFab, cultBadge)
require_once(__DIR__ . '/cult-components.php');

/**
 * Generar tarjeta de producto para la página de inicio
 */
function renderProductCard($key, $product, $delay = 0) {
    // Producto disponible / próximamente (config opcional 'available' en site config; por defecto true)
    $isAvailable = !isset($product['available']) || $product['available'] !== false;
    $minimalCls  = $isAvailable ? '' : ' cult-card-minimal';

    $html  = '<div class="col-xl-2 col-lg-4 col-md-6 col-10 text-center mb-4" data-aos="fade-up" data-aos-delay="' . $delay . '">';
    $html .= '<motion-tilt max-tilt="6" speed="400" style="display:block;">';
    $html .= '<div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl product-card-' . $key . ' cult-texture-deco position-relative' . $minimalCls . '">';

    // Badge solo para productos no disponibles
    if (!$isAvailable && function_exists('cultBadge')) {
        $html .= cultBadge('Próximamente', 'soon');
    }

    $html .= '<div class="mb-4 mx-auto width-15x height-15x flex-center position-relative">';

    // Determinar la ruta del logo
    $logoPath = 'assets/img/productos/' . $product['slug'] . '/';
    if (isset($product['logo_folder'])) {
        $logoPath .= $product['logo_folder'] . '/';
    }

    // Logo para tema claro con dimensiones explícitas (evita CLS)
    $logoLightSrc = $logoPath . $product['logo'];
    $logoLightSize = @getimagesize($logoLightSrc);
    $logoLightWidth = $logoLightSize ? (int) $logoLightSize[0] : 300;
    $logoLightHeight = $logoLightSize ? (int) $logoLightSize[1] : 180;
    $html .= '<img src="' . $logoLightSrc . '" alt="' . $product['name'] . '" class="img-fluid logo-light" width="' . $logoLightWidth . '" height="' . $logoLightHeight . '" loading="lazy" decoding="async">';

    // Logo para tema oscuro (si está disponible)
    if (isset($product['logo_dark'])) {
        $logoDarkSrc = $logoPath . $product['logo_dark'];
        $logoDarkSize = @getimagesize($logoDarkSrc);
        $logoDarkWidth = $logoDarkSize ? (int) $logoDarkSize[0] : 300;
        $logoDarkHeight = $logoDarkSize ? (int) $logoDarkSize[1] : 180;
        $html .= '<img src="' . $logoDarkSrc . '" alt="' . $product['name'] . '" class="img-fluid logo-dark" width="' . $logoDarkWidth . '" height="' . $logoDarkHeight . '" loading="lazy" decoding="async">';
    }

    $html .= '</div>';
    $html .= '<div class="d-flex align-items-center mb-3 justify-content-center w-100">';
    if ($isAvailable) {
        $html .= '<a href="' . $product['slug'] . '.php" class="btn btn-white btn-sm cult-btn-shimmer">ENTRAR</a>';
    } else {
        $html .= '<span class="btn btn-light btn-sm disabled">EN DESARROLLO</span>';
    }
    $html .= '</div>';
    $html .= '<p class="mb-0 w-lg-75 mx-auto text-white">' . $product['short_desc'] . '</p>';
    $html .= '</div>';
    $html .= '</motion-tilt>';
    $html .= '</div>';

    return $html;
}

/**
 * Generar breadcrumb
 */
function renderBreadcrumb($items) {
    $html = '<nav aria-label="breadcrumb">';
    $html .= '<ol class="breadcrumb">';
    $html .= '<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>';
    
    foreach ($items as $item) {
        if (isset($item['url'])) {
            $html .= '<li class="breadcrumb-item"><a href="' . $item['url'] . '">' . $item['label'] . '</a></li>';
        } else {
            $html .= '<li class="breadcrumb-item active" aria-current="page">' . $item['label'] . '</li>';
        }
    }
    
    $html .= '</ol>';
    $html .= '</nav>';
    
    return $html;
}

/**
 * Generar meta tags para redes sociales
 */
function generateSocialMeta($title, $description, $image = null) {
    $meta = '';
    
    // Open Graph
    $meta .= '<meta property="og:title" content="' . htmlspecialchars($title) . '">' . "\n";
    $meta .= '<meta property="og:description" content="' . htmlspecialchars($description) . '">' . "\n";
    $meta .= '<meta property="og:type" content="website">' . "\n";
    $meta .= '<meta property="og:url" content="' . getCurrentUrl() . '">' . "\n";
    
    if ($image) {
        $meta .= '<meta property="og:image" content="' . $image . '">' . "\n";
    }
    
    // Twitter Card
    $meta .= '<meta name="twitter:card" content="summary_large_image">' . "\n";
    $meta .= '<meta name="twitter:title" content="' . htmlspecialchars($title) . '">' . "\n";
    $meta .= '<meta name="twitter:description" content="' . htmlspecialchars($description) . '">' . "\n";
    
    if ($image) {
        $meta .= '<meta name="twitter:image" content="' . $image . '">' . "\n";
    }
    
    return $meta;
}

/**
 * Obtener URL actual
 */
function getCurrentUrl() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $url;
}

/**
 * Formatear número de teléfono para WhatsApp
 */
function formatPhoneForWhatsApp($phone) {
    // Remover caracteres no numéricos
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    // Si no empieza con código de país, agregar Argentina
    if (!str_starts_with($phone, '54')) {
        $phone = '54' . $phone;
    }
    
    return $phone;
}

/**
 * Generar enlace de WhatsApp
 */
function generateWhatsAppLink($message = '', $phone = null) {
    if (!$phone) {
        if (defined('SITE_WHATSAPP')) {
            $phone = SITE_WHATSAPP;
        } elseif (defined('SITE_PHONE')) {
            $phone = SITE_PHONE;
        }
    }
    
    $phone = formatPhoneForWhatsApp($phone);
    $link = 'https://wa.me/' . $phone;
    
    if ($message) {
        $link .= '?text=' . urlencode($message);
    }
    
    return $link;
}

/**
 * Truncar texto preservando palabras completas
 */
function truncateText($text, $length = 150, $suffix = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $truncated = substr($text, 0, $length);
    $lastSpace = strrpos($truncated, ' ');
    
    if ($lastSpace !== false) {
        $truncated = substr($truncated, 0, $lastSpace);
    }
    
    return $truncated . $suffix;
}

/**
 * Convertir array a atributos HTML
 */
function arrayToHtmlAttributes($attributes) {
    $html = '';
    
    foreach ($attributes as $key => $value) {
        if (is_bool($value)) {
            if ($value) {
                $html .= ' ' . $key;
            }
        } else {
            $html .= ' ' . $key . '="' . htmlspecialchars($value) . '"';
        }
    }
    
    return $html;
}

/**
 * Generar Schema markup para LocalBusiness
 */
function generateLocalBusinessSchema() {
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => SITE_NAME,
        "image" => SITE_URL . "/assets/img/logo/sys_logo.png",
        "@id" => SITE_URL,
        "url" => SITE_URL,
        "telephone" => SITE_PHONE,
        "email" => SITE_EMAIL,
        "priceRange" => "$$",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "San Martín 1180",
            "addressLocality" => "Corrientes",
            "addressRegion" => "Corrientes",
            "postalCode" => "3400",
            "addressCountry" => "AR"
        ],
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => -27.4692,
            "longitude" => -58.8306
        ],
        "openingHoursSpecification" => [
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens" => "08:00",
                "closes" => "13:00"
            ],
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens" => "16:00",
                "closes" => "20:00"
            ]
        ],
        "sameAs" => [
            "https://www.instagram.com/hardstore.ctes"
        ]
    ];
    
    return $schema;
}

/**
 * Generar Schema markup para Product (Productos Tango)
 */
function generateProductSchema($product) {
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "SoftwareApplication",
        "name" => $product['name'],
        "applicationCategory" => "BusinessApplication",
        "operatingSystem" => "Windows",
        "description" => isset($product['meta_desc']) ? $product['meta_desc'] : $product['short_desc'],
        "brand" => [
            "@type" => "Brand",
            "name" => "Tango Software"
        ],
        "offers" => [
            "@type" => "Offer",
            "price" => "0",
            "priceCurrency" => "ARS",
            "availability" => "https://schema.org/InStock",
            "priceSpecification" => [
                "@type" => "PriceSpecification",
                "priceCurrency" => "ARS",
                "price" => "Consultar precio"
            ],
            "seller" => [
                "@type" => "Organization",
                "name" => SITE_NAME
            ]
        ],
        "provider" => [
            "@type" => "Organization",
            "name" => SITE_NAME,
            "url" => SITE_URL
        ]
    ];
    
    if (isset($product['logo'])) {
        $logoPath = SITE_URL . '/assets/img/productos/' . $product['slug'] . '/' . $product['logo'];
        $schema['image'] = $logoPath;
    }
    
    return $schema;
}

/**
 * Generar Schema markup para Service
 */
function generateServiceSchema($service_name, $description, $service_type = "TechnologyService") {
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Service",
        "serviceType" => $service_type,
        "name" => $service_name,
        "description" => $description,
        "provider" => [
            "@type" => "LocalBusiness",
            "name" => SITE_NAME,
            "telephone" => SITE_PHONE,
            "email" => SITE_EMAIL,
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => "San Martín 1180",
                "addressLocality" => "Corrientes",
                "addressRegion" => "Corrientes",
                "postalCode" => "3400",
                "addressCountry" => "AR"
            ]
        ],
        "areaServed" => [
            "@type" => "City",
            "name" => "Corrientes",
            "containedInPlace" => [
                "@type" => "Country",
                "name" => "Argentina"
            ]
        ],
        "hasOfferCatalog" => [
            "@type" => "OfferCatalog",
            "name" => $service_name,
            "itemListElement" => [
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => $service_name
                    ]
                ]
            ]
        ]
    ];
    
    return $schema;
}

/**
 * Generar Schema markup para FAQ
 */
function generateFAQSchema($faqs) {
    if (empty($faqs)) {
        return null;
    }
    
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => []
    ];
    
    foreach ($faqs as $faq) {
        $schema['mainEntity'][] = [
            "@type" => "Question",
            "name" => $faq['question'],
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $faq['answer']
            ]
        ];
    }
    
    return $schema;
}

/**
 * Generar Schema markup para BreadcrumbList
 */
function generateBreadcrumbSchema($items) {
    if (empty($items)) {
        return null;
    }
    
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "BreadcrumbList",
        "itemListElement" => []
    ];
    
    $schema['itemListElement'][] = [
        "@type" => "ListItem",
        "position" => 1,
        "name" => "Inicio",
        "item" => SITE_URL
    ];
    
    $position = 2;
    foreach ($items as $item) {
        $breadcrumbItem = [
            "@type" => "ListItem",
            "position" => $position,
            "name" => $item['label']
        ];
        
        if (isset($item['url'])) {
            $breadcrumbItem['item'] = $item['url'];
        }
        
        $schema['itemListElement'][] = $breadcrumbItem;
        $position++;
    }
    
    return $schema;
}

/**
 * Generar clase CSS para animación AOS con delay
 */
function getAosDelay($index, $base = 50, $increment = 50) {
    return $base + ($index * $increment);
}
?>

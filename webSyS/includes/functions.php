<?php
/**
 * Funciones reutilizables para el sitio
 * Servicios y Sistemas SRL
 */

/**
 * Generar tarjeta de producto para la página de inicio
 */
function renderProductCard($key, $product, $delay = 0) {
    $html = '<div class="col-xl-2 col-lg-4 col-md-6 col-10 text-center mb-4" data-aos="fade-up" data-aos-delay="' . $delay . '">';
    $html .= '<div style="background-color:' . $product['color'] . ';" class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">';
    $html .= '<div class="mb-4 mx-auto width-15x height-15x flex-center position-relative">';
    
    // Determinar la ruta del logo
    $logoPath = 'assets/img/productos/' . $product['slug'] . '/';
    if (isset($product['logo_folder'])) {
        $logoPath .= $product['logo_folder'] . '/';
    }
    $logoPath .= $product['logo'];
    
    $html .= '<img src="' . $logoPath . '" alt="' . $product['name'] . '" class="img-fluid">';
    $html .= '</div>';
    $html .= '<div class="d-flex align-items-center mb-3 justify-content-center">';
    $html .= '<a href="' . $product['slug'] . '.php" class="btn btn-white btn-sm mr-3 me-3">ENTRAR</a>';
    $html .= '</div>';
    $html .= '<p class="mb-0 w-lg-75 mx-auto text-white">' . $product['short_desc'] . '</p>';
    $html .= '</div>';
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
    if (!$phone && defined('SITE_PHONE')) {
        $phone = SITE_PHONE;
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
            "@type" => "OpeningHoursSpecification",
            "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens" => "08:00",
            "closes" => "18:00"
        ],
        "sameAs" => [
            "https://www.facebook.com/serviciosysistemas",
            "https://www.instagram.com/serviciosysistemas"
        ]
    ];
    
    return json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}

/**
 * Verificar si es dispositivo móvil
 */
function isMobile() {
    return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $_SERVER['HTTP_USER_AGENT']);
}

/**
 * Generar clase CSS para animación AOS con delay
 */
function getAosDelay($index, $base = 50, $increment = 50) {
    return $base + ($index * $increment);
}
?> 
<?php
/**
 * Sitemap XML dinámico
 * Genera un sitemap actualizado de todas las páginas del sitio
 * Servicios y Sistemas SRL
 */

header('Content-Type: application/xml; charset=utf-8');

// Incluir configuración
require_once('config/config.php');

// URL base del sitio
$base_url = SITE_URL;

// Obtener la fecha de última modificación de un archivo
function getLastModified($file) {
    if (file_exists($file)) {
        return date('c', filemtime($file));
    }
    return date('c');
}

// Definir todas las URLs del sitio con sus propiedades
$urls = [
    // Página principal
    [
        'loc' => $base_url . '/',
        'lastmod' => getLastModified(__DIR__ . '/index.php'),
        'changefreq' => 'weekly',
        'priority' => '1.0'
    ],
    
    // Productos Tango
    [
        'loc' => $base_url . '/tango-gestion.php',
        'lastmod' => getLastModified(__DIR__ . '/tango-gestion.php'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'loc' => $base_url . '/tango-delta.php',
        'lastmod' => getLastModified(__DIR__ . '/tango-delta.php'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'loc' => $base_url . '/tango-estudios-contables.php',
        'lastmod' => getLastModified(__DIR__ . '/tango-estudios-contables.php'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'loc' => $base_url . '/tango-punto-de-venta.php',
        'lastmod' => getLastModified(__DIR__ . '/tango-punto-de-venta.php'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'loc' => $base_url . '/tango-resto.php',
        'lastmod' => getLastModified(__DIR__ . '/tango-resto.php'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    [
        'loc' => $base_url . '/tango-capital-humano.php',
        'lastmod' => getLastModified(__DIR__ . '/tango-capital-humano.php'),
        'changefreq' => 'weekly',
        'priority' => '0.9'
    ],
    
    // Servicios
    [
        'loc' => $base_url . '/datacenter.php',
        'lastmod' => getLastModified(__DIR__ . '/datacenter.php'),
        'changefreq' => 'monthly',
        'priority' => '0.8'
    ],
    [
        'loc' => $base_url . '/gestion-it.php',
        'lastmod' => getLastModified(__DIR__ . '/gestion-it.php'),
        'changefreq' => 'monthly',
        'priority' => '0.8'
    ]
];

// Generar XML del sitemap
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<?php foreach ($urls as $url): ?>
    <url>
        <loc><?= htmlspecialchars($url['loc']) ?></loc>
        <lastmod><?= $url['lastmod'] ?></lastmod>
        <changefreq><?= $url['changefreq'] ?></changefreq>
        <priority><?= $url['priority'] ?></priority>
    </url>
<?php endforeach; ?>
</urlset>


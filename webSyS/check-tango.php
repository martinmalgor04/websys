<?php
header('Content-Type: text/plain; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');

$log = [];
try {
    require_once __DIR__ . '/config/config.php';
    $log[] = '1 config';

    require_once __DIR__ . '/includes/functions.php';
    $log[] = '2 functions';

    require_once __DIR__ . '/includes/security-init.php';
    initSecurity();
    $log[] = '3 security';

    require_once __DIR__ . '/includes/components/cult-hero-product.php';
    require_once __DIR__ . '/includes/components/cult-modules-grouped.php';
    require_once __DIR__ . '/includes/components/cult-cta-form.php';
    require_once __DIR__ . '/includes/components/card-hover-2.php';
    require_once __DIR__ . '/includes/components/reportes-slider.php';
    require_once __DIR__ . '/includes/components/video-embed.php';
    $log[] = '4 components';

    $product_key = 'gestion';
    $product = $tango_products[$product_key];
    $whatsapp_demo = generateWhatsAppLink('test');

    ob_start();
    renderCultProductHero([
        'eyebrow_text' => 'test',
        'title'        => 'test',
        'shimmer'      => 'test',
        'subtitle'     => 'test',
        'ctas'         => [],
        'logo_src'     => 'assets/img/productos/tango-gestion/' . $product['logo_dark'],
        'logo_alt'     => $product['name'],
        'product_color'=> $product['color'],
    ]);
    $hero = ob_get_clean();
    $log[] = '5 hero len=' . strlen($hero);

    $product_key = 'gestion';
    include __DIR__ . '/templates/tango-product-template.php';
    $log[] = '6 template ok';
} catch (Throwable $e) {
    $log[] = 'ERR: ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine();
}

echo implode("\n", $log);

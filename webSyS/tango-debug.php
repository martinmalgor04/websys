<?php
/**
 * Diagnóstico temporal — eliminar después de arreglar Tango en producción.
 */
header('Content-Type: text/plain; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');

$steps = [];

try {
    require_once __DIR__ . '/config/config.php';
    $steps[] = 'config OK';

    require_once __DIR__ . '/includes/functions.php';
    $steps[] = 'functions OK';

    require_once __DIR__ . '/includes/security-init.php';
    $steps[] = 'security-init loaded';

    $steps[] = initSecurity() ? 'initSecurity OK' : 'initSecurity FAILED';

    foreach ([
        'includes/components/cult-hero-product.php',
        'includes/components/cult-modules-grouped.php',
        'includes/components/cult-cta-form.php',
        'includes/components/card-hover-2.php',
        'includes/components/reportes-slider.php',
        'includes/components/video-embed.php',
        'templates/tango-product-template.php',
    ] as $file) {
        $full = __DIR__ . '/' . $file;
        $steps[] = (is_file($full) ? 'exists' : 'MISSING') . ': ' . $file;
        if (is_file($full)) {
            require_once $full;
        }
    }

    $steps[] = 'env webSyS/.env: ' . (is_file(__DIR__ . '/.env') ? 'yes' : 'no');
    $steps[] = 'env private: ' . (is_file(__DIR__ . '/../private/.env') ? 'yes' : 'no');
    $steps[] = 'PHP ' . PHP_VERSION;
    $steps[] = function_exists('renderCultProductHero') ? 'renderCultProductHero OK' : 'renderCultProductHero MISSING';
} catch (Throwable $e) {
    $steps[] = 'ERROR: ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine();
}

echo implode("\n", $steps);

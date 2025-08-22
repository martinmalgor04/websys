<?php
/**
 * Template para el encabezado HTML
 * Incluye meta tags, título dinámico y links CSS
 */

// Incluir configuración si no está cargada
if (!defined('SITE_NAME')) {
    require_once(__DIR__ . '/../config/config.php');
}

// Valores por defecto
$page_title = isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME;
$meta_description = isset($meta_description) ? $meta_description : DEFAULT_META_DESCRIPTION;
$meta_keywords = isset($meta_keywords) ? $meta_keywords : DEFAULT_META_KEYWORDS;
$canonical_url = isset($canonical_url) ? $canonical_url : '';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- SEO Meta Tags -->
    <title><?= htmlspecialchars($page_title) ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords) ?>">
    <meta name="author" content="<?= SITE_NAME ?>">
    <?php if ($canonical_url): ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonical_url) ?>">
    <?php endif; ?>
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL ?>">
    <meta property="og:image" content="<?= SITE_URL ?>/assets/img/sharing/serviciosysistemas_.jpg">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($page_title) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($meta_description) ?>">
    <meta name="twitter:image" content="<?= SITE_URL ?>/assets/img/sharing/serviciosysistemas_.jpg">
    
    <!-- Schema.org JSON-LD -->
    <?php if (isset($schema_markup)): ?>
    <script type="application/ld+json">
    <?= json_encode($schema_markup, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
    </script>
    <?php endif; ?>
    
    <!-- CSS y Scripts -->
    <?php include(__DIR__ . '/link.php'); ?>
</head>
<body<?= isset($body_id) ? ' id="' . htmlspecialchars($body_id) . '"' : '' ?><?= isset($body_class) ? ' class="' . htmlspecialchars($body_class) . '"' : '' ?>> 
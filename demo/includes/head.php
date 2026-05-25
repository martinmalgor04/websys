<?php
declare(strict_types=1);

if (!defined('SITE_NAME')) {
    require_once __DIR__ . '/../config/site.php';
    require_once __DIR__ . '/../config/seo.php';
    require_once __DIR__ . '/../includes/helpers.php';
    require_once __DIR__ . '/../includes/icon.php';
}

$page_title = isset($page_title) ? e($page_title) . ' — ' . SITE_NAME : SITE_NAME;
$meta_description = isset($meta_description) ? e($meta_description) : DEFAULT_META_DESCRIPTION;
$meta_keywords = isset($meta_keywords) ? e($meta_keywords) : DEFAULT_META_KEYWORDS;
$canonical_url = $canonical_url ?? '';
$og_image = $og_image ?? SITE_URL . '/assets/img/sharing/serviciosysistemas_.jpg';
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <title><?= $page_title ?></title>
    <meta name="description" content="<?= $meta_description ?>">
    <meta name="keywords" content="<?= $meta_keywords ?>">
    <meta name="author" content="<?= SITE_NAME ?>">
    <?php if ($canonical_url): ?>
    <link rel="canonical" href="<?= e($canonical_url) ?>">
    <?php endif; ?>

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="language" content="Spanish">
    <meta name="geo.region" content="AR-W">
    <meta name="geo.position" content="-27.4675311;-58.8346995">
    <meta name="geo.placename" content="Corrientes">
    <meta http-equiv="x-dns-prefetch-control" content="on">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= $page_title ?>">
    <meta property="og:description" content="<?= $meta_description ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $canonical_url ? e($canonical_url) : SITE_URL ?>">
    <meta property="og:image" content="<?= e($og_image) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    <meta property="og:locale" content="es_AR">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $page_title ?>">
    <meta name="twitter:description" content="<?= $meta_description ?>">
    <meta name="twitter:image" content="<?= e($og_image) ?>">

    <!-- hreflang -->
    <link rel="alternate" hreflang="es-ar" href="<?= $canonical_url ? e($canonical_url) : SITE_URL ?>">
    <link rel="alternate" hreflang="x-default" href="<?= $canonical_url ? e($canonical_url) : SITE_URL ?>">

    <!-- Schema.org JSON-LD -->
    <?php if (isset($schemas) && is_array($schemas)): ?>
        <?= renderSchemas($schemas) ?>
    <?php endif; ?>

    <!-- Favicon -->
    <link rel="icon" href="<?= asset('') ?>../favicon.ico" type="image/x-icon">

    <!-- Google Fonts — Poppins + Source Serif Pro (same as webSyS) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital@0;1&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,400&family=Source+Serif+Pro:ital@0;1&display=swap" rel="stylesheet">
    </noscript>

    <!-- LCP image preload -->
    <?php if (isset($lcp_image)): ?>
    <link rel="preload" href="<?= e($lcp_image) ?>" as="image" fetchpriority="high">
    <?php endif; ?>

    <!-- CSS -->
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/cult.css') ?>">

    <!-- Prefetch product page when on home -->
    <?php if (isset($body_id) && $body_id === 'home'): ?>
    <link rel="prefetch" href="tango-gestion.php">
    <script type="speculationrules">
    {
      "prerender": [
        { "where": { "href_matches": "tango-gestion.php" }, "eagerness": "moderate" }
      ]
    }
    </script>
    <?php endif; ?>

    <!-- PWA -->
    <link rel="manifest" href="manifest.webmanifest">
    <meta name="theme-color" content="#FFFFFF" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0F1321" media="(prefers-color-scheme: dark)">

    <!-- motion-components: web components con spring physics (progressive enhancement) -->
    <script type="module" src="https://unpkg.com/motion-components@latest" crossorigin></script>

    <!-- Theme detection (inline to prevent FOUC) -->
    <script>
    (function(){
      var t = window.matchMedia('(prefers-color-scheme:dark)').matches ? 'dark' : 'light';
      document.documentElement.setAttribute('data-theme', t);
      document.documentElement.style.colorScheme = t;
    })();
    </script>
</head>
<body<?= isset($body_id) ? ' id="' . e($body_id) . '"' : '' ?>>
<a href="#main-content" class="skip-link">Ir al contenido principal</a>

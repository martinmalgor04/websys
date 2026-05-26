<?php
/**
 * Template genérico para productos Tango
 * Este template se usa para todos los productos Tango para evitar duplicación de código
 *
 * Variables requeridas:
 * - $product_key: clave del producto en el array $tango_products
 *
 * Variables opcionales (slots):
 * - $modules                  Array de módulos del producto (renderiza grid clásico).
 * - $modules_html             HTML pre-renderizado que reemplaza el grid clásico
 *                              (útil para usar renderCultModulesGrouped).
 * - $faq_items                Array de preguntas frecuentes.
 * - $render_faq               bool (default false). Activar la sección FAQ.
 *                              Las páginas legacy con $faq_items definidos pero
 *                              sin este flag NO renderizarán el bloque (back-compat).
 * - $custom_content           HTML inyectado entre módulos y partners (legacy).
 * - $partners_after_modules   HTML de partners (legacy).
 * - $hero_html                HTML completo del hero (reemplaza el hero por defecto).
 * - $stats_strip_html         HTML de la franja de stats bajo el hero.
 * - $intro_html               HTML completo de intro (reemplaza la intro por defecto).
 * - $show_intro               bool (default true). Si false, oculta la intro.
 * - $show_default_hero        bool (default true). Si false, oculta el hero por defecto.
 * - $pre_modules_html         HTML inyectado antes de la sección de módulos.
 * - $post_modules_html        HTML inyectado después de la sección de módulos.
 * - $cta_html                 HTML del CTA principal (antes del nav de productos).
 * - $show_product_nav         bool (default true). Si false, oculta el nav final.
 * - $schema_markup            Schema(s) JSON-LD (puede ser uno o array de schemas).
 * - $body_class               Clase extra para el <body>.
 */

// Incluir configuración
require_once('config/config.php');

// Obtener información del producto
if (!isset($product_key) || !isset($tango_products[$product_key])) {
    die('Error: Producto no encontrado');
}

$product = $tango_products[$product_key];
$product_logo_path = 'assets/img/productos/' . $product['slug'] . '/' . (isset($product['logo_folder']) ? $product['logo_folder'] . '/' : '') . $product['logo'];
$product_logo_size = @getimagesize($product_logo_path);
$product_logo_width = $product_logo_size ? (int) $product_logo_size[0] : 350;
$product_logo_height = $product_logo_size ? (int) $product_logo_size[1] : 210;

// Incluir funciones
require_once('includes/functions.php');

// Configurar meta tags
$page_title = $product['name'] . ' - Productos';
$meta_description = $product['meta_desc'];
$meta_keywords = strtolower($product['name']) . ', software empresarial, erp, gestion, tango software, corrientes, argentina';
$canonical_url = SITE_URL . '/' . $product['slug'] . '.php';

// Schema markup: respeta el que ya haya definido la página
if (!isset($schema_markup)) {
    $schema_markup = generateProductSchema($product);
}

// Incluir head
include('includes/head.php');
?>

<!--Preloader Spinner-->
<div class="spinner-loader bg-primary text-white">
    <div class="spinner-grow" role="status">
    </div>
    <span class="small d-block ms-2">Cargando...</span>
</div>

<!--Header Start-->
<?php include('includes/nav.php'); ?>

<?php
$show_default_hero = isset($show_default_hero) ? (bool) $show_default_hero : true;
$show_intro        = isset($show_intro)        ? (bool) $show_intro        : true;
$show_product_nav  = isset($show_product_nav)  ? (bool) $show_product_nav  : true;
?>
<!--Main content-->
<main class="main-content" id="main-content">

    <?php if (isset($hero_html)): ?>
        <?= $hero_html ?>
    <?php elseif ($show_default_hero): ?>
    <!--begin: Header del producto (default) -->
    <section class="position-relative text-white overflow-hidden cult-page-header" style="background-color:<?= $product['color'] ?>; isolation:isolate;">
        <div class="cult-hero-grid" aria-hidden="true"></div>
        <span class="cult-blob cult-blob--cyan" style="top:-15%; right:-10%; opacity:0.3; animation-delay:0s;" aria-hidden="true"></span>
        <span class="cult-blob" style="bottom:-20%; left:-15%; width:30rem; height:30rem; background:#ffffff; opacity:0.08; animation-delay:-6s;" aria-hidden="true"></span>
        <div class="container py-9 py-lg-15">
            <div class="row pt-4">
                <div class="col-xl-12">
                    <div class="d-flex align-items-center justify-content-center">
                        <motion-tilt max-tilt="6" speed="400" style="display:block; width:100%;">
                            <img src="<?= htmlspecialchars($product_logo_path, ENT_QUOTES, 'UTF-8') ?>"
                                 title="<?= $product['name'] ?>"
                                 alt="<?= $product['name'] ?>"
                                 class="img-fluid mx-auto product-logo-enhanced d-block"
                                 width="<?= $product_logo_width ?>"
                                 height="<?= $product_logo_height ?>"
                                 loading="eager"
                                 decoding="async"
                                 style="filter: drop-shadow(0 12px 32px rgba(0,0,0,0.3));">
                        </motion-tilt>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end: Header del producto -->
    <?php endif; ?>

    <?php if (isset($stats_strip_html)): ?>
        <?= $stats_strip_html ?>
    <?php endif; ?>

    <?php if (isset($intro_html)): ?>
        <?= $intro_html ?>
    <?php elseif ($show_intro): ?>
    <!--begin: Introducción -->
    <section class="overflow-hidden bg-body position-relative">
        <div class="container position-relative py-9 py-lg-9">
            <?php if (isset($intro_title)): ?>
            <h2 class="display-5 text-center mb-5"><?= $intro_title ?></h2>
            <?php endif; ?>

            <div class="row justify-content-center">
                <div class="col-md-10 text-center mb-4" data-aos="fade-up" data-aos-delay="50">
                    <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                        <p class="lead mx-auto text-dark">
                            <?= isset($intro_text) ? $intro_text : $product['short_desc'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end: Introducción -->
    <?php endif; ?>

    <?php if (isset($pre_modules_html)): ?>
        <?= $pre_modules_html ?>
    <?php endif; ?>

    <?php if (isset($modules_html)): ?>
        <?= $modules_html ?>
    <?php elseif (isset($modules) && count($modules) > 0): ?>
    <!--begin: Módulos -->
    <section class="overflow-hidden bg-gradient-light position-relative">
        <div class="container position-relative py-9 py-lg-11">
            <div class="row mb-9 mb-lg-11 justify-content-between align-items-end">
                <div class="col-lg-10 col-xl-8 mx-auto text-center">
                    <h2 class="display-5 mb-0" data-aos="fade-up">Módulos y <span class="cult-shimmer-text">Funcionalidades</span></h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <?php foreach ($modules as $index => $module): ?>
                <div class="col-md-6 col-lg-4 text-center mb-4" data-aos="fade-up" data-aos-delay="<?= 50 + ($index * 50) ?>">
                    <motion-tilt max-tilt="4" speed="400" style="display:block; height:100%;">
                        <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                            <div class="mb-4 position-relative">
                                <i class="<?= $module['icon'] ?> display-3 text-primary"></i>
                            </div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0"><?= $module['title'] ?></h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                                <?= $module['description'] ?>
                            </p>
                        </div>
                    </motion-tilt>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--end: Módulos -->
    <?php endif; ?>

    <?php if (isset($post_modules_html)): ?>
        <?= $post_modules_html ?>
    <?php endif; ?>

    <?php if (isset($custom_content)): ?>
        <?= $custom_content ?>
    <?php endif; ?>

    <?php if (isset($partners_after_modules)): ?>
        <?= $partners_after_modules ?>
    <?php endif; ?>

    <?php if (isset($cta_html)): ?>
        <?= $cta_html ?>
    <?php endif; ?>

    <?php
    // Back-compat: solo renderizar FAQ si la página lo activó explícitamente.
    // Páginas legacy con $faq_items definidos pero sin $render_faq conservan
    // el comportamiento previo (FAQ oculto).
    $render_faq = isset($render_faq) ? (bool) $render_faq : false;
    if ($render_faq && isset($faq_items) && is_array($faq_items) && count($faq_items) > 0):
        $faq_title    = isset($faq_title)    ? $faq_title    : 'Preguntas frecuentes — ' . $product['name'];
        $faq_subtitle = isset($faq_subtitle) ? $faq_subtitle : 'Resolvemos las dudas más comunes sobre ' . $product['name'] . '.';
        $faq_use_cult = isset($faq_use_cult) ? $faq_use_cult : true;
        include('includes/faq-template.php');
    endif; ?>

    <?php if ($show_product_nav): ?>
    <!--begin: Navegación productos -->
    <section class="position-relative border-bottom overflow-hidden product-navigation-bg">
        <div class="container py-9 py-lg-11 position-relative">
            <div class="row pt-5 pt-lg-7 justify-content-center align-items-center">
                <div class="col-xl-10 text-center mb-9">
                    <h4 class="display-4 mb-3 mobile-responsive-heading" data-aos="fade-up">Conoce nuestros productos</h4>

                    <div data-aos="fade-up" data-aos-delay="150">
                        <?php foreach ($tango_products as $key => $p): ?>
                            <?php if ($key !== $product_key): ?>
                            <a href="<?= $p['slug'] ?>.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill mb-2">
                                <span><?= $p['name'] ?></span>
                            </a>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end: Navegación productos -->
    <?php endif; ?>
</main>

<!--begin:Footer-->
<?php include('includes/footer.php'); ?>
<!--end:Footer-->

<?php include('includes/script.php'); ?>

</body>
</html> 
<?php
/**
 * Template genérico para productos Tango
 * Este template se usa para todos los productos Tango para evitar duplicación de código
 * 
 * Variables requeridas:
 * - $product_key: clave del producto en el array $tango_products
 * - $modules: array con los módulos del producto (opcional)
 * - $faq_items: array con preguntas frecuentes del producto (opcional)
 * - $custom_content: contenido HTML personalizado del producto (opcional)
 */

// Incluir configuración
require_once('config/config.php');

// Obtener información del producto
if (!isset($product_key) || !isset($tango_products[$product_key])) {
    die('Error: Producto no encontrado');
}

$product = $tango_products[$product_key];

// Configurar meta tags
$page_title = $product['name'] . ' - Productos';
$meta_description = $product['meta_desc'];
$canonical_url = SITE_URL . '/' . $product['slug'] . '.php';

// Schema markup
$schema_markup = [
    "@context" => "https://schema.org",
    "@type" => "SoftwareApplication",
    "name" => $product['name'],
    "description" => $product['meta_desc'],
    "applicationCategory" => "BusinessApplication",
    "operatingSystem" => "Windows",
    "offers" => [
        "@type" => "Offer",
        "price" => "0",
        "priceCurrency" => "ARS",
        "availability" => "https://schema.org/InStock",
        "seller" => [
            "@type" => "Organization",
            "name" => SITE_NAME
        ]
    ]
];

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

<!--Main content-->
<main class="main-content" id="main-content">
    <!--begin: Header del producto -->
    <section class="position-relative text-white" style="background-color:<?= $product['color'] ?>;">
        <div class="container position-relative py-9 py-lg-15">
            <div class="row pt-4">
                <div class="col-xl-12">
                    <div class="d-flex align-items-center">
                        <img src="assets/img/productos/<?= $product['slug'] ?>/<?= isset($product['logo_folder']) ? $product['logo_folder'] . '/' : '' ?><?= $product['logo'] ?>" 
                             title="<?= $product['name'] ?>" 
                             alt="<?= $product['name'] ?>" 
                             class="img-fluid mx-auto" 
                             style="max-height: 150px;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end: Header del producto -->
    
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
    
    <?php if (isset($custom_content)): ?>
        <?= $custom_content ?>
    <?php endif; ?>
    
    <?php if (isset($modules) && count($modules) > 0): ?>
    <!--begin: Módulos -->
    <section class="overflow-hidden bg-gradient-light position-relative">
        <div class="container position-relative py-9 py-lg-11">
            <div class="row mb-9 mb-lg-11 justify-content-between align-items-end">
                <div class="col-lg-10 col-xl-8 mx-auto text-center">
                    <h2 class="display-5 mb-0" data-aos="fade-up">Módulos y Funcionalidades</h2>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <?php foreach ($modules as $index => $module): ?>
                <div class="col-md-6 col-lg-4 text-center mb-4" data-aos="fade-up" data-aos-delay="<?= 50 + ($index * 50) ?>">
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
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!--end: Módulos -->
    <?php endif; ?>
    
    <?php if (isset($partners_after_modules)): ?>
        <?= $partners_after_modules ?>
    <?php endif; ?>
    
    <?php if (isset($faq_items) && count($faq_items) > 0): ?>
        <?php 
        // Configurar FAQ
        $faq_title = "PREGUNTAS FRECUENTES - " . strtoupper($product['name']);
        $faq_subtitle = "Resolvemos las dudas más comunes sobre " . $product['name'];
        include('includes/faq-template.php');
        ?>
    <?php endif; ?>
    
    <!--begin: Navegación productos -->
    <section class="position-relative border-bottom overflow-hidden" style="background-color: #E3F2FD">
        <div class="container py-9 py-lg-11 position-relative">
            <div class="row pt-5 pt-lg-7 justify-content-center align-items-center">
                <div class="col-xl-10 text-center mb-9">
                    <h4 class="display-4 mb-3" data-aos="fade-up">Conoce nuestros productos</h4>
                    
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
</main>

<!--begin:Footer-->
<?php include('includes/footer.php'); ?>
<!--end:Footer-->

<?php include('includes/script.php'); ?>

</body>
</html> 
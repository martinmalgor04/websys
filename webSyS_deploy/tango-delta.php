<?php
/**
 * Página Tango Delta 5 - Versión Standalone
 * La nueva generación de software empresarial con IA integrada
 */

header('Content-Type: text/html; charset=utf-8');

// Incluir configuración y funciones
require_once('config/config.php');
require_once('includes/functions.php');

// Configurar página
$page_title = 'Tango Delta 5';
$meta_description = $tango_products['delta']['meta_desc'];
$canonical_url = SITE_URL . '/tango-delta.php';
$body_id = 'tango-delta';

// Schema markup específico para Delta
$schema_markup = [
    "@context" => "https://schema.org",
    "@type" => "SoftwareApplication",
    "name" => $tango_products['delta']['name'],
    "description" => $tango_products['delta']['meta_desc'],
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

// Incluir encabezado HTML
include('includes/head.php');
?>
    <!-- Delta-specific CSS -->
    <link rel="stylesheet" href="assets/css/delta-styles.css">
</head>

<body id="tango-delta">
    <!--Preloader Spinner-->
    <div class="spinner-loader bg-primary text-white">
        <div class="spinner-grow" role="status"></div>
        <span class="small d-block ms-2">Cargando...</span>
    </div>

    <!--Header Start-->
    <?php include('includes/nav.php'); ?>

    <!--Main content-->
    <main class="main-content" id="main-content">
        
        <!-- Hero Section - La evolución de tu negocio -->
        <section class="position-relative py-11 py-lg-13 hero-delta-section" style="background: linear-gradient(135deg, #000000 0%, #000000 40%, #1e40af 70%, #1e40af 100%);">
            <!-- Background Image Overlay -->
            <div class="hero-background-overlay"></div>
            
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="row align-items-center">
                            <!-- Text Content - Left Side -->
                            <div class="col-lg-6 text-start" data-aos="fade-right">
                                <h1 class="display-3 fw-bold text-white mb-2 hero-title">
                                    LA EVOLUCIÓN<br>
                                    DE TU NEGOCIO CON<br>
                                    <span class="text-warning fw-bold" style="color: #ffc107 !important;">INTELIGENCIA<br>ARTIFICIAL</span>
                                </h1>
                                <p class="lead text-white-75 mb-3 hero-subtitle" data-aos="fade-up" data-aos-delay="150">
                                    Tecnología avanzada y una plataforma cada vez más abierta y flexible.
                                </p>
                            </div>
                            
                            <!-- Visual Element - Right Side -->
                            <div class="col-lg-6 text-center" data-aos="fade-left">
                                <div class="hero-visual-container">
                                    <div class="hero-logo-container">
                                        <img src="assets/img/productos/tango-delta/delta5isow.webp" alt="Tango Delta 5 Logo" class="img-fluid hero-logo" style="max-height: 200px shadow="fade";">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Inteligencia Artificial en Tango -->
        <section class="position-relative py-0 py-lg-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10 text-center mb-4">
                        <h2 class="display-4 mb-4" data-aos="fade-up">Inteligencia Artificial en Tango</h2>
                        <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
                            Sumamos AI para que analices datos en lenguaje natural, automatices tareas y ejecutes acciones, 
                            obteniendo respuestas más rápidas, incluso a partir de información cruzada entre módulos y datos no uniformes.
                        </p>
                        <div class="bg-light rounded-4 p-5 mb-0" data-aos="fade-up" data-aos-delay="200">
                            <h4 class="fw-bold mb-3">Más simple, más fácil, más rápido.</h4>
                            <p class="mb-3">
                                Todo bajo un principio clave: <strong>la soberanía de tus datos</strong>. Vos elegís con qué proveedor trabajar; 
                                ellos pueden analizarlos, pero nunca resguardarlos. La información siempre es tuya.
                            </p>
                            <p class="mb-0 fw-semibold text-primary">
                                <strong>Tecnología con propósito, sin perder el control.</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Funcionalidades principales -->
        <section class="position-relative pt-0 py-lg-0 bg-light">
            <div class="container">
                <div class="row g-5">
                    <!-- Automatizá tus pedidos -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="bg-white rounded-4 p-5 h-100 shadow-sm">
                            <div class="icon-box bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                                <i class="bx bx-package fs-4"></i>
                            </div>
                            <h3 class="mb-3">Automatizá tus pedidos</h3>
                            <h5 class="text-muted mb-3">Seguimos ampliando las posibilidades de integración de Tango.</h5>
                            <p class="mb-0">
                                Ahora en Ventas también podés modificar pedidos desde Excel o mediante API, respetando todas las validaciones 
                                del sistema y utilizando los datos por defecto del perfil seleccionado.
                            </p>
                        </div>
                    </div>

                    <!-- Diseñá tus comprobantes -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="bg-white rounded-4 p-5 h-100 shadow-sm">
                            <div class="icon-box bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                                <i class="bx bx-palette fs-4"></i>
                            </div>
                            <h3 class="mb-3">Diseñá tus comprobantes</h3>
                            <h5 class="text-muted mb-3">Nueva herramienta gráfica para poder diseñar intuitivamente tus formularios.</h5>
                            <p class="mb-0">
                                Vas a poder definir colores, incluir fórmulas para mostrar datos del comprobante según una condición, 
                                definir comportamientos, trabajar por secciones y agregar imágenes utilizando una herramienta gráfica. 
                                También contarás con modelos predefinidos para agilizar el armado del formulario.
                            </p>
                        </div>
                    </div>

                    <!-- Visión total del cliente -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="bg-white rounded-4 p-5 h-100 shadow-sm">
                            <div class="icon-box bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                                <i class="bx bx-user-circle fs-4"></i>
                            </div>
                            <h3 class="mb-3">Visión total del cliente</h3>
                            <h5 class="text-muted mb-3">Gestión de Clientes: toda la información, en una sola vista.</h5>
                            <p class="mb-0">
                                Esta poderosa herramienta, que a partir de esta versión denominamos Gestión de Clientes, ofrece una 
                                visión integral y ágil de cada cliente, con indicadores claves en formato tablero, acceso a su situación 
                                financiera actualizada desde el BCRA y consultas dinámicas por ventas, cuentas corrientes, pedidos y cotizaciones. 
                                Todo adaptado al perfil del usuario y con acceso directo a fichas live y comprobantes.
                            </p>
                        </div>
                    </div>

                    <!-- Compras más rápidas -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="bg-white rounded-4 p-5 h-100 shadow-sm">
                            <div class="icon-box bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                                <i class="bx bx-brain fs-4"></i>
                            </div>
                            <h3 class="mb-3">Compras más rápidas</h3>
                            <h5 class="text-muted mb-3">Importación de comprobantes por AI</h5>
                            <p class="mb-0">
                                Ahora podés simplificar y acelerar la gestión de compras con la importación automática de comprobantes 
                                en formato PDF, gracias a la inteligencia artificial que automatiza su registración en el módulo, 
                                ahorrándote tiempo y reduciendo errores.
                            </p>
                        </div>
                    </div>

                    <!-- Sueldos, Fácil y Flexible -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="bg-white rounded-4 p-5 h-100 shadow-sm">
                            <div class="icon-box bg-purple text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px; background-color: #6f42c1;">
                                <i class="bx bx-calculator fs-4"></i>
                            </div>
                            <h3 class="mb-3">Sueldos, Fácil y Flexible</h3>
                            <h5 class="text-muted mb-3">Editor avanzado de fórmulas y pago de sueldos a múltiples cuentas bancarias.</h5>
                            <p class="mb-0">
                                En esta nueva versión de TANGO, además del asistente, contás con un nuevo editor de Fórmulas de liquidación 
                                que te permite buscar de forma rápida las variables, sugiriéndote automáticamente las opciones disponibles 
                                y completando sus parámetros de manera sencilla. También podrás registrar múltiples cuentas bancarias por 
                                empleado y distribuir la acreditación del sueldo por importe o porcentaje.
                            </p>
                        </div>
                    </div>

                    <!-- Tango Empleados -->
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="bg-white rounded-4 p-5 h-100 shadow-sm">
                            <div class="icon-box bg-danger text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 60px; height: 60px;">
                                <i class="bx bx-group fs-4"></i>
                            </div>
                            <h3 class="mb-3">Tango Empleados</h3>
                            <h5 class="text-muted mb-3">Nuevo módulo de Formularios + AI para responder consultas de RRHH</h5>
                            <p class="mb-0">
                                Ahora, dentro del circuito de Gestión Documental, contás con un nuevo módulo de Formularios personalizables 
                                que te permite gestionar trámites y solicitudes de forma más ágil, tomando datos automáticamente desde el 
                                sistema para evitar errores y mejorar la eficiencia. Además, podés centralizar toda la documentación de 
                                Recursos Humanos para que la AI la interprete y responda de forma inmediata a las consultas más frecuentes 
                                de tus colaboradores.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="position-relative py-9 py-lg-11" style="background: linear-gradient(135deg, #2563eb 0%, #000000 33%, #000000 66%, #2563eb 100%);">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-xl-8" data-aos="fade-up">
                        <div class="d-flex justify-content-center mb-4">
                            <img src="assets/img/productos/tango-delta/delta5isow.webp" alt="Tango Delta 5 Logo Blanco" class="img-fluid" style="max-height: 80px;">
                        </div>
                        <h2 class="display-5 text-white mb-4">¿Listo para experimentar el futuro de la gestión empresarial?</h2>
                        <p class="lead text-white-75 mb-5">
                            Descubrí todas las innovaciones de Tango Delta 5 y cómo la inteligencia artificial puede transformar tu negocio.
                        </p>
                        <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                            <a href="mailto:<?= SITE_EMAIL ?>" class="btn btn-warning btn-lg rounded-pill px-5">
                                <i class="bx bx-envelope me-2"></i>Solicitar Información
                            </a>
                            <a href="tel:<?= SITE_PHONE ?>" class="btn btn-outline-light btn-lg rounded-pill px-5">
                                <i class="bx bx-phone me-2"></i>Contactar Ahora
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--begin: Navegación productos -->
        <section class="position-relative border-bottom overflow-hidden product-navigation-bg">
            <div class="container py-9 py-lg-11 position-relative">
                <div class="row pt-5 pt-lg-7 justify-content-center align-items-center">
                    <div class="col-xl-10 text-center mb-9">
                        <h4 class="display-4 mb-3" data-aos="fade-up">Conoce nuestros productos</h4>
                        
                        <div data-aos="fade-up" data-aos-delay="150">
                            <?php foreach ($tango_products as $key => $product): ?>
                                <?php if ($key !== 'delta'): ?>
                                <a href="<?= $product['slug'] ?>.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill mb-2">
                                    <span><?= $product['name'] ?></span>
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
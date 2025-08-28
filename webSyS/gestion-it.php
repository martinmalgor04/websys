<?php
// Configuración del encabezado y carga de configuración central
header('Content-Type: text/html; charset=utf-8');

// Incluir configuración central para constantes (SUPPORT_URL, ECOMMERCE_URL, etc.)
require_once('config/config.php');
require_once('includes/functions.php');

// Inicializar sistema de seguridad para CSRF protection
require_once('includes/security-init.php');
initSecurity();

// Configurar página
$page_title = 'Gestión Integral IT';
$body_id = 'gestion-it';
?>
<!doctype html>
<html lang="es">
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gestión Integral IT - Servicios y Sistemas</title>
		<meta name="description" content="Gestión integral de infraestructura IT para empresas. Soporte técnico 24/7, administración de servidores, monitoreo continuo y seguridad informática.">
		<?php include('includes/link.php');?>
		
    </head>

    <body>
         <!--Preloader Spinner-->
         <div class="spinner-loader bg-primary text-white">
            <div class="spinner-grow" role="status">
            </div>
            <span class="small d-block ms-2">Cargando...</span>
        </div>
        <!--Header Start-->
         <?php include('includes/nav.php');?>
        
        <!--Main content-->

        <main class="main-content" id="main-content">
            <!--begin: Header -->
            <section class="position-relative text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="container position-relative py-9 py-lg-15">
                    <div class="row align-items-center">
                        <div class="col-lg-8 text-center mx-auto">
                            <h1 class="display-3 mb-4 fw-bold" data-aos="fade-up">GESTIÓN INTEGRAL IT</h1>
                            <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
                                ¿Tu IT te genera dolores de cabeza? Con nuestra gestión integral te olvidás de los problemas tecnológicos
                            </p>
                            <div data-aos="fade-up" data-aos-delay="200">
                                <a href="#contacto" class="btn btn-white btn-lg rounded-pill px-5 py-3">
                                    <i class="bx bx-phone me-2"></i>CONTACTANOS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Header -->
            
            <!--begin: Compromiso -->
            <section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mb-9">
                            <h2 class="display-4 mb-5" data-aos="fade-up">NUESTRO COMPROMISO</h2>
                            <div class="card card-body py-5 px-4 border-0 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                                <p class="lead mb-0">
                                    La responsabilidad y compromiso con el cliente nos define. <strong>Nunca dejamos un trabajo a medias, nunca desaparecemos ante contingencias</strong> y dejamos el alma por nuestros clientes para que no tengan pérdidas por problemas en sus sistemas. Tu IT es nuestra prioridad.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Compromiso -->

            <!--begin: Servicios IT -->
            <section class="position-relative bg-dark text-white overflow-hidden">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-10 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">SERVICIOS DE GESTIÓN IT</h2>
                            <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
                                Ofrecemos una solución completa para PyMEs y grandes empresas que quieren desentenderse de los problemas tecnológicos
                            </p>
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-8">
                        <!-- Soporte Técnico -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="text-center h-100 p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                    <i class="bx bx-support text-white fs-1"></i>
                                </div>
                                <h4 class="mb-3">Soporte Técnico 24/7</h4>
                                <p class="text-light">
                                    Asistencia inmediata cuando más lo necesitás. Resolvemos problemas antes de que afecten tu productividad.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Infraestructura -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="text-center h-100 p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                    <i class="bx bx-server text-white fs-1"></i>
                                </div>
                                <h4 class="mb-3">Administración de Infraestructura</h4>
                                <p class="text-light">
                                    Mantenimiento y optimización completa de servidores, equipos y sistemas para máximo rendimiento.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Monitoreo -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="text-center h-100 p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                    <i class="bx bx-line-chart text-white fs-1"></i>
                                </div>
                                <h4 class="mb-3">Monitoreo Continuo</h4>
                                <p class="text-light">
                                    Vigilancia proactiva de tu infraestructura para detectar y prevenir problemas antes de que ocurran.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Seguridad -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="text-center h-100 p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                    <i class="bx bx-shield-quarter text-white fs-1"></i>
                                </div>
                                <h4 class="mb-3">Seguridad Informática</h4>
                                <p class="text-light">
                                    Protección integral contra amenazas digitales. Tu información empresarial siempre segura.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Backups -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="text-center h-100 p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                    <i class="bx bx-data text-white fs-1"></i>
                                </div>
                                <h4 class="mb-3">Backup & Recuperación</h4>
                                <p class="text-light">
                                    Respaldos automáticos y planes de recuperación ante desastres. Tu información nunca se pierde.
                                </p>
                            </div>
                        </div>
                        
                        <!-- Redes -->
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="text-center h-100 p-4">
                                <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                    <i class="bx bx-network-chart text-white fs-1"></i>
                                </div>
                                <h4 class="mb-3">Gestión de Redes</h4>
                                <p class="text-light">
                                    Diseño, implementación y mantenimiento de redes corporativas eficientes y seguras.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Servicios IT -->

            <!--begin: Relevamiento -->
            <section class="position-relative bg-gradient-light">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">RELEVAMIENTO DE INFRAESTRUCTURA</h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Antes de implementar cualquier solución, realizamos un análisis completo de tu infraestructura actual
                            </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!--begin: Análisis -->
                        <div class="col-lg-6 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="50">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="bx bx-analyse display-3 text-primary"></i>
                                </div>
                                <h5 class="mb-3 fw-bold text-primary">Diagnóstico Completo</h5>
                                <p class="mb-0">
                                    Evaluamos equipos, software, redes, seguridad y procesos para identificar oportunidades de mejora y riesgos potenciales.
                                </p>
                            </div>
                        </div>
                        <!--end: Análisis -->

                        <!--begin: Propuesta -->
                        <div class="col-lg-6 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="bx bx-file-find display-3 text-success"></i>
                                </div>
                                <h5 class="mb-3 fw-bold text-success">Plan de Optimización</h5>
                                <p class="mb-0">
                                    Te entregamos un informe detallado con recomendaciones específicas y un plan de acción para mejorar tu IT.
                                </p>
                            </div>
                        </div>
                        <!--end: Propuesta -->
                    </div>
                </div>
            </section>
            <!--end: Relevamiento -->

            <!--begin: CTA Final -->
            <section class="position-relative bg-primary text-white overflow-hidden">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-8">
                            <h2 class="display-4 mb-4" data-aos="fade-up">¿Necesitás una auditoría de tu infraestructura IT?</h2>
                            <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
                                Realizamos un relevamiento completo de tu infraestructura actual y te proponemos 
                                las mejores soluciones para optimizar tu IT.
                            </p>
                            <div data-aos="fade-up" data-aos-delay="200">
                                <a href="#contacto" class="btn btn-white btn-lg rounded-pill px-5 py-3">
                                    <i class="bx bx-phone me-2"></i>CONTACTANOS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: CTA Final -->

            <!--begin: Contacto -->
            <section id="contacto" class="position-relative bg-dark text-white overflow-hidden">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">CONTACTO</h2>
                            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                                Conversemos sobre cómo podemos mejorar tu infraestructura IT
                            </p>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card card-body py-5 px-4 shadow-lg border-0" data-aos="fade-up" data-aos-delay="150">
                                <form id="datacenterForm" method="POST" action="enviar-datacenter.php">
                                    <!-- Formulario seguro con protección CSRF -->
                                    <?php echo CSRFProtection::getTokenField('contact_form'); ?>
                                    
                                    <!-- Mensaje de estado del formulario -->
                                    <div id="form-messages" class="mb-4" style="display: none;">
                                        <div id="success-message" class="alert alert-success" role="alert" style="display: none;">
                                            <i class="bx bx-check-circle me-2"></i>
                                            <span></span>
                                        </div>
                                        <div id="error-message" class="alert alert-danger" role="alert" style="display: none;">
                                            <i class="bx bx-error me-2"></i>
                                            <span></span>
                                        </div>
                                        <div id="rate-limit-message" class="alert alert-warning" role="alert" style="display: none;">
                                            <i class="bx bx-time me-2"></i>
                                            <span>Demasiados intentos. Por favor esperá un momento antes de enviar nuevamente.</span>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="nombre" class="form-label fw-bold">Nombre y Apellido *</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="email" class="form-label fw-bold">Email *</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="telefono" class="form-label fw-bold">Teléfono</label>
                                            <input type="tel" class="form-control" id="telefono" name="telefono">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="empresa" class="form-label fw-bold">Empresa</label>
                                            <input type="text" class="form-control" id="empresa" name="empresa">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="puesto" class="form-label fw-bold">Puesto / Cargo</label>
                                            <input type="text" class="form-control" id="puesto" name="puesto">
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="asunto" class="form-label fw-bold">Asunto *</label>
                                            <select class="form-select" id="asunto" name="asunto" required>
                                                <option value="">Seleccionar asunto</option>
                                                <option value="GESTIÓN IT">GESTIÓN IT</option>
                                                <option value="INFRAESTRUCTURA">INFRAESTRUCTURA</option>
                                                <option value="SOPORTE TÉCNICO">SOPORTE TÉCNICO</option>
                                                <option value="MONITOREO">MONITOREO</option>
                                                <option value="SEGURIDAD">SEGURIDAD</option>
                                                <option value="BACKUP">BACKUP</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="mensaje" class="form-label fw-bold">Mensaje o Comentarios</label>
                                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Contanos sobre tu infraestructura actual y qué problemas estás teniendo..."></textarea>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label fw-bold">¿Cómo te enteraste de nosotros?</label>
                                        <div class="row">
                                            <div class="col-6 col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="como_se_entero" id="redes" value="REDES SOCIALES">
                                                    <label class="form-check-label" for="redes">
                                                        REDES SOCIALES
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="como_se_entero" id="boca" value="BOCA EN BOCA">
                                                    <label class="form-check-label" for="boca">
                                                        BOCA EN BOCA
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="como_se_entero" id="google" value="GOOGLE">
                                                    <label class="form-check-label" for="google">
                                                        GOOGLE
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 col-md-3 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="como_se_entero" id="local" value="EN EL LOCAL">
                                                    <label class="form-check-label" for="local">
                                                        EN EL LOCAL
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3">
                                            <i class="bx bx-send me-2"></i>ENVIAR CONSULTA
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Contacto -->

        </main>

        <!--begin:Footer-->
        <?php include('includes/footer.php');?>
        <!--end:Footer-->

        <?php include('includes/script.php');?>
    </body>

</html>

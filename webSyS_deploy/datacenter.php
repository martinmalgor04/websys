<?php
// Configuración del encabezado y carga de configuración central
header('Content-Type: text/html; charset=utf-8');

// Incluir configuración central para constantes (SUPPORT_URL, ECOMMERCE_URL, etc.)
require_once('config/config.php');
require_once('includes/functions.php');

// Inicializar sistema de seguridad para CSRF protection
require_once('includes/security-init.php');
initSecurity();
?>
<!doctype html>
<html lang="es">
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Datacenter - Hosting y Servidores - Servicios y Sistemas</title>
		<meta name="description" content="Alojá tu servidor en nuestro datacenter de alta disponibilidad. Seguridad 24/7, respaldo continuo y soporte especializado para tu empresa.">
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
                            <h1 class="display-3 mb-4 fw-bold" data-aos="fade-up">DATACENTER</h1>
                            <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
                                Alojá tu servidor en nuestra infraestructura de alta disponibilidad y olvidate de los problemas técnicos
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
            
            <!--begin: ¿Qué es un Datacenter? -->
            <section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mb-9">
                            <h2 class="display-4 mb-5" data-aos="fade-up">¿QUÉ ES UN DATACENTER?</h2>
                            <div class="card card-body py-5 px-4 border-0 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                                <p class="lead mb-0">
                                    Un datacenter es una granja de servidores de alto rendimiento que alberga sistemas de TI críticos. Gracias a la climatización, la energía de respaldo y las medidas de seguridad avanzadas, garantiza que tus datos y aplicaciones estén siempre protegidos y disponibles, sin la necesidad de gestionar tu propio servidor físico y todo lo que ello implica.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: ¿Qué es un Datacenter? -->

            <!--begin: ¿Por qué elegir? -->
            <section class="position-relative bg-gradient-light">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">¿POR QUÉ ELEGIR UN SERVIDOR ALOJADO?</h2>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!--begin: Ahorro de costos -->
                        <div class="col-lg-6 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="50">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="bx bx-dollar-circle display-3 text-success"></i>
                                </div>
                                <h5 class="mb-3 fw-bold text-success">Ahorro de costos</h5>
                                <p class="mb-0">
                                    Despedite de la inversión en equipos, mantenimiento y energía. Optimizá tus gastos con un plan de hosting a tu medida.
                                </p>
                            </div>
                        </div>
                        <!--end: Ahorro de costos -->

                        <!--begin: Máxima seguridad -->
                        <div class="col-lg-6 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="bx bx-shield-quarter display-3 text-primary"></i>
                                </div>
                                <h5 class="mb-3 fw-bold text-primary">Máxima seguridad</h5>
                                <p class="mb-0">
                                    Nuestra vigilancia 24/7, sistemas de acceso controlado y respaldo continuo protegen tus datos en todo momento.
                                </p>
                            </div>
                        </div>
                        <!--end: Máxima seguridad -->

                        <!--begin: Disponibilidad garantizada -->
                        <div class="col-lg-6 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="150">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="bx bx-time-five display-3 text-warning"></i>
                                </div>
                                <h5 class="mb-3 fw-bold text-warning">Disponibilidad garantizada</h5>
                                <p class="mb-0">
                                    Con redundancia en energía, clima y conectividad, tu servidor está siempre en línea.
                                </p>
                            </div>
                        </div>
                        <!--end: Disponibilidad garantizada -->

                        <!--begin: Soporte especializado -->
                        <div class="col-lg-6 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="200">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="bx bx-support display-3 text-info"></i>
                                </div>
                                <h5 class="mb-3 fw-bold text-info">Soporte especializado</h5>
                                <p class="mb-0">
                                    Un equipo de expertos se ocupa de monitoreo, actualizaciones y asistencia técnica.
                                </p>
                            </div>
                        </div>
                        <!--end: Soporte especializado -->
                    </div>
                </div>
            </section>
            <!--end: ¿Por qué elegir? -->

            <!--begin: Comparación -->
            <section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">SERVIDOR LOCAL VS DATACENTER</h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Compará las ventajas de alojar tu servidor en nuestro datacenter
                            </p>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="table-responsive" data-aos="fade-up" data-aos-delay="150">
                                <table class="table table-lg">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col" class="text-center py-4">Aspecto</th>
                                            <th scope="col" class="text-center py-4">
                                                <i class="bx bx-desktop text-danger fs-2 d-block mb-2"></i>
                                                Servidor Local
                                            </th>
                                            <th scope="col" class="text-center py-4">
                                                <i class="bx bx-cloud text-success fs-2 d-block mb-2"></i>
                                                Servidor en Datacenter
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bold">Inversión Inicial</td>
                                            <td class="text-danger">Alta (compra de hardware, instalación, infraestructura)</td>
                                            <td class="text-success">Baja (planes de hosting y recursos escalables según necesidad)</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Seguridad</td>
                                            <td class="text-warning">La seguridad dependerá de la inversión inicial y los sistemas que se implementen</td>
                                            <td class="text-success">Múltiples capas de seguridad con firewall y conexión exclusiva con monitoreo 24/7</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Personal</td>
                                            <td class="text-danger">Personal Interno a cargo de la organización con costo adicional</td>
                                            <td class="text-success">Equipo que 24/7 se ocupa de soporte, reparaciones, actualizaciones y backups</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Escalabilidad</td>
                                            <td class="text-warning">Limitada al espacio y capacidad del hardware</td>
                                            <td class="text-success">Inmediata: podés sumar recursos (RAM, CPU, almacenamiento) sin comprar equipos nuevos</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Disponibilidad</td>
                                            <td class="text-danger">Suele verse afectada por cortes de energía o internet</td>
                                            <td class="text-success">Redundancia en energía, clima, conectividad y soporte, asegurando un alto nivel de disponibilidad (uptime)</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Mantenimiento</td>
                                            <td class="text-danger">Mantenimiento continuo, reemplazo de equipos, insumos</td>
                                            <td class="text-success">Costos fijos y previsibles, sin necesidad de grandes inversiones en infraestructura</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Comparación -->

            <!--begin: Cómo empezar -->
            <section class="position-relative" style="background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center text-white">
                            <h2 class="display-4 mb-4" data-aos="fade-up">¿CÓMO EMPEZAR?</h2>
                        </div>
                    </div>
                    
                    <div class="row">
                        <!--begin: Paso 1 -->
                        <div class="col-lg-3 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="50">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg h-100">
                                <div class="mb-4 position-relative">
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                        <span class="fs-2 fw-bold">1</span>
                                    </div>
                                </div>
                                <h5 class="mb-3 fw-bold text-primary">Contactanos</h5>
                                <p class="mb-0">
                                    Conversá con nuestro equipo para evaluar las necesidades de tu negocio y definir la mejor configuración de servidor.
                                </p>
                            </div>
                        </div>
                        <!--end: Paso 1 -->

                        <!--begin: Paso 2 -->
                        <div class="col-lg-3 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="100">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg h-100">
                                <div class="mb-4 position-relative">
                                    <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                        <span class="fs-2 fw-bold">2</span>
                                    </div>
                                </div>
                                <h5 class="mb-3 fw-bold text-success">Diseño de la solución</h5>
                                <p class="mb-0">
                                    Te asesoramos sobre el tipo de servidor, capacidad, seguridad y planes de soporte que se ajusten a tus objetivos.
                                </p>
                            </div>
                        </div>
                        <!--end: Paso 2 -->

                        <!--begin: Paso 3 -->
                        <div class="col-lg-3 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="150">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg h-100">
                                <div class="mb-4 position-relative">
                                    <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                        <span class="fs-2 fw-bold">3</span>
                                    </div>
                                </div>
                                <h5 class="mb-3 fw-bold text-warning">Implementación</h5>
                                <p class="mb-0">
                                    Migramos tus datos y aplicaciones al datacenter de manera ágil y segura, minimizando cualquier interrupción en tus operaciones.
                                </p>
                            </div>
                        </div>
                        <!--end: Paso 3 -->

                        <!--begin: Paso 4 -->
                        <div class="col-lg-3 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="200">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg h-100">
                                <div class="mb-4 position-relative">
                                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px;">
                                        <span class="fs-2 fw-bold">4</span>
                                    </div>
                                </div>
                                <h5 class="mb-3 fw-bold text-info">Monitoreo y soporte</h5>
                                <p class="mb-0">
                                    Una vez en marcha, monitoreamos tu infraestructura y te brindamos soporte para garantizar un rendimiento óptimo.
                                </p>
                            </div>
                        </div>
                        <!--end: Paso 4 -->
                    </div>
                </div>
            </section>
            <!--end: Cómo empezar -->

            <!--begin: Formulario de Contacto -->
            <section id="contacto" class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">CONTACTANOS</h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Completá el formulario y nos pondremos en contacto para diseñar la solución perfecta para tu empresa
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
                                                <option value="DATACENTER">DATACENTER</option>
                                                <option value="INFRAESTRUCTURA">INFRAESTRUCTURA</option>
                                                <option value="TANGO">TANGO</option>
                                                <option value="SOPORTE TÉCNICO">SOPORTE TÉCNICO</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="mensaje" class="form-label fw-bold">Mensaje o Comentarios</label>
                                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Contanos sobre tus necesidades específicas de infraestructura..."></textarea>
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
            <!--end: Formulario de Contacto -->

            <?php
            // FAQ específico para Datacenter
            $faq_title = "PREGUNTAS FRECUENTES - DATACENTER";
            $faq_subtitle = "Resolvemos las dudas más comunes sobre nuestros servicios de datacenter y hosting";
            
            $faq_items = [
                [
                    'icon' => 'bx bx-server',
                    'question' => '¿Qué tipos de servidores pueden alojar en su datacenter?',
                    'answer' => '<p class="mb-3">Alojamos todo tipo de servidores y aplicaciones:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Servidores de aplicaciones empresariales (ERP, CRM)</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Servidores web y de e-commerce</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Bases de datos (SQL Server, MySQL, Oracle)</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Servidores de correo y colaboración</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Aplicaciones personalizadas y sistemas legacy</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-shield-quarter',
                    'question' => '¿Qué medidas de seguridad implementan?',
                    'answer' => '<p class="mb-3">Nuestro datacenter cuenta con múltiples capas de seguridad:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Acceso controlado con tarjetas y biometría</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Vigilancia 24/7 con cámaras y personal de seguridad</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Firewall perimetral y sistemas de detección de intrusos</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Respaldos automáticos y replicación de datos</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Climatización y control de humedad</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-time-five',
                    'question' => '¿Cuál es el nivel de disponibilidad (uptime)?',
                    'answer' => '<p class="mb-3">Garantizamos alta disponibilidad con:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>99.9% de uptime garantizado</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Redundancia en energía (UPS y generadores)</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Múltiples proveedores de internet</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Monitoreo proactivo 24/7</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Planes de contingencia y recuperación</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-transfer-alt',
                    'question' => '¿Cómo es el proceso de migración?',
                    'answer' => '<p class="mb-3">La migración se realiza de forma planificada y segura:</p>
                    <ol class="list-group list-group-numbered list-group-flush">
                        <li class="list-group-item border-0 px-0"><strong>Evaluación:</strong> Analizamos tu infraestructura actual</li>
                        <li class="list-group-item border-0 px-0"><strong>Planificación:</strong> Diseñamos la estrategia de migración</li>
                        <li class="list-group-item border-0 px-0"><strong>Pruebas:</strong> Realizamos tests en ambiente controlado</li>
                        <li class="list-group-item border-0 px-0"><strong>Migración:</strong> Transferimos datos fuera del horario laboral</li>
                        <li class="list-group-item border-0 px-0"><strong>Validación:</strong> Verificamos el correcto funcionamiento</li>
                    </ol>'
                ],
                [
                    'icon' => 'bx bx-trending-up',
                    'question' => '¿Puedo escalar recursos según mis necesidades?',
                    'answer' => '<p class="mb-3">Sí, ofrecemos escalabilidad completa:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Aumento de RAM y CPU sin downtime</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Expansión de almacenamiento inmediata</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Ancho de banda flexible</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Servidores adicionales cuando los necesites</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Pago solo por los recursos que usás</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-support',
                    'question' => '¿Qué tipo de soporte técnico incluye?',
                    'answer' => '<p class="mb-3">Brindamos soporte integral:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Monitoreo proactivo 24/7/365</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Soporte técnico especializado</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Actualizaciones y parches de seguridad</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Respaldos automatizados</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Reportes de rendimiento y uso</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Asesoramiento en optimización</li>
                    </ul>'
                ]
            ];
            
            // Incluir el template FAQ
            include('includes/faq-template.php');
            ?>

        </main>

        <!--begin:Footer-->
        <?php include('includes/footer.php');?>
        <!--end:Footer-->

        <?php include('includes/script.php');?>
        
        <!-- Formulario seguro con validaciones client-side -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('datacenterForm');
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.innerHTML;
            
            // Funciones de utilidad para mostrar mensajes
            function showMessage(type, message) {
                const messagesDiv = document.getElementById('form-messages');
                const successDiv = document.getElementById('success-message');
                const errorDiv = document.getElementById('error-message');
                const rateLimitDiv = document.getElementById('rate-limit-message');
                
                // Ocultar todos los mensajes
                successDiv.style.display = 'none';
                errorDiv.style.display = 'none';
                rateLimitDiv.style.display = 'none';
                
                // Mostrar el mensaje correspondiente
                messagesDiv.style.display = 'block';
                
                if (type === 'success') {
                    successDiv.querySelector('span').textContent = message;
                    successDiv.style.display = 'block';
                } else if (type === 'error') {
                    errorDiv.querySelector('span').textContent = message;
                    errorDiv.style.display = 'block';
                } else if (type === 'rate-limit') {
                    rateLimitDiv.style.display = 'block';
                }
                
                // Scroll al mensaje
                messagesDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
            
            function hideMessages() {
                document.getElementById('form-messages').style.display = 'none';
            }
            
            function setButtonLoading(loading) {
                if (loading) {
                    submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>ENVIANDO...';
                    submitBtn.disabled = true;
                } else {
                    submitBtn.innerHTML = originalBtnText;
                    submitBtn.disabled = false;
                }
            }
            
            // Validaciones client-side básicas
            function validateForm() {
                const nombre = form.nombre.value.trim();
                const email = form.email.value.trim();
                const asunto = form.asunto.value;
                
                if (nombre.length < 2) {
                    showMessage('error', 'El nombre debe tener al menos 2 caracteres');
                    return false;
                }
                
                if (!email || !email.includes('@')) {
                    showMessage('error', 'Por favor ingresá un email válido');
                    return false;
                }
                
                if (!asunto) {
                    showMessage('error', 'Por favor seleccioná un asunto');
                    return false;
                }
                
                return true;
            }
            
            // Manejo del formulario
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                hideMessages();
                
                // Validar formulario
                if (!validateForm()) {
                    return;
                }
                
                setButtonLoading(true);
                
                // Preparar datos del formulario
                const formData = new FormData(this);
                
                // Enviar vía fetch
                fetch('enviar-datacenter.php', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showMessage('success', data.mensaje || '¡Gracias por tu consulta! Te hemos enviado una confirmación por email.');
                        form.reset();
                        
                        // Redireccionar a página de agradecimiento después de 3 segundos
                        setTimeout(() => {
                            window.location.href = 'gracias.html';
                        }, 3000);
                        
                    } else {
                        showMessage('error', data.error || 'Error al enviar la consulta. Por favor intentá nuevamente.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                    // Verificar si es un error de rate limiting
                    if (error.message && error.message.includes('429')) {
                        showMessage('rate-limit');
                    } else {
                        showMessage('error', 'Error de conexión. Por favor verificá tu internet e intentá nuevamente.');
                    }
                })
                .finally(() => {
                    setButtonLoading(false);
                });
            });
            
            // Limpiar mensajes cuando el usuario empieza a escribir
            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', hideMessages);
            });
        });
        </script>
		
    </body>
	

</html> 
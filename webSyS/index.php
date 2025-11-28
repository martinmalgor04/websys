<?php
header('Content-Type: text/html; charset=utf-8');

// Incluir configuración y funciones
require_once('config/config.php');
require_once('includes/functions.php');

// Configurar página
$page_title = 'Inicio';
$meta_description = 'Servicios y Sistemas - Soluciones tecnológicas integrales para empresas en Corrientes, Argentina. Distribuidores oficiales de Tango Software, Datacenter y Gestión IT. Más de 30 años de experiencia.';
$meta_keywords = 'servicios y sistemas, tango software, erp, datacenter, gestion it, corrientes, argentina, soluciones tecnologicas, software empresarial';
$body_id = 'home';
$canonical_url = SITE_URL;

// FAQs para schema markup
$faqs = [
    [
        'question' => '¿Quiénes somos y cuál es nuestra trayectoria?',
        'answer' => 'Somos una empresa con más de 30 años de experiencia en el desarrollo de soluciones tecnológicas para la gestión empresarial. Nos caracterizamos por innovar y adaptarnos a las necesidades de negocios de distintos tamaños, integrando sistemas de gestión, ventas, contabilidad y más para brindar un servicio integral y confiable.'
    ],
    [
        'question' => '¿Qué soluciones y servicios ofrecemos?',
        'answer' => 'Ofrecemos una amplia gama de soluciones tecnológicas para tu empresa: Plataforma Tango (incluye Tango Gestión, Tango Punto de Venta, Tango Estudios Contables y Tango Restô), Insumos Informáticos (computadoras, sistemas de videovigilancia), y Hosting de Servidores (servidores virtuales adaptados con posibilidad de escalabilidad).'
    ],
    [
        'question' => '¿Cómo garantizamos la calidad y seguridad de nuestros sistemas?',
        'answer' => 'Trabajamos con altos estándares de calidad y utilizamos tecnología de punta para proteger tus datos. Nuestros sistemas cuentan con protocolos de cifrado, autenticación robusta y se alojan en Data Centers con monitoreo 24/7, asegurando disponibilidad y confiabilidad.'
    ],
    [
        'question' => '¿Qué soporte técnico y atención al cliente ofrecen?',
        'answer' => 'Nuestro equipo de soporte está disponible de forma personalizada y 24/7. Brindamos asesoría técnica, capacitación en la implementación y seguimiento continuo para resolver dudas y optimizar el uso de nuestras soluciones.'
    ],
    [
        'question' => '¿Cómo es el proceso de implementación y capacitación?',
        'answer' => 'El proceso se realiza en etapas: 1) Diagnóstico y asesoría (evaluamos las necesidades), 2) Diseño y configuración (adaptamos las soluciones), 3) Migración e integración (transferimos datos), 4) Capacitación y soporte continuo (formamos al equipo).'
    ],
    [
        'question' => '¿Qué alianzas estratégicas y certificaciones respaldan nuestras soluciones?',
        'answer' => 'Contamos con alianzas con proveedores y plataformas reconocidas (como Mercado Pago, Tienda Nube, entre otros), y nuestras soluciones cumplen con normativas y certificaciones internacionales, lo que garantiza su eficiencia y seguridad.'
    ]
];

// Schemas múltiples: LocalBusiness y FAQPage
$schema_markup = [
    generateLocalBusinessSchema(),
    generateFAQSchema($faqs)
];

// Incluir encabezado HTML
include('includes/head.php');
?>
		<script type="application/ld+json">
		{
		  "@context": "//schema.org",
		  "@type": "Organization",
		  "url": "https://serviciosysistemas.com.ar/",
		  "contactPoint": [{
			"@type": "ContactPoint",
			"name": "SERVICIOS & SISTEMAS",
			"description": "Trabajamos para ofrecer las más creativas soluciones Informáticas para su empresa, proveyendo e integrando el hardware, software, la infraestructura de red y los servicios para diseñar, poner en marcha y dar soporte y servicio en forma integral.",
			"email": "info@serviciosysistemas.com.ar",
			"telephone": "+54 379 426022",
			"contactType": "customer service"
		  }]
		}
		</script>
		
		<?php include('includes/link.php');?>
    </head>

    <body id="home">
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
            <?php include('includes/slider.php');?>
            <section id="product" class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <h2 class="display-4 text-center mb-5">Productos</h2>
                    <div class="row justify-content-center">
                        <?php 
                        // Usar orden definido en configuración
                        global $product_display_order;
                        $delay = 50;
                        
                        foreach ($product_display_order as $productKey) {
                            if (isset($tango_products[$productKey])) {
                                echo renderProductCard($productKey, $tango_products[$productKey], $delay);
                                $delay += 50;
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>

            <!--begin: Datacenter Section -->
            <section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center text-white mb-5 mb-lg-0" data-aos="fade-up">
                            <h2 class="display-4 fw-bold mb-4">SERVICIOS DE DATACENTER</h2>
                            <p class="lead mb-5">
                                Alojá tu servidor en nuestra infraestructura de alta disponibilidad y olvidate de los problemas técnicos. 
                                Seguridad 24/7, respaldo continuo y soporte especializado para tu empresa.
                            </p>
                            
                            <div class="row justify-content-center mb-5">
                                <div class="col-md-5 col-lg-4 mb-3 text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bx bx-shield-quarter fs-1 mb-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Máxima Seguridad</h6>
                                            <small class="text-white-50">Protección avanzada 24/7</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-4 mb-3 text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bx bx-server fs-1 mb-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Alta Disponibilidad</h6>
                                            <small class="text-white-50">99.9% uptime garantizado</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-4 mb-3 text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bx bx-support fs-1 mb-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Soporte Experto</h6>
                                            <small class="text-white-50">Asistencia especializada</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-4 mb-3 text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bx bx-dollar-circle fs-1 mb-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Ahorro de Costos</h6>
                                            <small class="text-white-50">Sin inversión en equipos</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <a href="datacenter.php" class="btn btn-white btn-lg rounded-pill px-5 py-3 hover-lift">
                                    <i class="bx bx-info-circle me-2"></i>CONOCER MÁS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Datacenter Section -->

			<!--begin:Nosotros section-->
            <section id="nosotros" class="position-relative bg-body">
                <div class="container position-relative py-9 py-lg-11">
					<div class="row justify-content-center align-items-center mb-9">
                        <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
							<h2 class="display-4 mb-4">NOSOTROS</h2>
							<p class="lead mb-4">
                                Somos Servicios y Sistemas, una empresa que busca revolucionar empresas y negocios a través de soluciones tecnológicas creativas. Con más de 30 años en la industria, contamos con amplia experiencia y un equipo que se forma continuamente para brindar el mejor servicio al cliente.
							</p>
							<p class="mb-4">
								Como distribuidores oficiales de Tango Software y Business Partner de HPE (Hewlett Packard Enterprise), Lenovo, Dell y Sophos, nos hemos posicionado como pioneros en la incorporación de soluciones innovadoras en el nordeste argentino. Nuestra propuesta integral abarca desde hardware y software hasta infraestructura de red y servicios especializados, brindando una poderosa solución a los miles de clientes que han confiado en nosotros a lo largo de estas décadas.
							</p>
							<p class="mb-4">
								Más de 200 empresas eligen nuestros servicios cada año, testimonio del valor que aportamos y la confianza que hemos construido. Con presencia consolidada en todo el nordeste argentino, hemos crecido junto a nuestros clientes, acompañándolos en su transformación digital.
							</p>
							<p class="mb-0">
								Estamos frente a un futuro donde la tecnología evoluciona constantemente y transforma la manera de hacer negocios. En esta vorágine de cambio permanente, lo que mantenemos como valor esencial es la responsabilidad hacia nuestros clientes. La filosofía de quienes conformamos Servicios y Sistemas, un equipo de 12 profesionales en constante formación, se enfoca en mantener la excelencia en el servicio y el compromiso genuino con el éxito de cada cliente que confía en nosotros.
							</p>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="position-relative bg-light rounded-3 p-4" style="min-height: 400px;">
                                <!-- Placeholder para imagen/video -->
                                <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                <img src="assets/img/about.png" alt="Equipo de Servicios y Sistemas" style="width:500px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Métricas -->
                    <div class="row justify-content-center text-center">
                        <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="150">
                                                          <div class="mb-4">
                                  <div class="width-15x height-15x rounded-circle bg-white border border-3 border-dark mx-auto d-flex align-items-center justify-content-center mb-3">
                                     <i class="fi fi-rr-calendar display-2 text-dark"></i>
                                  </div>
                                 <h2 class="fw-bold mb-2 text-white" style="font-size: 4rem;">+30</h2>
                                 <h5 class="fw-bold mb-2 text-white">Años de Experiencia</h5>
                                  <p class="text-muted mb-0">proveyendo soluciones tecnológicas inteligentes</p>
                              </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="200">
                                                          <div class="mb-4">
                                  <div class="width-15x height-15x rounded-circle bg-white border border-3 border-dark mx-auto d-flex align-items-center justify-content-center mb-3">
                                     <i class="fi fi-rr-users-alt display-2 text-dark"></i>
                                  </div>
                                 <h2 class="fw-bold mb-2 text-white" style="font-size: 4rem;">+1000</h2>
                                 <h5 class="fw-bold mb-2 text-white">Empresas</h5>
                                  <p class="text-muted mb-0">Con Implementaciones de Tango Software Exitosa</p>
                              </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="200">
                                                          <div class="mb-4">
                                  <div class="width-15x height-15x rounded-circle bg-white border border-3 border-dark mx-auto d-flex align-items-center justify-content-center mb-3">
                                      <!-- Medalla SVG personalizada -->
                                                                             <img src="assets/img/medalla.svg" alt="Medalla" style="width: 60px; height: 60px;" class="text-dark">
                                  </div>
                                 <h2 class="fw-bold mb-2 text-white" style="font-size: 4rem;">+5</h2>
                                 <h5 class="fw-bold mb-2 text-white">Años Siendo premiados con</h5>
                                 <h6 class="fw-bold text-white">Mejor Proveedor del NEA</h6>
                              </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end:Nosotros section-->
			<!--begin:About section-->
            <section class="position-relative">
                <div class="container position-relative">
					<div class="row justify-content-center">
                        <div class="col-12 text-center mb-4" data-aos="fade-up" data-aos-delay="50">
							<h2 class="display-5 text-center mb-5">Confían en Nosotros</h2>
						</div>
                    </div>
					<div data-aos="fade-up" class="border rounded-3 text-dark px-5 py-8 py-lg-9 px-lg-9 mb-5 shadow-lg position-relative z-1">
                    <!--Swiper thumbnails-->
                    <div class="swiper-container position-relative overflow-hidden swiper-partners">
                        <div class="swiper-wrapper pb-5">
                            <?php
                                $client_images = glob('assets/img/partners/clients/*.{png,jpg,jpeg,webp}', GLOB_BRACE);
                                foreach ($client_images as $img) {
                                    echo '<div class="swiper-slide"><div class="d-flex align-items-center justify-content-center"><div class="bg-white rounded-3 p-3"><img src="' . $img . '" alt="" class="img-fluid"></div></div></div>';
                                }
                            ?>
                        </div>

                        <!--Pagination-->
                        <div class="swiper-pagination swiper-partners-pagination bottom-0 position-relative pt-4">
                        </div>
                    </div>
                    <!-- / Swiper thumbnails-->
                    </div>
                </div>
            </section>
            <!--/end:About section-->
            
            <!--begin: FAQ Section -->
            <section class="position-relative bg-gradient-light overflow-hidden">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">PREGUNTAS FRECUENTES</h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Resolvemos las dudas más comunes sobre nuestros servicios y soluciones tecnológicas
                            </p>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accordion" id="faqAccordion" data-aos="fade-up" data-aos-delay="150">
                                
                                <!-- FAQ 1 -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h3 class="accordion-header" id="faq1">
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                            <i class="bx bx-help-circle me-3 text-primary fs-5"></i>
                                            ¿Quiénes somos y cuál es nuestra trayectoria?
                                        </button>
                                    </h3>
                                    <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-0">
                                                Somos una empresa con más de 30 años de experiencia en el desarrollo de soluciones tecnológicas para la gestión empresarial. Nos caracterizamos por innovar y adaptarnos a las necesidades de negocios de distintos tamaños, integrando sistemas de gestión, ventas, contabilidad y más para brindar un servicio integral y confiable.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- FAQ 2 -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h3 class="accordion-header" id="faq2">
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                            <i class="bx bx-cog me-3 text-primary fs-5"></i>
                                            ¿Qué soluciones y servicios ofrecemos?
                                        </button>
                                    </h3>
                                    <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-3">Ofrecemos una amplia gama de soluciones tecnológicas para tu empresa, entre las que se destacan:</p>
                                            <ul class="list-unstyled">
                                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Plataforma Tango:</strong> Incluye módulos como Tango Gestión, Tango Punto de Venta, Tango Estudios Contables y Tango Restô además de todas las herramientas y módulos que podes tener.</li>
                                                <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Insumos Informáticos:</strong> contamos con una amplia gama de productos informáticos para equiparte con la mejor y última tecnología, desde computadoras hasta sistemas de videovigilancia.</li>
                                                <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i><strong>Hosting de tu Servidor con nosotros:</strong> olvidate de los problemas de tener tu propio servidor, nosotros ofrecemos servidores virtuales adaptados a tu empresa y con posibilidad de escalabilidad.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- FAQ 3 -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h3 class="accordion-header" id="faq3">
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                            <i class="bx bx-shield-quarter me-3 text-primary fs-5"></i>
                                            ¿Cómo garantizamos la calidad y seguridad de nuestros sistemas?
                                        </button>
                                    </h3>
                                    <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-0">
                                                Trabajamos con altos estándares de calidad y utilizamos tecnología de punta para proteger tus datos. Nuestros sistemas cuentan con protocolos de cifrado, autenticación robusta y se alojan en Data Centers con monitoreo 24/7, asegurando disponibilidad y confiabilidad.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- FAQ 4 -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h3 class="accordion-header" id="faq4">
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                            <i class="bx bx-support me-3 text-primary fs-5"></i>
                                            ¿Qué soporte técnico y atención al cliente ofrecen?
                                        </button>
                                    </h3>
                                    <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-0">
                                                Nuestro equipo de soporte está disponible de forma personalizada y 24/7. Brindamos asesoría técnica, capacitación en la implementación y seguimiento continuo para resolver dudas y optimizar el uso de nuestras soluciones.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- FAQ 5 -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h3 class="accordion-header" id="faq5">
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                            <i class="bx bx-trending-up me-3 text-primary fs-5"></i>
                                            ¿Cómo es el proceso de implementación y capacitación?
                                        </button>
                                    </h3>
                                    <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-3">El proceso se realiza en etapas:</p>
                                            <ol class="list-group list-group-numbered list-group-flush">
                                                <li class="list-group-item border-0 px-0"><strong>Diagnóstico y asesoría:</strong> Evaluamos las necesidades específicas de tu negocio.</li>
                                                <li class="list-group-item border-0 px-0"><strong>Diseño y configuración:</strong> Adaptamos nuestras soluciones a tu entorno y procesos.</li>
                                                <li class="list-group-item border-0 px-0"><strong>Migración e integración:</strong> Transferimos tus datos y conectamos con sistemas existentes.</li>
                                                <li class="list-group-item border-0 px-0"><strong>Capacitación y soporte continuo:</strong> Formamos a tu equipo y brindamos asistencia post-implementación.</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- FAQ 6 -->
                                <div class="accordion-item border-0 shadow-sm mb-3">
                                    <h3 class="accordion-header" id="faq6">
                                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                            <i class="bx bx-certification me-3 text-primary fs-5"></i>
                                            ¿Qué alianzas estratégicas y certificaciones respaldan nuestras soluciones?
                                        </button>
                                    </h3>
                                    <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <p class="mb-0">
                                                Contamos con alianzas con proveedores y plataformas reconocidas (como Mercado Pago, Tienda Nube, entre otros), y nuestras soluciones cumplen con normativas y certificaciones internacionales, lo que garantiza su eficiencia y seguridad.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: FAQ Section -->
            
            <!--begin: Contacto Section -->
            <section id="contacto" class="position-relative bg-body">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <h2 class="display-4 mb-4" data-aos="fade-up">Contactanos</h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                ¿Tenés alguna consulta? Estamos para ayudarte. Completá el formulario y nos pondremos en contacto contigo.
                            </p>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card card-body py-5 px-4 shadow-lg border-0" data-aos="fade-up" data-aos-delay="150">
                                <form id="contactForm" method="POST" action="https://formsubmit.co/<?= FORMSUBMIT_EMAIL ?>">
                                    <!-- Campos ocultos para FormSubmit -->
                                    <input type="hidden" name="_subject" value="Nueva consulta desde Servicios y Sistemas">
                                    <input type="hidden" name="_captcha" value="false">
                                    <input type="hidden" name="_template" value="table">
                                    <input type="text" name="_honey" style="display:none">
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
                                    
                                    <div class="mb-4">
                                        <label for="asunto" class="form-label fw-bold">Asunto *</label>
                                        <select class="form-select" id="asunto" name="asunto" required>
                                            <option value="">Seleccionar asunto</option>
                                            <option value="CONSULTA GENERAL">Consulta General</option>
                                            <option value="PRODUCTOS TANGO">Productos Tango</option>
                                            <option value="DATACENTER">Datacenter</option>
                                            <option value="GESTIÓN IT">Gestión IT</option>
                                            <option value="SOPORTE TÉCNICO">Soporte Técnico</option>
                                            <option value="COTIZACIÓN">Cotización</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="mensaje" class="form-label fw-bold">Mensaje o Comentarios *</label>
                                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Contanos cómo podemos ayudarte..." required></textarea>
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
            <!--end: Contacto Section -->

        </main>

        <!--begin:Footer-->
        <?php include('includes/footer.php');?>
        <!--end:Footer-->

        <?php include('includes/script.php');?>
        
        <!-- Formulario de contacto con FormSubmit -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            if (!form) return;
            
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
                const mensaje = form.mensaje.value.trim();
                
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
                
                if (mensaje.length < 10) {
                    showMessage('error', 'El mensaje debe tener al menos 10 caracteres');
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
                
                // Validar que el email esté configurado
                const formSubmitEmail = '<?= FORMSUBMIT_EMAIL ?>';
                if (!formSubmitEmail || formSubmitEmail === 'TU_EMAIL@ejemplo.com') {
                    showMessage('error', 'Error de configuración: Por favor configurá tu email en config/config.php');
                    return;
                }
                
                setButtonLoading(true);
                
                // FormSubmit funciona con submit normal, pero podemos interceptar para mostrar mensajes
                // Primero validamos, luego permitimos el submit normal
                const formAction = form.getAttribute('action');
                if (!formAction || !formAction.includes('formsubmit.co')) {
                    showMessage('error', 'Error de configuración del formulario');
                    setButtonLoading(false);
                    return;
                }
                
                // Preparar datos del formulario
                const formData = new FormData(this);
                
                // Enviar vía FormSubmit usando fetch para mejor control
                fetch(formAction, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'text/html'
                    }
                })
                .then(response => {
                    // FormSubmit redirige o devuelve HTML, así que verificamos el status
                    if (response.ok || response.status === 200 || response.redirected) {
                        showMessage('success', '¡Gracias por tu consulta! Te contactaremos pronto.');
                        form.reset();
                        // Scroll al mensaje de éxito
                        setTimeout(() => {
                            document.getElementById('form-messages').scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }, 300);
                    } else {
                        throw new Error('Error al enviar el formulario');
                    }
                })
                .catch(error => {
                    console.error('Error FormSubmit:', error);
                    showMessage('error', 'Error de conexión. Por favor verificá tu internet e intentá nuevamente.');
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
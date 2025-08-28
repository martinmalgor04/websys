<?php
header('Content-Type: text/html; charset=utf-8');

// Incluir configuración y funciones
require_once('config/config.php');
require_once('includes/functions.php');

// Configurar página
$page_title = 'Inicio';
$body_id = 'home';
$schema_markup = generateLocalBusinessSchema();

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
                    <div class="row align-items-center">
                        <div class="col-lg-7 text-white mb-5 mb-lg-0" data-aos="fade-right">
                            <h2 class="display-4 fw-bold mb-4">SERVICIOS DE DATACENTER</h2>
                            <p class="lead mb-5">
                                Alojá tu servidor en nuestra infraestructura de alta disponibilidad y olvidate de los problemas técnicos. 
                                Seguridad 24/7, respaldo continuo y soporte especializado para tu empresa.
                            </p>
                            
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-shield-quarter fs-2 me-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Máxima Seguridad</h6>
                                            <small class="text-white-50">Protección avanzada 24/7</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-server fs-2 me-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Alta Disponibilidad</h6>
                                            <small class="text-white-50">99.9% uptime garantizado</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-support fs-2 me-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Soporte Experto</h6>
                                            <small class="text-white-50">Asistencia especializada</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-dollar-circle fs-2 me-3 text-white"></i>
                                        <div>
                                            <h6 class="mb-1 text-white">Ahorro de Costos</h6>
                                            <small class="text-white-50">Sin inversión en equipos</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <a href="datacenter.php" class="btn btn-white btn-lg rounded-pill px-5 py-3 hover-lift">
                                <i class="bx bx-info-circle me-2"></i>CONOCER MÁS
                            </a>
                        </div>
                        <div class="col-lg-5" data-aos="fade-left">
                            <div class="position-relative">
                                <img src="assets/img/datacenter/datacenter-preview.jpg" alt="Servicios de Datacenter" class="img-fluid rounded-3 shadow-lg">
                                <div class="position-absolute top-50 start-50 translate-middle">
                                    <div class="bg-white rounded-circle p-4 shadow-lg">
                                        <i class="bx bx-server display-4 text-primary"></i>
                                    </div>
                                </div>
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
                                    <div class="text-center">
                                        <i class="bx bx-image display-4 mb-3"></i>
                                        <p>Imagen/Video institucional</p>
                                    </div>
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

        </main>

        <!--begin:Footer-->
        <?php include('includes/footer.php');?>
        <!--end:Footer-->

        <?php include('includes/script.php');?>
    </body>

</html>

<?php
// Configuración del encabezado y carga de configuración central
header('Content-Type: text/html; charset=utf-8');

// Incluir configuración central para constantes (SUPPORT_URL, ECOMMERCE_URL, etc.)
require_once('config/config.php');
require_once('includes/functions.php');
?>
<!doctype html>
<html lang="es">
    <head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Tango Estudios Contables - Productos - Servicios y Sistemas</title>
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
            <section class="position-relative text-white" style="background-color:#FF8300;">
                <div class="container position-relative py-9 py-lg-15">
                    <div class="row pt-4">
                        <div class="col-xl-12">
							<div class="d-flex align-items-center">
								<img src="assets/img/productos/tango-estudios-contables/logos/logo_ec-blanco01.png" title="Tango Estudios Contables" alt="Tango Estudios Contables" class="img-fluid mx-auto">
							</div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <!--/.content-->
            </section>
            <!--end: Header -->
            
            <!--begin: Intro Estudios Contables -->
			<section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-9">
                    <h2 class="display-5 text-center mb-5">La solución para tu estudio contable</h2>
					<div class="row justify-content-center">
                        <div class="col-md-10 text-center mb-4" data-aos="fade-up" data-aos-delay="50">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
								<p class="lead mx-auto text-dark">
									Tango Estudios Contables te facilita y potencia el trabajo. Funciona de manera eficiente, sin importar el tamaño de la empresa de tu cliente. Podés trabajar en línea y tener la tranquilidad de que siempre está actualizado con toda la reglamentación vigente. Además, se integra a la perfección con Tango Gestión, el software que elige la mayoría de tus clientes.
								</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<!--end: Intro Estudios Contables -->

            <!--begin: Características Principales -->
            <section class="position-relative bg-gradient-light">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center">
                        <!--begin:Eficiente -->
                        <div class="col-lg-4 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="50">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="icon-Speed-2 display-3 text-warning"></i>
                                </div>
                                <div class="d-flex align-items-center mb-3 justify-content-center">
                                    <h5 class="mb-0 text-warning fw-bold">EFICIENTE</h5>
                                </div>
                                <p class="mb-0 w-lg-75 mx-auto">
                                    Obtené el mejor resultado, de forma integrada en el menor tiempo posible.
                                </p>
                            </div>
                        </div>
                        <!--end:Eficiente -->

                        <!--begin:Flexible -->
                        <div class="col-lg-4 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="100">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="icon-Resize display-3 text-warning"></i>
                                </div>
                                <div class="d-flex align-items-center mb-3 justify-content-center">
                                    <h5 class="mb-0 text-warning fw-bold">FLEXIBLE</h5>
                                </div>
                                <p class="mb-0 w-lg-75 mx-auto">
                                    Se adapta a cualquiera sea el tamaño de tu empresa cliente ya sea una microempresa o un gran holding.
                                </p>
                            </div>
                        </div>
                        <!--end:Flexible -->

                        <!--begin:Conectado -->
                        <div class="col-lg-4 col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="150">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl h-100">
                                <div class="mb-4 position-relative">
                                    <i class="icon-Globe display-3 text-warning"></i>
                                </div>
                                <div class="d-flex align-items-center mb-3 justify-content-center">
                                    <h5 class="mb-0 text-warning fw-bold">CONECTADO</h5>
                                </div>
                                <p class="mb-0 w-lg-75 mx-auto">
                                    Podés enviar información en línea a tus clientes lo que te permite ahorrar tiempo y trabajo.
                                </p>
                            </div>
                        </div>
                        <!--end:Conectado -->
                    </div>
                </div>
            </section>
            <!--end: Características Principales -->

            <!--begin: Módulos Principales -->
            <section class="overflow-hidden bg-body position-relative">
				<div class="container position-relative py-9 py-lg-11">
					<div class="row mb-9 mb-lg-11 justify-content-between align-items-end">
						<div class="col-lg-10 col-xl-8 mx-auto text-center">
						  <h2 class="display-5 mb-0" data-aos="fade-up">Módulos del Sistema</h2>
						</div>
					</div>
					
					<!--begin: Sueldos -->
					<div class="row align-items-center mb-9">
						<div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
							<div class="pe-lg-5">
								<h3 class="display-6 mb-4" style="color: #FF8300;">SUELDOS</h3>
								<div class="mb-4">
									<ul class="list-unstyled">
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Alta y actualización de registración de empleados, empleados eventuales, modalidades de contratación, entre otros.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Actualización de eventos (horas, adelantos, etc.) producidos durante un período.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Confección de los distintos tipos de liquidaciones, emisión de los recibos y cálculo del Impuesto a las Ganancias.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Simulación de la liquidación y simulación del cálculo del sueldo bruto.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Importación automática desde Siradig.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Generación de asientos contables, exportación de información y generación de los datos para el depósito de haberes.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Reportes de control de las liquidaciones realizadas, y de la información ingresada en los archivos maestros del sistema.</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
							<div class="position-relative">
								<img src="assets/img/productos/tango-estudios-contables/sueldos_1.png" alt="Módulo de Sueldos" class="img-fluid rounded-3 shadow-lg">
							</div>
						</div>
					</div>
					<!--end: Sueldos -->

					<!--begin: Contabilidad -->
					<div class="row align-items-center mb-9">
						<div class="col-lg-6 order-lg-2 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
							<div class="ps-lg-5">
								<h3 class="display-6 mb-4" style="color: #FF8300;">CONTABILIDAD</h3>
								<div class="mb-4">
									<ul class="list-unstyled">
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Multiejercicio.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Multimonetario.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Ilimitada cantidad de planes de cuenta.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Emisión de papeles de trabajo.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Ajuste por inflación y Resultado por tenencia.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Tablero de indicadores configurable por el usuario.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Importación de asientos desde los módulos de Tango.</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-6 order-lg-1" data-aos="fade-up" data-aos-delay="100">
							<div class="position-relative">
								<img src="assets/img/productos/tango-estudios-contables/Contabilidad.jpg" alt="Módulo de Contabilidad" class="img-fluid rounded-3 shadow-lg">
							</div>
						</div>
					</div>
					<!--end: Contabilidad -->

					<!--begin: Liquidador IVA -->
					<div class="row align-items-center mb-9">
						<div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
							<div class="pe-lg-5">
								<h3 class="display-6 mb-4" style="color: #FF8300;">LIQUIDADOR DE I.V.A E INGRESOS BRUTOS</h3>
								<div class="mb-4">
									<ul class="list-unstyled">
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Registración de comprobantes de ventas y compras, ya sean facturas, notas de crédito, notas de débito o cualquier tipo de comprobante.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Registración de comprobantes de IIBB, comprobantes de anticipos, retenciones y otros pagos referidos a la liquidación de ingresos brutos.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Importación de comprobantes desde Excel de comprobantes desde Tango Ventas y Tango Compras / Proveedores.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Importación de comprobantes desde AFIP, según la RG 3685.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Generación y exportación de asientos contables.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Transporte de formularios y reportes hacia otras empresas.</li>
										<li class="py-2"><i class="bx bx-check text-success me-2"></i>Reportes y formularios totalmente configurables.</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
							<div class="position-relative">
								<img src="assets/img/productos/tango-estudios-contables/liquidador_iva.jpg" alt="Liquidador de IVA" class="img-fluid rounded-3 shadow-lg">
							</div>
						</div>
					</div>
					<!--end: Liquidador IVA -->
				</div>
            </section>
            <!--end: Módulos Principales -->

            <!--begin: Conectividad -->
            <?php
            // Incluir componente Card Hover 2
            require_once('includes/components/card-hover-2.php');
            renderConnectivitySection();
            ?>
            <!--end: Conectividad -->

            <!--begin: Tango Reportes -->
            <section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
                            <div class="pe-lg-5">
                                <h2 class="display-6 mb-4">TANGO REPORTES</h2>
                                <h4 class="mb-4 text-primary">La información de tus empresas desde donde estes</h4>
                                <div class="mb-4">
                                    <ul class="list-unstyled">
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Ver informes de los módulos Ventas, Sueldos y Stock de Tango Gestión, Punto de Venta y Restó; y de Comandas de Tango Restô.</li>
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Analizar la información de una empresa (o sucursal) o por un grupo de ellas.</li>
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Definir tus grupos de empresas de acuerdo a la necesidad de información.</li>
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Visualizar tu información mediante indicadores, informes de tipo grilla y pivot (multidimensional).</li>
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Exportar los informes a Excel.</li>
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Compartir tu información y recibir invitaciones.</li>
                                        <li class="py-2"><i class="bx bx-check text-success me-2"></i>Seleccionando informes puntuales de una empresa o grupo de empresas, o bien todos los informes.</li>
                                    </ul>
                                </div>
                                <p class="lead">
                                    Tango Reportes te permite acceder a la información consolidada de ventas, sueldos y stock de tus empresas desde donde estés.
                                </p>
                                
                                <h6 class="fw-bold mt-4 mb-3">Sistemas compatibles</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-primary px-3 py-2">TANGO GESTIÓN</span>
                                    <span class="badge bg-primary px-3 py-2">TANGO PUNTO DE VENTA</span>
                                    <span class="badge bg-warning px-3 py-2">TANGO ESTUDIOS CONTABLES</span>
                                    <span class="badge bg-danger px-3 py-2">TANGO RESTO</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="position-relative">
                                <img src="assets/img/productos/tango-estudios-contables/IMAGEN NEXO.png" alt="Tango Reportes" class="img-fluid rounded-3 shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Tango Reportes -->

            <?php
            // Definir FAQ específico para Tango Estudios Contables
            $faq_title = "PREGUNTAS FRECUENTES - TANGO ESTUDIOS CONTABLES";
            $faq_subtitle = "Resolvemos las dudas más comunes sobre Tango Estudios Contables";
            
            $faq_items = [
                [
                    'icon' => 'bx bx-briefcase-alt',
                    'question' => '¿Qué tipos de estudios contables pueden usar Tango Estudios Contables?',
                    'answer' => '<p class="mb-0">Tango Estudios Contables está diseñado para adaptarse a estudios de cualquier tamaño, desde contadores independientes hasta grandes estudios con múltiples socios. Funciona eficientemente tanto para microemprendimientos como para grandes holdings empresariales.</p>'
                ],
                [
                    'icon' => 'bx bx-cloud',
                    'question' => '¿Puedo trabajar en línea con mis clientes?',
                    'answer' => '<p class="mb-3">Sí, absolutamente. Tango Estudios Contables te permite:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Enviar información en línea a tus clientes</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Ahorrar tiempo y trabajo en la comunicación</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Acceso remoto desde cualquier dispositivo</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Sincronización automática de datos</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-refresh',
                    'question' => '¿Cómo se mantiene actualizado con la normativa vigente?',
                    'answer' => '<p class="mb-0">Tango Estudios Contables se actualiza automáticamente con toda la reglamentación vigente. Nuestro equipo de desarrollo mantiene el sistema al día con los cambios normativos de AFIP, actualizaciones fiscales y nuevas disposiciones contables, garantizando que siempre trabajes con la información más actual.</p>'
                ],
                [
                    'icon' => 'bx bx-link-alt',
                    'question' => '¿Cómo se integra con Tango Gestión?',
                    'answer' => '<p class="mb-3">La integración es perfecta y automática:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Importación directa de asientos contables</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Sincronización de datos entre sistemas</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Eliminación de doble carga de información</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Trabajo colaborativo con tus clientes que usan Tango Gestión</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-file-import',
                    'question' => '¿Puedo importar datos desde otros sistemas?',
                    'answer' => '<p class="mb-3">Sí, Tango Estudios Contables soporta múltiples formatos de importación:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Importación desde Excel</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Importación automática desde Siradig</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Importación desde AFIP (RG 3685)</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Compatibilidad con otros módulos de Tango</li>
                    </ul>'
                ],
                [
                    'icon' => 'bx bx-support',
                    'question' => '¿Qué soporte técnico incluye?',
                    'answer' => '<p class="mb-3">Ofrecemos soporte integral:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Capacitación inicial y continua</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Soporte técnico especializado</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Actualizaciones automáticas</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Migración de datos asistida</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Configuración personalizada según tu estudio</li>
                    </ul>'
                ]
            ];
            
            // Incluir el template FAQ
            include('includes/faq-template.php');
            ?>

			<!--begin: Navegation products -->
            <?php
            // Incluir componente Navigation Products
            require_once('includes/components/navigation-products.php');
            renderTangoProductsNavigation('tango-estudios-contables');
            ?>
            <!--end: Navegation products -->
			
        </main>

        <!--begin:Footer-->
        <?php include('includes/footer.php');?>
        <!--end:Footer-->

        <?php include('includes/script.php');?>
		
    </body>
	

</html>
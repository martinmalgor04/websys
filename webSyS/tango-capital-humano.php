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
		<title>Tango Capital Humano - Productos - Servicios y Sistemas</title>
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
            <section class="position-relative text-white" style="background-color:#00A8E1;">
                <div class="container position-relative py-9 py-lg-15">
                    <div class="row pt-4">
                        <div class="col-xl-12">
							<div class="d-flex  align-items-center">
								<img src="assets/img/productos/tango-capital-humano/tangocaphumano.png"  class="img-fluid mx-auto">
							</div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <!--/.content-->
            </section>
			
			<!--begin: Intro Capital Humano -->
            <section class="position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row pt-5  pt-lg-7">
                        <div class="col-xl-10 col-lg-8 mx-auto text-center mb-9">
                            <h2 class="display-4 mb-3" data-aos="fade-up">Sistema Integral de Gestión de Recursos Humanos</h2>
                            <p class="mb-0 lead" data-aos="fade-up" data-aos-delay="150">
                                Tango Capital Humano es la solución integral para la gestión moderna de recursos humanos. 
                                Desde la administración de personal hasta la evaluación de desempeño, optimiza todos los 
                                procesos de RRHH de tu empresa.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!--end: Intro Capital Humano -->
			
			<!--begin: Soluciones -->
			<section class="overflow-hidden bg-gradient-light position-relative">
				<div class="container position-relative py-9 py-lg-11">
					<div class="row mb-9 mb-lg-11 justify-content-between align-items-end">
						<div class="col-lg-10 col-xl-8 mx-auto text-center">
						  <h2 class="display-5 mb-0" data-aos="fade-up">Módulos y Funcionalidades</h2>
						</div>
					</div>
					<div class="row justify-content-center">
					    <!--begin:Ítem -->
					    <div class="col-md-6 text-center mb-4" data-aos="fade-up" data-aos-delay="50">
                            <!--Icon card-->
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                            <!--Icon-->
							<div class="mb-4 position-relative">
							  <i class="icon-Add-User display-3 text-primary"></i>
							</div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0">Gestión de Personal</h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                                Administración completa de legajos de empleados, control de datos personales, documentación, 
                                historia laboral y toda la información necesaria para una gestión eficiente del capital humano.
							</p>
                            </div>
                        </div>
					    <!--end:Ítem -->
						<!--begin:Ítem -->
					    <div class="col-md-6 text-center mb-4" data-aos="fade-up" data-aos-delay="100">
                            <!--Icon card-->
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                            <!--Icon-->
							<div class="mb-4 position-relative">
							  <i class="icon-Clock display-3 text-primary"></i>
							</div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0">Control de Asistencia</h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                               Registro y control automatizado de horarios, tardanzas, ausencias y presentismo. 
                               Integración con sistemas biométricos y generación de reportes detallados.
							</p>
                            </div>
                        </div>
					    <!--end:Ítem -->
						<!--begin:Ítem -->
					    <div class="col-md-6 text-center mb-4" data-aos="fade-up" data-aos-delay="150">
                            <!--Icon card-->
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                            <!--Icon-->
							<div class="mb-4 position-relative">
							  <i class="icon-Money display-3 text-primary"></i>
							</div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0">Liquidación de Sueldos</h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                                Cálculo automático de remuneraciones, descuentos, aportes y contribuciones. 
                                Cumplimiento total con la legislación laboral argentina vigente.
							</p>
                            </div>
                        </div>
					    <!--end:Ítem -->
						<!--begin:Ítem -->
					    <div class="col-md-6 text-center mb-4" data-aos="fade-up" data-aos-delay="200">
                            <!--Icon card-->
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                            <!--Icon-->
							<div class="mb-4 position-relative">
							  <i class="icon-Student-Hat display-3 text-primary"></i>
							</div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0">Capacitación y Desarrollo</h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                              Gestión de planes de capacitación, seguimiento de cursos, certificaciones y 
                              desarrollo profesional del personal.
							</p>
                            </div>
                        </div>
					    <!--end:Ítem -->
						<!--begin:Ítem -->
					    <div class="col-md-6 text-center mb-4" data-aos="fade-up" data-aos-delay="250">
                            <!--Icon card-->
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                            <!--Icon-->
							<div class="mb-4 position-relative">
							  <i class="icon-Statistic display-3 text-primary"></i>
							</div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0">Evaluación de Desempeño</h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                             Sistema de evaluaciones periódicas, objetivos, competencias y seguimiento 
                             del rendimiento del personal con reportes analíticos.
							</p>
                            </div>
                        </div>
					    <!--end:Ítem -->
						<!--begin:Ítem -->
					    <div class="col-md-6 text-center mb-4" data-aos="fade-up" data-aos-delay="300">
                            <!--Icon card-->
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
                            <!--Icon-->
							<div class="mb-4 position-relative">
							  <i class="icon-Medical-Sign display-3 text-primary"></i>
							</div>
                            <div class="d-flex align-items-center mb-3 justify-content-center">
                                <h5 class="mb-0">Medicina Laboral</h5>
                            </div>
                            <p class="mb-0 w-lg-75 mx-auto">
                             Control de exámenes médicos, vacunas, licencias por enfermedad y 
                             seguimiento de la salud ocupacional del personal.
							</p>
                            </div>
                        </div>
					    <!--end:Ítem -->
					</div>
                </div>
            </section>
            <!--end: Soluciones -->
			
			<!--begin: Navegation products -->
            <section class="position-relative border-bottom overflow-hidden" style="background-color: #E3F2FD ">
                <div class="container py-9 py-lg-11 position-relative">
                    <div class="row pt-5  pt-lg-7 justify-content-center align-items-center">
                        <div class="col-xl-10 text-center mb-9">
                            <h4 class="display-4 mb-3" data-aos="fade-up">Conoce nuestros productos
                            </h4>
                            
                            <div data-aos="fade-up" data-aos-delay="150">
                                <!-- -->
                                <a href="tango-gestion.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Gestión</span>
                                </a>
							
								<a href="tango-estudios-contables.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Estudios Contable</span>
                                </a>
							
								<a href="tango-punto-de-venta.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Punto de Venta</span>
                                </a>
							
								<a href="tango-resto.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Resto</span>
                                </a>
								
								<a href="tango-delta.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Delta</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!--end: Navegation products -->
			
        </main>

        <!--begin:Footer-->
        <?php include('includes/footer.php');?>
        <!--end:Footer-->

        <?php include('includes/script.php');?>
		
    </body>
	

</html> 
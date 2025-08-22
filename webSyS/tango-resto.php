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
		<title>Tango Resto - Productos - Servicios y Sistemas</title>
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
            <section class="position-relative text-white" style="background-color:#E31937;">
                <div class="container position-relative py-9 py-lg-15">
                    <div class="row pt-4">
                        <div class="col-xl-12">
							<div class="d-flex  align-items-center">
								<img src="assets/img/productos/tango-resto/Tango Resto v1.svg" title="Tango Resto" alt="Tango Resto" class="img-fluid mx-auto">
							</div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <!--/.content-->
            </section>
            
            
			<!--begin: Intro PVD -->
			<section class="position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row ">
						<div class="col-lg-9 mx-auto">
							<div class="row justify-content-between align-items-center">
								<div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
									<div class="position-relative p-2">
										<img src="assets/img/productos/tango-resto/Dispositivos desde cPanel.jpg" class="img-fluid" alt="">
									</div>
								</div>
								<div class="col-lg-6 position-relative" data-aos="fade-up" data-aos-delay="100">
									<!--Heading-->
									<h2 class="mb-4 display-5">El Software para tu cadena de restaurantes</h2>
									<p class="mb-5">
										Tango Restô es un software gastronómico que se adapta a cualquier tipo y tamaño de negocio: restaurantes, bares/discos, parrillas, pizzerías, heladerías, cafeterías, fast food, delivery, franquicias y más. Es un sistema totalmente escalable que acompaña tu crecimiento.
									</p>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </section>
			<!--end: Intro PVD -->
			<section class="position-relative">
                <div class="container position-relative py-9 py-lg-11">
					<div class="row justify-content-between align-items-center">
						<div class="alert alert-warning fs-4 text-center p-5">
							<strong><i class="bx bx-error d-inline-block align-middle me-1"></i> Atención</strong>
							 Estamos actualizando el contenido de esta sección.
						</div>
					</div>
				</div>
            </section>
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
							
								<a href="tango-delta.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Delta</span>
                                </a>
								
								<a href="tango-capital-humano.php" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Capital Humano</span>
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
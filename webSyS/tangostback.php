<?php
	header('Content-Type: text/html; charset=utf-8');
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
            <section class="position-relative text-white" style="background-color:#F47D30;">
                <div class="container position-relative py-9 py-lg-15">
                    <div class="row pt-4">
                        <div class="col-xl-12">
							<div class="d-flex  align-items-center">
								<img src="assets/img/productos/tango-estudios-contables/logo_ec_v2.png" title="Tango Estudios Contables" alt="Tango Estudios Contables" class="img-fluid mx-auto">
							</div>
                        </div>
                    </div>
                    <!--/.row-->
                </div>
                <!--/.content-->
            </section>
            
            
			<!--begin: Intro EC -->
			<section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-9">
                    <h2 class="display-5 text-center mb-5">La solución para tu estudio contable</h2>
					<div class="row justify-content-center">
                        <div class="col-md-10 text-center mb-4" data-aos="fade-up" data-aos-delay="50">
                            <div class="card card-body py-5 px-4 border-0 shadow-lg hover-lift hover-shadow-xl">
								<p class="lead mx-auto text-dark">
									Tango Estudios Contables te facilita y potencia el trabajo. Funciona de manera eficiente, sin importar el tamaño de la empresa de tu cliente. Podés trabajar en línea y tener la tranquilidad de que siempre está actualizado con toda la reglamentación vigente. Además, se integra a la perfección con Tango Gestión, el software que elige la mayoría de tus clientes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
			<!--end: Intro EC -->
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
                                <a href="tango-punto-de-venta" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Punto de Venta</span>
                                </a>
							
								<a href="tango-gestion" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Gestión</span>
                                </a>
							
								<a href="tango-resto" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
                                    <span>Tango Restó</span>
                                </a>
							
								<a href="tango-delta" class="btn btn-lg btn-outline-primary hover-lift rounded-pill">
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

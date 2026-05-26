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

            <!-- 1. Hero -->
            <section class="position-relative text-white overflow-hidden cult-mesh-bg cult-mesh-bg--blue cult-page-header">
                <div class="cult-hero-grid" aria-hidden="true"></div>
                <div class="cult-blob cult-blob--cyan cult-decoration" style="top:-8%; right:-5%; opacity:0.35;" aria-hidden="true"></div>
                <div class="cult-blob cult-blob--violet cult-decoration" style="bottom:-12%; left:-8%; opacity:0.25;" aria-hidden="true"></div>
                <div class="container position-relative py-9 py-lg-15" style="z-index:2;">
                    <div class="row align-items-center">
                        <div class="col-lg-10 text-center mx-auto">
                            <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex" data-aos="fade-up">
                                <i class="bx bx-server" aria-hidden="true"></i>
                                Hosting y servidores
                            </span>
                            <h1 class="cult-display cult-display--hero mb-4" data-aos="fade-up" data-aos-delay="50">
                                Data<span class="cult-shimmer-text--bright">center</span>
                            </h1>
                            <p class="lead mb-5 mx-auto" style="max-width: 38rem; opacity: 0.85;" data-aos="fade-up" data-aos-delay="100">
                                Alojá tu servidor en nuestra infraestructura de alta disponibilidad y olvidate de los problemas técnicos
                            </p>

                            <div class="cult-stats-row mb-5" data-aos="fade-up" data-aos-delay="150">
                                <?= cultStatNumber('99.9', 'Uptime garantizado', '', '%', true,  'cult-stat-block--light') ?>
                                <?= cultStatNumber('24/7', 'Monitoreo continuo', '',  '', false, 'cult-stat-block--light') ?>
                                <?= cultStatNumber('5',    'Latencia máx.',     '<', 'ms', false, 'cult-stat-block--light') ?>
                                <?= cultStatNumber('30',   'Años de experiencia', '+', '', true,  'cult-stat-block--light') ?>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up" data-aos-delay="200">
                                <a href="#contacto" class="btn cult-btn-glass btn-lg cult-btn-shimmer">
                                    <i class="bx bx-phone me-2"></i>Solicitar consulta
                                </a>
                                <a href="#beneficios" class="btn cult-btn-glass btn-lg">
                                    <i class="bx bx-down-arrow-alt me-2"></i>Ver beneficios
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. ¿Qué es un Datacenter? -->
            <section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mb-5">
                            <span class="cult-section-eyebrow" data-aos="fade-up">Concepto</span>
                            <h2 class="cult-display cult-display--xl mb-0" data-aos="fade-up" data-aos-delay="50">
                                ¿Qué es un <span class="cult-gradient-text">Datacenter</span>?
                            </h2>
                        </div>
                        <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                            <div class="cult-callout-card text-center">
                                <div class="cult-callout-card__icon">
                                    <i class="bx bx-chip" aria-hidden="true"></i>
                                </div>
                                <p class="lead mb-0">
                                    Un datacenter es una granja de servidores de alto rendimiento que alberga sistemas de TI críticos. Gracias a la climatización, la energía de respaldo y las medidas de seguridad avanzadas, garantiza que tus datos y aplicaciones estén siempre protegidos y disponibles, sin la necesidad de gestionar tu propio servidor físico y todo lo que ello implica.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. Por qué elegir — 4 pilares -->
            <section id="beneficios" class="position-relative bg-body">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <span class="cult-section-eyebrow" data-aos="fade-up">Beneficios</span>
                            <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                                ¿Por qué elegir un <span class="cult-gradient-text">servidor alojado</span>?
                            </h2>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="50">
                            <motion-tilt max-tilt="5" speed="400" style="display:block;height:100%;">
                                <div class="cult-pillar-card h-100">
                                    <i class="bx bx-dollar-circle cult-pillar-card__icon text-success" aria-hidden="true"></i>
                                    <h3 class="cult-pillar-card__title">Ahorro de costos</h3>
                                    <p class="cult-pillar-card__text">Despedite de la inversión en equipos, mantenimiento y energía. Optimizá tus gastos con un plan de hosting a tu medida.</p>
                                </div>
                            </motion-tilt>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <motion-tilt max-tilt="5" speed="400" style="display:block;height:100%;">
                                <div class="cult-pillar-card h-100">
                                    <i class="bx bx-shield-quarter cult-pillar-card__icon text-primary" aria-hidden="true"></i>
                                    <h3 class="cult-pillar-card__title">Máxima seguridad</h3>
                                    <p class="cult-pillar-card__text">Nuestra vigilancia 24/7, sistemas de acceso controlado y respaldo continuo protegen tus datos en todo momento.</p>
                                </div>
                            </motion-tilt>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
                            <motion-tilt max-tilt="5" speed="400" style="display:block;height:100%;">
                                <div class="cult-pillar-card h-100">
                                    <i class="bx bx-time-five cult-pillar-card__icon text-warning" aria-hidden="true"></i>
                                    <h3 class="cult-pillar-card__title">Disponibilidad garantizada</h3>
                                    <p class="cult-pillar-card__text">Con redundancia en energía, clima y conectividad, tu servidor está siempre en línea.</p>
                                </div>
                            </motion-tilt>
                        </div>
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                            <motion-tilt max-tilt="5" speed="400" style="display:block;height:100%;">
                                <div class="cult-pillar-card h-100">
                                    <i class="bx bx-support cult-pillar-card__icon text-info" aria-hidden="true"></i>
                                    <h3 class="cult-pillar-card__title">Soporte especializado</h3>
                                    <p class="cult-pillar-card__text">Un equipo de expertos se ocupa de monitoreo, actualizaciones y asistencia técnica.</p>
                                </div>
                            </motion-tilt>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4. Local vs Datacenter -->
            <section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue">
                <div class="cult-hero-grid" aria-hidden="true"></div>
                <div class="container position-relative py-9 py-lg-11" style="z-index:2;">
                    <div class="cult-vs">
                        <div class="cult-vs__header text-white">
                            <span class="cult-section-eyebrow cult-section-eyebrow--light" data-aos="fade-up">Comparativa</span>
                            <h2 class="cult-display cult-display--xl mb-2 text-white" data-aos="fade-up" data-aos-delay="50">
                                Servidor Local vs <span class="cult-shimmer-text--bright">Datacenter</span>
                            </h2>
                            <p class="lead mx-auto mb-0" style="max-width:36rem; opacity:0.8;" data-aos="fade-up" data-aos-delay="100">
                                Compará las ventajas de alojar tu servidor en nuestro datacenter
                            </p>
                            <div class="cult-vs__chip" aria-hidden="true">VS</div>
                        </div>

                        <?php
                        $vs_rows = [
                            ['icon' => 'bx bx-wallet',       'label' => 'Inversión Inicial',   'local' => 'Alta (compra de hardware, instalación, infraestructura)',                          'dc' => 'Baja (planes de hosting y recursos escalables según necesidad)'],
                            ['icon' => 'bx bx-shield',        'label' => 'Seguridad',           'local' => 'La seguridad dependerá de la inversión inicial y los sistemas que se implementen', 'dc' => 'Múltiples capas de seguridad con firewall y conexión exclusiva con monitoreo 24/7'],
                            ['icon' => 'bx bx-group',         'label' => 'Personal',            'local' => 'Personal interno a cargo de la organización con costo adicional',                  'dc' => 'Equipo que 24/7 se ocupa de soporte, reparaciones, actualizaciones y backups'],
                            ['icon' => 'bx bx-trending-up',   'label' => 'Escalabilidad',       'local' => 'Limitada al espacio y capacidad del hardware',                                     'dc' => 'Inmediata: podés sumar recursos (RAM, CPU, almacenamiento) sin comprar equipos nuevos'],
                            ['icon' => 'bx bx-check-shield',  'label' => 'Disponibilidad',      'local' => 'Suele verse afectada por cortes de energía o internet',                            'dc' => 'Redundancia en energía, clima, conectividad y soporte, asegurando un alto nivel de uptime'],
                            ['icon' => 'bx bx-wrench',        'label' => 'Mantenimiento',       'local' => 'Mantenimiento continuo, reemplazo de equipos, insumos',                          'dc' => 'Costos fijos y previsibles, sin necesidad de grandes inversiones en infraestructura'],
                        ];
                        foreach ($vs_rows as $i => $row):
                        ?>
                        <div class="cult-vs__row" data-aos="fade-up" data-aos-delay="<?= 50 + ($i * 40) ?>">
                            <div class="cult-vs__label">
                                <i class="<?= $row['icon'] ?> text-info" aria-hidden="true"></i>
                                <?= htmlspecialchars($row['label'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                            <div class="cult-vs__side cult-vs__side--bad">
                                <i class="bx bx-x-circle text-danger" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($row['local'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <div class="cult-vs__divider" aria-hidden="true">·</div>
                            <div class="cult-vs__side cult-vs__side--good">
                                <i class="bx bx-check-circle text-success" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($row['dc'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- 5. Cómo empezar -->
            <section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue">
                <div class="cult-hero-grid" aria-hidden="true"></div>
                <div class="container position-relative py-9 py-lg-11" style="z-index:2;">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center text-white">
                            <span class="cult-section-eyebrow cult-section-eyebrow--light" data-aos="fade-up">Proceso</span>
                            <h2 class="cult-display cult-display--xl mb-0 text-white" data-aos="fade-up" data-aos-delay="50">
                                ¿Cómo <span class="cult-shimmer-text--bright">empezar</span>?
                            </h2>
                        </div>
                    </div>

                    <div class="cult-steps" data-aos="fade-up" data-aos-delay="100">
                        <div class="cult-steps__rail" aria-hidden="true"></div>

                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">1</div>
                                <h3 class="cult-step__title">Contactanos</h3>
                                <p class="cult-step__text">Conversá con nuestro equipo para evaluar las necesidades de tu negocio y definir la mejor configuración de servidor.</p>
                            </div>
                        </div>
                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">2</div>
                                <h3 class="cult-step__title">Diseño de la solución</h3>
                                <p class="cult-step__text">Te asesoramos sobre el tipo de servidor, capacidad, seguridad y planes de soporte que se ajusten a tus objetivos.</p>
                            </div>
                        </div>
                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">3</div>
                                <h3 class="cult-step__title">Implementación</h3>
                                <p class="cult-step__text">Migramos tus datos y aplicaciones al datacenter de manera ágil y segura, minimizando cualquier interrupción en tus operaciones.</p>
                            </div>
                        </div>
                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">4</div>
                                <h3 class="cult-step__title">Monitoreo y soporte</h3>
                                <p class="cult-step__text">Una vez en marcha, monitoreamos tu infraestructura y te brindamos soporte para garantizar un rendimiento óptimo.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            // FAQ específico para Datacenter
            $faq_title = "Preguntas frecuentes — Datacenter";
            $faq_subtitle = "Resolvemos las dudas más comunes sobre nuestros servicios de datacenter y hosting";
            $faq_use_cult = true;
            
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

            <!-- 7. Formulario de Contacto -->
            <section id="contacto" class="bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <span class="cult-section-eyebrow" data-aos="fade-up">Contacto</span>
                            <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                                Hablemos de tu <span class="cult-gradient-text">infraestructura</span>
                            </h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Completá el formulario y nos pondremos en contacto para diseñar la solución perfecta para tu empresa
                            </p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="cult-form-card py-5 px-4 px-lg-5" data-aos="fade-up" data-aos-delay="150">
                                <form id="datacenterForm" class="cult-form" method="POST" action="enviar-datacenter.php">
                                    <?php echo CSRFProtection::getTokenField('contact_form'); ?>

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
                                            <div class="cult-form-select-wrap">
                                                <select class="form-select" id="asunto" name="asunto" required>
                                                    <option value="">Seleccionar asunto</option>
                                                    <option value="DATACENTER">Datacenter</option>
                                                    <option value="INFRAESTRUCTURA">Infraestructura</option>
                                                    <option value="TANGO">Tango</option>
                                                    <option value="SOPORTE TÉCNICO">Soporte técnico</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="mensaje" class="form-label fw-bold">Mensaje o Comentarios</label>
                                        <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Contanos sobre tus necesidades específicas de infraestructura..."></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label fw-bold">¿Cómo te enteraste de nosotros?</label>
                                        <div class="cult-form-radio-group">
                                            <label class="cult-form-radio-chip">
                                                <input type="radio" name="como_se_entero" value="REDES SOCIALES">
                                                <span>Redes sociales</span>
                                            </label>
                                            <label class="cult-form-radio-chip">
                                                <input type="radio" name="como_se_entero" value="BOCA EN BOCA">
                                                <span>Boca en boca</span>
                                            </label>
                                            <label class="cult-form-radio-chip">
                                                <input type="radio" name="como_se_entero" value="GOOGLE">
                                                <span>Google</span>
                                            </label>
                                            <label class="cult-form-radio-chip">
                                                <input type="radio" name="como_se_entero" value="EN EL LOCAL">
                                                <span>En el local</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn cult-btn-primary btn-lg cult-btn-shimmer px-5 py-3">
                                            <i class="bx bx-send me-2"></i>Enviar consulta
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

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
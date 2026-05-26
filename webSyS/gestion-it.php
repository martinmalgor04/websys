<?php
/**
 * Página de Gestión Integral IT — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con stats animados + CTAs
 *   2. Compromiso (cult-callout-card)
 *   3. Servicios IT (6 cult-pillar-card)
 *   4. Cableado e infraestructura de red (4 cult-pillar-card)
 *   5. Comparativa Sin vs Con Gestión IT
 *   6. Cómo empezamos (cult-steps)
 *   7. FAQ
 *   8. CTA + formulario (renderCultCtaForm)
 */

header('Content-Type: text/html; charset=utf-8');

require_once('config/config.php');
require_once('includes/functions.php');
require_once('includes/security-init.php');
initSecurity();

require_once('includes/components/cult-cta-form.php');

$page_title = 'Gestión Integral IT';
$body_id    = 'gestion-it';

$it_services = [
    [
        'title'       => 'Soporte Técnico 24/7',
        'icon'        => 'bx bx-support text-primary',
        'description' => 'Asistencia inmediata cuando más lo necesitás. Resolvemos problemas antes de que afecten tu productividad.',
    ],
    [
        'title'       => 'Administración de Infraestructura',
        'icon'        => 'bx bx-server text-info',
        'description' => 'Mantenimiento y optimización completa de servidores, equipos y sistemas para máximo rendimiento.',
    ],
    [
        'title'       => 'Monitoreo Continuo',
        'icon'        => 'bx bx-line-chart text-warning',
        'description' => 'Vigilancia proactiva de tu infraestructura para detectar y prevenir problemas antes de que ocurran.',
    ],
    [
        'title'       => 'Seguridad Informática',
        'icon'        => 'bx bx-shield-quarter text-success',
        'description' => 'Protección integral contra amenazas digitales. Tu información empresarial siempre segura.',
    ],
    [
        'title'       => 'Backup & Recuperación',
        'icon'        => 'bx bx-data text-danger',
        'description' => 'Respaldos automáticos y planes de recuperación ante desastres. Tu información nunca se pierde.',
    ],
    [
        'title'       => 'Gestión de Redes',
        'icon'        => 'bx bx-network-chart text-primary',
        'description' => 'Configuración y administración lógica de switches, VLANs, firewalls y WiFi corporativo. Monitoreo de tráfico y optimización de rendimiento.',
    ],
];

$infra_services = [
    [
        'title'       => 'Fibra óptica',
        'icon'        => 'bx bx-broadcast text-primary',
        'description' => 'Tendido y fusión de fibra OM3/OM4 y monomodo. Conectorizado LC/SC, enlaces inter-edificio y dentro de sala de servidores.',
    ],
    [
        'title'       => 'Cableado estructurado',
        'icon'        => 'bx bx-network-chart text-info',
        'description' => 'UTP categoría 6 y 6A certificado. Distribución por colores, etiquetado por norma y documentación completa de planos.',
    ],
    [
        'title'       => 'Racks y patch panels',
        'icon'        => 'bx bx-server text-warning',
        'description' => 'Gabinetes 19" desde 6U hasta 42U. Patch panels keystone, organizadores horizontales, PDUs y ventilación.',
    ],
    [
        'title'       => 'Certificación y as-built',
        'icon'        => 'bx bx-check-shield text-success',
        'description' => 'Mediciones con instrumental Fluke, planos as-built, garantía sobre el trabajo realizado y revisiones periódicas.',
    ],
];

$vs_rows = [
    ['icon' => 'bx bx-time-five',      'label' => 'Tiempo de respuesta', 'sin' => 'Horas o días hasta que alguien atienda el incidente', 'con' => 'Menos de 15 minutos con monitoreo proactivo y alertas automáticas'],
    ['icon' => 'bx bx-wallet',         'label' => 'Costo',               'sin' => 'IT interno, horas extras y gastos imprevistos en reparaciones', 'con' => 'Tarifa fija mensual predecible, sin sorpresas'],
    ['icon' => 'bx bx-calendar-check', 'label' => 'Disponibilidad',      'sin' => 'Soporte cuando aparece el problema o en horario laboral', 'con' => 'Cobertura 24/7 todos los días del año'],
    ['icon' => 'bx bx-shield',         'label' => 'Seguridad',           'sin' => 'Enfoque reactivo: actuás cuando ya hubo un incidente', 'con' => 'Preventiva: parches, backups y monitoreo de amenazas automático'],
    ['icon' => 'bx bx-group',          'label' => 'Conocimiento',        'sin' => 'Dependencia de una sola persona con conocimiento limitado', 'con' => 'Equipo multidisciplinario con especialistas en cada área'],
    ['icon' => 'bx bx-trending-up',    'label' => 'Escalabilidad',       'sin' => 'Limitada al personal interno y su capacidad', 'con' => 'Crece con tu negocio: sumás recursos sin contratar más gente'],
];
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
        <div class="spinner-loader bg-primary text-white">
            <div class="spinner-grow" role="status"></div>
            <span class="small d-block ms-2">Cargando...</span>
        </div>

        <?php include('includes/nav.php');?>

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
                                <i class="bx bx-cog" aria-hidden="true"></i>
                                Servicio gestionado
                            </span>
                            <h1 class="cult-display cult-display--hero mb-4" data-aos="fade-up" data-aos-delay="50">
                                Gestión <span class="cult-shimmer-text--bright">integral</span><br>de tu IT
                            </h1>
                            <p class="lead mb-5 mx-auto" style="max-width: 38rem; opacity: 0.85;" data-aos="fade-up" data-aos-delay="100">
                                ¿Tu IT te genera dolores de cabeza? Con nuestra gestión integral te olvidás de los problemas tecnológicos
                            </p>

                            <div class="cult-stats-row mb-5" data-aos="fade-up" data-aos-delay="150">
                                <?= cultStatNumber('30',   'Años de experiencia', '+', '', true,  'cult-stat-block--light') ?>
                                <?= cultStatNumber('24/7', 'Soporte continuo',    '',  '', false, 'cult-stat-block--light') ?>
                                <?= cultStatNumber('15',   'Tiempo de respuesta', '<', 'min', false, 'cult-stat-block--light') ?>
                                <?= cultStatNumber('99',   'Satisfacción',        '',  '%', true,  'cult-stat-block--light') ?>
                            </div>

                            <div class="d-flex flex-wrap justify-content-center gap-3" data-aos="fade-up" data-aos-delay="200">
                                <a href="#contacto" class="btn cult-btn-glass btn-lg cult-btn-shimmer">
                                    <i class="bx bx-phone me-2"></i>Contactanos
                                </a>
                                <a href="#servicios" class="btn cult-btn-glass btn-lg">
                                    <i class="bx bx-down-arrow-alt me-2"></i>Ver servicios
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. Compromiso -->
            <section class="overflow-hidden bg-body position-relative">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center">
                        <div class="col-lg-10 text-center mb-5">
                            <span class="cult-section-eyebrow" data-aos="fade-up">Nuestra promesa</span>
                            <h2 class="cult-display cult-display--xl mb-0" data-aos="fade-up" data-aos-delay="50">
                                Nuestro <span class="cult-gradient-text">compromiso</span>
                            </h2>
                        </div>
                        <div class="col-lg-9" data-aos="fade-up" data-aos-delay="100">
                            <div class="cult-callout-card text-center">
                                <div class="cult-callout-card__icon">
                                    <i class="bx bx-heart" aria-hidden="true"></i>
                                </div>
                                <p class="lead mb-0">
                                    La responsabilidad y compromiso con el cliente nos define. <strong>Nunca dejamos un trabajo a medias, nunca desaparecemos ante contingencias</strong> y dejamos el alma por nuestros clientes para que no tengan pérdidas por problemas en sus sistemas. Tu IT es nuestra prioridad.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. Servicios IT -->
            <section id="servicios" class="position-relative bg-body">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <span class="cult-section-eyebrow" data-aos="fade-up">Servicios</span>
                            <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                                Gestión IT <span class="cult-gradient-text">integral</span>
                            </h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Ofrecemos una solución completa para PyMEs y grandes empresas que quieren desentenderse de los problemas tecnológicos
                            </p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php foreach ($it_services as $i => $service): ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= 50 + ($i * 50) ?>">
                            <motion-tilt max-tilt="4" speed="400" style="display:block;height:100%;">
                                <article class="cult-pillar-card h-100 text-center">
                                    <i class="cult-pillar-card__icon <?= htmlspecialchars($service['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                                    <h3 class="cult-pillar-card__title"><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                    <p class="cult-pillar-card__text mb-0"><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></p>
                                </article>
                            </motion-tilt>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- 4. Cableado e infraestructura de red -->
            <section id="cableado" class="position-relative overflow-hidden bg-gradient-light">
                <div class="container position-relative py-9 py-lg-11">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center">
                            <span class="cult-section-eyebrow" data-aos="fade-up">Infraestructura física</span>
                            <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                                Cableado <span class="cult-gradient-text">estructurado y fibra</span>
                            </h2>
                            <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">
                                Diseñamos, instalamos y certificamos la infraestructura de red de tu empresa.
                                Desde tendido de fibra óptica entre edificios hasta el armado completo de tu rack.
                            </p>
                        </div>
                    </div>

                    <div class="row g-4">
                        <?php foreach ($infra_services as $i => $service): ?>
                        <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= 50 + ($i * 50) ?>">
                            <motion-tilt max-tilt="4" speed="400" style="display:block;height:100%;">
                                <article class="cult-pillar-card h-100 text-center">
                                    <i class="cult-pillar-card__icon <?= htmlspecialchars($service['icon'], ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                                    <h3 class="cult-pillar-card__title"><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                                    <p class="cult-pillar-card__text mb-0"><?= htmlspecialchars($service['description'], ENT_QUOTES, 'UTF-8') ?></p>
                                </article>
                            </motion-tilt>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- 5. Sin vs Con Gestión IT -->
            <section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue">
                <div class="cult-hero-grid" aria-hidden="true"></div>
                <div class="container position-relative py-9 py-lg-11" style="z-index:2;">
                    <div class="cult-vs">
                        <div class="cult-vs__header text-white">
                            <span class="cult-section-eyebrow cult-section-eyebrow--light" data-aos="fade-up">Comparativa</span>
                            <h2 class="cult-display cult-display--xl mb-2 text-white" data-aos="fade-up" data-aos-delay="50">
                                Sin Gestión IT vs <span class="cult-shimmer-text--bright">Con Gestión IT</span>
                            </h2>
                            <p class="lead mx-auto mb-0" style="max-width:36rem; opacity:0.8;" data-aos="fade-up" data-aos-delay="100">
                                Compará lo que implica gestionar tu IT por tu cuenta frente a delegarla en un equipo especializado
                            </p>
                            <div class="cult-vs__chip" aria-hidden="true">VS</div>
                        </div>

                        <?php foreach ($vs_rows as $i => $row): ?>
                        <div class="cult-vs__row" data-aos="fade-up" data-aos-delay="<?= 50 + ($i * 40) ?>">
                            <div class="cult-vs__label">
                                <i class="<?= htmlspecialchars($row['icon'], ENT_QUOTES, 'UTF-8') ?> text-info" aria-hidden="true"></i>
                                <?= htmlspecialchars($row['label'], ENT_QUOTES, 'UTF-8') ?>
                            </div>
                            <div class="cult-vs__side cult-vs__side--bad">
                                <i class="bx bx-x-circle text-danger" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($row['sin'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                            <div class="cult-vs__divider" aria-hidden="true">·</div>
                            <div class="cult-vs__side cult-vs__side--good">
                                <i class="bx bx-check-circle text-success" aria-hidden="true"></i>
                                <span><?= htmlspecialchars($row['con'], ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- 6. Cómo empezamos -->
            <section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue">
                <div class="cult-hero-grid" aria-hidden="true"></div>
                <div class="container position-relative py-9 py-lg-11" style="z-index:2;">
                    <div class="row justify-content-center mb-9">
                        <div class="col-lg-8 text-center text-white">
                            <span class="cult-section-eyebrow cult-section-eyebrow--light" data-aos="fade-up">Proceso</span>
                            <h2 class="cult-display cult-display--xl mb-0 text-white" data-aos="fade-up" data-aos-delay="50">
                                ¿Cómo <span class="cult-shimmer-text--bright">empezamos</span>?
                            </h2>
                        </div>
                    </div>

                    <div class="cult-steps" data-aos="fade-up" data-aos-delay="100">
                        <div class="cult-steps__rail" aria-hidden="true"></div>

                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">1</div>
                                <h3 class="cult-step__title">Diagnóstico</h3>
                                <p class="cult-step__text">Relevamos equipos, software, redes, seguridad y procesos para identificar oportunidades de mejora y riesgos potenciales.</p>
                            </div>
                        </div>
                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">2</div>
                                <h3 class="cult-step__title">Plan de optimización</h3>
                                <p class="cult-step__text">Te entregamos un informe detallado con recomendaciones específicas y un plan de acción priorizado para mejorar tu IT.</p>
                            </div>
                        </div>
                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">3</div>
                                <h3 class="cult-step__title">Implementación</h3>
                                <p class="cult-step__text">Ejecutamos las mejoras de forma ágil y segura, minimizando interrupciones en tus operaciones diarias.</p>
                            </div>
                        </div>
                        <div class="cult-step">
                            <div class="cult-step__card">
                                <div class="cult-step__num">4</div>
                                <h3 class="cult-step__title">Gestión continua</h3>
                                <p class="cult-step__text">Monitoreamos tu infraestructura, brindamos soporte y aplicamos mejoras evolutivas mes a mes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
            // 7. FAQ
            $faq_title    = 'Preguntas frecuentes — Gestión IT';
            $faq_subtitle = 'Resolvemos las dudas más comunes sobre nuestro servicio de gestión integral de infraestructura IT';
            $faq_use_cult = true;

            $faq_items = [
                [
                    'icon'     => 'bx bx-support',
                    'question' => '¿Qué incluye el servicio de Gestión IT?',
                    'answer'   => '<p class="mb-3">Nuestro servicio cubre toda tu infraestructura tecnológica:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Soporte técnico remoto y presencial 24/7</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Administración de servidores, equipos y sistemas</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Monitoreo proactivo con alertas automáticas</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Seguridad informática y gestión de parches</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Backups automáticos y planes de recuperación</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Gestión y mantenimiento de redes corporativas</li>
                    </ul>',
                ],
                [
                    'icon'     => 'bx bx-time-five',
                    'question' => '¿Cuál es el tiempo de respuesta ante un incidente?',
                    'answer'   => '<p class="mb-3">Nuestros tiempos de respuesta dependen de la criticidad del incidente:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Crítico:</strong> respuesta inmediata, resolución en menos de 1 hora</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Alto:</strong> respuesta en menos de 15 minutos</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Medio:</strong> respuesta en menos de 2 horas</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i><strong>Bajo:</strong> respuesta en el mismo día hábil</li>
                    </ul>',
                ],
                [
                    'icon'     => 'bx bx-moon',
                    'question' => '¿Brindan soporte fuera del horario laboral?',
                    'answer'   => '<p class="mb-0">Sí. Nuestro servicio de gestión IT incluye cobertura <strong>24 horas, 7 días a la semana, 365 días al año</strong>. Los incidentes no esperan al horario de oficina, y nosotros tampoco. Contás con un equipo de guardia permanente para emergencias críticas.</p>',
                ],
                [
                    'icon'     => 'bx bx-file',
                    'question' => '¿Hay permanencia mínima o contratos anuales?',
                    'answer'   => '<p class="mb-0">Ofrecemos planes flexibles adaptados a cada empresa. Trabajamos con contratos mensuales y anuales según tus necesidades. Contactanos para conocer las opciones disponibles y elegir el plan que mejor se ajuste a tu operación.</p>',
                ],
                [
                    'icon'     => 'bx bx-laptop',
                    'question' => '¿El soporte es remoto o presencial?',
                    'answer'   => '<p class="mb-3">Combinamos ambos modelos según la situación:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Remoto:</strong> resolución inmediata de la mayoría de incidentes sin desplazamiento</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i><strong>Presencial:</strong> visitas programadas para instalaciones, relevamientos y casos que lo requieran</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i><strong>Híbrido:</strong> monitoreo remoto continuo con intervención onsite cuando es necesario</li>
                    </ul>',
                ],
                [
                    'icon'     => 'bx bx-broadcast',
                    'question' => '¿Hacen instalaciones de cableado y fibra óptica?',
                    'answer'   => '<p class="mb-3">Sí. Realizamos proyectos de infraestructura física de red de punta a punta:</p>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Tendido y fusión de fibra óptica (OM3, OM4, monomodo)</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Cableado estructurado UTP categoría 6 y 6A</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Armado de racks, patch panels y organización de cableado</li>
                        <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Certificación con instrumental Fluke y entrega de planos as-built</li>
                        <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Garantía sobre el trabajo realizado y revisiones periódicas</li>
                    </ul>',
                ],
                [
                    'icon'     => 'bx bx-group',
                    'question' => '¿Qué pasa si ya tenemos personal de IT interno?',
                    'answer'   => '<p class="mb-0">Nuestro servicio se complementa con tu equipo interno. Podemos actuar como <strong>refuerzo especializado</strong> para tareas complejas (seguridad, servidores, backups), liberar a tu personal de tareas operativas, o cubrir guardias fuera de horario. Diseñamos el esquema que mejor se adapte a tu organización.</p>',
                ],
            ];

            include('includes/faq-template.php');

            // 8. CTA + Formulario
            renderCultCtaForm([
                'section_id'     => 'contacto',
                'eyebrow'        => 'Hablemos',
                'title'          => '¿Listo para olvidarte de los',
                'shimmer'        => 'problemas IT',
                'title_after'    => '?',
                'subtitle'       => 'Completá el formulario y nos pondremos en contacto para diseñar la solución perfecta para tu empresa.',
                'asunto_default' => 'GESTIÓN IT',
                'asunto_options' => [
                    'GESTIÓN IT'      => 'Gestión IT',
                    'INFRAESTRUCTURA' => 'Infraestructura',
                    'CABLEADO'        => 'Cableado y fibra óptica',
                    'SOPORTE TÉCNICO' => 'Soporte técnico',
                    'MONITOREO'       => 'Monitoreo',
                    'SEGURIDAD'       => 'Seguridad',
                    'BACKUP'          => 'Backup',
                ],
                'mensaje_ph'     => 'Contanos sobre tu infraestructura actual y qué problemas estás teniendo…',
                'bg_variant'     => 'mesh-blue',
            ]);
            ?>

        </main>

        <?php include('includes/footer.php');?>
        <?php include('includes/script.php');?>
    </body>
</html>

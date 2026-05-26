<?php
/**
 * Página de Tango Capital Humano — Versión modernizada (cult-* design system)
 * Servicios y Sistemas SRL
 *
 * Estructura:
 *   1. Hero cult con propuesta de valor + CTAs (WhatsApp + scroll a módulos) + stats
 *   2. Promesa / introducción
 *   3. Módulos (8 módulos agrupados en 4 áreas funcionales)
 *   4. Tango Empleados (autogestión móvil) — bloque diferenciador
 *   5. Firma digital + Gestión documental
 *   6. Tango Reportes (informes de Sueldos y Control de Personal)
 *   7. Conectividad (TangoNet + Tango Connect)
 *   8. Integración con Tango Gestión (ecosistema)
 *   9. CTA principal con formulario de contacto
 *  10. FAQ específico
 *  11. Navegación a otros productos
 *
 * Color de marca: #00A8E1 (config.php)
 */

header('Content-Type: text/html; charset=utf-8');

require_once('config/config.php');
require_once('includes/functions.php');
require_once('includes/security-init.php');
initSecurity();

require_once('includes/components/cult-hero-product.php');
require_once('includes/components/cult-modules-grouped.php');
require_once('includes/components/cult-cta-form.php');
require_once('includes/components/card-hover-2.php');
require_once('includes/components/reportes-slider.php');

// ─── Identidad del producto ─────────────────────────────────────────────
$product_key = 'capital-humano';
$product     = $tango_products[$product_key];
$img_base    = 'assets/img/productos/' . $product['slug'] . '/';

$product_color_style = function_exists('cultProductMeshStyle') ? cultProductMeshStyle($product['color']) : '';
$mesh_class          = function_exists('cultProductMeshClass')
    ? cultProductMeshClass()
    : 'cult-mesh-bg cult-mesh-bg--product text-white';

// ─── Hero ───────────────────────────────────────────────────────────────
$whatsapp_demo = generateWhatsAppLink(
    'Hola, me interesa Tango Capital Humano. ¿Podrían enviarme más información y coordinar una demo?'
);

ob_start();
renderCultProductHero([
    'eyebrow_text'  => 'Gestión integral de RRHH · 30+ años',
    'eyebrow_icon'  => 'bx bx-group',
    'title'         => 'Potenciá tu',
    'shimmer'       => 'capital humano',
    'subtitle'      => 'Tango Capital Humano integra liquidación de sueldos, control de personal, autogestión del empleado, firma digital y gestión documental en una sola plataforma. Cumplí con la normativa argentina, automatizá procesos y enfocá al equipo de RRHH en lo que realmente importa: las personas.',
    'ctas'          => [
        ['label' => 'Solicitar demo', 'href' => $whatsapp_demo, 'icon' => 'bxl-whatsapp', 'class' => 'cult-btn-glass cult-btn-shimmer', 'target' => '_blank'],
        ['label' => 'Ver módulos',    'href' => '#modulos',     'icon' => 'bx bx-down-arrow-alt', 'class' => 'btn-outline-light'],
    ],
    'logo_src'      => $img_base . $product['logo_dark'],
    'logo_alt'      => $product['name'] . ' — Logo',
    'logo_width'    => 280,
    'logo_height'   => 227,
    'product_color' => $product['color'],
    'stats'         => [
        ['value' => '30',     'label' => 'Años en el mercado',     'prefix' => '+'],
        ['value' => '8',      'label' => 'Módulos integrados'],
        ['value' => '100',    'label' => 'Cumplimiento normativo', 'suffix' => '%'],
        ['value' => 'Cloud',  'label' => 'Disponible en la nube',  'animate' => false],
    ],
]);
$hero_html = ob_get_clean();

// ─── Intro ──────────────────────────────────────────────────────────────
ob_start(); ?>
<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9 text-center">
                <span class="cult-section-eyebrow" data-aos="fade-up">La solución integral de RRHH</span>
                <h2 class="cult-display cult-display--xl mb-4" data-aos="fade-up" data-aos-delay="50">
                    Una plataforma. <span class="cult-shimmer-text">Todo tu equipo.</span>
                </h2>
                <p class="lead text-muted mx-auto" data-aos="fade-up" data-aos-delay="100" style="max-width: 50rem;">
                    Reducí tiempos administrativos, evitá errores de liquidación y mejorá la experiencia del empleado.
                    Tango Capital Humano automatiza la liquidación de sueldos, controla la asistencia y el desempeño,
                    centraliza la documentación de tu personal y conecta con organismos oficiales como ARCA y el
                    Libro de Sueldos Digital. Todo en línea, con seguridad y cumplimiento de la normativa argentina.
                </p>
            </div>
        </div>
    </div>
</section>
<?php
$intro_html = ob_get_clean();

// ─── Módulos: 8 módulos agrupados en 4 áreas funcionales ────────────────
$module_groups = [
    'Liquidación y nómina' => [
        [
            'title'       => 'Sueldos',
            'icon'        => 'bx bx-money',
            'description' => 'La manera más rápida y segura de liquidar sueldos. Cubrí todos los convenios de trabajo desde el ingreso del empleado hasta la conexión con organismos oficiales. Liquidaciones en paralelo, reliquidaciones y carga de novedades por fecha, legajo o concepto.',
        ],
        [
            'title'       => 'Libro de Sueldos Digital',
            'icon'        => 'bx bx-book-content',
            'description' => 'Generación e integración directa con ARCA / AFIP para el Libro de Sueldos Digital. Cumplimiento normativo automático y envío de información legal a organismos sin pasos manuales.',
        ],
    ],
    'Asistencia y desempeño' => [
        [
            'title'       => 'Control de Personal',
            'icon'        => 'bx bx-time-five',
            'description' => 'Información detallada sobre el desempeño de tus empleados: ausentismo, llegadas tarde, salidas temprano, presentismo y comparativos de horas reales vs. esperadas. Las novedades pasan automáticamente al módulo de Sueldos.',
        ],
        [
            'title'       => 'Fichadas y horarios',
            'icon'        => 'bx bx-fingerprint',
            'description' => 'Registro automático de fichadas, integración con dispositivos biométricos y de proximidad. Control de horas toleradas, autorizaciones de horas extras y permisos de salida en tiempo real.',
        ],
    ],
    'Experiencia del empleado' => [
        [
            'title'       => 'Tango Empleados',
            'icon'        => 'bx bx-mobile-alt',
            'description' => 'Plataforma web y móvil para que tus colaboradores consulten recibos, soliciten vacaciones y licencias, actualicen sus datos y firmen documentos digitalmente. Vos aprobás todo con un solo clic.',
        ],
        [
            'title'       => 'Capacitación y desarrollo',
            'icon'        => 'bx bx-book-reader',
            'description' => 'Registrá y hacé seguimiento de las capacitaciones de tu equipo. Asegurate de que todo el personal cumpla con los requisitos obligatorios y planificá el desarrollo profesional.',
        ],
    ],
    'Documentación y compliance' => [
        [
            'title'       => 'Firma digital electrónica',
            'icon'        => 'bx bx-edit',
            'description' => 'Validá recibos, contratos y comunicaciones internas sin papel ni traslados. Autenticidad y validez legal asegurada, con notificación al empleado y registro auditable de cada firma.',
        ],
        [
            'title'       => 'Gestión documental',
            'icon'        => 'bx bx-folder-open',
            'description' => 'Centralizá legajos, certificados, exámenes médicos, contratos y comunicaciones en un solo repositorio digital. Búsqueda inmediata, control de vencimientos y permisos por rol.',
        ],
    ],
];

ob_start();
renderCultModulesGrouped($module_groups, [
    'eyebrow'       => '8 módulos integrados',
    'title'         => 'Todo lo que necesitás para gestionar',
    'shimmer'       => 'a tu gente',
    'subtitle'      => 'Cada módulo trabaja en conjunto para automatizar la liquidación, controlar la asistencia, empoderar al empleado y mantener el cumplimiento normativo en una sola plataforma.',
    'section_id'    => 'modulos',
    'product_color' => $product['color'],
]);
$modules_html = ob_get_clean();

// ─── Post-módulos: Tango Empleados (autogestión móvil) + Firma digital
//                  + Reportes + Conectividad + Integración con Tango Gestión
ob_start();
?>
<section class="position-relative overflow-hidden cult-page-header <?= htmlspecialchars($mesh_class, ENT_QUOTES, 'UTF-8') ?>"
         <?= $product_color_style ? 'style="' . $product_color_style . '"' : '' ?>>
    <div class="cult-hero-grid" aria-hidden="true"></div>
    <span class="cult-blob cult-blob--cyan" style="bottom:-20%; right:-10%; opacity:0.35;" aria-hidden="true"></span>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center g-5">
            <div class="col-lg-7 text-white" data-aos="fade-up">
                <span class="cult-eyebrow cult-eyebrow--light mb-4 d-inline-flex">Autogestión del empleado</span>
                <h2 class="cult-display cult-display--xl mb-4" style="line-height: 1.15;">
                    Empoderá a tu equipo con <span class="cult-shimmer-text cult-shimmer-text--bright">Tango Empleados</span>
                </h2>
                <p class="lead mb-4 opacity-90">
                    Una plataforma web y móvil para que tus colaboradores autogestionen su día a día. Menos consultas
                    al área de RRHH, más tiempo para lo que realmente suma.
                </p>
                <ul class="list-unstyled cult-check-list cult-check-list--light mb-0">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Recibos de sueldo digitales con firma electrónica</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Solicitud de vacaciones y licencias en minutos</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Aprobaciones del manager con un solo clic</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Consulta de saldos de vacaciones y licencias</span>
                    </li>
                    <li class="d-flex align-items-start mb-0">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Acceso desde cualquier dispositivo, sin instalación</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="cult-feature-glass text-center p-5 p-lg-6">
                    <i class="bx bx-mobile-alt display-1 mb-3" aria-hidden="true"></i>
                    <h3 class="h4 text-white mb-2">App de empleados</h3>
                    <p class="text-white-50 mb-0">Recibos, vacaciones y firma digital en el celular</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="position-relative overflow-hidden bg-body cult-product-scoped"<?= $product_color_style ? ' style="' . $product_color_style . '"' : '' ?>>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2" data-aos="fade-up" data-aos-delay="50">
                <div class="cult-feature-glass cult-feature-glass--light p-5 p-lg-6 text-center">
                    <i class="bx bx-shield-quarter display-1 text-primary mb-3" aria-hidden="true"></i>
                    <h3 class="h4 mb-2">Firma digital + Gestión documental</h3>
                    <p class="text-muted mb-0">Eliminá el papel del circuito de RRHH</p>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1" data-aos="fade-up">
                <span class="cult-section-eyebrow">Cero papel</span>
                <h2 class="cult-display cult-display--xl mb-3">
                    Documentación firmada, <span class="cult-shimmer-text">centralizada y segura</span>
                </h2>
                <p class="lead text-muted mb-4">
                    Validá contratos, recibos y comunicaciones internas sin imprimir ni mover papeles. Toda la
                    documentación del personal en un solo lugar, con permisos granulares y trazabilidad completa.
                </p>
                <ul class="list-unstyled cult-check-list mb-5">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Firma electrónica con validez legal</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Repositorio único de legajos y certificados</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Alertas de vencimientos (exámenes médicos, contratos)</span>
                    </li>
                    <li class="d-flex align-items-start mb-0">
                        <i class="bx bx-check-circle me-2 fs-5 text-primary flex-shrink-0" aria-hidden="true"></i>
                        <span>Auditoría completa de quién firmó y cuándo</span>
                    </li>
                </ul>
                <a href="#contacto" class="btn btn-outline-primary btn-lg rounded-pill hover-lift">
                    <i class="bx bx-edit me-1" aria-hidden="true"></i>
                    Ver cómo funciona la firma digital
                </a>
            </div>
        </div>
    </div>
</section>
<?php

renderCultTangoReportes([
    'eyebrow'       => 'Tango Reportes',
    'title'         => 'Indicadores de tu equipo',
    'shimmer'       => 'desde donde estés',
    'subtitle'      => 'Consultá liquidaciones, dotación, presentismo, horas extras y costos laborales desde cualquier dispositivo. Compartí informes con socios, auditores o el área financiera con permisos granulares.',
    'size'          => 'compact',
    'product_color' => $product['color'],
    'features'      => [
        'Informes de los módulos Sueldos y Control de Personal de Tango Capital Humano.',
        'Dotación, ausentismo, presentismo y horas extras analizadas en tiempo real.',
        'Indicadores, informes pivot multidimensional e indicadores en tableros.',
        'Análisis por convenio, área, sucursal o legajo individual.',
        'Exportación directa a Excel para análisis externos.',
        'Acceso desde cualquier navegador y dispositivo, sin instalación.',
    ],
    'systems'       => [
        ['name' => 'TANGO CAPITAL HUMANO',     'class' => 'bg-primary'],
        ['name' => 'TANGO GESTIÓN',            'class' => 'bg-primary'],
        ['name' => 'TANGO ESTUDIOS CONTABLES', 'class' => 'bg-warning text-dark'],
        ['name' => 'TANGO RESTÔ',              'class' => 'bg-danger'],
    ],
]);

renderCultConnectivitySection(
    'Tu RRHH, conectado',
    'Conectividad total',
    'Operá desde cualquier lugar y mantené sincronizadas las novedades de personal, liquidaciones y aprobaciones. Acceso seguro desde web y móvil para todo tu equipo.',
    $product['color']
);
?>
<section class="position-relative overflow-hidden cult-mesh-bg cult-mesh-bg--blue text-white">
    <div class="cult-hero-grid" aria-hidden="true"></div>
    <span class="cult-blob cult-blob--cyan" style="bottom:-20%; right:-10%; opacity:0.35;" aria-hidden="true"></span>
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-up">
                <span class="cult-eyebrow cult-eyebrow--light">Integración nativa</span>
                <h2 class="cult-display cult-display--xl mb-4">
                    Conectado al ecosistema <span class="cult-shimmer-text cult-shimmer-text--bright">Tango Gestión</span>
                </h2>
                <p class="lead mb-4 opacity-90">
                    Tango Capital Humano se integra de forma nativa con Tango Gestión y Tango Estudios Contables.
                    Las liquidaciones generan automáticamente los asientos contables, los pagos pasan a Tesorería
                    y la información llega al estudio sin re-cargar datos.
                </p>
                <ul class="list-unstyled cult-check-list cult-check-list--light mb-5">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Asientos contables automáticos a Tango Gestión</span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Pagos de sueldos integrados a Tesorería</span>
                    </li>
                    <li class="d-flex align-items-start mb-0">
                        <i class="bx bx-check-circle me-2 fs-5 flex-shrink-0" aria-hidden="true"></i>
                        <span>Sin re-carga manual entre RRHH y administración</span>
                    </li>
                </ul>
                <a href="tango-gestion.php" class="btn btn-light btn-lg rounded-pill hover-lift">
                    <i class="bx bx-link-external me-1" aria-hidden="true"></i>
                    Conocer Tango Gestión
                </a>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="cult-feature-glass p-4 p-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-4 flex-wrap">
                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill">Capital Humano</span>
                        <i class="bx bx-transfer-alt fs-3 opacity-75" aria-hidden="true"></i>
                        <span class="badge bg-primary px-3 py-2 rounded-pill">Tango Gestión</span>
                        <i class="bx bx-transfer-alt fs-3 opacity-75" aria-hidden="true"></i>
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Estudios Contables</span>
                    </div>
                    <p class="mb-0 opacity-90">
                        Liquidás sueldos en Capital Humano, los asientos contables aparecen en Tango Gestión y la
                        información queda disponible para tu contador o estudio. Un solo dato, todo el ciclo cubierto.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$post_modules_html = ob_get_clean();

// ─── CTA + formulario ───────────────────────────────────────────────────
ob_start();
renderCultCtaForm([
    'section_id'     => 'contacto',
    'eyebrow'        => 'Hablemos',
    'title'          => '¿Listo para',
    'shimmer'        => 'transformar',
    'title_after'    => ' tu RRHH?',
    'subtitle'       => 'Coordinemos una demo personalizada y descubrí cómo Tango Capital Humano puede automatizar la liquidación, controlar la asistencia y mejorar la experiencia de tus empleados. Te respondemos en menos de 24 horas hábiles.',
    'asunto_default' => 'TANGO CAPITAL HUMANO',
    'asunto_options' => [
        'TANGO CAPITAL HUMANO'      => 'Tango Capital Humano — Consulta general',
        'DEMO TANGO CAPITAL HUMANO' => 'Solicitar demo',
        'PRESUPUESTO'               => 'Pedir presupuesto',
        'MIGRACION SUELDOS'         => 'Migración desde otro sistema de sueldos',
        'IMPLEMENTACION'            => 'Implementación y capacitación',
        'TANGO EMPLEADOS'           => 'Tango Empleados (autogestión)',
        'FIRMA DIGITAL'             => 'Firma digital y gestión documental',
        'SOPORTE'                   => 'Soporte técnico',
    ],
    'mensaje_ph'    => 'Contanos cuántos empleados tenés, qué convenios manejás y si necesitás autogestión móvil, firma digital o integración con Tango Gestión…',
    'bg_variant'    => 'mesh-product',
    'product_color' => $product['color'],
]);
$cta_html = ob_get_clean();

// ─── FAQ específico de Tango Capital Humano ─────────────────────────────
$faq_items = [
    [
        'question' => '¿Tango Capital Humano cumple con la normativa argentina?',
        'answer'   => 'Sí. Cubre todos los convenios colectivos vigentes y se conecta con organismos oficiales (ARCA / AFIP) para el Libro de Sueldos Digital. Las actualizaciones normativas están incluidas en el soporte oficial, por lo que el sistema se mantiene siempre alineado con cambios de impuestos, escalas salariales y aportes.',
        'icon'     => 'bx bx-check-shield',
    ],
    [
        'question' => '¿Maneja varios convenios y categorías a la vez?',
        'answer'   => 'Sí, está pensado para empresas con personal bajo distintos convenios y categorías. Podés configurar conceptos, escalas y novedades por convenio, mantener escalas salariales históricas y liquidar en paralelo grupos diferentes en una misma corrida.',
        'icon'     => 'bx bx-collection',
    ],
    [
        'question' => '¿Cómo funciona Tango Empleados (autogestión)?',
        'answer'   => 'Es una plataforma web y móvil donde tus colaboradores acceden a recibos, solicitan vacaciones y licencias, actualizan sus datos y firman documentos digitalmente. El equipo de RRHH y los managers reciben las solicitudes y aprueban con un solo clic, sin papeles ni emails.',
        'icon'     => 'bx bx-mobile-alt',
    ],
    [
        'question' => '¿Puedo controlar asistencia con relojes biométricos?',
        'answer'   => 'Sí. El módulo de Control de Personal se integra con dispositivos biométricos y de proximidad para registrar fichadas automáticamente. Genera reportes de presentismo, ausentismo, horas extras y comparativos de horas reales vs. esperadas, y envía las novedades al módulo de Sueldos sin pasos manuales.',
        'icon'     => 'bx bx-fingerprint',
    ],
    [
        'question' => '¿La firma digital tiene validez legal?',
        'answer'   => 'Sí. La firma digital electrónica cumple con la normativa argentina y permite validar recibos, contratos, comunicaciones internas y políticas. Cada firma queda registrada con fecha, hora y autenticación del firmante, y podés auditar quién firmó cada documento.',
        'icon'     => 'bx bx-shield',
    ],
    [
        'question' => '¿Se integra con Tango Gestión y Tango Estudios Contables?',
        'answer'   => 'Sí. La liquidación de sueldos genera automáticamente los asientos contables en Tango Gestión y los pagos quedan reflejados en Tesorería. Si tu empresa trabaja con un estudio contable, la información también puede ser consumida desde Tango Estudios Contables sin re-carga manual.',
        'icon'     => 'bx bx-link',
    ],
    [
        'question' => '¿Funciona en la nube o necesito un servidor?',
        'answer'   => 'Las dos opciones están disponibles. Podés instalarlo en tu servidor con SQL Server, o bien hostearlo en nuestro Datacenter en modalidad cloud para acceder desde cualquier lugar sin administrar infraestructura. Tango Empleados y los reportes funcionan siempre desde la web.',
        'icon'     => 'bx bx-cloud',
    ],
    [
        'question' => '¿Cuánto cuesta? ¿Incluye implementación y capacitación?',
        'answer'   => 'El precio depende de la cantidad de empleados, convenios, módulos contratados (Sueldos, Control de Personal, Tango Empleados, etc.) y modalidad (perpetuo o suscripción). Como distribuidores oficiales, acompañamos toda la implementación: relevamiento, parametrización, migración desde tu sistema actual y capacitación al equipo de RRHH.',
        'icon'     => 'bx bx-dollar-circle',
    ],
];
$faq_title    = 'Preguntas frecuentes sobre Tango Capital Humano';
$faq_subtitle = 'Las dudas más comunes que nos hacen las empresas antes de modernizar la gestión de RRHH.';
$faq_use_cult = true;
$render_faq   = true;

// ─── Schemas: producto + breadcrumb + FAQ ──────────────────────────────
$schema_markup = [
    generateProductSchema($product),
    generateBreadcrumbSchema([
        ['label' => 'Productos', 'url' => SITE_URL . '/index.php#product'],
        ['label' => $product['name']],
    ]),
    generateFAQSchema($faq_items),
];

// ─── Cargar template unificado ──────────────────────────────────────────
include('templates/tango-product-template.php');

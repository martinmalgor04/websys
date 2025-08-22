<?php
/**
 * Página de Tango Estudios Contables - Refactorizada para usar template unificado
 * Incluye documentación en español y uso de constantes centralizadas
 */

// Configuración del producto
$product_key = 'estudios-contables';

// Título personalizado para la sección intro
$intro_title = 'La solución para tu estudio contable';

// Texto personalizado de introducción
$intro_text = 'Tango Estudios Contables te facilita y potencia el trabajo. Funciona de manera eficiente, sin importar el tamaño de la empresa de tu cliente. Podés trabajar en línea y tener la tranquilidad de que siempre está actualizado con toda la reglamentación vigente. Además, se integra a la perfección con Tango Gestión, el software que elige la mayoría de tus clientes.';

// Módulos/Características de Tango Estudios Contables
$modules = [
    [
        'title' => 'EFICIENTE',
        'icon' => 'bx bx-tachometer',
        'description' => 'Obtené el mejor resultado, de forma integrada en el menor tiempo posible.'
    ],
    [
        'title' => 'FLEXIBLE',
        'icon' => 'bx bx-shuffle',
        'description' => 'Se adapta a cualquiera sea el tamaño de tu empresa cliente ya sea una microempresa o un gran holding.'
    ],
    [
        'title' => 'CONECTADO',
        'icon' => 'bx bx-globe',
        'description' => 'Trabajá en línea desde cualquier lugar y mantené siempre actualizada la información.'
    ],
    [
        'title' => 'Contabilidad',
        'icon' => 'bx bx-calculator',
        'description' => 'Sistema contable completo con plan de cuentas personalizable, asientos automáticos y reportes gerenciales.'
    ],
    [
        'title' => 'IVA',
        'icon' => 'bx bx-receipt',
        'description' => 'Liquidación automática de IVA con generación de libros, declaraciones juradas y cumplimiento normativo.'
    ],
    [
        'title' => 'Sueldos',
        'icon' => 'bx bx-money',
        'description' => 'Liquidación de sueldos con cálculo automático de aportes, contribuciones y presentaciones ante organismos.'
    ]
];

// Incluir componente Card Hover 2 (Conectividad)
ob_start();
require_once('includes/components/card-hover-2.php');
renderConnectivitySection();
$connectivity_content = ob_get_clean();

// Incluir componente Reportes
$reportes_content = '<section class="overflow-hidden bg-body position-relative">
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
                <div class="pe-lg-5">
                    <h2 class="display-6 mb-4">TANGO REPORTES</h2>
                    <h4 class="mb-4 text-primary">La información de tus empresas desde donde estes</h4>
                    <div class="mb-4">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Ver informes de los módulos Ventas, Sueldos y Stock</li>
                            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Analizar información por empresa o grupo</li>
                            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Definir grupos de empresas</li>
                            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Visualización mediante indicadores y pivots</li>
                            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Exportar informes a Excel</li>
                        </ul>
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
</section>';

// Contenido personalizado adicional
$custom_content = $reportes_content . $connectivity_content;

// Preguntas frecuentes
$faq_items = [
    [
        'icon' => 'bx bx-help-circle',
        'question' => '¿Qué incluye Tango Estudios Contables?',
        'answer' => '<p class="mb-3">Incluye todos los módulos necesarios para la gestión contable:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Sistema de contabilidad completo</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Liquidación de IVA automática</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Módulo de sueldos y jornales</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Reportes gerenciales</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Integración con Tango Gestión</li>
        </ul>'
    ],
    [
        'icon' => 'bx bx-cloud',
        'question' => '¿Funciona en la nube?',
        'answer' => '<p class="mb-3">Sí, está preparado para trabajar en línea:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Acceso desde cualquier ubicación</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Datos siempre actualizados</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Backup automático</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Múltiples usuarios simultáneos</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Configuración personalizada según tu estudio</li>
        </ul>'
    ]
];

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
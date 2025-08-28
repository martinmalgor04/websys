<?php
/**
 * Página de Tango Gestión - Refactorizada para usar template unificado
 * Incluye documentación en español y uso de constantes centralizadas
 */

// Configuración del producto
$product_key = 'gestion';

// Título personalizado para la sección intro
$intro_title = 'La solución para la gestión integral de su empresa';

// Texto personalizado de introducción
$intro_text = 'Es una solución que ofrece una visión completa de su empresa y agiliza sus procesos en el menor tiempo posible. Gracias a su diseño escalable, se adapta a cualquier situación y acompaña el crecimiento de su negocio. Con más de 30 años de experiencia, incorpora las últimas tendencias del mercado y cumple con todas las normativas vigentes. Además, permite conectar sucursales, depósitos y puntos de venta de forma transparente y segura a través de TangoNet.';

// Módulos de Tango Gestión con iconos y descripciones
$modules = [
    [
        'title' => 'Ventas',
        'icon' => 'bx bx-store-alt',
        'description' => 'Te permite facturar, administrar pedidos, administrar tus clientes, generar automáticamente el libro IVA y los asientos contables correspondientes. Además de los permisos generales de cada empleado, podés tener asignado un perfil diferente para distintas tareas dentro de la facturación, evitando errores y facilitando el control.'
    ],
    [
        'title' => 'Stock',
        'icon' => 'bx bx-package',
        'description' => 'Te permite ingresar artículos, administrar precios, manejar múltiples depósitos, controlar saldos, valorizar tu stock y realizar armado de productos. Vas a tener total control sobre tu stock: podés conocer no sólo el stock actual sino el que tiene comprometido en tus pedidos.'
    ],
    [
        'title' => 'Compras',
        'icon' => 'bx bx-cart',
        'description' => 'Te permite generar y autorizar solicitudes y órdenes de compra, emitir comprobantes de recepción y cargar facturas de proveedores. Llevá un manejo de cuentas corrientes acreedoras y confección del libro I.V.A. Compras.'
    ],
    [
        'title' => 'Importaciones',
        'icon' => 'bx bx-world',
        'description' => 'Te permite generar carpetas de importación, registro de embarques, facturas FOB, despachos y costos. Podés administrar el circuito completo de tus importaciones desde la Orden de la Importación hasta el Ingreso del despacho.'
    ],
    [
        'title' => 'Proveedores',
        'icon' => 'bx bx-group',
        'description' => 'Te permite realizar la carga de facturas de compra (sin manejo de stock), manejar cuentas corrientes acreedoras, generar el libro I.V.A. y los asientos contables correspondientes en forma automática.'
    ],
    [
        'title' => 'Tesorería',
        'icon' => 'bx bx-wallet',
        'description' => 'Te permite administrar caja, bancos y tarjetas de crédito. Generar la conciliación bancaria en forma automática. Administrar e imprimir cheques. Generar todos los asientos correspondientes automáticamente.'
    ],
    [
        'title' => 'Contabilidad',
        'icon' => 'bx bx-calculator',
        'description' => 'Te permite cubrir todos los requerimientos en materia de registración contable, incluyendo procesos tales como conversión a otra moneda, ajuste por inflación, resultado por tenencia.'
    ],
    [
        'title' => 'I.V.A.',
        'icon' => 'bx bx-receipt',
        'description' => 'Te permite generar los libros de I.V.A. Compras / Ventas y la liquidación mediante la carga de comprobantes en forma individual o en lote. Generación de asientos para el pasaje a contabilidad.'
    ],
    [
        'title' => 'Sueldos',
        'icon' => 'bx bx-money',
        'description' => 'La manera más rápida y segura de liquidar sueldos. Te permite liquidar todos los convenios de trabajo cubriendo todo el circuito desde el ingreso del empleado, la liquidación de sueldos, y la conexión con sistemas de organismos oficiales.'
    ],
    [
        'title' => 'Control de Personal',
        'icon' => 'bx bx-user-check',
        'description' => 'Obtené toda la información sobre su personal. Le brinda información sumamente detallada acerca del desempeño de tus empleados, estadística de ausentismo, llegadas tarde y salidas temprana.'
    ],
    [
        'title' => 'Activo Fijo',
        'icon' => 'bx bx-building',
        'description' => 'Podés ingresar el alta de bienes en forma automática desde Compras, generar automáticamente los asientos correspondientes a altas, amortizaciones, ajustes por inflación, revalúos y baja de bienes.'
    ],
    [
        'title' => 'Central',
        'icon' => 'bx bx-network-chart',
        'description' => 'Tenés a tu alcance toda la información de tus sucursales. Te permite consolidar la información entre la administración central y tus sucursales ya que la información es transferida por el servicio de Tango Net.'
    ]
];

// Incluir componente Partners Slider
ob_start();
require_once("includes/components/partners-slider.php");
renderTangoGestionPartnersSlider();
$partners_slider_content = ob_get_clean();

// Incluir componente Card Hover 2 (Conectividad)
ob_start();
require_once('includes/components/card-hover-2.php');
renderConnectivitySection();
$connectivity_content = ob_get_clean();

// Incluir componente Video Embed
ob_start();
require_once('includes/components/video-embed.php');
renderTangoGestionVideo();
$video_content = ob_get_clean();

// Incluir componente Reportes Slider
ob_start();
require_once('includes/components/reportes-slider.php');
renderTangoReportesSlider("TANGO REPORTES", "La información de tus empresas desde donde estés", "bg-light");
$reportes_content = ob_get_clean();

// Contenido HTML personalizado adicional (videos, reportes, conectividad)
// Nuevo orden: video -> reportes -> conectividad (partners se moverá después de módulos)
$custom_content = $video_content . 
                 $reportes_content . 
                 $connectivity_content;

// Partners slider para insertar después de los módulos
$partners_after_modules = $partners_slider_content;

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
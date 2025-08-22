<?php
/**
 * Página de Tango Punto de Venta - Refactorizada para usar template unificado
 * Color oficial: #3FAE2A (Pantone 361 C)
 * Incluye documentación en español y uso de constantes centralizadas
 */

// Configuración del producto
$product_key = 'punto-venta';

// Título personalizado para la sección intro
$intro_title = 'La solución para tu comercio o cadena de comercios';

// Texto personalizado de introducción
$intro_text = 'Tango Punto de Venta administra todas las necesidades de tu negocio. Te ayuda a decidir. Te ayuda a vender. Podés tener información centralizada y por sucursal. Desde la administración central podés dar alta instantánea de precios, promociones, artículos y más. Es sumamente fácil de usar y cuenta con permisos y controles que te dan una total seguridad.';

// Módulos/Soluciones de Tango Punto de Venta
$modules = [
    [
        'title' => 'Ventas Punto de Venta',
        'icon' => 'bx bx-store-alt',
        'description' => 'Facturador rápido y fácil de usar, que tiene una conexión automática con impresoras y controladores fiscales. Cuenta con el manejo de cuentas corrientes, emisión de libro de I.V.A. Ventas, y generación de información contable disponible para enviarla a tu contador.'
    ],
    [
        'title' => 'Stock Punto de Venta',
        'icon' => 'bx bx-package',
        'description' => 'Control de stock de los productos, generación e impresión de etiquetas, manejo de múltiples depósitos y actualización automática del saldo de stock cuando se factura o remite. Preparado para trabajar con productos o servicios, artículos con escalas o niveles (color, talle, etc.), entre todos.'
    ],
    [
        'title' => 'Compras',
        'icon' => 'bx bx-cart',
        'description' => 'Ingreso de facturas de compras con detalle de productos para actualización automática del stock y de las cuentas corrientes acreedoras. Permite la generación y autorización de solicitudes y órdenes de compra, emisión de comprobantes de recepción, confección del Libro de I.V.A. Compras y generación de asientos contables de forma automática.'
    ],
    [
        'title' => 'Proveedores',
        'icon' => 'bx bx-group',
        'description' => 'Carga de facturas de compra sin detalle de productos para manejar las cuentas corrientes acreedoras sin llevar el control del stock. Permite crear conceptos de gastos y compras (gastos bancarios, alquiler, etc.), generar el Libro de IVA Compras y los asientos contables en forma automática.'
    ],
    [
        'title' => 'Tesorería',
        'icon' => 'bx bx-wallet',
        'description' => 'Administra caja, bancos y tarjetas de crédito. Actualiza automáticamente el saldo de las cuentas cuando se generan movimientos de los módulos de ventas y compras. Genera la conciliación bancaria en forma automática importando el extracto electrónico. Administra e imprime cheques. Genera todos los asientos contables automáticamente.'
    ],
    [
        'title' => 'Central',
        'icon' => 'bx bx-network-chart',
        'description' => 'Permite obtener información consolidada y conectar sus negocios. Puede obtener rankings de Ventas y Compras, realizar actualizaciones automáticas de artículos, clientes, proveedores, parámetros, etc. La información es transferida por el servicio de Tango Net o bien de forma manual mediante la generación de archivos que se exportan e importan en cada negocio.'
    ],
    [
        'title' => 'Tango Net',
        'icon' => 'bx bx-wifi',
        'description' => 'Tango Net es un servicio de conexión entre sus distintas soluciones Tango. Puede intercambiar información dentro de los distintos escenarios de su negocio. Un actor (sucursales, casa central, depósitos, etc.) puede ser emisor o receptor de información dependiendo del circuito en que se encuentre. Usted tiene seguridad total en el resguardo de sus datos ya que le permite generar un espejo con toda la información de sus sucursales en otro lugar físico que usted designe.'
    ]
];

// Capturar contenido de componentes usando output buffering
// Sección Vende Online
ob_start();
?>
<section class="position-relative bg-light">
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 text-center">
                <h2 class="display-5 mb-4" data-aos="fade-up">VENDE ONLINE</h2>
                <p class="lead mb-5" data-aos="fade-up" data-aos-delay="100">
                    La flexibilidad de Tango Gestión permite integrar fácilmente otros sistemas, potenciando sus funcionalidades y garantizando la solidez de tus procesos.
                </p>
                <div data-aos="fade-up" data-aos-delay="200">
                    <a href="#" class="btn btn-primary btn-lg rounded-pill px-5">
                        <i class="bx bx-store me-2"></i>VER TANGO TIENDAS
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$vende_online_content = ob_get_clean();

// Sección Mercado Pago
ob_start();
?>
<section class="position-relative" style="background: linear-gradient(135deg, #3FAE2A 0%, #2E8B20 100%);">
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center">
            <div class="col-lg-7 text-white mb-5 mb-lg-0" data-aos="fade-right">
                <h2 class="display-5 fw-bold mb-4">COBRÁ TUS VENTAS FÁCILMENTE</h2>
                <h4 class="mb-5">Utilizá el código QR de Mercado Pago</h4>
                
                <div class="row mb-5">
                    <div class="col-12">
                        <ul class="list-unstyled fs-6">
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bx bx-check-circle fs-4 me-3 text-white"></i>
                                <span>Los cobros de Mercado Pago ingresan automáticamente al Facturador de Tango</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bx bx-check-circle fs-4 me-3 text-white"></i>
                                <span>Ofrecés cobro electrónico seguro sin contacto físico de tarjetas ni efectivo</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bx bx-check-circle fs-4 me-3 text-white"></i>
                                <span>Tu cliente paga directamente desde su celular</span>
                            </li>
                            <li class="mb-3 d-flex align-items-start">
                                <i class="bx bx-check-circle fs-4 me-3 text-white"></i>
                                <span>Recibís tus pagos al instante</span>
                            </li>
                            <li class="mb-0 d-flex align-items-start">
                                <i class="bx bx-check-circle fs-4 me-3 text-white"></i>
                                <span>Contás con informes de ventas detallados por medios de pago</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
                <div class="position-relative text-center">
                    <div class="bg-white rounded-3 p-5 shadow-lg">
                        <i class="bx bx-qr display-1 text-primary mb-3"></i>
                        <h5 class="text-dark">Código QR</h5>
                        <p class="text-muted mb-0">Mercado Pago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$mercado_pago_content = ob_get_clean();

// Sección Facturador Touchscreen
ob_start();
?>
<section class="position-relative overflow-hidden">
    <div class="container position-relative py-9 py-lg-11">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
                <div class="pe-lg-5">
                    <h2 class="display-5 mb-4">FACTURADOR TOUCHSCREEN</h2>
                    <h4 class="mb-4 text-success">ÁGIL Y AMIGABLE</h4>
                    <p class="lead mb-5">
                        Cuenta con facturación intensiva al mostrador de forma rápida con terminales touchscreen, compatible también con teclado o mouse.
                    </p>
                    
                    <div class="mb-5">
                        <ul class="list-unstyled">
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Interfaz táctil intuitiva</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Compatible con teclado y mouse</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Facturación rápida al mostrador</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Diseñado para comercios intensivos</li>
                        </ul>
                    </div>
                    
                    <a href="#" class="btn btn-outline-success btn-lg rounded-pill px-5">
                        <i class="bx bx-touch me-2"></i>VER MÁS
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="position-relative">
                    <img src="assets/img/productos/tango-punto-de-venta/Dispositivos desde cPanel.png" alt="Facturador Touchscreen" class="img-fluid rounded-3 shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$touchscreen_content = ob_get_clean();

// Incluir componente de conectividad
ob_start();
require_once('includes/components/card-hover-2.php');
renderConnectivitySection();
$connectivity_content = ob_get_clean();

// Incluir Tango Reportes específico para Punto de Venta
ob_start();
?>
<section class="overflow-hidden bg-body position-relative">
    <div class="container position-relative py-9 py-lg-11">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="50">
                <div class="pe-lg-5">
                    <h2 class="display-6 mb-4">REPORTES EN LA NUBE</h2>
                    <p class="lead mb-4 text-success">
                        Tango Reportes le permite consultar informes del estado de sus ventas y los movimientos de stock de sus negocios, desde cualquier dispositivo.
                    </p>
                    <div class="mb-4">
                        <ul class="list-unstyled">
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Informes de sus módulos Ventas y Stock</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Visualización de la información mediante indicadores, informes de tipo grilla y pivot (multidimensional)</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Definición de grupos de empresas de acuerdo a la necesidad de información</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Análisis de su información en forma individual por sucursales o por un grupo de ellas</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Envío de todos sus informes a Excel</li>
                            <li class="py-2"><i class="bx bx-check text-success me-2"></i>Permite invitar a otras personas a acceder a su información</li>
                        </ul>
                    </div>
                    
                    <h6 class="fw-bold mt-4 mb-3">Sistema compatible</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <span class="badge bg-success px-3 py-2">TANGO PUNTO DE VENTA</span>
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
<?php
$reportes_content = ob_get_clean();

// Contenido HTML personalizado adicional
$custom_content = $vende_online_content . 
                 $mercado_pago_content . 
                 $touchscreen_content . 
                 $connectivity_content . 
                 $reportes_content;

// FAQ específico para Punto de Venta
$faq_title = "PREGUNTAS FRECUENTES - TANGO PUNTO DE VENTA";
$faq_subtitle = "Resolvemos las dudas más comunes sobre Tango Punto de Venta";

$faq_items = [
    [
        'icon' => 'bx bx-store-alt',
        'question' => '¿Qué tipos de comercio pueden usar Tango Punto de Venta?',
        'answer' => '<p class="mb-3">Tango Punto de Venta es ideal para cualquier tipo de comercio:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Comercios minoristas</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Cadenas de sucursales</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Franquicias</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Farmacias</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Cualquier negocio que facture al mostrador</li>
        </ul>'
    ],
    [
        'icon' => 'bx bx-qr',
        'question' => '¿Cómo funciona la integración con Mercado Pago?',
        'answer' => '<p class="mb-3">La integración con Mercado Pago es completamente automática:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Los cobros ingresan automáticamente al Facturador</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Cobro con código QR sin contacto físico</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Pagos instantáneos desde el celular</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Informes detallados por medio de pago</li>
        </ul>'
    ],
    [
        'icon' => 'bx bx-touch',
        'question' => '¿Es fácil de usar para mis empleados?',
        'answer' => '<p class="mb-3">Sí, Tango Punto de Venta está diseñado para ser extremadamente fácil de usar:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Interfaz táctil intuitiva</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Facturación rápida al mostrador</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Compatible con touchscreen, teclado y mouse</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Sistema de permisos y controles de seguridad</li>
        </ul>'
    ],
    [
        'icon' => 'bx bx-network-chart',
        'question' => '¿Puedo conectar múltiples sucursales?',
        'answer' => '<p class="mb-3">Absolutamente. El módulo Central te permite:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Información centralizada y por sucursal</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Alta instantánea de precios y promociones</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Conexión segura con Tango Net</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Respaldo total de información empresarial</li>
        </ul>'
    ],
    [
        'icon' => 'bx bx-package',
        'question' => '¿Cómo maneja el control de stock?',
        'answer' => '<p class="mb-3">El módulo Stock Punto de Venta ofrece control completo:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Actualización automática al facturar</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Generación e impresión de etiquetas</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Manejo de múltiples depósitos</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Artículos con escalas (color, talle, etc.)</li>
        </ul>'
    ],
    [
        'icon' => 'bx bx-support',
        'question' => '¿Qué soporte y capacitación incluye?',
        'answer' => '<p class="mb-3">Ofrecemos soporte integral especializado en comercios:</p>
        <ul class="list-unstyled">
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Capacitación inicial para tu equipo</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Soporte técnico especializado en POS</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Configuración de impresoras fiscales</li>
            <li class="mb-2"><i class="bx bx-check-circle text-success me-2"></i>Migración de datos desde otros sistemas</li>
            <li class="mb-0"><i class="bx bx-check-circle text-success me-2"></i>Mesa de ayuda durante horario comercial</li>
        </ul>'
    ]
];

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
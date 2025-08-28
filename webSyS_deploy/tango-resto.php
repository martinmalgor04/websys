<?php
/**
 * Página de Tango Resto - Refactorizada para usar template unificado
 * Incluye documentación en español y uso de constantes centralizadas
 */

// Configuración del producto
$product_key = 'resto';

// Título personalizado para la sección intro
$intro_title = 'El Software para tu cadena de restaurantes';

// Texto personalizado de introducción
$intro_text = 'Tango Restô es un software gastronómico que se adapta a cualquier tipo y tamaño de negocio: restaurantes, bares/discos, parrillas, pizzerías, heladerías, cafeterías, fast food, delivery, franquicias y más. Es un sistema totalmente escalable que acompaña tu crecimiento.';

// Contenido personalizado - placeholder mientras se actualiza
$custom_content = '<section class="position-relative"><div class="container position-relative py-9 py-lg-11"><div class="row justify-content-center"><div class="col-md-10 text-center mb-4" data-aos="fade-up" data-aos-delay="50"><div class="alert alert-warning fs-4 text-center p-5"><strong><i class="bx bx-error d-inline-block align-middle me-1"></i> Atención</strong> Estamos actualizando el contenido de esta sección.</div></div></div></div></section>';

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
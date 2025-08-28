<?php
/**
 * Página de Tango Capital Humano - Refactorizada para usar template unificado
 * Incluye documentación en español y uso de constantes centralizadas
 */

// Configuración del producto
$product_key = 'capital-humano';

// Título personalizado para la sección intro
$intro_title = 'Sistema Integral de Gestión de Recursos Humanos';

// Texto personalizado de introducción
$intro_text = 'Tango Capital Humano es la solución integral para la gestión moderna de recursos humanos. Desde la administración de personal hasta la evaluación de desempeño, optimiza todos los procesos de RRHH de tu empresa.';

// Módulos de Tango Capital Humano con iconos y descripciones
$modules = [
    [
        'title' => 'Gestión de Personal',
        'icon' => 'bx bx-user-plus',
        'description' => 'Administración completa de legajos de empleados, control de datos personales, documentación, historia laboral y toda la información necesaria para una gestión eficiente del capital humano.'
    ],
    [
        'title' => 'Control de Asistencia',
        'icon' => 'bx bx-time-five',
        'description' => 'Registro y control automatizado de horarios, tardanzas, ausencias y presentismo. Integración con sistemas biométricos y generación de reportes detallados.'
    ],
    [
        'title' => 'Liquidación de Sueldos',
        'icon' => 'bx bx-money',
        'description' => 'Cálculo automático de remuneraciones, descuentos, aportes y contribuciones. Cumplimiento total con la legislación laboral argentina vigente.'
    ],
    [
        'title' => 'Capacitación y Desarrollo',
        'icon' => 'bx bx-book-reader',
        'description' => 'Gestión de planes de capacitación, seguimiento de cursos, certificaciones y desarrollo profesional del personal.'
    ],
    [
        'title' => 'Evaluación de Desempeño',
        'icon' => 'bx bx-trending-up',
        'description' => 'Sistema de evaluaciones periódicas, objetivos, competencias y seguimiento del rendimiento del personal con reportes analíticos.'
    ],
    [
        'title' => 'Medicina Laboral',
        'icon' => 'bx bx-plus-medical',
        'description' => 'Control de exámenes médicos, vacunas, licencias por enfermedad y seguimiento de la salud ocupacional del personal.'
    ]
];

// Cargar el template unificado
include('templates/tango-product-template.php');
?>
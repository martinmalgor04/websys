<?php
/**
 * Endpoint de Formulario de Contacto Datacenter - webSyS
 * Servicios y Sistemas SRL
 * 
 * Endpoint seguro para procesamiento de formulario de contacto
 * Incluye protecciones CSRF, rate limiting, validación robusta
 */

// Cargar configuración de entorno y módulos de seguridad
require_once('config/env.php');
require_once('includes/logger.php');
require_once('includes/security/csrf.php');
require_once('includes/security/rate-limiter.php');
require_once('includes/security/validator.php');

// Configurar respuesta JSON
header('Content-Type: application/json; charset=utf-8');

// Configuración CORS restrictiva basada en variables de entorno
$allowedOrigins = getCORSConfig();
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (!empty($allowedOrigins) && in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
} else {
    // Fallback a primer origen permitido en producción
    $fallbackOrigin = !empty($allowedOrigins) ? $allowedOrigins[0] : 'https://serviciosysistemas.com.ar';
    header('Access-Control-Allow-Origin: ' . $fallbackOrigin);
}

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400'); // 24 horas

// Verificar método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

/**
 * Función para responder con error de forma segura
 * No expone información sensible del sistema
 */
function respondError($message, $code = 400, $logMessage = null) {
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message]);
    
    if ($logMessage) {
        SimpleLogger::logSecurityEvent('Form error: ' . $logMessage, [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
    }
    
    exit;
}

// Obtener IP del cliente para rate limiting y logging
$clientIP = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

// ===== VERIFICACIÓN DE RATE LIMITING =====
if (!RateLimiter::checkLimit($clientIP, 'contact_form', 3, 3600)) {
    SimpleLogger::logSecurityEvent('Rate limit exceeded for contact form', [
        'ip' => $clientIP,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ]);
    respondError('Demasiados intentos. Por favor intentá nuevamente en 1 hora.', 429);
}

// Registrar intento
RateLimiter::logAttempt($clientIP, 'contact_form');

// ===== VERIFICACIÓN CSRF =====
if (!CSRFProtection::validateRequest('contact_form')) {
    SimpleLogger::logSecurityEvent('CSRF validation failed for contact form', [
        'ip' => $clientIP,
        'post_data' => array_keys($_POST)
    ]);
    respondError('Token de seguridad inválido. Por favor recargá la página e intentá nuevamente.', 403);
}

// ===== VALIDACIÓN ROBUSTA DE ENTRADA =====
$validation = InputValidator::validateContactForm($_POST);

if (!$validation['valid']) {
    SimpleLogger::logSecurityEvent('Input validation failed for contact form', [
        'ip' => $clientIP,
        'errors' => $validation['errors']
    ]);
    
    $errorMessages = implode(', ', $validation['errors']);
    respondError('Datos del formulario inválidos: ' . $errorMessages, 400);
}

// Extraer datos validados y sanitizados
$nombre = $validation['data']['nombre'];
$email = $validation['data']['email'];
$telefono = $validation['data']['telefono'] ?? '';
$empresa = $validation['data']['empresa'] ?? '';
$mensaje = $validation['data']['mensaje'];

// Campos adicionales específicos del datacenter
$puesto = isset($_POST['puesto']) ? InputValidator::sanitizeString($_POST['puesto']) : '';
$asunto = isset($_POST['asunto']) ? InputValidator::sanitizeString($_POST['asunto']) : '';
$como_se_entero = isset($_POST['como_se_entero']) ? InputValidator::sanitizeString($_POST['como_se_entero']) : '';

// Validar asunto como campo requerido
if (empty($asunto) || strlen($asunto) < 3) {
    respondError('El asunto es requerido (mínimo 3 caracteres)', 400);
}

// ===== PREPARACIÓN SEGURA DEL EMAIL =====
$salt = getEnvVar('APP_SALT', 'default_salt_change_in_production');
$ipHash = hash('sha256', $clientIP . $salt);

// Destinatario y configuración desde variables de entorno
$destinatario = getEnvVar('MAIL_TO', 'daniel@serviciosysistemas.com.ar');
$mailFrom = getEnvVar('MAIL_FROM', 'noreply@serviciosysistemas.com.ar');
$mailFromName = getEnvVar('MAIL_FROM_NAME', 'Servicios y Sistemas SRL');

$subject = 'Consulta Datacenter - ' . $asunto . ' - ' . $nombre;

$message = "NUEVA CONSULTA - DATACENTER\n";
$message .= "============================\n\n";
$message .= "Datos del Contacto:\n";
$message .= "- Nombre: " . $nombre . "\n";
$message .= "- Email: " . $email . "\n";
$message .= "- Teléfono: " . $telefono . "\n";
$message .= "- Empresa: " . $empresa . "\n";
$message .= "- Puesto/Cargo: " . $puesto . "\n";
$message .= "- Asunto: " . $asunto . "\n";
$message .= "- ¿Cómo se enteró?: " . $como_se_entero . "\n\n";
$message .= "Mensaje:\n" . $mensaje . "\n\n";
$message .= "============================\n";
$message .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
$message .= "IP: " . $ipHash . "\n";
$message .= "ID Referencia: " . uniqid('DCT-', true) . "\n";

// Headers seguros del email
$headers = "From: " . $mailFromName . " <" . $mailFrom . ">\r\n";
$headers .= "Reply-To: " . InputValidator::sanitizeEmailHeader($email) . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: webSyS-SecureForm/1.0\r\n";
$headers .= "X-Priority: 3\r\n";

// ===== ENVÍO DE EMAIL =====
try {
    $enviado = mail($destinatario, $subject, $message, $headers);
    
    if (!$enviado) {
        SimpleLogger::error('Error al enviar email principal del formulario de contacto', [
            'destinatario' => $destinatario,
            'ip_hash' => $ipHash
        ]);
        respondError('Error al enviar la consulta. Por favor contactanos directamente al +54 3794 426022', 500);
    }
    
    // ===== LOGGING SEGURO =====
    $logData = [
        'timestamp' => date('Y-m-d H:i:s'),
        'type' => 'contact_form_datacenter',
        'nombre' => $nombre,
        'email' => $email,
        'empresa' => $empresa,
        'asunto' => $asunto,
        'ip_hash' => $ipHash,
        'success' => true,
        'reference_id' => uniqid('DCT-', true)
    ];
    
    SimpleLogger::info('Formulario de contacto datacenter procesado exitosamente', $logData);
    
    // ===== AUTO-RESPUESTA AL CLIENTE =====
    $autoSubject = "Consulta recibida - Servicios y Sistemas";
    $autoMessage = "Hola " . $nombre . ",\n\n";
    $autoMessage .= "¡Gracias por contactarte con Servicios y Sistemas!\n\n";
    $autoMessage .= "Hemos recibido tu consulta sobre " . $asunto . " y nos pondremos en contacto contigo en las próximas 24 horas hábiles.\n\n";
    $autoMessage .= "Datos de tu consulta:\n";
    $autoMessage .= "- Asunto: " . $asunto . "\n";
    $autoMessage .= "- Empresa: " . $empresa . "\n";
    $autoMessage .= "- Fecha: " . date('d/m/Y H:i') . "\n\n";
    $autoMessage .= "Si tenés alguna consulta urgente, podés contactarnos directamente:\n";
    $autoMessage .= "- Teléfono: +54 3794 426022\n";
    $autoMessage .= "- Email: info@serviciosysistemas.com.ar\n";
    $autoMessage .= "- Sitio web: https://serviciosysistemas.com.ar\n\n";
    $autoMessage .= "Saludos cordiales,\n";
    $autoMessage .= "Equipo de Servicios y Sistemas SRL";
    
    $autoHeaders = "From: " . $mailFromName . " <info@serviciosysistemas.com.ar>\r\n";
    $autoHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $autoHeaders .= "X-Mailer: webSyS-AutoResponse/1.0\r\n";
    
    // Enviar auto-respuesta (error silencioso si falla)
    if (!mail($email, $autoSubject, $autoMessage, $autoHeaders)) {
        SimpleLogger::warning('Error al enviar auto-respuesta del formulario de contacto', [
            'email_destino' => $email,
            'ip_hash' => $ipHash
        ]);
    }
    
    // ===== RESPUESTA EXITOSA =====
    echo json_encode([
        'success' => true,
        'mensaje' => '¡Gracias por tu consulta! Te hemos enviado una confirmación por email y nos pondremos en contacto contigo en las próximas 24 horas.',
        'timestamp' => time()
    ]);
    
} catch (Exception $e) {
    // Log del error sin exponer detalles al cliente
    SimpleLogger::error('Excepción en procesamiento de formulario de contacto', [
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'ip_hash' => $ipHash
    ]);
    
    respondError('Error interno del servidor. Por favor contactanos directamente al +54 3794 426022', 500);
}
?>
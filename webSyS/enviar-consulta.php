<?php
/**
 * Endpoint unificado de formularios de contacto - webSyS.
 * Servicios y Sistemas SRL.
 */

require_once('config/env.php');
require_once('includes/logger.php');
require_once('includes/security/csrf.php');
require_once('includes/security/rate-limiter.php');
require_once('includes/security/validator.php');
require_once('includes/security/spam-guard.php');
require_once('includes/espo-lead.php');

header('Content-Type: application/json; charset=utf-8');

$allowedOrigins = getCORSConfig();
$requestOrigin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (!empty($allowedOrigins) && in_array($requestOrigin, $allowedOrigins, true)) {
    header('Access-Control-Allow-Origin: ' . $requestOrigin);
} else {
    $fallbackOrigin = !empty($allowedOrigins) ? $allowedOrigins[0] : 'https://serviciosysistemas.com.ar';
    header('Access-Control-Allow-Origin: ' . $fallbackOrigin);
}

header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

function respondError($message, $code = 400, $logMessage = null)
{
    http_response_code($code);
    echo json_encode(['success' => false, 'error' => $message]);

    if ($logMessage) {
        SimpleLogger::logSecurityEvent('Form error: ' . $logMessage, [
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
        ]);
    }

    exit;
}

$clientIP = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';

if (!RateLimiter::checkLimit($clientIP, 'contact_form', 3, 3600)) {
    SimpleLogger::logSecurityEvent('Rate limit exceeded for contact form', [
        'ip' => $clientIP,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
    ]);
    respondError('Demasiados intentos. Por favor intentá nuevamente en 1 hora.', 429);
}

RateLimiter::logAttempt($clientIP, 'contact_form');

if (!CSRFProtection::validateRequest('contact_form')) {
    SimpleLogger::logSecurityEvent('CSRF validation failed for contact form', [
        'ip' => $clientIP,
        'post_data' => array_keys($_POST),
    ]);
    respondError('Token de seguridad inválido. Por favor recargá la página e intentá nuevamente.', 403);
}

// Anti-spam: honeypot + timing + heurísticas AR. Rechazo silencioso
// (mismo JSON de éxito) para no dar feedback a los bots.
$spamCheck = SpamGuard::evaluate($_POST);
if (!empty($spamCheck['spam'])) {
    SimpleLogger::logSecurityEvent('Spam blocked on contact form', [
        'ip' => $clientIP,
        'score' => $spamCheck['score'] ?? 0,
        'reasons' => $spamCheck['reasons'] ?? [],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
    ]);

    echo json_encode([
        'success' => true,
        'mensaje' => '¡Gracias por tu consulta! Te hemos enviado una confirmación por email y nos pondremos en contacto contigo en las próximas 24 horas.',
        'timestamp' => time(),
    ]);
    exit;
}

$validation = InputValidator::validateContactForm($_POST);

if (!$validation['valid']) {
    SimpleLogger::logSecurityEvent('Input validation failed for contact form', [
        'ip' => $clientIP,
        'errors' => $validation['errors'],
    ]);
    respondError('Datos del formulario inválidos: ' . implode(', ', $validation['errors']), 400);
}

$allowedSources = [
    'home',
    'datacenter',
    'tango-gestion',
    'tango-punto-de-venta',
    'tango-resto',
    'tango-estudios-contables',
    'tango-capital-humano',
    'tango-delta',
    'gestion-it',
];

$origen = InputValidator::validateChoice($_POST['origen'] ?? '', $allowedSources);
if ($origen === false) {
    respondError('Origen del formulario inválido', 400, 'invalid form source');
}

$asunto = InputValidator::validateSubject($_POST['asunto'] ?? '');
if ($asunto === false) {
    respondError('El asunto es requerido (3-200 caracteres)', 400);
}

$puesto = InputValidator::validateOptionalText($_POST['puesto'] ?? '', 100);
if ($puesto === false) {
    respondError('El puesto/cargo es inválido', 400);
}

$comoSeEntero = InputValidator::validateOptionalText($_POST['como_se_entero'] ?? '', 100);
if ($comoSeEntero === false) {
    respondError('El valor de cómo se enteró es inválido', 400);
}

$nombre = $validation['data']['nombre'];
$email = $validation['data']['email'];
$telefono = $validation['data']['telefono'] ?? '';
$empresa = $validation['data']['empresa'] ?? '';
$mensaje = $validation['data']['mensaje'];
$fecha = date('Y-m-d H:i:s');
$referenceId = uniqid('WEB-', true);

$salt = getEnvVar('APP_SALT', 'default_salt_change_in_production');
$ipHash = hash('sha256', $clientIP . $salt);

$destinatario = getEnvVar('MAIL_TO', 'info@serviciosysistemas.com.ar');
$mailFrom = getEnvVar('MAIL_FROM', 'noreply@serviciosysistemas.com.ar');
$mailFromName = getEnvVar('MAIL_FROM_NAME', 'Servicios y Sistemas SRL');

$safeSubject = InputValidator::sanitizeEmailHeader(
    'Consulta web - ' . $origen . ' - ' . $asunto . ' - ' . $nombre
);

$message = 'NUEVA CONSULTA - ' . strtoupper($origen) . "\n";
$message .= "============================\n\n";
$message .= "Datos del Contacto:\n";
$message .= '- Nombre: ' . $nombre . "\n";
$message .= '- Email: ' . $email . "\n";
$message .= '- Teléfono: ' . $telefono . "\n";
$message .= '- Empresa: ' . $empresa . "\n";
$message .= '- Puesto/Cargo: ' . $puesto . "\n";
$message .= '- Asunto: ' . $asunto . "\n";
$message .= '- Origen: ' . $origen . "\n";
$message .= '- ¿Cómo se enteró?: ' . $comoSeEntero . "\n\n";
$message .= "Mensaje:\n" . $mensaje . "\n\n";
$message .= "============================\n";
$message .= 'Fecha: ' . $fecha . "\n";
$message .= 'IP: ' . $ipHash . "\n";
$message .= 'ID Referencia: ' . $referenceId . "\n";

$headers = 'From: ' . $mailFromName . ' <' . $mailFrom . ">\r\n";
$headers .= 'Reply-To: ' . InputValidator::sanitizeEmailHeader($email) . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: webSyS-SecureForm/1.0\r\n";
$headers .= "X-Priority: 3\r\n";

try {
    $enviado = mail($destinatario, $safeSubject, $message, $headers);

    if (!$enviado) {
        SimpleLogger::error('Error al enviar email principal del formulario de contacto', [
            'destinatario' => $destinatario,
            'origen' => $origen,
            'ip_hash' => $ipHash,
        ]);
        respondError('Error al enviar la consulta. Por favor contactanos directamente al +54 3794 426022', 500);
    }

    SimpleLogger::info('Formulario de contacto procesado exitosamente', [
        'timestamp' => $fecha,
        'type' => 'contact_form',
        'nombre' => $nombre,
        'email' => $email,
        'empresa' => $empresa,
        'asunto' => $asunto,
        'origen' => $origen,
        'ip_hash' => $ipHash,
        'success' => true,
        'reference_id' => $referenceId,
    ]);

    try {
        espoCreateLead([
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'empresa' => $empresa,
            'puesto' => $puesto,
            'asunto' => $asunto,
            'origen' => $origen,
            'como_se_entero' => $comoSeEntero,
            'mensaje' => $mensaje,
            'fecha' => $fecha,
        ]);
    } catch (Throwable $e) {
        SimpleLogger::warning('Excepción al crear Lead en EspoCRM', [
            'error' => $e->getMessage(),
            'origen' => $origen,
            'reference_id' => $referenceId,
        ]);
    }

    $autoSubject = 'Consulta recibida - Servicios y Sistemas';
    $autoMessage = 'Hola ' . $nombre . ",\n\n";
    $autoMessage .= "¡Gracias por contactarte con Servicios y Sistemas!\n\n";
    $autoMessage .= 'Hemos recibido tu consulta sobre ' . $asunto . " y nos pondremos en contacto contigo en las próximas 24 horas hábiles.\n\n";
    $autoMessage .= "Datos de tu consulta:\n";
    $autoMessage .= '- Asunto: ' . $asunto . "\n";
    $autoMessage .= '- Empresa: ' . $empresa . "\n";
    $autoMessage .= '- Fecha: ' . date('d/m/Y H:i') . "\n\n";
    $autoMessage .= "Si tenés alguna consulta urgente, podés contactarnos directamente:\n";
    $autoMessage .= "- Teléfono: +54 3794 426022\n";
    $autoMessage .= "- Email: info@serviciosysistemas.com.ar\n";
    $autoMessage .= "- Sitio web: https://serviciosysistemas.com.ar\n\n";
    $autoMessage .= "Saludos cordiales,\n";
    $autoMessage .= 'Equipo de Servicios y Sistemas SRL';

    $autoHeaders = 'From: ' . $mailFromName . " <info@serviciosysistemas.com.ar>\r\n";
    $autoHeaders .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $autoHeaders .= "X-Mailer: webSyS-AutoResponse/1.0\r\n";

    if (!mail($email, $autoSubject, $autoMessage, $autoHeaders)) {
        SimpleLogger::warning('Error al enviar auto-respuesta del formulario de contacto', [
            'email_destino' => $email,
            'ip_hash' => $ipHash,
        ]);
    }

    echo json_encode([
        'success' => true,
        'mensaje' => '¡Gracias por tu consulta! Te hemos enviado una confirmación por email y nos pondremos en contacto contigo en las próximas 24 horas.',
        'timestamp' => time(),
    ]);
} catch (Throwable $e) {
    SimpleLogger::error('Excepción en procesamiento de formulario de contacto', [
        'error' => $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine(),
        'ip_hash' => $ipHash,
    ]);
    respondError('Error interno del servidor. Por favor contactanos directamente al +54 3794 426022', 500);
}

<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Verificar que sea POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Método no permitido']);
    exit;
}

// Obtener y limpiar datos
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
$empresa = isset($_POST['empresa']) ? trim($_POST['empresa']) : '';
$puesto = isset($_POST['puesto']) ? trim($_POST['puesto']) : '';
$asunto = isset($_POST['asunto']) ? trim($_POST['asunto']) : '';
$mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';
$como_se_entero = isset($_POST['como_se_entero']) ? trim($_POST['como_se_entero']) : '';

// Validaciones básicas
if (empty($nombre) || empty($email) || empty($asunto)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Faltan campos requeridos']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'Email inválido']);
    exit;
}

// Preparar email
$to = 'daniel@serviciosysistemas.com.ar';
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
$message .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";

// Headers del email
$headers = "From: noreply@serviciosysistemas.com.ar\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

// Enviar email
$enviado = mail($to, $subject, $message, $headers);

if ($enviado) {
    // Log opcional (crear carpeta logs si no existe)
    $log_data = [
        'fecha' => date('Y-m-d H:i:s'),
        'nombre' => $nombre,
        'email' => $email,
        'empresa' => $empresa,
        'asunto' => $asunto,
        'ip' => $_SERVER['REMOTE_ADDR']
    ];
    
    if (!file_exists('logs')) {
        mkdir('logs', 0755, true);
    }
    
    file_put_contents('logs/datacenter_' . date('Y-m') . '.log', 
                     json_encode($log_data) . "\n", 
                     FILE_APPEND | LOCK_EX);
    
    // Auto-respuesta al cliente
    $auto_subject = "Consulta recibida - Servicios y Sistemas";
    $auto_message = "Hola " . $nombre . ",\n\n";
    $auto_message .= "¡Gracias por contactarte con Servicios y Sistemas!\n\n";
    $auto_message .= "Hemos recibido tu consulta sobre " . $asunto . " y nos pondremos en contacto contigo en las próximas 24 horas hábiles.\n\n";
    $auto_message .= "Datos de tu consulta:\n";
    $auto_message .= "- Asunto: " . $asunto . "\n";
    $auto_message .= "- Empresa: " . $empresa . "\n";
    $auto_message .= "- Fecha: " . date('d/m/Y H:i') . "\n\n";
    $auto_message .= "Si tenés alguna consulta urgente, podés contactarnos directamente:\n";
    $auto_message .= "- Teléfono: +54 3794 426022\n";
    $auto_message .= "- Email: info@serviciosysistemas.com.ar\n\n";
    $auto_message .= "Saludos cordiales,\n";
    $auto_message .= "Equipo de Servicios y Sistemas";
    
    $auto_headers = "From: info@serviciosysistemas.com.ar\r\n";
    $auto_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    mail($email, $auto_subject, $auto_message, $auto_headers);
    
    echo json_encode([
        'success' => true, 
        'mensaje' => '¡Gracias por tu consulta! Te hemos enviado una confirmación por email.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'error' => 'Error al enviar el email. Intentá nuevamente o contactanos al +54 3794 426022'
    ]);
}
?> 
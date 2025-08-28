<?php
/**
 * Router Seguro - webSyS
 * Servicios y Sistemas SRL
 * 
 * Router para desarrollo local con PHP built-in server
 * Implementa whitelist de rutas permitidas y protección contra path traversal
 * Simula las reglas de .htaccess para URLs limpias de forma segura
 */

// Cargar sistema de logging para eventos de seguridad
require_once('includes/logger.php');

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$clientIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Eliminar slash inicial y limpiar path
$path = ltrim($path, '/');
$path = trim($path);

// Si no hay path, servir index.php
if (empty($path) || $path === '/') {
    include 'index.php';
    return;
}

// Whitelist de archivos PHP permitidos (SIN extensión)
$allowedFiles = [
    'index',
    'tango-gestion',
    'tango-punto-de-venta', 
    'tango-estudios-contables',
    'tango-resto',
    'tango-capital-humano',
    'tango-delta',
    'datacenter',
    'gracias',
    'pronto',
    'error',
    '404',
    '403',
    '500'
];

// Sanitizar y validar el path solicitado
$requestedPath = $path;

// Detectar intentos de path traversal
if (strpos($requestedPath, '..') !== false || 
    strpos($requestedPath, './') !== false || 
    strpos($requestedPath, '\\') !== false ||
    strpos($requestedPath, '%') !== false) {
    
    // Log del intento de path traversal
    SimpleLogger::logSecurityEvent('Intento de path traversal detectado', [
        'ip' => $clientIP,
        'path_solicitado' => $requestedPath,
        'uri_original' => $uri,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ]);
    
    http_response_code(404);
    include '404.php';
    return;
}

// Extraer el primer segmento del path para comparar con whitelist
$pathSegments = explode('/', $requestedPath);
$mainPath = $pathSegments[0];

// Validar que el path esté en la whitelist
if (!in_array($mainPath, $allowedFiles, true)) {
    // Log del acceso a archivo no permitido
    SimpleLogger::logSecurityEvent('Acceso a ruta no permitida', [
        'ip' => $clientIP,
        'path_solicitado' => $mainPath,
        'uri_original' => $uri,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ]);
    
    http_response_code(404);
    include '404.php';
    return;
}

// Si el archivo existe como archivo estático (CSS, JS, imágenes), servirlo
$staticFile = $requestedPath;
if (file_exists($staticFile) && is_file($staticFile)) {
    // Validación adicional: asegurar que el archivo esté en el directorio correcto
    $realPath = realpath($staticFile);
    $webRoot = realpath(__DIR__);
    
    if ($realPath && strpos($realPath, $webRoot) === 0) {
        // Verificar que no sea un archivo PHP fuera de la whitelist
        if (pathinfo($realPath, PATHINFO_EXTENSION) === 'php') {
            SimpleLogger::logSecurityEvent('Intento de acceso directo a PHP no permitido', [
                'ip' => $clientIP,
                'archivo' => $staticFile,
                'real_path' => $realPath
            ]);
            
            http_response_code(404);
            include '404.php';
            return;
        }
        
        // Permitir que PHP sirva el archivo estático
        return false;
    } else {
        // Intento de acceso fuera del webroot
        SimpleLogger::logSecurityEvent('Intento de acceso fuera del webroot', [
            'ip' => $clientIP,
            'archivo_solicitado' => $staticFile,
            'real_path' => $realPath,
            'web_root' => $webRoot
        ]);
        
        http_response_code(404);
        include '404.php';
        return;
    }
}

// Buscar archivo PHP correspondiente de la whitelist
$phpFile = $mainPath . '.php';

if (file_exists($phpFile) && is_file($phpFile)) {
    // Validación adicional con realpath para prevenir symlink attacks
    $realPath = realpath($phpFile);
    $webRoot = realpath(__DIR__);
    
    if ($realPath && strpos($realPath, $webRoot) === 0) {
        // Verificar que el archivo está en el directorio raíz (no subdirectorios)
        $relativePath = str_replace($webRoot . DIRECTORY_SEPARATOR, '', $realPath);
        
        // Solo permitir archivos en el directorio raíz
        if (strpos($relativePath, DIRECTORY_SEPARATOR) === false) {
            include $phpFile;
            return;
        } else {
            SimpleLogger::logSecurityEvent('Intento de acceso a PHP en subdirectorio', [
                'ip' => $clientIP,
                'archivo' => $phpFile,
                'real_path' => $realPath,
                'relative_path' => $relativePath
            ]);
        }
    } else {
        SimpleLogger::logSecurityEvent('Intento de acceso a PHP fuera del webroot', [
            'ip' => $clientIP,
            'archivo' => $phpFile,
            'real_path' => $realPath ?: 'false',
            'web_root' => $webRoot
        ]);
    }
}

// Si llegamos aquí, el archivo no se encontró o no está permitido
// Log del intento de acceso a archivo inexistente
SimpleLogger::warning('Acceso a archivo no encontrado', [
    'ip' => $clientIP,
    'path_solicitado' => $requestedPath,
    'main_path' => $mainPath,
    'uri_original' => $uri,
    'archivo_php_buscado' => $phpFile ?? 'none'
]);

// Respuesta 404 genérica que no revela información del sistema
http_response_code(404);
include '404.php';
?>
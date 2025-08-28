<?php
/**
 * Inicialización de Seguridad - webSyS
 * Servicios y Sistemas SRL
 * 
 * Sistema centralizado de inicialización de seguridad
 * Carga todos los módulos de seguridad y configura el entorno
 */

// Prevenir acceso directo
if (!defined('SECURITY_INIT_ALLOWED')) {
    define('SECURITY_INIT_ALLOWED', true);
}

// Cargar configuración de entorno
require_once(dirname(__FILE__) . '/../config/env.php');

/**
 * Inicializa todos los sistemas de seguridad
 * @return bool true si se inicializó correctamente
 */
function initSecurity() {
    static $initialized = false;
    
    if ($initialized) {
        return true;
    }
    
    try {
        // 1. Inicializar configuración de entorno
        if (!initEnvironment()) {
            error_log('SecurityInit: Error al inicializar configuración de entorno');
            return false;
        }
        
        // 2. Configurar manejo de errores seguro
        if (!setupErrorHandling()) {
            error_log('SecurityInit: Error al configurar manejo de errores');
            return false;
        }
        
        // 3. Verificar permisos de directorios críticos
        if (!checkDirectoryPermissions()) {
            error_log('SecurityInit: Error en permisos de directorios');
            return false;
        }
        
        // 4. Configurar sesiones seguras
        if (!setupSecureSessions()) {
            error_log('SecurityInit: Error al configurar sesiones seguras');
            return false;
        }
        
        // 5. Cargar módulos de seguridad
        if (!loadSecurityModules()) {
            error_log('SecurityInit: Error al cargar módulos de seguridad');
            return false;
        }
        
        // 6. Validar configuración de seguridad
        if (!validateSecurityConfig()) {
            error_log('SecurityInit: Error en validación de configuración');
            return false;
        }
        
        $initialized = true;
        error_log('SecurityInit: Sistema de seguridad inicializado correctamente');
        return true;
        
    } catch (Exception $e) {
        error_log('SecurityInit: Excepción durante inicialización: ' . $e->getMessage());
        return false;
    }
}

/**
 * Verifica permisos de directorios críticos
 * @return bool true si los permisos son correctos
 */
function checkDirectoryPermissions() {
    $criticalDirectories = [
        '../private' => 0750,
        '../private/logs' => 0750
    ];
    
    foreach ($criticalDirectories as $dir => $expectedPerms) {
        $fullPath = realpath($dir);
        
        if (!$fullPath || !is_dir($fullPath)) {
            // Intentar crear directorio si no existe
            if (!mkdir($dir, $expectedPerms, true)) {
                error_log("checkDirectoryPermissions: No se pudo crear directorio $dir");
                return false;
            }
            $fullPath = realpath($dir);
        }
        
        // Verificar permisos actuales
        $currentPerms = fileperms($fullPath) & 0777;
        if ($currentPerms !== $expectedPerms) {
            if (!chmod($fullPath, $expectedPerms)) {
                error_log("checkDirectoryPermissions: No se pudieron ajustar permisos de $dir");
                return false;
            }
        }
        
        // Crear .htaccess para protección adicional
        $htaccessFile = $fullPath . '/.htaccess';
        if (!file_exists($htaccessFile)) {
            $htaccessContent = "# Acceso denegado por seguridad\nDeny from all\nOptions -Indexes\n";
            if (!file_put_contents($htaccessFile, $htaccessContent)) {
                error_log("checkDirectoryPermissions: No se pudo crear .htaccess en $dir");
            }
        }
    }
    
    return true;
}

/**
 * Configura manejo de errores seguro
 * @return bool true si se configuró correctamente
 */
function setupErrorHandling() {
    // Configuración basada en el entorno
    if (isProduction()) {
        // Producción: No mostrar errores al usuario
        error_reporting(0);
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
        ini_set('log_errors', 1);
    } else {
        // Desarrollo: Mostrar errores pero no información sensible
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        ini_set('log_errors', 1);
    }
    
    // Configurar archivo de log de errores
    $logDir = getEnvVar('LOG_DIR', '../private/logs');
    $errorLog = $logDir . '/php_errors.log';
    
    if (!is_dir($logDir)) {
        mkdir($logDir, 0750, true);
    }
    
    ini_set('error_log', $errorLog);
    
    // Configurar handler personalizado para errores fatales
    register_shutdown_function('handleFatalError');
    
    return true;
}

/**
 * Handler para errores fatales
 */
function handleFatalError() {
    $error = error_get_last();
    
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        // Log del error sin información sensible
        $sanitizedMessage = str_replace([__DIR__, $_SERVER['DOCUMENT_ROOT']], ['[DIR]', '[ROOT]'], $error['message']);
        error_log("Error fatal: $sanitizedMessage en línea {$error['line']}");
        
        // En producción, mostrar página de error genérica
        if (isProduction() && !headers_sent()) {
            http_response_code(500);
            include_once('500.php');
            exit();
        }
    }
}

/**
 * Configura sesiones seguras
 * @return bool true si se configuró correctamente
 */
function setupSecureSessions() {
    // Configurar parámetros de sesión segura
    $sessionConfig = [
        'cookie_lifetime' => (int)getEnvVar('SESSION_LIFETIME', 7200),
        'cookie_httponly' => getEnvVar('SESSION_HTTPONLY', 'true') === 'true',
        'cookie_secure' => getEnvVar('SESSION_SECURE', 'true') === 'true' && 
                          (isset($_SERVER['HTTPS']) || isset($_SERVER['HTTP_X_FORWARDED_PROTO'])),
        'cookie_samesite' => getEnvVar('SESSION_SAMESITE', 'Strict'),
        'use_strict_mode' => 1,
        'use_cookies' => 1,
        'use_only_cookies' => 1,
        'entropy_file' => '/dev/urandom',
        'entropy_length' => 32,
        'hash_function' => 'sha256'
    ];
    
    foreach ($sessionConfig as $key => $value) {
        if (!ini_set("session.$key", $value)) {
            error_log("setupSecureSessions: No se pudo configurar session.$key");
        }
    }
    
    return true;
}

/**
 * Carga todos los módulos de seguridad
 * @return bool true si se cargaron correctamente
 */
function loadSecurityModules() {
    $securityModules = [
        'csrf.php' => 'CSRFProtection',
        'rate-limiter.php' => 'RateLimiter', 
        'validator.php' => 'InputValidator'
    ];
    
    $securityDir = dirname(__FILE__) . '/security/';
    
    foreach ($securityModules as $file => $expectedClass) {
        $filePath = $securityDir . $file;
        
        if (!file_exists($filePath)) {
            error_log("loadSecurityModules: Archivo de seguridad no encontrado: $file");
            return false;
        }
        
        require_once($filePath);
        
        if (!class_exists($expectedClass)) {
            error_log("loadSecurityModules: Clase $expectedClass no encontrada en $file");
            return false;
        }
    }
    
    return true;
}

/**
 * Valida la configuración de seguridad
 * @return bool true si la configuración es válida
 */
function validateSecurityConfig() {
    $requiredVars = ['APP_SALT', 'ALLOWED_ORIGINS', 'LOG_DIR'];
    $errors = validateEnvVars($requiredVars);
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            error_log("validateSecurityConfig: $error");
        }
        return false;
    }
    
    // Validaciones adicionales específicas de seguridad
    $salt = getEnvVar('APP_SALT');
    if (strlen($salt) < 32) {
        error_log('validateSecurityConfig: APP_SALT debe tener al menos 32 caracteres');
        return false;
    }
    
    // Verificar que CORS no esté configurado como wildcard en producción
    if (isProduction()) {
        $origins = getCORSConfig();
        if (in_array('*', $origins)) {
            error_log('validateSecurityConfig: CORS no debe usar wildcard (*) en producción');
            return false;
        }
    }
    
    return true;
}

/**
 * Obtiene información del estado de seguridad (para debugging)
 * @return array Estado de seguridad
 */
function getSecurityStatus() {
    return [
        'environment' => getEnvVar('APP_ENV', 'unknown'),
        'debug_mode' => isDebugMode(),
        'salt_configured' => !empty(getEnvVar('APP_SALT')),
        'cors_configured' => !empty(getEnvVar('ALLOWED_ORIGINS')),
        'logs_dir_exists' => is_dir(getEnvVar('LOG_DIR', '../private/logs')),
        'session_secure' => ini_get('session.cookie_secure') === '1',
        'modules_loaded' => [
            'csrf' => class_exists('CSRFProtection'),
            'rate_limiter' => class_exists('RateLimiter'),
            'validator' => class_exists('InputValidator')
        ]
    ];
}

/**
 * Función de conveniencia para verificar si la seguridad está inicializada
 * @return bool true si está inicializada
 */
function isSecurityInitialized() {
    return class_exists('CSRFProtection') && 
           class_exists('RateLimiter') && 
           class_exists('InputValidator') &&
           !empty(getEnvVar('APP_SALT'));
}

/**
 * Limpieza de emergencia en caso de problemas de seguridad
 * Borra sesiones, tokens CSRF y resetea estado
 */
function securityEmergencyCleanup() {
    // Limpiar sesión actual
    if (session_status() === PHP_SESSION_ACTIVE) {
        session_destroy();
    }
    
    // Limpiar cookies de sesión
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 3600, '/');
    }
    
    // Log del evento
    error_log('SecurityInit: Limpieza de emergencia ejecutada');
    
    // Limpiar tokens CSRF si la clase está disponible
    if (class_exists('CSRFProtection')) {
        CSRFProtection::clearAllTokens();
    }
}

// Auto-inicialización condicional
// Solo si este archivo es incluido directamente (no requerido por otros módulos)
if (!defined('SECURITY_AUTO_INIT_DISABLED') && 
    basename($_SERVER['SCRIPT_NAME'] ?? '') !== 'security-init.php') {
    
    if (!initSecurity()) {
        error_log('SecurityInit: Fallo en auto-inicialización');
        
        // En producción, fallar de forma segura
        if (isProduction()) {
            http_response_code(503);
            header('Retry-After: 300');
            exit('Servicio temporalmente no disponible');
        }
    }
}
?>
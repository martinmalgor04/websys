<?php
/**
 * Cargador de Variables de Entorno - webSyS
 * Servicios y Sistemas SRL
 * 
 * Sistema seguro para cargar configuración desde archivo .env
 * Elimina la necesidad de secrets hardcodeados en el código
 */

// Variables requeridas del sistema
$requiredVars = [
    'APP_SALT',
    'ALLOWED_ORIGINS',
    'LOG_DIR'
];

/**
 * Carga las variables de entorno desde archivo .env
 * @param string $envFile Ruta al archivo .env (relativo al directorio actual)
 * @return bool true si se cargó correctamente, false en caso de error
 */
function loadEnv($envFile = '.env') {
    // Verificar que el archivo .env existe
    if (!file_exists($envFile)) {
        error_log("Archivo .env no encontrado: $envFile");
        return false;
    }

    // Leer las líneas del archivo
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        error_log("Error al leer archivo .env: $envFile");
        return false;
    }

    foreach ($lines as $lineNumber => $line) {
        $line = trim($line);
        
        // Saltar comentarios y líneas vacías
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }
        
        // Verificar formato variable=valor
        if (strpos($line, '=') === false) {
            error_log("Formato inválido en .env línea " . ($lineNumber + 1) . ": $line");
            continue;
        }
        
        // Separar nombre y valor
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        
        // Remover comillas si están presentes
        if ((substr($value, 0, 1) === '"' && substr($value, -1) === '"') || 
            (substr($value, 0, 1) === "'" && substr($value, -1) === "'")) {
            $value = substr($value, 1, -1);
        }
        
        // Validar nombre de variable
        if (!preg_match('/^[A-Z_][A-Z0-9_]*$/', $name)) {
            error_log("Nombre de variable inválido en .env: $name");
            continue;
        }
        
        // Establecer variable de entorno
        $_ENV[$name] = $value;
        putenv("$name=$value");
    }
    
    return true;
}

/**
 * Obtiene el valor de una variable de entorno
 * @param string $key Nombre de la variable
 * @param mixed $default Valor por defecto si la variable no existe
 * @return mixed Valor de la variable o valor por defecto
 */
function getEnvVar($key, $default = null) {
    // Intentar desde $_ENV primero
    if (isset($_ENV[$key])) {
        return $_ENV[$key];
    }
    
    // Intentar desde getenv()
    $value = getenv($key);
    if ($value !== false) {
        return $value;
    }
    
    // Retornar valor por defecto
    return $default;
}

/**
 * Valida que las variables de entorno requeridas estén configuradas
 * @param array $required Array de nombres de variables requeridas
 * @return array Array con errores de validación (vacío si todo está correcto)
 */
function validateEnvVars($required = null) {
    global $requiredVars;
    $errors = [];
    
    if ($required === null) {
        $required = $requiredVars;
    }
    
    foreach ($required as $var) {
        $value = getEnvVar($var);
        
        if ($value === null || $value === '') {
            $errors[] = "Variable de entorno requerida no configurada: $var";
            continue;
        }
        
        // Validaciones específicas
        switch ($var) {
            case 'APP_SALT':
                if (strlen($value) < 32) {
                    $errors[] = "APP_SALT debe tener al menos 32 caracteres";
                }
                if ($value === 'default_salt_change_in_production' || $value === 'salt_serviciosysistemas') {
                    $errors[] = "APP_SALT debe ser cambiado del valor por defecto";
                }
                break;
                
            case 'ALLOWED_ORIGINS':
                $origins = explode(',', $value);
                foreach ($origins as $origin) {
                    $origin = trim($origin);
                    if (!filter_var($origin, FILTER_VALIDATE_URL) && $origin !== '*') {
                        $errors[] = "Origen CORS inválido: $origin";
                    }
                }
                break;
                
            case 'LOG_DIR':
                // Crear directorio si no existe
                if (!is_dir($value)) {
                    if (!mkdir($value, 0750, true)) {
                        $errors[] = "No se pudo crear directorio de logs: $value";
                    }
                }
                break;
        }
    }
    
    return $errors;
}

/**
 * Obtiene configuración de CORS basada en variables de entorno
 * @return array Configuración de CORS
 */
function getCORSConfig() {
    $allowedOrigins = getEnvVar('ALLOWED_ORIGINS', '');
    
    if (empty($allowedOrigins)) {
        return [];
    }
    
    return array_map('trim', explode(',', $allowedOrigins));
}

/**
 * Determina si la aplicación está en modo debug
 * @return bool true si está en modo debug
 */
function isDebugMode() {
    $debug = getEnvVar('APP_DEBUG', 'false');
    return strtolower($debug) === 'true' || $debug === '1';
}

/**
 * Determina si la aplicación está en producción
 * @return bool true si está en producción
 */
function isProduction() {
    $env = getEnvVar('APP_ENV', 'production');
    return strtolower($env) === 'production';
}

/**
 * Inicializa el sistema de configuración de entorno
 * Carga variables y valida configuración
 * @param string $envFile Ruta al archivo .env
 * @return bool true si se inicializó correctamente
 */
function initEnvironment($envFile = '.env') {
    // Cargar variables de entorno
    if (!loadEnv($envFile)) {
        return false;
    }
    
    // Validar variables requeridas
    $errors = validateEnvVars();
    if (!empty($errors)) {
        foreach ($errors as $error) {
            error_log("Error de configuración: $error");
        }
        return false;
    }
    
    // Configurar error reporting basado en entorno
    if (isProduction()) {
        error_reporting(0);
        ini_set('display_errors', 0);
        ini_set('log_errors', 1);
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }
    
    return true;
}

// Auto-inicializar si este archivo es incluido
// Solo si no se ha inicializado previamente
if (!defined('ENV_INITIALIZED')) {
    $envFile = dirname(__FILE__) . '/../.env';
    if (initEnvironment($envFile)) {
        define('ENV_INITIALIZED', true);
    } else {
        error_log('Error crítico: No se pudo inicializar configuración de entorno');
        if (!isProduction()) {
            die('Error de configuración: Revisar logs del sistema');
        }
    }
}
?>
<?php
/**
 * Rate Limiter - webSyS
 * Servicios y Sistemas SRL
 * 
 * Sistema de limitación de velocidad basado en archivos
 * Previene ataques de fuerza bruta y spam
 * Compatible con hosting básico, sin dependencias externas
 */

require_once(dirname(__FILE__) . '/../../config/env.php');

class RateLimiter {
    
    /**
     * Directorio para almacenar datos de rate limiting
     */
    private static $dataDir = null;
    
    /**
     * Configuración por defecto
     */
    private static $defaultConfig = [
        'max_attempts' => 5,
        'time_window' => 3600, // 1 hora
        'cleanup_interval' => 300 // 5 minutos
    ];
    
    /**
     * Inicializa el rate limiter
     */
    private static function init() {
        if (self::$dataDir === null) {
            self::$dataDir = getEnvVar('LOG_DIR', '../private/logs') . '/rate_limit';
            
            // Crear directorio si no existe
            if (!is_dir(self::$dataDir)) {
                if (!mkdir(self::$dataDir, 0750, true)) {
                    error_log('RateLimiter: No se pudo crear directorio ' . self::$dataDir);
                    return false;
                }
            }
            
            // Crear .htaccess para proteger el directorio
            $htaccessFile = self::$dataDir . '/.htaccess';
            if (!file_exists($htaccessFile)) {
                file_put_contents($htaccessFile, "Deny from all\n");
            }
        }
        return true;
    }
    
    /**
     * Obtiene la clave única para un cliente e IP
     * @param string $ip Dirección IP del cliente
     * @param string $action Acción que está realizando
     * @return string Clave única hasheada
     */
    private static function getClientKey($ip, $action) {
        $salt = getEnvVar('APP_SALT', 'default_salt');
        return hash('sha256', $ip . ':' . $action . ':' . $salt);
    }
    
    /**
     * Obtiene el archivo de datos para una clave de cliente
     * @param string $clientKey Clave del cliente
     * @return string Ruta completa al archivo
     */
    private static function getDataFile($clientKey) {
        return self::$dataDir . '/' . $clientKey . '.json';
    }
    
    /**
     * Carga los datos de intentos para un cliente
     * @param string $clientKey Clave del cliente
     * @return array Datos de intentos
     */
    private static function loadAttempts($clientKey) {
        $file = self::getDataFile($clientKey);
        
        if (!file_exists($file)) {
            return [
                'attempts' => 0,
                'first_attempt' => time(),
                'last_attempt' => time(),
                'blocked_until' => 0
            ];
        }
        
        $data = json_decode(file_get_contents($file), true);
        return $data ?: [
            'attempts' => 0,
            'first_attempt' => time(),
            'last_attempt' => time(),
            'blocked_until' => 0
        ];
    }
    
    /**
     * Guarda los datos de intentos para un cliente
     * @param string $clientKey Clave del cliente
     * @param array $data Datos a guardar
     */
    private static function saveAttempts($clientKey, $data) {
        $file = self::getDataFile($clientKey);
        file_put_contents($file, json_encode($data), LOCK_EX);
        chmod($file, 0640);
    }
    
    /**
     * Verifica si un cliente está dentro del límite de velocidad
     * @param string $ip Dirección IP del cliente
     * @param string $action Acción que intenta realizar
     * @param int $maxAttempts Máximo intentos permitidos (opcional)
     * @param int $timeWindow Ventana de tiempo en segundos (opcional)
     * @return bool true si está permitido, false si excede el límite
     */
    public static function checkLimit($ip, $action, $maxAttempts = null, $timeWindow = null) {
        if (!self::init()) {
            // Si no se puede inicializar, permitir por seguridad
            return true;
        }
        
        // Usar configuración por defecto si no se especifica
        $maxAttempts = $maxAttempts ?? self::$defaultConfig['max_attempts'];
        $timeWindow = $timeWindow ?? self::$defaultConfig['time_window'];
        
        // Obtener configuración desde variables de entorno
        if ($maxAttempts === self::$defaultConfig['max_attempts']) {
            $maxAttempts = (int)getEnvVar('RATE_LIMIT_MAX', self::$defaultConfig['max_attempts']);
        }
        if ($timeWindow === self::$defaultConfig['time_window']) {
            $timeWindow = (int)getEnvVar('RATE_LIMIT_WINDOW', self::$defaultConfig['time_window']);
        }
        
        $clientKey = self::getClientKey($ip, $action);
        $data = self::loadAttempts($clientKey);
        $currentTime = time();
        
        // Verificar si está bloqueado
        if ($data['blocked_until'] > $currentTime) {
            error_log("RateLimiter: Cliente $ip bloqueado para acción '$action' hasta " . date('Y-m-d H:i:s', $data['blocked_until']));
            return false;
        }
        
        // Verificar si la ventana de tiempo ha expirado
        if ($currentTime - $data['first_attempt'] > $timeWindow) {
            // Resetear contador
            $data = [
                'attempts' => 0,
                'first_attempt' => $currentTime,
                'last_attempt' => $currentTime,
                'blocked_until' => 0
            ];
        }
        
        // Verificar límite de intentos
        if ($data['attempts'] >= $maxAttempts) {
            // Bloquear por el doble del tiempo de ventana
            $blockDuration = $timeWindow * 2;
            $data['blocked_until'] = $currentTime + $blockDuration;
            
            error_log("RateLimiter: Cliente $ip excedió límite para acción '$action'. Bloqueado por $blockDuration segundos");
            
            self::saveAttempts($clientKey, $data);
            return false;
        }
        
        return true;
    }
    
    /**
     * Registra un intento para un cliente
     * @param string $ip Dirección IP del cliente
     * @param string $action Acción realizada
     */
    public static function logAttempt($ip, $action) {
        if (!self::init()) {
            return;
        }
        
        $clientKey = self::getClientKey($ip, $action);
        $data = self::loadAttempts($clientKey);
        $currentTime = time();
        
        $timeWindow = (int)getEnvVar('RATE_LIMIT_WINDOW', self::$defaultConfig['time_window']);
        
        // Si la ventana ha expirado, resetear
        if ($currentTime - $data['first_attempt'] > $timeWindow) {
            $data = [
                'attempts' => 1,
                'first_attempt' => $currentTime,
                'last_attempt' => $currentTime,
                'blocked_until' => 0
            ];
        } else {
            // Incrementar contador
            $data['attempts']++;
            $data['last_attempt'] = $currentTime;
        }
        
        self::saveAttempts($clientKey, $data);
        
        // Log del intento
        error_log("RateLimiter: Intento #{$data['attempts']} de $ip para acción '$action'");
    }
    
    /**
     * Verifica si un cliente está actualmente bloqueado
     * @param string $ip Dirección IP del cliente
     * @param string $action Acción a verificar
     * @return bool true si está bloqueado
     */
    public static function isBlocked($ip, $action) {
        if (!self::init()) {
            return false;
        }
        
        $clientKey = self::getClientKey($ip, $action);
        $data = self::loadAttempts($clientKey);
        
        return $data['blocked_until'] > time();
    }
    
    /**
     * Obtiene información sobre el estado de rate limiting para un cliente
     * @param string $ip Dirección IP del cliente
     * @param string $action Acción a consultar
     * @return array Información del estado
     */
    public static function getStatus($ip, $action) {
        if (!self::init()) {
            return [
                'allowed' => true,
                'attempts' => 0,
                'blocked' => false,
                'blocked_until' => 0,
                'remaining_time' => 0
            ];
        }
        
        $clientKey = self::getClientKey($ip, $action);
        $data = self::loadAttempts($clientKey);
        $currentTime = time();
        
        $maxAttempts = (int)getEnvVar('RATE_LIMIT_MAX', self::$defaultConfig['max_attempts']);
        $blocked = $data['blocked_until'] > $currentTime;
        
        return [
            'allowed' => !$blocked && $data['attempts'] < $maxAttempts,
            'attempts' => $data['attempts'],
            'max_attempts' => $maxAttempts,
            'blocked' => $blocked,
            'blocked_until' => $data['blocked_until'],
            'remaining_time' => max(0, $data['blocked_until'] - $currentTime),
            'reset_time' => $data['first_attempt'] + (int)getEnvVar('RATE_LIMIT_WINDOW', self::$defaultConfig['time_window'])
        ];
    }
    
    /**
     * Limpia datos antiguos de rate limiting
     * @param int $olderThan Limpiar datos más antiguos que X segundos
     */
    public static function cleanup($olderThan = null) {
        if (!self::init()) {
            return;
        }
        
        $olderThan = $olderThan ?? (self::$defaultConfig['time_window'] * 2);
        $cutoffTime = time() - $olderThan;
        $cleaned = 0;
        
        $files = glob(self::$dataDir . '/*.json');
        
        foreach ($files as $file) {
            if (filemtime($file) < $cutoffTime) {
                if (unlink($file)) {
                    $cleaned++;
                }
            }
        }
        
        if ($cleaned > 0) {
            error_log("RateLimiter: Limpiados $cleaned archivos antiguos");
        }
    }
    
    /**
     * Resetea el contador de intentos para un cliente específico
     * @param string $ip Dirección IP del cliente
     * @param string $action Acción a resetear
     */
    public static function reset($ip, $action) {
        if (!self::init()) {
            return false;
        }
        
        $clientKey = self::getClientKey($ip, $action);
        $file = self::getDataFile($clientKey);
        
        if (file_exists($file)) {
            unlink($file);
            return true;
        }
        
        return false;
    }
}

/**
 * Función de conveniencia para verificar rate limiting
 * @param string $action Acción a verificar
 * @param string $ip IP del cliente (opcional, se detecta automáticamente)
 * @return bool true si está permitido
 */
function rate_limit_check($action, $ip = null) {
    if ($ip === null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
    
    return RateLimiter::checkLimit($ip, $action);
}

/**
 * Función de conveniencia para registrar intento
 * @param string $action Acción realizada
 * @param string $ip IP del cliente (opcional, se detecta automáticamente)
 */
function rate_limit_log($action, $ip = null) {
    if ($ip === null) {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
    }
    
    RateLimiter::logAttempt($ip, $action);
}
?>
<?php
/**
 * Sistema de Logging Seguro Centralizado - webSyS
 * Servicios y Sistemas SRL
 * 
 * Sistema de logging con sanitización automática, rotación de archivos
 * y logging de eventos de seguridad
 */

require_once(dirname(__FILE__) . '/../config/env.php');

class SimpleLogger {
    
    /**
     * Directorio de logs configurado desde variables de entorno
     */
    private static $log_dir = null;
    
    /**
     * Salt para hashing configurado desde variables de entorno
     */
    private static $salt = null;
    
    /**
     * Tamaño máximo de archivo de log antes de rotación
     */
    private static $max_log_size = null;
    
    /**
     * Request ID único para tracking de requests
     */
    private static $request_id = null;
    
    /**
     * Si el logger está inicializado
     */
    private static $initialized = false;
    
    /**
     * Patrones de datos sensibles a sanitizar
     */
    private static $sensitivePatterns = [
        '/password["\']?\s*[:=]\s*["\']?[^"\'\s,}]+/i' => '[REDACTED_PASSWORD]',
        '/token["\']?\s*[:=]\s*["\']?[^"\'\s,}]+/i' => '[REDACTED_TOKEN]',
        '/api[_-]?key["\']?\s*[:=]\s*["\']?[^"\'\s,}]+/i' => '[REDACTED_API_KEY]',
        '/secret["\']?\s*[:=]\s*["\']?[^"\'\s,}]+/i' => '[REDACTED_SECRET]',
        '/csrf[_-]?token["\']?\s*[:=]\s*["\']?[^"\'\s,}]+/i' => '[REDACTED_CSRF_TOKEN]',
        '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/' => '[EMAIL_HASH]' // Emails reemplazados por hash
    ];
    
    /**
     * Inicializa el logger con configuración desde variables de entorno
     */
    public static function init() {
        if (self::$initialized) {
            return true;
        }
        
        // Configurar directorio de logs desde variable de entorno
        self::$log_dir = getEnvVar('LOG_DIR', '../private/logs');
        
        // Configurar salt desde variable de entorno
        self::$salt = getEnvVar('APP_SALT', 'default_salt_change_in_production');
        
        // Configurar tamaño máximo de logs
        self::$max_log_size = (int)getEnvVar('LOG_MAX_SIZE', 10485760); // 10MB por defecto
        
        // Generar request ID único
        self::$request_id = uniqid('req_', true);
        
        // Crear directorio de logs si no existe
        if (!is_dir(self::$log_dir)) {
            if (!mkdir(self::$log_dir, 0750, true)) {
                error_log('SimpleLogger: No se pudo crear directorio de logs: ' . self::$log_dir);
                return false;
            }
        }
        
        // Crear .htaccess para proteger directorio de logs
        $htaccess_file = self::$log_dir . '/.htaccess';
        if (!file_exists($htaccess_file)) {
            $htaccess_content = "# Denegar acceso web a logs\nDeny from all\n<Files ~ \"\.log$\">\n    Order allow,deny\n    Deny from all\n</Files>";
            file_put_contents($htaccess_file, $htaccess_content);
        }
        
        // Verificar permisos del directorio
        if (!is_writable(self::$log_dir)) {
            error_log('SimpleLogger: Directorio de logs no tiene permisos de escritura: ' . self::$log_dir);
            return false;
        }
        
        self::$initialized = true;
        
        // Log de inicialización exitosa
        self::info('Logger inicializado correctamente', [
            'log_dir' => self::$log_dir,
            'max_size' => self::$max_log_size
        ]);
        
        return true;
    }
    
    /**
     * Sanitiza datos sensibles de mensajes de log
     * @param string $data Datos a sanitizar
     * @return string Datos sanitizados
     */
    private static function sanitizeLogData($data) {
        if (!is_string($data)) {
            return $data;
        }
        
        // Aplicar patrones de sanitización
        foreach (self::$sensitivePatterns as $pattern => $replacement) {
            if ($pattern === '/([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})/') {
                // Hash emails en lugar de solo removerlos
                $data = preg_replace_callback($pattern, function($matches) {
                    return substr(hash('sha256', $matches[1] . self::$salt), 0, 8) . '@[HASHED]';
                }, $data);
            } else {
                $data = preg_replace($pattern, $replacement, $data);
            }
        }
        
        return $data;
    }
    
    /**
     * Hash datos sensibles para logging seguro
     * @param mixed $data Datos a hashear
     * @return string Hash de los datos
     */
    public static function hashSensitiveData($data) {
        return substr(hash('sha256', serialize($data) . self::$salt), 0, 16);
    }
    
    /**
     * Verifica si un archivo de log necesita rotación y la ejecuta
     * @param string $log_file Ruta al archivo de log
     */
    private static function rotateLogIfNeeded($log_file) {
        if (!file_exists($log_file) || filesize($log_file) < self::$max_log_size) {
            return;
        }
        
        // Rotación de archivos (mantener últimos 5)
        $path_info = pathinfo($log_file);
        $base_name = $path_info['dirname'] . '/' . $path_info['filename'];
        $extension = $path_info['extension'] ?? 'log';
        
        // Eliminar archivo más antiguo si existe
        $oldest_file = $base_name . '.5.' . $extension;
        if (file_exists($oldest_file)) {
            unlink($oldest_file);
        }
        
        // Rotar archivos existentes
        for ($i = 4; $i >= 1; $i--) {
            $current_file = $base_name . '.' . $i . '.' . $extension;
            $next_file = $base_name . '.' . ($i + 1) . '.' . $extension;
            
            if (file_exists($current_file)) {
                rename($current_file, $next_file);
            }
        }
        
        // Mover archivo actual a .1
        $rotated_file = $base_name . '.1.' . $extension;
        rename($log_file, $rotated_file);
        
        self::info('Log rotado automáticamente', [
            'archivo_original' => basename($log_file),
            'archivo_rotado' => basename($rotated_file),
            'tamaño_original' => filesize($rotated_file)
        ]);
    }
    
    /**
     * Registra un evento en el sistema
     * @param string $level Nivel del log (ERROR, WARNING, INFO, DEBUG, SECURITY)
     * @param string $message Mensaje del log
     * @param array $context Contexto adicional
     * @return bool true si se registró exitosamente
     */
    public static function log($level, $message, $context = []) {
        // Auto-inicializar si es necesario
        if (!self::$initialized) {
            if (!self::init()) {
                return false;
            }
        }
        
        // Sanitizar mensaje
        $sanitized_message = self::sanitizeLogData($message);
        
        // Sanitizar contexto
        $sanitized_context = [];
        foreach ($context as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $sanitized_context[$key] = self::sanitizeLogData(json_encode($value));
            } else {
                $sanitized_context[$key] = self::sanitizeLogData((string)$value);
            }
        }
        
        // Crear entrada de log con contexto de seguridad ampliado
        $log_entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'timestamp_unix' => time(),
            'level' => strtoupper($level),
            'message' => $sanitized_message,
            'context' => $sanitized_context,
            'request_id' => self::$request_id,
            'ip_hash' => self::getClientIPHash(),
            'user_agent_hash' => self::getUserAgentHash(),
            'memory_usage' => memory_get_usage(true),
            'script' => $_SERVER['SCRIPT_NAME'] ?? 'unknown',
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
            'uri' => $_SERVER['REQUEST_URI'] ?? 'CLI'
        ];
        
        // Determinar archivo de log según nivel
        $log_file_prefix = ($level === 'SECURITY') ? 'security' : 'system';
        $log_file = self::$log_dir . '/' . $log_file_prefix . '_' . date('Y-m') . '.log';
        
        // Verificar si necesita rotación
        self::rotateLogIfNeeded($log_file);
        
        // Escribir al archivo
        $log_line = json_encode($log_entry, JSON_UNESCAPED_UNICODE) . "\n";
        $result = file_put_contents($log_file, $log_line, FILE_APPEND | LOCK_EX);
        
        // Establecer permisos restrictivos
        if ($result !== false && file_exists($log_file)) {
            chmod($log_file, 0640);
        }
        
        return $result !== false;
    }
    
    /**
     * Obtiene hash de IP del cliente de forma segura
     * @return string Hash de IP
     */
    private static function getClientIPHash() {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        if ($ip === 'unknown') {
            return 'unknown';
        }
        return hash('sha256', $ip . self::$salt);
    }
    
    /**
     * Obtiene hash de User Agent de forma segura
     * @return string Hash de User Agent
     */
    private static function getUserAgentHash() {
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        if ($ua === 'unknown') {
            return 'unknown';
        }
        return substr(hash('sha256', $ua . self::$salt), 0, 16);
    }
    
    /**
     * Registra evento de seguridad específico
     * @param string $event Nombre del evento de seguridad
     * @param array $details Detalles del evento
     * @return bool true si se registró exitosamente
     */
    public static function logSecurityEvent($event, $details = []) {
        $security_context = array_merge($details, [
            'event_type' => 'security_event',
            'severity' => 'high',
            'requires_attention' => true
        ]);
        
        return self::log('SECURITY', $event, $security_context);
    }
    
    /**
     * Log de errores
     */
    public static function error($message, $context = []) {
        return self::log('ERROR', $message, $context);
    }
    
    /**
     * Log de advertencias
     */
    public static function warning($message, $context = []) {
        return self::log('WARNING', $message, $context);
    }
    
    /**
     * Log de información
     */
    public static function info($message, $context = []) {
        return self::log('INFO', $message, $context);
    }
    
    /**
     * Log de debug (solo en entornos no productivos)
     */
    public static function debug($message, $context = []) {
        if (isDebugMode()) {
            return self::log('DEBUG', $message, $context);
        }
        return true;
    }
    
    /**
     * Obtiene estadísticas de logging
     * @return array Estadísticas del sistema de logging
     */
    public static function getStats() {
        if (!self::$initialized) {
            self::init();
        }
        
        $stats = [
            'log_directory' => self::$log_dir,
            'max_log_size' => self::$max_log_size,
            'request_id' => self::$request_id,
            'initialized' => self::$initialized,
            'files' => []
        ];
        
        // Información de archivos de log
        if (is_dir(self::$log_dir)) {
            $log_files = glob(self::$log_dir . '/*.log');
            foreach ($log_files as $file) {
                $stats['files'][basename($file)] = [
                    'size' => filesize($file),
                    'modified' => filemtime($file),
                    'readable' => is_readable($file),
                    'writable' => is_writable($file)
                ];
            }
        }
        
        return $stats;
    }
    
    /**
     * Limpia logs antiguos basado en configuración
     * @param int $days_to_keep Días de logs a mantener (por defecto 30)
     */
    public static function cleanupOldLogs($days_to_keep = 30) {
        if (!self::$initialized) {
            self::init();
        }
        
        $cutoff_time = time() - ($days_to_keep * 24 * 3600);
        $cleaned_files = 0;
        
        if (is_dir(self::$log_dir)) {
            $log_files = glob(self::$log_dir . '/*.log*');
            
            foreach ($log_files as $file) {
                if (filemtime($file) < $cutoff_time) {
                    if (unlink($file)) {
                        $cleaned_files++;
                    }
                }
            }
        }
        
        if ($cleaned_files > 0) {
            self::info("Cleanup de logs completado", [
                'archivos_eliminados' => $cleaned_files,
                'dias_mantenidos' => $days_to_keep
            ]);
        }
        
        return $cleaned_files;
    }
}

// Auto-inicializar el logger cuando se incluye el archivo
if (!defined('LOGGER_INITIALIZED')) {
    SimpleLogger::init();
    define('LOGGER_INITIALIZED', true);
}
?>
<?php
/**
 * Protección CSRF (Cross-Site Request Forgery) - webSyS  
 * Servicios y Sistemas SRL
 * 
 * Sistema de tokens CSRF basado en sesión para prevenir ataques cross-site
 * Compatible con hosting básico, sin dependencias externas
 */

class CSRFProtection {
    
    /**
     * Clave de sesión para almacenar tokens CSRF
     */
    private static $sessionKey = 'csrf_tokens';
    
    /**
     * Tiempo de expiración por defecto para tokens (en segundos)
     */
    private static $defaultExpiry = 3600; // 1 hora
    
    /**
     * Inicializa la sesión si no está activa
     * @return bool true si la sesión está disponible
     */
    private static function ensureSession() {
        if (session_status() === PHP_SESSION_NONE) {
            // Configurar sesión segura
            ini_set('session.cookie_httponly', 1);
            ini_set('session.cookie_secure', 1);
            ini_set('session.cookie_samesite', 'Strict');
            ini_set('session.use_strict_mode', 1);
            
            if (!session_start()) {
                error_log('CSRF: Error al iniciar sesión');
                return false;
            }
        }
        return true;
    }
    
    /**
     * Genera un token CSRF para una acción específica
     * @param string $action Nombre de la acción (ej: 'contact_form', 'login')
     * @param int $expiry Tiempo de expiración en segundos (opcional)
     * @return string Token CSRF generado
     */
    public static function generateToken($action = 'default', $expiry = null) {
        if (!self::ensureSession()) {
            return false;
        }
        
        if ($expiry === null) {
            $expiry = self::$defaultExpiry;
        }
        
        // Generar token criptográficamente seguro
        $token = bin2hex(random_bytes(32));
        
        // Limpiar tokens expirados
        self::cleanExpiredTokens();
        
        // Almacenar token con timestamp de expiración
        if (!isset($_SESSION[self::$sessionKey])) {
            $_SESSION[self::$sessionKey] = [];
        }
        
        $_SESSION[self::$sessionKey][$action] = [
            'token' => $token,
            'expires' => time() + $expiry,
            'created' => time()
        ];
        
        return $token;
    }
    
    /**
     * Valida un token CSRF
     * @param string $token Token a validar
     * @param string $action Acción asociada al token
     * @param bool $singleUse Si es true, el token se elimina después de usar
     * @return bool true si el token es válido
     */
    public static function validateToken($token, $action = 'default', $singleUse = true) {
        if (!self::ensureSession()) {
            return false;
        }
        
        if (empty($token) || !is_string($token)) {
            error_log("CSRF: Token inválido proporcionado para acción '$action'");
            return false;
        }
        
        // Verificar que exista el token para la acción
        if (!isset($_SESSION[self::$sessionKey][$action])) {
            error_log("CSRF: No existe token para acción '$action'");
            return false;
        }
        
        $storedData = $_SESSION[self::$sessionKey][$action];
        
        // Verificar expiración
        if (time() > $storedData['expires']) {
            error_log("CSRF: Token expirado para acción '$action'");
            unset($_SESSION[self::$sessionKey][$action]);
            return false;
        }
        
        // Verificar token con comparación segura (timing attack resistant)
        if (!hash_equals($storedData['token'], $token)) {
            error_log("CSRF: Token no coincide para acción '$action'");
            return false;
        }
        
        // Eliminar token si es de un solo uso
        if ($singleUse) {
            unset($_SESSION[self::$sessionKey][$action]);
        }
        
        return true;
    }
    
    /**
     * Genera campo HTML oculto con token CSRF
     * @param string $action Acción para el token
     * @param int $expiry Tiempo de expiración (opcional)
     * @return string HTML del campo oculto
     */
    public static function getTokenField($action = 'default', $expiry = null) {
        $token = self::generateToken($action, $expiry);
        if (!$token) {
            return '<!-- Error: No se pudo generar token CSRF -->';
        }
        
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">' . 
               '<input type="hidden" name="csrf_action" value="' . htmlspecialchars($action, ENT_QUOTES, 'UTF-8') . '">';
    }
    
    /**
     * Middleware para validar CSRF en requests POST/PUT/DELETE
     * @param string $action Acción esperada (opcional, se lee desde POST si no se proporciona)
     * @return bool true si es válido o no es necesario validar
     */
    public static function validateRequest($action = null) {
        $method = $_SERVER['REQUEST_METHOD'] ?? '';
        
        // Solo validar métodos que pueden causar cambios de estado
        if (!in_array($method, ['POST', 'PUT', 'DELETE', 'PATCH'])) {
            return true;
        }
        
        // Obtener token desde POST data
        $token = $_POST['csrf_token'] ?? '';
        
        // Si no se proporciona acción, usar la del formulario
        if ($action === null) {
            $action = $_POST['csrf_action'] ?? 'default';
        }
        
        return self::validateToken($token, $action);
    }
    
    /**
     * Limpia tokens CSRF expirados de la sesión
     */
    private static function cleanExpiredTokens() {
        if (!isset($_SESSION[self::$sessionKey])) {
            return;
        }
        
        $currentTime = time();
        $tokensToRemove = [];
        
        foreach ($_SESSION[self::$sessionKey] as $action => $data) {
            if (!isset($data['expires']) || $currentTime > $data['expires']) {
                $tokensToRemove[] = $action;
            }
        }
        
        foreach ($tokensToRemove as $action) {
            unset($_SESSION[self::$sessionKey][$action]);
        }
    }
    
    /**
     * Elimina todos los tokens CSRF de la sesión
     * Útil para logout o reset de seguridad
     */
    public static function clearAllTokens() {
        if (!self::ensureSession()) {
            return false;
        }
        
        unset($_SESSION[self::$sessionKey]);
        return true;
    }
    
    /**
     * Obtiene información sobre tokens activos (para debugging)
     * @return array Información de tokens (sin valores sensibles)
     */
    public static function getTokenInfo() {
        if (!self::ensureSession() || !isset($_SESSION[self::$sessionKey])) {
            return [];
        }
        
        $info = [];
        $currentTime = time();
        
        foreach ($_SESSION[self::$sessionKey] as $action => $data) {
            $info[$action] = [
                'created' => $data['created'] ?? 0,
                'expires' => $data['expires'] ?? 0,
                'valid' => ($data['expires'] ?? 0) > $currentTime,
                'age' => $currentTime - ($data['created'] ?? 0)
            ];
        }
        
        return $info;
    }
}

/**
 * Función de conveniencia para generar campo CSRF
 * @param string $action Acción del formulario
 * @return string HTML del campo CSRF
 */
function csrf_field($action = 'default') {
    return CSRFProtection::getTokenField($action);
}

/**
 * Función de conveniencia para validar CSRF en middleware
 * @param string $action Acción a validar (opcional)
 * @return bool true si es válido
 */
function csrf_validate($action = null) {
    return CSRFProtection::validateRequest($action);
}
?>
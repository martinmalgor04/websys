<?php
/**
 * Validador de Entrada - webSyS
 * Servicios y Sistemas SRL
 * 
 * Sistema de validación y sanitización de entrada
 * Previene XSS, inyección de headers de email, y otros ataques de entrada
 * Compatible con hosting básico, sin dependencias externas
 */

class InputValidator {
    
    /**
     * Patrones de validación comunes
     */
    private static $patterns = [
        'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
        'phone' => '/^[\+]?[(]?[\d\s\-\(\)]{7,15}$/',
        'name' => '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-\'\.]{1,50}$/',
        'company' => '/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-\'\.\&\,]{1,100}$/',
        'subject' => '/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-\'\.\?\!\,\:]{1,200}$/',
    ];
    
    /**
     * Palabras y patrones sospechosos para detectar ataques
     */
    private static $suspiciousPatterns = [
        '/script/i', '/javascript/i', '/vbscript/i', '/onload/i', '/onclick/i',
        '/eval\(/i', '/expression\(/i', '/<iframe/i', '/<object/i', '/<embed/i',
        '/\bBCC:/i', '/\bCC:/i', '/\bTO:/i', '/\bFrom:/i',
        '/Content-Type:/i', '/MIME-Version:/i', '/\r\n/i', '/\r/i', '/\n/i'
    ];
    
    /**
     * Sanitiza una cadena de texto para prevenir XSS
     * @param string $input Texto a sanitizar
     * @param bool $allowBasicHtml Si permite HTML básico (strong, em, br)
     * @return string Texto sanitizado
     */
    public static function sanitizeString($input, $allowBasicHtml = false) {
        if (!is_string($input)) {
            return '';
        }
        
        // Remover caracteres de control y null bytes
        $input = str_replace("\0", '', $input);
        $input = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $input);
        
        // Trimear espacios
        $input = trim($input);
        
        if ($allowBasicHtml) {
            // Permitir solo tags básicos y seguros
            $allowed = '<strong><em><b><i><br><p>';
            $input = strip_tags($input, $allowed);
        } else {
            // Escapar todas las entidades HTML
            $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        
        return $input;
    }
    
    /**
     * Sanitiza headers de email para prevenir inyección
     * @param string $input Texto del header
     * @return string Header sanitizado
     */
    public static function sanitizeEmailHeader($input) {
        if (!is_string($input)) {
            return '';
        }
        
        // Remover caracteres peligrosos para headers de email
        $dangerous = ["\r", "\n", "%0a", "%0d", "\0", "%00"];
        $input = str_ireplace($dangerous, '', $input);
        
        // Remover headers de email comunes que podrían ser inyectados
        $emailHeaders = ['to:', 'cc:', 'bcc:', 'from:', 'subject:', 'content-type:', 'mime-version:'];
        $input = str_ireplace($emailHeaders, '', $input);
        
        return trim($input);
    }
    
    /**
     * Valida formato de email
     * @param string $email Email a validar
     * @return bool true si es válido
     */
    public static function validateEmail($email) {
        if (!is_string($email) || empty($email)) {
            return false;
        }
        
        // Sanitizar primero
        $email = trim($email);
        
        // Validar formato básico
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        
        // Validar con expresión regular adicional
        if (!preg_match(self::$patterns['email'], $email)) {
            return false;
        }
        
        // Verificar longitud
        if (strlen($email) > 254) {
            return false;
        }
        
        // Verificar que no contenga patrones sospechosos
        foreach (self::$suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $email)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Valida nombre de persona
     * @param string $name Nombre a validar
     * @return bool true si es válido
     */
    public static function validateName($name) {
        if (!is_string($name) || empty($name)) {
            return false;
        }
        
        $name = trim($name);
        
        // Verificar longitud
        if (strlen($name) < 2 || strlen($name) > 50) {
            return false;
        }
        
        // Verificar patrón
        if (!preg_match(self::$patterns['name'], $name)) {
            return false;
        }
        
        // Verificar que no sea solo espacios o caracteres especiales
        if (preg_match('/^[\s\-\'\.]+$/', $name)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Valida número de teléfono
     * @param string $phone Teléfono a validar
     * @return bool true si es válido
     */
    public static function validatePhone($phone) {
        if (!is_string($phone)) {
            return false;
        }
        
        // Permitir campo vacío para teléfono opcional
        $phone = trim($phone);
        if (empty($phone)) {
            return true;
        }
        
        // Remover espacios y caracteres comunes
        $cleanPhone = preg_replace('/[\s\-\(\)]/', '', $phone);
        
        // Verificar que solo contenga números y posible +
        if (!preg_match('/^[\+]?\d{7,15}$/', $cleanPhone)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Valida nombre de empresa
     * @param string $company Empresa a validar
     * @return bool true si es válido
     */
    public static function validateCompany($company) {
        if (!is_string($company)) {
            return false;
        }
        
        // Permitir campo vacío para empresa opcional
        $company = trim($company);
        if (empty($company)) {
            return true;
        }
        
        // Verificar longitud
        if (strlen($company) > 100) {
            return false;
        }
        
        // Verificar patrón
        if (!preg_match(self::$patterns['company'], $company)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * Valida mensaje/comentario
     * @param string $message Mensaje a validar
     * @param int $minLength Longitud mínima
     * @param int $maxLength Longitud máxima
     * @return bool true si es válido
     */
    public static function validateMessage($message, $minLength = 10, $maxLength = 2000) {
        if (!is_string($message) || empty($message)) {
            return false;
        }
        
        $message = trim($message);
        
        // Verificar longitud
        if (strlen($message) < $minLength || strlen($message) > $maxLength) {
            return false;
        }
        
        // Verificar que no contenga solo espacios o caracteres especiales
        if (preg_match('/^[\s\-\.\,\!\?]+$/', $message)) {
            return false;
        }
        
        // Verificar patrones sospechosos
        foreach (self::$suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $message)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Detecta si el input contiene contenido sospechoso
     * @param string $input Texto a analizar
     * @return bool true si es sospechoso
     */
    public static function isSuspicious($input) {
        if (!is_string($input)) {
            return false;
        }
        
        foreach (self::$suspiciousPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Valida y sanitiza todos los campos de un formulario de contacto
     * @param array $data Datos del formulario
     * @return array Array con 'valid' (bool), 'errors' (array), 'data' (array sanitized)
     */
    public static function validateContactForm($data) {
        $result = [
            'valid' => true,
            'errors' => [],
            'data' => []
        ];
        
        // Validar nombre
        if (!isset($data['nombre']) || !self::validateName($data['nombre'])) {
            $result['valid'] = false;
            $result['errors']['nombre'] = 'Nombre requerido (2-50 caracteres, solo letras y espacios)';
        } else {
            $result['data']['nombre'] = self::sanitizeString($data['nombre']);
        }
        
        // Validar email
        if (!isset($data['email']) || !self::validateEmail($data['email'])) {
            $result['valid'] = false;
            $result['errors']['email'] = 'Email requerido con formato válido';
        } else {
            $result['data']['email'] = trim(strtolower($data['email']));
        }
        
        // Validar teléfono (opcional)
        if (isset($data['telefono'])) {
            if (!self::validatePhone($data['telefono'])) {
                $result['valid'] = false;
                $result['errors']['telefono'] = 'Formato de teléfono inválido (7-15 dígitos)';
            } else {
                $result['data']['telefono'] = self::sanitizeString($data['telefono']);
            }
        }
        
        // Validar empresa (opcional)
        if (isset($data['empresa'])) {
            if (!self::validateCompany($data['empresa'])) {
                $result['valid'] = false;
                $result['errors']['empresa'] = 'Nombre de empresa inválido (máximo 100 caracteres)';
            } else {
                $result['data']['empresa'] = self::sanitizeString($data['empresa']);
            }
        }
        
        // Validar mensaje
        if (!isset($data['mensaje']) || !self::validateMessage($data['mensaje'])) {
            $result['valid'] = false;
            $result['errors']['mensaje'] = 'Mensaje requerido (10-2000 caracteres)';
        } else {
            $result['data']['mensaje'] = self::sanitizeString($data['mensaje'], false);
        }
        
        // Verificar contenido sospechoso en todos los campos
        foreach ($result['data'] as $field => $value) {
            if (self::isSuspicious($value)) {
                $result['valid'] = false;
                $result['errors'][$field] = 'Contenido no permitido detectado';
                error_log("Validador: Contenido sospechoso detectado en campo '$field': " . substr($value, 0, 100));
            }
        }
        
        return $result;
    }
    
    /**
     * Limpia y valida parámetros de URL/GET
     * @param array $params Parámetros GET
     * @return array Parámetros sanitizados
     */
    public static function sanitizeGetParams($params) {
        $clean = [];
        
        foreach ($params as $key => $value) {
            // Sanitizar clave
            $cleanKey = preg_replace('/[^a-zA-Z0-9_-]/', '', $key);
            if (empty($cleanKey) || strlen($cleanKey) > 50) {
                continue;
            }
            
            if (is_string($value)) {
                $cleanValue = self::sanitizeString($value);
                // Limitar longitud
                $cleanValue = substr($cleanValue, 0, 255);
                $clean[$cleanKey] = $cleanValue;
            } elseif (is_numeric($value)) {
                $clean[$cleanKey] = (string)$value;
            }
        }
        
        return $clean;
    }
    
    /**
     * Genera token aleatorio seguro para formularios
     * @param int $length Longitud del token
     * @return string Token generado
     */
    public static function generateSecureToken($length = 32) {
        return bin2hex(random_bytes($length));
    }
}

/**
 * Función de conveniencia para sanitizar string
 * @param string $input Texto a sanitizar
 * @return string Texto sanitizado
 */
function sanitize_input($input) {
    return InputValidator::sanitizeString($input);
}

/**
 * Función de conveniencia para validar email
 * @param string $email Email a validar
 * @return bool true si es válido
 */
function validate_email($email) {
    return InputValidator::validateEmail($email);
}
?>
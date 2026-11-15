<?php
/**
 * Anti-spam para formularios de contacto - webSyS
 * Servicios y Sistemas SRL
 *
 * Capas sin dependencias externas:
 * 1) Honeypot (campo invisible que los bots suelen completar)
 * 2) Timing firmado (rechaza envíos demasiado rápidos o tokens viejos)
 * 3) Heurísticas de mercado AR (teléfonos +1 / mensajes spam en inglés)
 *
 * Los rechazos son silenciosos hacia el bot (respuesta "éxito" falsa)
 * para no enseñarles qué falló.
 */

class SpamGuard
{
    private const MIN_SECONDS = 3;
    private const MAX_SECONDS = 3600;
    private const SCORE_THRESHOLD = 4;

    /** Frases típicas de spam SEO / lead-gen en inglés */
    private static $englishSpamPhrases = [
        'dear sir',
        'dear madam',
        'to whom it may concern',
        'i am interested in your services',
        'we offer seo',
        'increase your ranking',
        'guest post',
        'backlink',
        'link building',
        'digital marketing agency',
        'grow your business online',
        'cryptocurrency',
        'forex trading',
        'make money online',
        'click here',
        'visit our website',
        'looking for partnership',
        'business proposal',
        'we can help you rank',
        'outsource',
        'cold email',
    ];

    /**
     * Campos ocultos de honeypot + timestamp firmado para insertar en el HTML del form.
     */
    public static function getProtectionFields(): string
    {
        $ts = (string) time();
        $sig = self::signTimestamp($ts);

        $html = '<div class="sys-hp" aria-hidden="true" tabindex="-1">' . "\n";
        $html .= '  <label for="website_url">Website</label>' . "\n";
        $html .= '  <input type="text" name="website_url" id="website_url" value="" autocomplete="off" tabindex="-1">' . "\n";
        $html .= '  <input type="text" name="company_url" value="" autocomplete="off" tabindex="-1">' . "\n";
        $html .= '</div>' . "\n";
        $html .= '<input type="hidden" name="form_ts" value="' . htmlspecialchars($ts, ENT_QUOTES, 'UTF-8') . '">' . "\n";
        $html .= '<input type="hidden" name="form_sig" value="' . htmlspecialchars($sig, ENT_QUOTES, 'UTF-8') . '">' . "\n";

        return $html;
    }

    /**
     * Evalúa un envío. Devuelve ['spam' => bool, 'reasons' => string[], 'score' => int]
     */
    public static function evaluate(array $post): array
    {
        $reasons = [];
        $score = 0;

        // 1) Honeypot: si llenaron el campo oculto → bot seguro
        foreach (['website_url', 'company_url'] as $hpField) {
            $value = trim((string) ($post[$hpField] ?? ''));
            if ($value !== '') {
                return [
                    'spam' => true,
                    'reasons' => ['honeypot:' . $hpField],
                    'score' => 100,
                ];
            }
        }

        // 2) Timing firmado
        $timing = self::evaluateTiming($post['form_ts'] ?? '', $post['form_sig'] ?? '');
        if ($timing['hard_fail']) {
            return [
                'spam' => true,
                'reasons' => [$timing['reason']],
                'score' => 100,
            ];
        }
        if ($timing['score'] > 0) {
            $score += $timing['score'];
            $reasons[] = $timing['reason'];
        }

        $telefono = trim((string) ($post['telefono'] ?? ''));
        $mensaje = trim((string) ($post['mensaje'] ?? ''));
        $nombre = trim((string) ($post['nombre'] ?? ''));
        $email = strtolower(trim((string) ($post['email'] ?? '')));
        $empresa = trim((string) ($post['empresa'] ?? ''));

        // 3) Teléfono estadounidense (+1 / formato NANP)
        if ($telefono !== '' && self::looksLikeUsPhone($telefono)) {
            $score += 3;
            $reasons[] = 'us_phone';
        }

        // 4) Mensaje con spam inglés / poco español
        $msgScore = self::scoreMessage($mensaje);
        if ($msgScore['score'] > 0) {
            $score += $msgScore['score'];
            $reasons = array_merge($reasons, $msgScore['reasons']);
        }

        // 5) Combo típico: teléfono US + mensaje en inglés → rechazo duro
        if (in_array('us_phone', $reasons, true) && in_array('english_spam', $reasons, true)) {
            $score += 3;
            $reasons[] = 'us_english_combo';
        }

        // 6) URLs en el mensaje (spam SEO)
        if (preg_match('/https?:\/\/|www\./i', $mensaje)) {
            $score += 2;
            $reasons[] = 'url_in_message';
        }

        // 7) Dominios desechables frecuentes en bots
        if (self::isDisposableEmail($email)) {
            $score += 3;
            $reasons[] = 'disposable_email';
        }

        // 8) Nombre con patrones raros (solo ASCII, muchas mayúsculas aleatorias, etc.)
        if (self::looksLikeFakeName($nombre)) {
            $score += 1;
            $reasons[] = 'fake_name_pattern';
        }

        // 9) Empresa que es URL o email
        if ($empresa !== '' && preg_match('/https?:\/\/|www\.|@/', $empresa)) {
            $score += 2;
            $reasons[] = 'empresa_url_or_email';
        }

        return [
            'spam' => $score >= self::SCORE_THRESHOLD,
            'reasons' => $reasons,
            'score' => $score,
        ];
    }

    private static function signTimestamp(string $ts): string
    {
        $salt = function_exists('getEnvVar')
            ? getEnvVar('APP_SALT', 'default_salt_change_in_production')
            : 'default_salt_change_in_production';

        return hash_hmac('sha256', $ts, $salt);
    }

    private static function evaluateTiming($tsRaw, $sigRaw): array
    {
        $ts = is_string($tsRaw) ? trim($tsRaw) : '';
        $sig = is_string($sigRaw) ? trim($sigRaw) : '';

        if ($ts === '' || $sig === '' || !ctype_digit($ts)) {
            return ['hard_fail' => true, 'score' => 100, 'reason' => 'missing_timing'];
        }

        $expected = self::signTimestamp($ts);
        if (!hash_equals($expected, $sig)) {
            return ['hard_fail' => true, 'score' => 100, 'reason' => 'bad_timing_sig'];
        }

        $age = time() - (int) $ts;

        if ($age < 0) {
            return ['hard_fail' => true, 'score' => 100, 'reason' => 'future_timing'];
        }

        if ($age > self::MAX_SECONDS) {
            return ['hard_fail' => true, 'score' => 100, 'reason' => 'expired_timing'];
        }

        if ($age < self::MIN_SECONDS) {
            return ['hard_fail' => false, 'score' => 5, 'reason' => 'too_fast'];
        }

        return ['hard_fail' => false, 'score' => 0, 'reason' => ''];
    }

    /**
     * Detecta números NANP / +1 típicos de spam USA.
     * No bloquea +54 ni locales argentinos (379, 11, 15, etc.).
     */
    public static function looksLikeUsPhone(string $phone): bool
    {
        $digits = preg_replace('/\D+/', '', $phone);
        if ($digits === null || $digits === '') {
            return false;
        }

        // Prefijo explícito Argentina → no es US
        if (strpos($digits, '54') === 0 && strlen($digits) >= 10) {
            return false;
        }

        // +1 + 10 dígitos NANP
        if (preg_match('/^1\d{10}$/', $digits)) {
            return true;
        }

        // 10 dígitos con área US válida (2-9 en NXX) y sin 0/1 inicial de AR
        // Evitar falsos positivos con móviles AR de 10 dígitos (ej. 3794123456)
        // Heurística: si el usuario escribió "+1" o "(xxx) xxx-xxxx" estilo US en el texto original
        if (preg_match('/^\+?\s*1[\s\-\.]?\(?\d{3}\)?[\s\-\.]?\d{3}[\s\-\.]?\d{4}$/', trim($phone))) {
            return true;
        }

        // Formato literal con paréntesis estilo US: (305) 555-1234
        if (preg_match('/^\(\d{3}\)\s*\d{3}[\-\s]?\d{4}$/', trim($phone))) {
            return true;
        }

        return false;
    }

    private static function scoreMessage(string $message): array
    {
        $reasons = [];
        $score = 0;
        $lower = mb_strtolower($message, 'UTF-8');

        foreach (self::$englishSpamPhrases as $phrase) {
            if (strpos($lower, $phrase) !== false) {
                $score += 3;
                $reasons[] = 'english_spam';
                break;
            }
        }

        // Muchas palabras inglesas comunes y casi nada de español
        $englishHits = preg_match_all(
            '/\b(the|and|your|our|we|you|services|company|business|website|please|interested|solution|marketing|seo|agency|offer|looking|partnership)\b/i',
            $message
        );
        $spanishHits = preg_match_all(
            '/\b(hola|buenas|consulta|necesito|quiero|empresa|presupuesto|gracias|información|informacion|sistema|tango|soporte|demo|cotización|cotizacion|necesito|podrían|podrian|ustedes|negocio)\b/iu',
            $message
        );

        if ($englishHits >= 4 && $spanishHits === 0) {
            $score += 3;
            if (!in_array('english_spam', $reasons, true)) {
                $reasons[] = 'english_spam';
            }
            $reasons[] = 'english_only';
        }

        return ['score' => $score, 'reasons' => $reasons];
    }

    private static function isDisposableEmail(string $email): bool
    {
        if ($email === '' || strpos($email, '@') === false) {
            return false;
        }

        $domain = substr(strrchr($email, '@'), 1);
        $blocked = [
            'mailinator.com',
            'guerrillamail.com',
            'tempmail.com',
            'temp-mail.org',
            '10minutemail.com',
            'yopmail.com',
            'trashmail.com',
            'sharklasers.com',
            'getnada.com',
            'discard.email',
        ];

        return in_array($domain, $blocked, true);
    }

    private static function looksLikeFakeName(string $name): bool
    {
        if ($name === '') {
            return false;
        }

        // Todo mayúsculas con más de una palabra corta tipo "JOHN SMITH DOE"
        if ($name === strtoupper($name) && preg_match('/^[A-Z]{2,}(\s+[A-Z]{2,}){1,}$/', $name)) {
            return true;
        }

        // Sin vocales en alguna "palabra" de 5+ letras
        $parts = preg_split('/\s+/', $name) ?: [];
        foreach ($parts as $part) {
            if (mb_strlen($part, 'UTF-8') >= 5 && !preg_match('/[aeiouáéíóúAEIOUÁÉÍÓÚ]/u', $part)) {
                return true;
            }
        }

        return false;
    }
}

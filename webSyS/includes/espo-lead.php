<?php
/**
 * Integración opcional con EspoCRM.
 *
 * La ausencia o falla de EspoCRM nunca debe interrumpir el envío del formulario.
 */

function espoCreateLead(array $data): bool
{
    $baseUrl = trim((string) getEnvVar('ESPOCRM_URL', ''));
    $apiKey = trim((string) getEnvVar('ESPOCRM_API_KEY', ''));

    if ($baseUrl === '' || $apiKey === '') {
        SimpleLogger::warning('Integración EspoCRM no configurada; no se creó el Lead', [
            'origen' => $data['origen'] ?? 'unknown',
        ]);
        return false;
    }

    if (!function_exists('curl_init')) {
        SimpleLogger::warning('Extensión cURL no disponible; no se creó el Lead en EspoCRM', [
            'origen' => $data['origen'] ?? 'unknown',
        ]);
        return false;
    }

    $nameParts = preg_split('/\s+/', trim((string) ($data['nombre'] ?? '')), 2);
    $firstName = $nameParts[0] ?? '';
    $lastName = $nameParts[1] ?? '';

    $description = (string) ($data['mensaje'] ?? '');
    $description .= "\n\nAsunto: " . ($data['asunto'] ?? '');
    $description .= "\nOrigen: " . ($data['origen'] ?? '');
    $description .= "\nCómo se enteró: " . ($data['como_se_entero'] ?? '');
    $description .= "\nFecha: " . ($data['fecha'] ?? date('Y-m-d H:i:s'));

    $payload = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'emailAddress' => $data['email'] ?? '',
        'phoneNumber' => $data['telefono'] ?? '',
        'accountName' => $data['empresa'] ?? '',
        'title' => $data['puesto'] ?? '',
        'source' => 'Web Site',
        'status' => 'New',
        'description' => $description,
    ];

    $jsonPayload = json_encode($payload, JSON_UNESCAPED_UNICODE);
    if ($jsonPayload === false) {
        SimpleLogger::warning('No se pudo serializar el Lead para EspoCRM', [
            'origen' => $data['origen'] ?? 'unknown',
        ]);
        return false;
    }

    $curl = curl_init(rtrim($baseUrl, '/') . '/api/v1/Lead');
    curl_setopt_array($curl, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Accept: application/json',
            'X-Api-Key: ' . $apiKey,
        ],
        CURLOPT_POSTFIELDS => $jsonPayload,
    ]);

    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    $statusCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($response === false || $curlError !== '') {
        SimpleLogger::warning('Error de conexión al crear Lead en EspoCRM', [
            'error' => $curlError,
            'origen' => $data['origen'] ?? 'unknown',
        ]);
        return false;
    }

    $responseData = json_decode($response, true);
    if (
        $statusCode < 200 ||
        $statusCode >= 300 ||
        !is_array($responseData) ||
        empty($responseData['id'])
    ) {
        SimpleLogger::warning('EspoCRM rechazó la creación del Lead', [
            'http_status' => $statusCode,
            'origen' => $data['origen'] ?? 'unknown',
        ]);
        return false;
    }

    SimpleLogger::info('Lead creado exitosamente en EspoCRM', [
        'lead_id' => $responseData['id'],
        'origen' => $data['origen'] ?? 'unknown',
    ]);

    return true;
}

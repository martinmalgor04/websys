<?php
/**
 * Sirve el instalador SysDesk con headers de descarga correctos.
 * El .exe debe estar en: assets/downloads/SysDesk.exe (misma carpeta que index.php).
 */
declare(strict_types=1);

$installer = __DIR__ . '/assets/downloads/SysDesk.exe';

if (!is_file($installer) || !is_readable($installer)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    header('Cache-Control: no-store');
    exit('El instalador no está disponible en el servidor. Contactá a soporte.');
}

$size = filesize($installer);
if ($size === false) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    exit('No se pudo leer el instalador.');
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="SysDesk.exe"');
header('Content-Length: ' . (string) $size);
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');
header('X-Content-Type-Options: nosniff');

if (ob_get_level()) {
    ob_end_clean();
}

readfile($installer);
exit;

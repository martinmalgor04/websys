<?php
/**
 * Router simple para desarrollo local con PHP built-in server
 * Simula las reglas de .htaccess para URLs limpias
 */

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Eliminar slash inicial
$path = ltrim($path, '/');

// Si no hay path, servir index.php
if (empty($path) || $path === '/') {
    include 'index.php';
    return;
}

// Si el archivo existe directamente, servirlo
if (file_exists($path)) {
    return false; // Dejar que PHP sirva el archivo
}

// Si existe el archivo .php correspondiente, incluirlo
$phpFile = $path . '.php';
if (file_exists($phpFile)) {
    include $phpFile;
    return;
}

// Si no se encuentra nada, mostrar 404
http_response_code(404);
include '404.php';
?>
<?php
// index.php - punto de entrada

// Mostrar errores en pantalla (útil en desarrollo; quítalo al publicar)
ini_set('display_errors', '1');
ini_set('html_errors', '0');
error_reporting(E_ALL);

require_once __DIR__ . '/conexion.php';                  // Conexión PDO ($conexion)
require_once __DIR__ . '/controllers/SiteController.php';

try {
    // Instanciamos el controlador pasándole la conexión
    $controlador = new SiteController($conexion);

    // Ejecutamos la lógica de la aplicación
    $controlador->manejarPeticion();
} catch (Throwable $e) {
    http_response_code(500);
    echo "<pre>Error: " . htmlspecialchars($e->getMessage())
       . "\nArchivo: " . htmlspecialchars(basename($e->getFile()))
       . " (línea " . $e->getLine() . ")</pre>";
}

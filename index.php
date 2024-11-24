<?php
require_once 'db.php';

// Rutas
if (preg_match('/\/usuarios/i', $_SERVER['REQUEST_URI'])) {
    require_once 'routes/usuarios.php';
} elseif (preg_match('/\/actividades/i', $_SERVER['REQUEST_URI'])) {
    require_once 'routes/actividades.php';
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Ruta no encontrada']);
}
?>

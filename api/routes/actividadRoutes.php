<?php
require_once 'controllers/ActividadController.php';

$controller = new ActividadController($pdo);

// Crear actividad
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['id' => $controller->crear($data)]);
}

// Obtener todas las actividades
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
    echo json_encode($controller->obtenerTodas());
}

// Obtener una actividad por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    echo json_encode($controller->obtenerPorId($_GET['id']));
}

// Actualizar actividad
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    parse_str(file_get_contents('php://input'), $_PUT);
    echo json_encode(['updated' => $controller->actualizar($_PUT['id'], $data)]);
}

// Eliminar actividad
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    echo json_encode(['deleted' => $controller->eliminar($_DELETE['id'])]);
}

<?php
require_once 'controllers/UsuarioController.php';

$controller = new UsuarioController($pdo);

// Crear usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['id' => $controller->crear($data)]);
}

// Obtener todos los usuarios
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['id'])) {
    echo json_encode($controller->obtenerTodos());
}

// Obtener un usuario por ID
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    echo json_encode($controller->obtenerPorId($_GET['id']));
}

// Actualizar usuario
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    parse_str(file_get_contents('php://input'), $_PUT);
    echo json_encode(['updated' => $controller->actualizar($_PUT['id'], $data)]);
}

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents('php://input'), $_DELETE);
    echo json_encode(['deleted' => $controller->eliminar($_DELETE['id'])]);
}

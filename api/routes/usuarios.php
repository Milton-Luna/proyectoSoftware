<?php
require_once '../controllers/UsuarioController.php';

$controller = new UsuarioController($pdo);

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode($controller->obtenerPorId($_GET['id']));
        } else {
            echo json_encode($controller->obtenerTodos());
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['id' => $controller->crear($data)]);
        break;

    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        parse_str(file_get_contents('php://input'), $_PUT);
        echo json_encode(['updated' => $controller->actualizar($_PUT['id'], $data)]);
        break;

    case 'DELETE':
        parse_str(file_get_contents('php://input'), $_DELETE);
        echo json_encode(['deleted' => $controller->eliminar($_DELETE['id'])]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Método no permitido']);
        break;
}
?>

<?php
require_once '../controllers/EventController.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    EventController::getAllEvents();
} elseif ($method === 'POST') {
    EventController::createEvent();
} else {
    echo json_encode(['error' => 'Método no soportado']);
}

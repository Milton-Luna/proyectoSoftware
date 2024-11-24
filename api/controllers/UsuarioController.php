<?php
require_once 'models/Usuario.php';

class UsuarioController {
    private $usuario;

    public function __construct($pdo) {
        $this->usuario = new Usuario($pdo);
    }

    public function crear($data) {
        return $this->usuario->crear($data['id_rol'],
        $data['id_persona'], $data['correo'],
        $data['contrasena']);
    }

    public function obtenerTodos() {
        return $this->usuario->obtenerTodos();
    }

    public function obtenerPorId($id) {
        return $this->usuario->obtenerPorId($id);
    }

    public function actualizar($id, $data) {
        return $this->usuario->actualizar($id, $data['id_rol'],
        $data['id_persona'], $data['correo'],
        $data['contrasena']);
    }

    public function eliminar($id) {
        return $this->usuario->eliminar($id);
    }
}


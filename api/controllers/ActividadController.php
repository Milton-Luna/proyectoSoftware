<?php
require_once 'models/Actividad.php';

class ActividadController {
    private $actividad;

    public function __construct($pdo) {
        $this->actividad = new Actividad($pdo);
    }

    public function crear($data) {
        return $this->actividad->crear($data['titulo'],
        $data['id_fecha'], $data['id_notas'],
        $data['id_tipo_actividad']);
    }

    public function obtenerTodas() {
        return $this->actividad->obtenerTodas();
    }

    public function obtenerPorId($id) {
        return $this->actividad->obtenerPorId($id);
    }

    public function actualizar($id, $data) {
        return $this->actividad->actualizar($id,
        $data['titulo'], $data['id_fecha'],
        $data['id_notas'], 
        $data['id_tipo_actividad']);
    }

    public function eliminar($id) {
        return $this->actividad->eliminar($id);
    }
}

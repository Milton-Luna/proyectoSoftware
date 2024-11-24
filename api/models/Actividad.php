<?php
require_once 'db.php';

class Actividad {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear($titulo, $id_fecha, $id_notas, $id_tipo_actividad) {
        $sql = "INSERT INTO ACTIVIDADES (TITULO, ID_FECHA, ID_NOTAS, ID_TIPO_ACTIVIDAD) 
                VALUES (:titulo, :id_fecha, :id_notas, :id_tipo_actividad)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':id_fecha' => $id_fecha,
            ':id_notas' => $id_notas,
            ':id_tipo_actividad' => $id_tipo_actividad
        ]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerTodas() {
        $sql = "SELECT * FROM ACTIVIDADES";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM ACTIVIDADES WHERE ID_ACTIVIDADES = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $titulo, $id_fecha, $id_notas, $id_tipo_actividad) {
        $sql = "UPDATE ACTIVIDADES SET TITULO = :titulo, ID_FECHA = :id_fecha, 
                ID_NOTAS = :id_notas, ID_TIPO_ACTIVIDAD = :id_tipo_actividad 
                WHERE ID_ACTIVIDADES = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':titulo' => $titulo,
            ':id_fecha' => $id_fecha,
            ':id_notas' => $id_notas,
            ':id_tipo_actividad' => $id_tipo_actividad,
            ':id' => $id
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM ACTIVIDADES WHERE ID_ACTIVIDADES = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }
}

<?php
require_once 'db.php';

class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crear($id_rol, $id_persona, $correo, $contrasena) {
        $sql = "INSERT INTO Usuario (ID_ROL, ID_PERSONA, CORREO, CONTRASEÑA) 
                VALUES (:id_rol, :id_persona, :correo, :contrasena)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_rol' => $id_rol,
            ':id_persona' => $id_persona,
            ':correo' => $correo,
            ':contrasena' => password_hash($contrasena, PASSWORD_BCRYPT) // Encriptar contraseña
        ]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerTodos() {
        $sql = "SELECT Usuario.*, PERSONA.NOMBRE, ROL.ROL 
                FROM Usuario 
                JOIN PERSONA ON Usuario.ID_PERSONA = PERSONA.ID_PERSONA
                JOIN ROL ON Usuario.ID_ROL = ROL.ID_ROL";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT Usuario.*, PERSONA.NOMBRE, ROL.ROL 
                FROM Usuario 
                JOIN PERSONA ON Usuario.ID_PERSONA = PERSONA.ID_PERSONA
                JOIN ROL ON Usuario.ID_ROL = ROL.ID_ROL
                WHERE Usuario.ID_USUARIO = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $id_rol, $id_persona, $correo, $contrasena) {
        $sql = "UPDATE Usuario SET 
                ID_ROL = :id_rol, 
                ID_PERSONA = :id_persona, 
                CORREO = :correo, 
                CONTRASEÑA = :contrasena 
                WHERE ID_USUARIO = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id_rol' => $id_rol,
            ':id_persona' => $id_persona,
            ':correo' => $correo,
            ':contrasena' => password_hash($contrasena, PASSWORD_BCRYPT),
            ':id' => $id
        ]);
        return $stmt->rowCount();
    }

    public function eliminar($id) {
        $sql = "DELETE FROM Usuario WHERE ID_USUARIO = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }
}

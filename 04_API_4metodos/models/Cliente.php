<?php

require_once 'connection/Connection.php';

class Cliente {
    private $conn;
    private $tableName = 'clientes';

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->getConnection();
    }

    // Obtener todos los registros
    public function getAll() {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener un registro por ID
    public function getOne($id) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    // Insertar un nuevo registro
    public function insert($data) {
        $query = "INSERT INTO " . $this->tableName . " (nombre, apellidos, fecha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $data['nombre']);
        $stmt->bindParam(2, $data['apellidos']);
        $stmt->bindParam(3, $data['fecha']);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Actualizar un registro existente
    public function update($id, $data) {
        $query = "UPDATE " . $this->tableName . " SET nombre = ?, apellidos = ?, fecha = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $data['nombre']);
        $stmt->bindParam(2, $data['apellidos']);
        $stmt->bindParam(3, $data['fecha']);
        $stmt->bindParam(4, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Eliminar un registro
    public function delete($id) {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

<?php

require_once 'connection/Data.php';

class Connection {
    private $host = DB_IP;
    private $port = DB_PORT;
    private $dbName = DB_BD;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conn;

    // get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            // Construir la parte inicial del DSN
            $dsn = "mysql:host=" . $this->host;
            $dsn .= ";port=" . $this->port;
            $dsn .= ";dbname=" . $this->dbName;
            $dsn .= ";charset=utf8mb4";

            // Opciones de configuración PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            // Crear la conexión PDO
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);

            // Establecer el conjunto de caracteres y el cotejamiento
            $this->conn->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");

            // Conexion ok
            // echo "Connection ok";
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

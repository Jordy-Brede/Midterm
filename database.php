<?php
class Database {
    private $host = "localhost";
    private $db_name = "quotesdb";
    private $username = "your_db_user";
    private $password = "your_db_password";
    private $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo json_encode(["message" => "Database Connection Error: " . $e->getMessage()]);
            exit;
        }
        return $this->conn;
    }
}

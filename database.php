<?php

/**
 * OMAA Database Helper
 * A simplified PDO wrapper to make CRUD operations safer and faster.
 */

class Database {
    private $host = "localhost";
    private $db_name = "your_db_name";
    private $username = "your_username";
    private $password = "your_password";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Connection Error: " . $e->getMessage());
        }
    }

    /**
     * Executes a query safely (handles prepared statements automatically)
     */
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    /**
     * Fetch a single row
     */
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }

    /**
     * Fetch multiple rows
     */
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
}

// --- Usage Example ---
// $db = new Database();
// $user = $db->fetch("SELECT * FROM users WHERE id = ?", [1]);

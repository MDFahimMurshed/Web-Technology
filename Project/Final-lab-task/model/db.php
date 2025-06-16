<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "hospital_management";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function registerAdmin($fullname, $email, $username, $password) {
        $stmt = $this->conn->prepare("INSERT INTO admins (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);
        return $stmt->execute();
    }

    public function validateAdmin($username, $password) {
        $stmt = $this->conn->prepare("SELECT id, username, password FROM admins WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                return $admin;
            }
        }
        return false;
    }

    public function close() {
        $this->conn->close();
    }
}
?>
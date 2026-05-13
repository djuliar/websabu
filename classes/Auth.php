<?php
class Auth {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function register($name, $email, $password) {
        $name = trim($name);
        $email = trim($email);
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah email sudah terdaftar
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return false; // Email sudah terdaftar
        }

        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        return $stmt->execute();
    }

    public function login($email, $password) {
        $email = trim($email);

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['name'];
                return true; // Login berhasil
            }
        }
        return false; // Login gagal
    }
}
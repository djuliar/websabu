<?php
class Database {
    // Konfigurasi database
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "websabu";
    
    // Properti untuk koneksi database
    public $conn;

    public function __construct() {
        // Inisialisasi koneksi saat objek dibuat
        $this->getConnection();
    }

    public function getConnection() {
        // Membuat koneksi ke database dengan error handling
        try {
            $this->conn = new mysqli(
                $this->host, $this->user, $this->pass, $this->db
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $this->conn;
    }
}
?>
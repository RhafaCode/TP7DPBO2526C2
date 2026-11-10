<?php

// membuat kelas database untuk koneksi pdo
class Database {
    // atribut penampung host database
    private $host = "localhost";
    // atribut penampung nama database
    private $db_name = "db_kursus";
    // atribut penampung username database
    private $username = "root";
    // atribut penampung password database
    private $password = "";
    // atribut koneksi pdo
    private $conn;

    // fungsi untuk mengkoneksikan pdo ke database
    public function getConnection() {
        // mengosongkan nilai koneksi awal
        $this->conn = null;

        // mencoba menghubungkan koneksi pdo
        try {
            // inisialisasi koneksi pdo
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            // mengatur mode error ke mode exception (konstanta pdo wajib uppercase)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // mengatur mode fetch bawaan menjadi array asosiatif (konstanta pdo wajib uppercase)
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // menghentikan program jika koneksi gagal
            die("koneksi database gagal: " . $e->getMessage());
        }

        // mengembalikan objek koneksi pdo
        return $this->conn;
    }
}
<?php

// membuat kelas instructor untuk logika crud tabel instructors
class instructor {

    // atribut menyimpan koneksi pdo
    private $conn;

    // atribut nama tabel
    private $table_name = "instructors";

    // konstruktor kelas menerima instansi pdo
    public function __construct($db) {
        // menyimpan objek pdo
        $this->conn = $db;
    }

    // fungsi mengunduh seluruh data instruktur berurutan id asc
    public function readall() {
        // perintah query select seluruh instruktur berurutan id asc
        $query = "select * from " . $this->table_name . " order by id asc";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // jalankan query
        $stmt->execute();

        // kembalikan seluruh baris data
        return $stmt->fetchall();
    }

    // fungsi membaca data instruktur spesifik
    public function readone($id) {
        // query select berdasar id
        $query = "select * from " . $this->table_name . " where id = ?";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // jalankan query dengan id
        $stmt->execute([$id]);

        // kembalikan baris tunggal
        return $stmt->fetch();
    }

    // fungsi membuat instruktur baru
    public function create($name, $email, $phone) {
        // query insert instruktur
        $query = "insert into " . $this->table_name . " (name, email, phone) values (?, ?, ?)";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // eksekusi penambahan data
        return $stmt->execute([$name, $email, $phone]);
    }

    // fungsi mengubah instruktur
    public function update($id, $name, $email, $phone) {
        // query update instruktur
        $query = "update " . $this->table_name . " set name = ?, email = ?, phone = ? where id = ?";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // eksekusi perbaikan data
        return $stmt->execute([$name, $email, $phone, $id]);
    }

    // fungsi menghapus data instruktur
        public function delete($id) {
            $query = "delete from " . $this->table_name . " where id = ?";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([$id]);

            // meriset auto_increment
            $this->conn->query("alter table " . $this->table_name . " auto_increment = 1");

            return $result;
        }
}
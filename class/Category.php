<?php

// membuat kelas category untuk logika crud tabel categories
class category {

    // atribut menyimpan objek pdo
    private $conn;

    // atribut nama tabel
    private $table_name = "categories";

    // konstruktor menerima objek pdo
    public function __construct($db) {
        // menetapkan koneksi ke atribut lokal
        $this->conn = $db;
    }

    // fungsi membaca semua data kategori berurutan id asc
    public function readall() {
        // perintah query mengambil seluruh data berurutan dari id terkecil
        $query = "select * from " . $this->table_name . " order by id asc";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi query
        $stmt->execute();

        // mengembalikan hasil array data
        return $stmt->fetchall();
    }

    // fungsi membaca satu data kategori
    public function readone($id) {
        // perintah query mengambil data berdasarkan id
        $query = "select * from " . $this->table_name . " where id = ?";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi query dengan parameter id
        $stmt->execute([$id]);

        // mengembalikan satu baris data
        return $stmt->fetch();
    }

    // fungsi menambah data kategori baru
    public function create($name, $description) {
        // perintah query insert data
        $query = "insert into " . $this->table_name . " (name, description) values (?, ?)";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi query tambah data
        return $stmt->execute([$name, $description]);
    }

    // fungsi memperbarui data kategori
    public function update($id, $name, $description) {
        // perintah query update data
        $query = "update " . $this->table_name . " set name = ?, description = ? where id = ?";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi query ubah data
        return $stmt->execute([$name, $description, $id]);
    }

    // fungsi menghapus data kategori
        public function delete($id) {
            $query = "delete from " . $this->table_name . " where id = ?";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([$id]);

            // meriset auto_increment
            $this->conn->query("alter table " . $this->table_name . " auto_increment = 1");

            return $result;
        }
}
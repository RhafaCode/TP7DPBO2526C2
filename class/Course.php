<?php

// membuat kelas course untuk mengelola data relasi kursus
class course {

    // atribut menyimpan pdo
    private $conn;

    // atribut nama tabel utama
    private $table_name = "courses";

    // konstruktor penampung koneksi pdo
    public function __construct($db) {
        // simpan pdo ke variabel lokal
        $this->conn = $db;
    }

    // fungsi membaca data kursus gabungan tabel relasi berurutan id asc
    public function readall() {
        // query join tabel courses dengan instructors dan categories berurutan id asc
        $query = "select c.*, i.name as instructor_name, cat.name as category_name
                  from " . $this->table_name . " c
                  join instructors i on c.instructor_id = i.id
                  join categories cat on c.category_id = cat.id
                  order by c.id asc";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi query join
        $stmt->execute();

        // mengembalikan semua baris relasi
        return $stmt->fetchall();
    }

    // fungsi membaca satu data kursus
    public function readone($id) {
        // query select kursus berdasarkan id
        $query = "select * from " . $this->table_name . " where id = ?";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi query id
        $stmt->execute([$id]);

        // mengembalikan satu baris data kursus
        return $stmt->fetch();
    }

    // fungsi menambah data kursus baru beserta foreign key
    public function create($title, $description, $price, $instructor_id, $category_id) {
        // query insert data kursus
        $query = "insert into " . $this->table_name . " (title, description, price, instructor_id, category_id) values (?, ?, ?, ?, ?)";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi masukan data kursus
        return $stmt->execute([$title, $description, $price, $instructor_id, $category_id]);
    }

    // fungsi memperbarui data kursus
    public function update($id, $title, $description, $price, $instructor_id, $category_id) {
        // query update data kursus
        $query = "update " . $this->table_name . " set title = ?, description = ?, price = ?, instructor_id = ?, category_id = ? where id = ?";

        // menyiapkan prepared statement
        $stmt = $this->conn->prepare($query);

        // mengeksekusi perubahan data kursus
        return $stmt->execute([$title, $description, $price, $instructor_id, $category_id, $id]);
    }

    // fungsi menghapus data kursus
        public function delete($id) {
            // query delete data kursus
            $query = "delete from " . $this->table_name . " where id = ?";
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute([$id]);

            // meriset auto_increment agar data baru berikutnya melanjutkan id terbesar yang ada
            $this->conn->query("alter table " . $this->table_name . " auto_increment = 1");

            return $result;
        }
}
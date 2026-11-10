# TP7DPBO2526C2
# Janji
Saya Rhafa Farell Valeno dengan NIM 2508020 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Course Management System

Sistem Informasi Manajemen Kursus Online berbasis PHP Native dengan arsitektur Object-Oriented Programming (OOP) dan MySQL PDO (PHP Data Objects). Aplikasi ini menangani pengelolaan data relasional antara tiga entitas utama (*Categories*, *Instructors*, dan *Courses*) dengan dukungan pengujian CRUD lengkap dan kepatuhan penuh terhadap standar PHP 8+.

---

## 1. Spesifikasi Tugas & Ketentuan Praktikum

Proyek ini disusun berdasarkan spesifikasi teknis Tugas Praktikum DPBO:

1. **Pengelolaan 3 Entitas Utama**:
    - `categories`: Menyimpan data kategori bidang studi kursus.
    - `instructors`: Menyimpan data pengajar/instruktur.
    - `courses`: Menyimpan data kursus yang terikat dengan relasi *Foreign Key* ke `categories` dan `instructors`.
2. **Aturan Pengurutan & Format Tampilan Data**:
    - Seluruh data pada tabel diurutkan berdasarkan **`id ASC`** (urutan dari terkecil ke terbesar, sehingga baris data baru selalu berada di posisi paling bawah).
    - Format penulisan nilai harga pada tampilan GUI wajib diawali dengan penulisan **`Rp.`** (contoh: `Rp. 150.000`).
    - Penanganan *Auto Increment* otomatis disesuaikan saat operasi penghapusan data (`ALTER TABLE ... AUTO_INCREMENT = 1`).
3. **Kepatuhan PHP 8+ & Strict Case Sensitivity**:
    - Menggunakan variabel *superglobal* PHP (`$_GET` dan `$_POST`) dengan penulisan huruf kapital secara konsisten.
    - Implementasi pengecekan tipe data `is_array()` pada fungsi pemanggilan data tunggal (`readOne`) untuk mengantisipasi *Fatal Error* pada PHP 8+ jika ID data tidak ditemukan.
4. **Kelengkapan Berkas Pengumpulan**:
    - Berkas skrip basis data: `database/db_kursus.sql`.
    - Berkas dokumentasi pengujian video: `Dokumentasi/gameplay.mp4`.
    - Berkas instruksi & spesifikasi: `README.md`.

---

## 2. Struktur Basis Data (Schema & Relasi)

Basis data bernama `db_kursus` terdiri dari 3 tabel relasional berikut:

### Tabel `categories`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, Auto Increment) | Primary Key entitas kategori |
| `name` | VARCHAR(100) | Nama kategori kursus |
| `description` | TEXT | Deskripsi singkat kategori |

### Tabel `instructors`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, Auto Increment) | Primary Key entitas instruktur |
| `name` | VARCHAR(100) | Nama lengkap instruktur |
| `email` | VARCHAR(100) | Alamat email instruktur |
| `phone` | VARCHAR(20) | Nomor telepon/HP instruktur |

### Tabel `courses`
| Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | INT (PK, Auto Increment) | Primary Key entitas kursus |
| `title` | VARCHAR(150) | Judul materi kursus |
| `description` | TEXT | Deskripsi detail kursus |
| `price` | INT | Harga kursus dalam bentuk angka murni |
| `instructor_id` | INT (FK) | Foreign Key mengacu pada `instructors(id)` |
| `category_id` | INT (FK) | Foreign Key mengacu pada `categories(id)` |

---

## 3. Fitur Sistem & Operasi CRUD

### A. Modul Kategori (`index.php?page=categories`)
- **Create**: Menambahkan data kategori baru melalui formulir input nama dan deskripsi.
- **Read**: Menampilkan seluruh daftar kategori terurut `id ASC`.
- **Update**: Memuat data lama ke dalam formulir berdasarkan parameter `action=edit&id=X`, lalu memperbarui data saat tombol *Update* diklik.
- **Delete**: Menghapus baris data berdasarkan `action=delete&id=X` dan meriset urutan *Auto Increment*.

### B. Modul Instruktur (`index.php?page=instructors`)
- **Create**: Menambahkan data profil instruktur baru (nama, email, nomor telepon).
- **Read**: Menampilkan daftar instruktur terurut `id ASC`.
- **Update**: Mengubah rincian kontak dan profil instruktur.
- **Delete**: Menghapus data profil instruktur.

### C. Modul Kursus (`index.php?page=courses`)
- **Create**: Menambahkan data kursus baru yang memilih data instruktur dan kategori dari menu *dropdown* dinamis.
- **Read**: Menampilkan daftar kursus gabungan (*INNER JOIN*) dengan rincian nama instruktur, nama kategori, serta format harga `Rp. X.XXX.XXX`.
- **Update**: Memilih ulang relasi instruktur/kategori serta memperbarui judul, deskripsi, dan harga.
- **Delete**: Menghapus data kursus terpilih.

---

## 4. Struktur Direktori Proyek

```text
TP7DPBO2526C2/
├── class/
│   ├── Category.php        # Class Model entitas categories (CRUD & ORDER BY id ASC)
│   ├── Course.php          # Class Model entitas courses (Join Table & Relasi FK)
│   └── Instructor.php      # Class Model entitas instructors (CRUD & ORDER BY id ASC)
├── config/
│   └── db.php              # Konfigurasi koneksi PDO MySQL & mode Error Exception
├── database/
│   └── db_kursus.sql       # Skrip SQL penyiapan struktur tabel & data dummy
├── Dokumentasi/
│   └── gameplay.mp4        # Video rekaman layar pengujian alur kerja CRUD
├── view/
│   ├── categories.php      # Form & Tabel Tampilan Manajemen Kategori
│   ├── courses.php         # Form & Tabel Tampilan Manajemen Kursus (Format Rp.)
│   ├── footer.php          # Elemen penutup dokumen HTML & footer
│   ├── header.php          # Elemen navigasi & kepala dokumen HTML
│   └── instructors.php      # Form & Tabel Tampilan Manajemen Instruktur
├── index.php               # Main Controller & Router halaman aplikasi
├── README.md               # Berkas dokumentasi resmi proyek
└── style.css               # Berkas CSS kustom tata letak GUI
<?php

// mengimpor berkas koneksi database
require_once 'config/db.php';

// mengimpor berkas kelas model category
require_once 'class/Category.php';

// mengimpor berkas kelas model instructor
require_once 'class/Instructor.php';

// mengimpor berkas kelas model course
require_once 'class/Course.php';

// menginisialisasi objek database
$database = new Database();

// mengambil koneksi pdo
$db = $database->getConnection();

// membuat objek model (nama variabel huruf kecil)
$categorymodel = new Category($db);
$instructormodel = new Instructor($db);
$coursemodel = new Course($db);

// menentukan halaman aktif dari parameter url
$page = $_GET['page'] ?? 'courses';

// memproses aksi untuk halaman kategori
if ($page == 'categories') {
    if (isset($_POST['create'])) {
        $categorymodel->create($_POST['name'], $_POST['description']);
        header("Location: index.php?page=categories");
        exit;
    } elseif (isset($_POST['update'])) {
        $categorymodel->update($_POST['id'], $_POST['name'], $_POST['description']);
        header("Location: index.php?page=categories");
        exit;
    } elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $categorymodel->delete($_GET['id']);
        header("Location: index.php?page=categories");
        exit;
    }
    $categories = $categorymodel->readAll();
}

// memproses aksi untuk halaman instruktur
if ($page == 'instructors') {
    if (isset($_POST['create'])) {
        $instructormodel->create($_POST['name'], $_POST['email'], $_POST['phone']);
        header("Location: index.php?page=instructors");
        exit;
    } elseif (isset($_POST['update'])) {
        $instructormodel->update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['phone']);
        header("Location: index.php?page=instructors");
        exit;
    } elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $instructormodel->delete($_GET['id']);
        header("Location: index.php?page=instructors");
        exit;
    }
    $instructors = $instructormodel->readAll();
}

// memproses aksi untuk halaman kursus
if ($page == 'courses') {
    if (isset($_POST['create'])) {
        $coursemodel->create($_POST['title'], $_POST['description'], $_POST['price'], $_POST['instructor_id'], $_POST['category_id']);
        header("Location: index.php?page=courses");
        exit;
    } elseif (isset($_POST['update'])) {
        $coursemodel->update($_POST['id'], $_POST['title'], $_POST['description'], $_POST['price'], $_POST['instructor_id'], $_POST['category_id']);
        header("Location: index.php?page=courses");
        exit;
    } elseif (isset($_GET['action']) && $_GET['action'] == 'delete') {
        $coursemodel->delete($_GET['id']);
        header("Location: index.php?page=courses");
        exit;
    }
    $courses = $coursemodel->readAll();
    $instructors = $instructormodel->readAll();
    $categories = $categorymodel->readAll();
}

// memuat elemen header gui
include 'view/header.php';

// memuat elemen konten sesuai rute halaman
if ($page == 'categories') {
    include 'view/categories.php';
} elseif ($page == 'instructors') {
    include 'view/instructors.php';
} else {
    include 'view/courses.php';
}

// memuat elemen footer gui
include 'view/footer.php';
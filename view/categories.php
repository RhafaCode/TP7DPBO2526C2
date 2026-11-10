<?php

// inisialisasi variabel edit data
$edit_data = null;

// mengecek opsi edit pada url dan memastikan data id ada
if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
    // mengambil data dari model
    $fetched = $categorymodel->readone($_GET['id']);
    // validasi memastikan data berupa array
    if ($fetched && is_array($fetched)) {
        $edit_data = $fetched;
    }
}

?>

<!-- judul halaman kategori -->
<h2>manajemen kategori</h2>

<!-- formulir tambah dan ubah data kategori -->
<form action="index.php?page=categories" method="post">
    <!-- input tersembunyi penampung id kategori -->
    <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">

    <!-- grup masukan nama kategori -->
    <div class="form-group">
        <!-- label nama kategori -->
        <label>nama kategori</label>
        <!-- input teks nama kategori -->
        <input type="text" name="name" value="<?= htmlspecialchars($edit_data['name'] ?? '') ?>" required>
    </div>

    <!-- grup masukan deskripsi -->
    <div class="form-group">
        <!-- label deskripsi -->
        <label>deskripsi</label>
        <!-- area teks deskripsi -->
        <textarea name="description" rows="3"><?= htmlspecialchars($edit_data['description'] ?? '') ?></textarea>
    </div>

    <!-- tombol simpan atau pembaruan data -->
    <button type="submit" name="<?= $edit_data ? 'update' : 'create' ?>" class="btn btn-primary">
        <?= $edit_data ? 'update kategori' : 'tambah kategori' ?>
    </button>

    <!-- tombol batal saat mode edit -->
    <?php if ($edit_data): ?>
        <!-- tautan pembatalan edit -->
        <a href="index.php?page=categories" class="btn btn-danger">batal</a>
    <?php endif; ?>
</form>

<!-- tabel menampilkan daftar data kategori -->
<table>
    <!-- kepala tabel -->
    <thead>
        <!-- baris judul kolom -->
        <tr>
            <!-- kolom id -->
            <th>id</th>
            <!-- kolom nama kategori -->
            <th>nama kategori</th>
            <!-- kolom deskripsi -->
            <th>deskripsi</th>
            <!-- kolom tombol aksi -->
            <th>aksi</th>
        </tr>
    </thead>
    <!-- badan tabel -->
    <tbody>
        <!-- perulangan menampilkan data kategori -->
        <?php foreach ($categories as $cat): ?>
        <!-- baris data kategori -->
        <tr>
            <!-- menampilkan id kategori -->
            <td><?= $cat['id'] ?></td>
            <!-- menampilkan nama kategori -->
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <!-- menampilkan deskripsi kategori -->
            <td><?= htmlspecialchars($cat['description']) ?></td>
            <!-- kolom berisi aksi edit dan hapus -->
            <td>
                <!-- tombol ubah data -->
                <a href="index.php?page=categories&action=edit&id=<?= $cat['id'] ?>" class="btn btn-warning">edit</a>
                <!-- tombol hapus data dengan konfirmasi -->
                <a href="index.php?page=categories&action=delete&id=<?= $cat['id'] ?>" class="btn btn-danger" onclick="return confirm('hapus kategori ini?')">hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
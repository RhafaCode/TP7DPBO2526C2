<?php

// inisialisasi variabel edit data
$edit_data = null;

// mengecek apakah ada aksi edit dari url dan pastikan data id terisi
if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
    // mengambil data instruktur berdasarkan id
    $fetched = $instructormodel->readone($_GET['id']);
    // validasi hasil fetch wajib berupa array agar tidak fatal error jika id tidak ada
    if ($fetched && is_array($fetched)) {
        $edit_data = $fetched;
    }
}

?>

<!-- judul bagian manajemen instruktur -->
<h2>manajemen instruktur</h2>

<!-- formulir tambah dan ubah instruktur -->
<form action="index.php?page=instructors" method="post">
    <!-- id tersembunyi instruktur -->
    <input type="hidden" name="id" value="<?= is_array($edit_data) ? $edit_data['id'] : '' ?>">

    <!-- grup masukan nama -->
    <div class="form-group">
        <!-- label nama -->
        <label>nama lengkap</label>
        <!-- input nama lengkap -->
        <input type="text" name="name" value="<?= is_array($edit_data) ? htmlspecialchars($edit_data['name']) : '' ?>" required>
    </div>

    <!-- grup masukan email -->
    <div class="form-group">
        <!-- label email -->
        <label>email</label>
        <!-- input alamat email -->
        <input type="email" name="email" value="<?= is_array($edit_data) ? htmlspecialchars($edit_data['email']) : '' ?>" required>
    </div>

    <!-- grup masukan telepon -->
    <div class="form-group">
        <!-- label telepon -->
        <label>no. hp / telepon</label>
        <!-- input nomor telepon -->
        <input type="text" name="phone" value="<?= is_array($edit_data) ? htmlspecialchars($edit_data['phone']) : '' ?>">
    </div>

    <!-- tombol simpan data -->
    <button type="submit" name="<?= $edit_data ? 'update' : 'create' ?>" class="btn btn-primary">
        <?= $edit_data ? 'update instruktur' : 'tambah instruktur' ?>
    </button>

    <!-- opsi batal edit -->
    <?php if ($edit_data): ?>
        <!-- tombol pembatalan edit -->
        <a href="index.php?page=instructors" class="btn btn-danger">batal</a>
    <?php endif; ?>
</form>

<!-- tabel daftar instruktur -->
<table>
    <!-- kepala tabel instruktur -->
    <thead>
        <!-- baris judul kolom -->
        <tr>
            <!-- kolom id -->
            <th>id</th>
            <!-- kolom nama -->
            <th>nama</th>
            <!-- kolom email -->
            <th>email</th>
            <!-- kolom telepon -->
            <th>telepon</th>
            <!-- kolom aksi -->
            <th>aksi</th>
        </tr>
    </thead>
    <!-- badan tabel instruktur -->
    <tbody>
        <!-- perulangan data instruktur -->
        <?php if (!empty($instructors) && is_array($instructors)): ?>
            <?php foreach ($instructors as $ins): ?>
            <!-- baris data instruktur -->
            <tr>
                <!-- menampilkan id -->
                <td><?= $ins['id'] ?></td>
                <!-- menampilkan nama -->
                <td><?= htmlspecialchars($ins['name']) ?></td>
                <!-- menampilkan email -->
                <td><?= htmlspecialchars($ins['email']) ?></td>
                <!-- menampilkan telepon -->
                <td><?= htmlspecialchars($ins['phone']) ?></td>
                <!-- kolom tombol aksi -->
                <td>
                    <!-- tombol ubah data -->
                    <a href="index.php?page=instructors&action=edit&id=<?= $ins['id'] ?>" class="btn btn-warning">edit</a>
                    <!-- tombol hapus data -->
                    <a href="index.php?page=instructors&action=delete&id=<?= $ins['id'] ?>" class="btn btn-danger" onclick="return confirm('hapus instruktur ini?')">hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
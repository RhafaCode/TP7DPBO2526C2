<?php

// inisialisasi variabel edit data
$edit_data = null;

// mengecek opsi edit pada url dan memastikan data id ada
if (isset($_GET['action']) && $_GET['action'] == 'edit' && !empty($_GET['id'])) {
    // mengambil data dari model
    $fetched = $coursemodel->readone($_GET['id']);
    // validasi memastikan data berupa array agar php 8 tidak crash jika id tidak ditemukan
    if ($fetched && is_array($fetched)) {
        $edit_data = $fetched;
    }
}

?>

<!-- judul halaman manajemen kursus -->
<h2>manajemen kursus</h2>

<!-- formulir tambah dan ubah kursus -->
<form action="index.php?page=courses" method="post">
    <!-- id tersembunyi kursus -->
    <input type="hidden" name="id" value="<?= is_array($edit_data) ? $edit_data['id'] : '' ?>">

    <!-- grup masukan judul -->
    <div class="form-group">
        <!-- label judul kursus -->
        <label>judul kursus</label>
        <!-- input teks judul kursus -->
        <input type="text" name="title" value="<?= is_array($edit_data) ? htmlspecialchars($edit_data['title']) : '' ?>" required>
    </div>

    <!-- grup masukan harga -->
    <div class="form-group">
        <!-- label harga kursus -->
        <label>harga (rp)</label>
        <!-- input angka harga -->
        <input type="number" name="price" value="<?= is_array($edit_data) ? $edit_data['price'] : 0 ?>" required>
    </div>

    <!-- grup masukan relasi instruktur -->
    <div class="form-group">
        <!-- label instruktur -->
        <label>instruktur</label>
        <!-- pilihan dropdown instruktur -->
        <select name="instructor_id" required>
            <!-- opsi default pilih instruktur -->
            <option value="">-- pilih instruktur --</option>
            <!-- perulangan opsi instruktur -->
            <?php foreach ($instructors as $ins): ?>
                <!-- opsi instruktur dengan pengecekan terpilih -->
                <option value="<?= $ins['id'] ?>" <?= (is_array($edit_data) && $edit_data['instructor_id'] == $ins['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ins['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- grup masukan relasi kategori -->
    <div class="form-group">
        <!-- label kategori -->
        <label>kategori</label>
        <!-- pilihan dropdown kategori -->
        <select name="category_id" required>
            <!-- opsi default pilih kategori -->
            <option value="">-- pilih kategori --</option>
            <!-- perulangan opsi kategori -->
            <?php foreach ($categories as $cat): ?>
                <!-- opsi kategori dengan pengecekan terpilih -->
                <option value="<?= $cat['id'] ?>" <?= (is_array($edit_data) && $edit_data['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- grup masukan deskripsi -->
    <div class="form-group">
        <!-- label deskripsi -->
        <label>deskripsi</label>
        <!-- area teks deskripsi kursus -->
        <textarea name="description" rows="3"><?= is_array($edit_data) ? htmlspecialchars($edit_data['description']) : '' ?></textarea>
    </div>

    <!-- tombol submit formulir -->
    <button type="submit" name="<?= $edit_data ? 'update' : 'create' ?>" class="btn btn-primary">
        <?= $edit_data ? 'update kursus' : 'tambah kursus' ?>
    </button>

    <!-- opsi pembatalan edit -->
    <?php if ($edit_data): ?>
        <!-- tombol batal -->
        <a href="index.php?page=courses" class="btn btn-danger">batal</a>
    <?php endif; ?>
</form>

<!-- tabel data kursus -->
<table>
    <!-- kepala tabel kursus -->
    <thead>
        <!-- baris judul kolom -->
        <tr>
            <!-- kolom id -->
            <th>id</th>
            <!-- kolom judul -->
            <th>judul</th>
            <!-- kolom harga -->
            <th>harga</th>
            <!-- kolom instruktur -->
            <th>instruktur</th>
            <!-- kolom kategori -->
            <th>kategori</th>
            <!-- kolom aksi -->
            <th>aksi</th>
        </tr>
    </thead>
    <!-- badan tabel kursus -->
    <tbody>
        <!-- perulangan data kursus -->
        <?php if (!empty($courses) && is_array($courses)): ?>
            <?php foreach ($courses as $c): ?>
            <!-- baris data kursus -->
            <tr>
                <!-- id kursus -->
                <td><?= $c['id'] ?></td>
                <!-- judul kursus -->
                <td><?= htmlspecialchars($c['title']) ?></td>
                <!-- format harga rupiah -->
                <td>Rp. <?= number_format($c['price'], 0, ',', '.') ?></td>
                <!-- nama instruktur relasi -->
                <td><?= htmlspecialchars($c['instructor_name']) ?></td>
                <!-- nama kategori relasi -->
                <td><?= htmlspecialchars($c['category_name']) ?></td>
                <!-- aksi tombol edit dan hapus -->
                <td>
                    <!-- tombol edit -->
                    <a href="index.php?page=courses&action=edit&id=<?= $c['id'] ?>" class="btn btn-warning">edit</a>
                    <!-- tombol hapus -->
                    <a href="index.php?page=courses&action=delete&id=<?= $c['id'] ?>" class="btn btn-danger" onclick="return confirm('hapus kursus ini?')">hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
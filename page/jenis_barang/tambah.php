<div class="container mt-5">
    <div class="mb-4">
        <h3>Tambah Jenis Barang</h3>
    </div>

    <form action="" method="post">
        <div class="form-group">
            <label>Nama Jenis Barang</label>
            <input name="nama_jenis_barang" type="text" class="form-control" placeholder="Nama Jenis Barang" required>
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>


<?php

if (isset($_POST['simpan'])) {

    $nama_jenis_barang = $_POST['nama_jenis_barang'];
    $pdo = koneksi::connect();
    $sql = "INSERT INTO jenis_barang (nama_jenis_barang) VALUES (?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_jenis_barang));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=jenis_barang' </script> ";
}
?>
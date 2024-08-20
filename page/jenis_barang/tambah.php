<?php

$pdo = koneksi::connect();
$jenis_barang = Jenisbarang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);

    if (empty($nama_jenis_barang)) {
        echo '<script>window.location="index.php?page=jenis_barang&alert=err1"</script>'; 
        exit();
    }

    if ($jenis_barang->add($nama_jenis_barang)) {
        echo '<script>window.location="index.php?page=jenis_barang&alert=success1"</script>';
        exit();
    } else {
        echo "Terjadi kesalahan saat menambahkan data.";
    }
}
?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Tambah Jenis Barang</h3>
            </div>

            <form action="" method="post">
                <div class="form-group">
                    <label>Nama Jenis Barang</label>
                    <input name="nama_jenis_barang" type="text" class="form-control" placeholder="Nama Jenis Barang">
                </div>
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
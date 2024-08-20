<?php
if (empty($_GET['id_jenis_barang'])) {
    echo "<script>window.location.href = 'index.php?page=jenis_barang'</script>";
    exit();
}

$id_jenis_barang = $_GET['id_jenis_barang'];
$pdo = koneksi::connect();
$jenis_barang = Jenisbarang::getInstance($pdo);

if (isset($_POST['simpan'])) {
    $nama_jenis_barang = htmlspecialchars($_POST['nama_jenis_barang']);

    if (empty($nama_jenis_barang)) {
        echo '<script>window.location="index.php?page=jenis_barang&alert=err1"</script>'; 
        exit();
    }

    if ($jenis_barang->update($id_jenis_barang, $nama_jenis_barang)) {
        echo '<script>window.location="index.php?page=jenis_barang&alert=success1"</script>';
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
} else {
    $data = $jenis_barang->getID($id_jenis_barang);

    if (!$data) {
        echo "<script>window.location.href = 'index.php?page=jenis_barang'</script>";
        exit();
    }

    $nama_jenis_barang = htmlspecialchars($data['nama_jenis_barang']);
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Edit Jenis Barang</h3>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label for="namaJenisBarang">Jenis Barang</label>
            <input name="nama_jenis_barang" type="text" class="form-control" id="namaJenisBarang" placeholder="Jenis Barang"  value="<?php echo htmlspecialchars($nama_jenis_barang); ?>">
        </div>
        <input type="hidden" name="id_jenis_barang" value="<?php echo htmlspecialchars($id_jenis_barang); ?>">
        <div class="form-group mt-4">
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
        <a href="index.php?page=jenis_barang" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

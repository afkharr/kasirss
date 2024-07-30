<?php
if (isset($_POST['simpan'])) {
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $stok_barang = htmlspecialchars($_POST['stok_barang']);
    $harga_barang = htmlspecialchars($_POST['harga_barang']);

    $image = $_FILES["gambar"]["name"];
    $tmpname = $_FILES["gambar"]["tmp_name"];
    $error = $_FILES["gambar"]["error"];

    if ($error === UPLOAD_ERR_OK) {
        $newfilename = uniqid() . "." . pathinfo($image, PATHINFO_EXTENSION);
        if (move_uploaded_file($tmpname, 'page/barang/img/' . $newfilename)) {
            require_once 'database/config.php';
            require_once 'database/class/barang.php';

            $pdo = Koneksi::connect();
            $barang = Barang::getInstance($pdo);
            if ($barang->add($nama_barang, $harga_barang, $stok_barang, $newfilename)) {
                echo "<script>window.location.href = 'index.php?page=barang'</script>";
            } else {
                echo "Terjadi kesalahan saat menyimpan data.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah gambar.";
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Barang</h3>
        </div>
        
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required>
            </div>

            <div class="form-group">
                <label>Harga Satuan</label>
                <input name="harga_barang" type="text" class="form-control" placeholder="Harga Satuan" required>
            </div>

            <div class="form-group">
                <label>Stok Barang</label>
                <input name="stok_barang" type="text" class="form-control" placeholder="Stok Barang" required>
            </div>

            <div class="form-group">
                <label>Gambar Barang</label>
                <input name="gambar" type="file" class="form-control" placeholder="gambar" required>
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
</div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

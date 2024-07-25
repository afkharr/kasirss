<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Supplier</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Supplier</label>
                <input name="nama_supplier" type="text" class="form-control" placeholder="Masukan nama" required>
            </div>
            <div class="form-group">
                <label>Alamat Supplier</label>
                <input name="alamat_supplier" type="text" class="form-control" placeholder="Masukan alamat" required>
            </div>
            <div class="form-group">
                <label>No Tlp</label>
                <input name="no_telp" type="text" class="form-control" placeholder="Masukan no telp" required>
            </div>
            <div class="form-group">
                <label>No Rekening</label>
                <input name="no_rekening" type="text" class="form-control" placeholder="Masukan no rekening" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=supplier" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php

if(isset($_POST['simpan'])){

    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $no_telp = $_POST['no_telp'];
    $no_rekening = $_POST['no_rekening'];

    $pdo = koneksi::connect();
    $sql = "INSERT INTO supplier (nama_supplier,alamat_supplier,no_telp,no_rekening) VALUES (?,?,?,?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_supplier,$alamat_supplier,$no_telp,$no_rekening));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
}
?>

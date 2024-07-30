<?php 


if (empty($_GET['id_supplier'])) {
    echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
    exit();
}

$id_supplier = $_GET['id_supplier'];

$pdo = Koneksi::connect();
$supplier = Supplier::getInstance($pdo);

if (isset($_POST['simpan'])) {

    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $no_telp = $_POST['no_telp'];
    $no_rekening = $_POST['no_rekening'];

    $result = $supplier->update($id_supplier, $nama_supplier, $alamat_supplier, $no_telp, $no_rekening);
    
    if ($result) {
        echo "<script>window.location.href = 'index.php?page=supplier'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

$data = $supplier->getID($id_supplier);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=supplier'</script>";
    exit();
}

$nama_supplier = $data['nama_supplier'];
$alamat_supplier = $data['alamat_supplier'];
$no_telp = $data['no_telp'];
$no_rekening = $data['no_rekening'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Supplier</h3>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Supplier</label>
                <input name="nama_supplier" type="text" class="form-control" placeholder="Masukan nama" required value="<?php echo htmlspecialchars($nama_supplier); ?>">
            </div>
            <div class="form-group">
                <label>Alamat Supplier</label>
                <input name="alamat_supplier" type="text" class="form-control" placeholder="Masukan alamat" required value="<?php echo htmlspecialchars($alamat_supplier); ?>">
            </div>
            <div class="form-group">
                <label>No Tlp</label>
                <input name="no_telp" type="text" class="form-control" placeholder="Masukan no telp" required value="<?php echo htmlspecialchars($no_telp); ?>">
            </div>
            <div class="form-group">
                <label>No Rekening</label>
                <input name="no_rekening" type="text" class="form-control" placeholder="Masukan no rekening" required value="<?php echo htmlspecialchars($no_rekening); ?>">
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

<?php 

if (empty($_GET['id_barang'])) {
    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
    exit();
}

$id_barang = $_GET['id_barang'];

if (isset($_POST['simpan'])) {

    $nama_barang = $_POST['nama_barang'];
    $stok_barang = $_POST['stok_barang'];
    $harga_barang = $_POST['harga_barang'];

    $pdo = koneksi::connect();
    $sql = "UPDATE barang SET nama_barang = ?, stok_barang = ?, harga_barang = ? WHERE id_barang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_barang, $stok_barang, $harga_barang, $id_barang));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM barang WHERE id_barang = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_barang));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=barang' </script> ";
        exit();
    }

    $nama_barang = $data['nama_barang'];
    $stok_barang = $data['stok_barang'];
    $harga_barang = $data['harga_barang'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Barang</h3>
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Barang</label>
                <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required value="<?php echo htmlspecialchars($nama_barang); ?>">
            </div>
            <div class="form-group">
                <label>Jumlah Barang</label>
                <input name="stok_barang" type="text" class="form-control" placeholder="Jumlah Barang" required value="<?php echo htmlspecialchars($stok_barang); ?>">
            </div>
            <div class="form-group">
                <label>Harga Satuan</label>
                <input name="harga_barang" type="text" class="form-control" placeholder="Harga Satuan" required value="<?php echo htmlspecialchars($harga_barang); ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

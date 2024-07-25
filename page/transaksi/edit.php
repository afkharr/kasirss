<?php 

if (empty($_GET['id_transaksi'])) {
    echo "<script> window.location.href = 'index.php?page=member' </script> ";
    exit();
}

$id_transaksi = $_GET['id_transaksi'];

if (isset($_POST['simpan'])) {

    $nominal = $_POST['nominal'];
    $total = $_POST['total'];
    $tgl_waktu = $_POST['tgl_waktu'];
    $kembalian = $_POST['kembalian'];
    $total_diskon = $_POST['total_diskon'];

    $pdo = koneksi::connect();
    $sql = "UPDATE transaksi SET nominal = ?, total = ?, tgl_waktu = ?, kembalian = ?, total_diskon = ? WHERE id_transaksi = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nominal, $total, $tgl_waktu, $kembalian, $total_diskon, $id_transaksi));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=member' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM transaksi WHERE id_transaksi = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_transaksi));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=member' </script> ";
        exit();
    }
    $nominal = $data['nominal'];
    $total = $data['total'];
    $tgl_waktu = $data['tgl_waktu'];
    $kembalian = $data['kembalian'];
    $total_diskon = $data['total_diskon'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Transaksi</h3>
        </div>
        <form action= "" method="post">
            <div class="form-group">
                <label>Nominal</label>
                <input name="nominal" type="text" class="form-control" placeholder="Masukan nominal" required value="<?php echo htmlspecialchars($nominal); ?>">
            </div>
            <div class="form-group">
                <label>Total</label>
                <input name="total" type="text" class="form-control" placeholder="Total" required value="<?php echo htmlspecialchars($total); ?>">
            </div>
            <div class="form-group">
                <label>Tgl Waktu</label>
                <input name="tgl_waktu" type="datetime-local" class="form-control" placeholder="Tanggal waktu" required value="<?php echo htmlspecialchars($tgl_waktu); ?>">
            </div>
            <div class="form-group">
                <label>Kembalian</label>
                <input name="kembalian" type="text" class="form-control" placeholder="Kembalian" required value="<?php echo htmlspecialchars($kembalian); ?>">
            </div>
            <div class="form-group">
                <label>Total Diskon</label>
                <input name="total_diskon" type="text" class="form-control" placeholder="Diskon" required value="<?php echo htmlspecialchars($total_diskon); ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

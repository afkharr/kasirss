<?php

if (isset($_POST['simpan'])) {
    $nominal = $_POST['nominal'];
    $total = $_POST['total'];
    $tgl_waktu = $_POST['tgl_waktu'];
    $kembalian = $_POST['kembalian'];
    $total_diskon = $_POST['total_diskon'];

    $pdo = koneksi::connect();
    $sql = "INSERT INTO transaksi (nominal, total, tgl_waktu, kembalian, total_diskon) VALUES (?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nominal, $total, $tgl_waktu, $kembalian, $total_diskon));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=transaksi' </script> ";
}
?>

<div class="container mt-5">
    <div class="mb-4">
        <h3>Tambah Transaksi</h3>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label>Nominal</label>
            <input name="nominal" type="text" class="form-control" placeholder="Masukan nominal" required>
        </div>
        <div class="form-group">
            <label>Total</label>
            <input name="total" type="text" class="form-control" placeholder="Total" required>
        </div>
        <div class="form-group">
            <label>Tgl Waktu</label>
            <input name="tgl_waktu" type="datetime-local" class="form-control" placeholder="Tanggal waktu" required>
        </div>
        <div class="form-group">
            <label>Kembalian</label>
            <input name="kembalian" type="text" class="form-control" placeholder="Kembalian" required>
        </div>
        <div class="form-group">
            <label>Total Diskon</label>
            <input name="total_diskon" type="text" class="form-control" placeholder="Diskon" required>
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
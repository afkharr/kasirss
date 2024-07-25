<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Member</h3>
        </div>
        
        <form action="" method="post">
        <div class="form-group">
                <label for="nama">Nama</label>
                <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="total_poin">Total Poin</label>
                <input id="total_poin" name="total_poin" type="text" class="form-control" placeholder="Masukkan total poin" required>
            </div>
            <div class="form-group">
                <label for="no_telp">No Tlp</label>
                <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" required>
            </div>
            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=member" class="btn btn-secondary">Kembali</a>
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

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $total_poin = $_POST['total_poin'];
    $no_telp = $_POST['no_telp'];

    $pdo = koneksi::connect();
    $sql = "INSERT INTO member (nama, alamat, jenis_kelamin, total_poin, no_telp) VALUES (?, ?, ?, ?, ?)";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama, $alamat, $jenis_kelamin, $total_poin, $no_telp));

    koneksi::disconnect();
    echo "<script> window.location.href = 'index.php?page=barang' </script> ";
}
?>

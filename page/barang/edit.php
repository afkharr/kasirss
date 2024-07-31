<?php
// Pastikan ada ID barang
if (empty($_GET['id_barang'])) {
    echo "<script>window.location.href = 'index.php?page=barang'</script>";
    exit();
}

$id_barang = $_GET['id_barang'];

// Koneksi ke database dan mendapatkan instance Barang
$pdo = Koneksi::connect();
$barang = Barang::getInstance($pdo);

// Menangani pengiriman form
if (isset($_POST['simpan'])) {
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $harga_barang = htmlspecialchars($_POST['harga_barang']);
    $stok_barang = htmlspecialchars($_POST['stok_barang']);
    $supplier = htmlspecialchars($_POST['supplier']);

    $result = false;

    if (!empty($_FILES['gambar']['name'])) {
        // Mengunggah gambar
        $extensi = explode(".", $_FILES['gambar']['name']);
        $gambarbarang = "gambar-" . round(microtime(true)) . "." . end($extensi);
        $sumber = $_FILES['gambar']['tmp_name'];
        $upload = move_uploaded_file($sumber, "page/barang/img/" . $gambarbarang);

        if ($upload) {
            $result = $barang->update($id_barang, $nama_barang, $jenis_barang, $harga_barang, $stok_barang, $gambarbarang, $supplier);
        } else {
            echo "Gagal mengunggah gambar.";
            exit();
        }
    } else {
        $result = $barang->updateWithoutImage($id_barang, $nama_barang, $jenis_barang, $harga_barang, $stok_barang, $supplier);
    }

    if ($result) {
        echo "<script>window.location.href = 'index.php?page=barang'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

// Mengambil data barang untuk ditampilkan di form
$data = $barang->getID($id_barang);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=barang'</script>";
    exit();
}

// Menyiapkan data untuk form
$nama_barang = htmlspecialchars($data['nama_barang']);
$jenis_barang = htmlspecialchars($data['id_jenis_barang']);
$harga_barang = htmlspecialchars($data['harga_barang']);
$stok_barang = htmlspecialchars($data['stok_barang']);
$supplier = htmlspecialchars($data['id_supplier']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Edit Barang</h3>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" required>
                </div>

                <div class="form-group">
                        <label>Jenis Barang</label>
                        <select name="jenis_barang" id="" class="form-control">
                            <option value="">Pilih Jenis</option>
                            <?php
                            $pdo = Koneksi::connect();
                            $barang = Barang::getInstance($pdo);
                            ?>
                            <?php foreach ($barang->getAllJenisBarang() as $jenis) : ?>
                                <option value="<?= $jenis['id_jenis_barang'] ?>">
                                    <?= $jenis['nama_jenis_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input name="harga_barang" type="text" class="form-control" placeholder="Harga Satuan" value="<?php echo $harga_barang; ?>" required>
                </div>

                <div class="form-group">
                    <label>Stok Barang</label>
                    <input name="stok_barang" type="text" class="form-control" placeholder="Stok Barang" value="<?php echo $stok_barang; ?>" required>
                </div>

                <div class="form-group">
                    <label>Gambar Barang</label>
                    <input name="gambar" type="file" class="form-control">
                </div>

                <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier" id="" class="form-control">
                            <option value="">Pilih Supplier</option>
                            <?php
                            $pdo = Koneksi::connect();
                            $barang = Barang::getInstance($pdo);
                            ?>
                            <?php foreach ($barang->getAllSupplier() as $jenis) : ?>
                                <option value="<?= $jenis['id_supplier'] ?>">
                                    <?= $jenis['nama_supplier'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=barang" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- AdminLTE JS -->
<script src="asset/dist/js/adminlte.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

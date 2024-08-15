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

    if (empty($nama_barang) || empty($jenis_barang) || empty($harga_barang) || empty($stok_barang) || empty($supplier)) {
        echo '<script>window.location="index.php?page=barang&alert=err1"</script>';
    } else if (!empty($_FILES['gambar']['name'])) {
        // Mengunggah gambar
        $extensi = explode(".", $_FILES['gambar']['name']);
        $gambarbarang = "gambar-" . round(microtime(true)) . "." . end($extensi);
        $sumber = $_FILES['gambar']['tmp_name'];
        $upload = move_uploaded_file($sumber, "assets/image/img/" . $gambarbarang);

        if ($upload) {
            $result = $barang->update($id_barang, $nama_barang, $jenis_barang, $harga_barang, $stok_barang, $gambarbarang, $supplier);
        } else {
            // Gagal mengunggah gambar
            echo '<script>window.location="index.php?page=barang&alert=err1"</script>';
            exit();
        }
    } else {
        $result = $barang->updateWithoutImage($id_barang, $nama_barang, $jenis_barang, $harga_barang, $stok_barang, $supplier);
    }

    if ($result) {
        // Berhasil menyimpan data barang
        echo '<script>window.location="index.php?page=barang&alert=success2"</script>';
        exit();
    } else {
        // Gagal menyimpan data barang
        echo '<script>window.location="index.php?page=barang&alert=err1"</script>';
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

<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Edit Barang</h3>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input name="nama_barang" type="text" class="form-control" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" >
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
                            <option value="<?= $jenis['id_jenis_barang'] ?>" <?= $jenis_barang == $jenis['id_jenis_barang'] ? 'selected' : '' ?>>
                                <?= $jenis['nama_jenis_barang'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Harga Satuan</label>
                    <input name="harga_barang" type="text" class="form-control" placeholder="Harga Satuan" value="<?php echo $harga_barang; ?>" >
                </div>

                <div class="form-group">
                    <label>Stok Barang</label>
                    <input name="stok_barang" type="text" class="form-control" placeholder="Stok Barang" value="<?php echo $stok_barang; ?>" >
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
                            <option value="<?= $jenis['id_supplier'] ?>" <?= $supplier == $jenis['id_supplier'] ? 'selected' : '' ?>>
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

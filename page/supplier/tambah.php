<?php
if ($_SESSION['user']['role'] == "kasir") {
    echo "<script>
    window.location = 'index.php?alert=err2';
    </script>";}
?>

<div class="container mt-5">
    <div class="mb-4">
        <h3>Tambah Supplier</h3>
    </div>

    <form action="" method="post">
        <div class="form-group">
            <label>Nama Supplier</label>
            <input name="nama_supplier" type="text" class="form-control" placeholder="Masukan nama">
        </div>
        <div class="form-group">
            <label>Alamat Supplier</label>
            <input name="alamat_supplier" type="text" class="form-control" placeholder="Masukan alamat">
        </div>
        <div class="form-group">
            <label>No Tlp</label>
            <input name="no_telp" type="text" class="form-control" placeholder="Masukan no telp">
        </div>
        <div class="form-group">
            <label>No Rekening</label>
            <input name="no_rekening" type="text" class="form-control" placeholder="Masukan no rekening">
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=supplier" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['simpan'])) {

    $nama_supplier = $_POST['nama_supplier'];
    $alamat_supplier = $_POST['alamat_supplier'];
    $no_telp = $_POST['no_telp'];
    $no_rekening = $_POST['no_rekening'];



    $pdo = Koneksi::connect();
    $supplier = Supplier::getInstance($pdo);
    if (empty($nama_supplier) || empty($alamat_supplier) || empty($no_telp) || empty($no_rekening)) {
        echo '<script>window.location="index.php?page=supplier&alert=err1"</script>';
    } elseif ($supplier->add($nama_supplier, $alamat_supplier, $no_telp, $no_rekening)) {
        echo '<script>window.location="index.php?page=supplier&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

?>
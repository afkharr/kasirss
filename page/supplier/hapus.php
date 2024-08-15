<?php

if (empty($_GET['id_supplier'])) header("Location: index.php");

$id_supplier = $_GET['id_supplier'];

$pdo = koneksi::connect();
$supplier = Supplier::getInstance($pdo);
$result = $supplier->delete($id_supplier);
koneksi::disconnect();

if ($result) {
    echo '<script>window.location="index.php?page=supplier&alert=hapus"</script>';
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

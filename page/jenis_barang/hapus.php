<?php

if (empty($_GET['id_jenis_barang'])) header("Location: index.php");

$id_jenis_barang = $_GET['id_jenis_barang'];

$pdo = koneksi::connect();
$jenis_barang = Jenisbarang::getInstance($pdo);
$result = $jenis_barang->delete($id_jenis_barang);
koneksi::disconnect();

if ($result) {
    echo "<script>window.location.href = 'index.php?page=jenis_barang';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}
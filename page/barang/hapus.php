<?php

 if(empty($_GET['id_barang'])) header("Location: index.php");

 $id_barang = $_GET['id_barang'];

 $pdo = koneksi::connect();
 $barang = barang::getInstance($pdo);
 $result = $barang->delete($id_barang);
 koneksi::disconnect();
 
 if ($result) {
    echo '<script>window.location="index.php?page=barang&alert=hapus"</script>';
} else {
     echo "Terjadi kesalahan saat menghapus data.";
 }
 
 ?>
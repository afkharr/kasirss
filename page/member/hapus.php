<?php

 if(empty($_GET['id_member'])) header("Location: index.php");

 $id_member = $_GET['id_member'];

 $pdo = koneksi::connect();
 $member = Member::getInstance($pdo);
 $result = $member->delete($id_member);
 koneksi::disconnect();
 
 if ($result) {
    echo '<script>window.location="index.php?page=member&alert=hapus"</script>';
} else {
     echo "Terjadi kesalahan saat menghapus data.";
 }
 
 ?>
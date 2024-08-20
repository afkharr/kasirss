<?php

if (empty($_GET['id_user'])) header("Location: index.php");

$id_user = $_GET['id_user'];

$pdo = koneksi::connect();
$user = User::getInstance($pdo);
$result = $user->hapus($id_user);
koneksi::disconnect();

if ($user->hapus($id_user) == true) {
    echo "<script>window.location.href = 'index.php?page=user&alert=hapus'</script>";
}

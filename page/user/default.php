<?php
include_once "database/class/user.php";
include_once "database/config.php";


$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'tambah':
        include 'tambah.php';
        break;
    case 'logout':
        include 'logout.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'hapus':
        include 'hapus.php';
        break;
    case 'ganti_password':
        include 'ganti_password.php';
        break;
    default:
        include 'index.php';
        break;
}

<?php
include_once "database/config.php";
include "database/class/transaksi.php";


$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'tambah':
        include 'index.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'hapus':
        include 'hapus.php';
        break;
    default:
        include 'laporan.php';
        break;
}

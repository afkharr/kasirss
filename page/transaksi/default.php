<?php
include_once "database/config.php";
include "database/class/transaksi.php";


$act = isset($_GET['act']) ? $_GET['act'] : '';
switch ($act) {
    case 'tambah':
        include 'index.php';
        break;
    default:
        include 'laporan.php';
        break;
}

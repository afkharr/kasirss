<?php
$pdo = koneksi::connect();


$sqlBarang ='SELECT COUNT(*) FROM barang';
$resultBarang = $pdo->query($sqlBarang);
$jumlah_barang = $resultBarang->fetchColumn();

$sqlJenisBarang ='SELECT COUNT(*) FROM jenis_barang';
$resultJenisBarang = $pdo->query($sqlJenisBarang);
$jumlah_jenis_barang = $resultJenisBarang->fetchColumn();

$sqlSupplier ='SELECT COUNT(*) FROM supplier';
$resultSupplier = $pdo->query($sqlSupplier);
$jumlah_supplier = $resultSupplier->fetchColumn();

$sqlTransaksi ='SELECT COUNT(*) FROM transaksi';
$resultTransaksi = $pdo->query($sqlTransaksi);
$jumlah_transaksi = $resultTransaksi->fetchColumn();

$sqlMember ='SELECT COUNT(*) FROM member';
$resultMember = $pdo->query($sqlMember);
$jumlah_member = $resultMember->fetchColumn();

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <?php if ($_SESSION['user']['role'] == "super_admin") : ?>
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h2><a href="index.php?page=user">User</a></h2>
                    0
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php if ($_SESSION['user']['role'] == "super_admin" || $_SESSION['user']['role'] == "admin" || $_SESSION['user']['role'] == "kasir") : ?>
        <div class="col-lg-3 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h2><a href="index.php?page=member">Member</a></h2>
                    <?= $jumlah_member ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "super_admin" || $_SESSION['user']['role'] == "admin") : ?>
        <div class="col-lg-3 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h2><a href="index.php?page=supplier">Supplier</a></h2>
                    <?= $jumlah_supplier ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "super_admin" || $_SESSION['user']['role'] == "admin" || $_SESSION['user']['role'] == "kasir") : ?>
        <div class="col-lg-3 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h2><a href="index.php?page=jenis_barang">Jenis Barang</a></h2>
                    <?= $jumlah_jenis_barang ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "super_admin" || $_SESSION['user']['role'] == "admin" || $_SESSION['user']['role'] == "kasir") : ?>
        <div class="col-lg-3 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h2><a href="index.php?page=barang">Barang</a></h2>
                    <?= $jumlah_barang ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($_SESSION['user']['role'] == "super_admin" || $_SESSION['user']['role'] == "admin" || $_SESSION['user']['role'] == "kasir") : ?>
        <div class="col-lg-3 mb-4">
            <div class="card border-primary">
                <div class="card-body">
                    <h2><a href="index.php?page=transaksi">Transaksi</a></h2>
                    <?= $jumlah_transaksi ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- /.container-fluid -->

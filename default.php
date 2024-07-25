<?php
$pdo = koneksi::connect();


$sqlBarang ='SELECT COUNT(*) FROM barang';
$resultBarang = $pdo->query($sqlBarang);
$jumlah_barang = $resultBarang->fetchColumn();

$sqlJenisBarang ='SELECT COUNT(*) FROM jenis_barang';
$resultJenisBarang = $pdo->query($sqlJenisBarang);
$jumlah_jenis_barang = $resultJenisBarang->fetchColumn();

$sqlsupplier ='SELECT COUNT(*) FROM supplier';
$resultsupplier = $pdo->query($sqlsupplier);
$jumlahsupplier = $resultsupplier->fetchColumn();

?>

<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h2><a href="index.php?page=user">User</a></h2>
                        0
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-primary">
                    <div class="card-body">
                    <h2><a href="index.php?page=member">Member</a></h2>
                    0
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-primary">
                    <div class="card-body">
                    <h2><a href="index.php?page=supplier">Supplier</a></h2>
                    <?= $jumlahsupplier ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-lg-3">
            <div class="card border-primary">
                    <div class="card-body">
                    <h2><a href="index.php?page=jenis_barang">Jenis Barang</a></h2>
                    <?= $jumlah_jenis_barang ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-primary">
                    <div class="card-body">
                    <h2><a href="index.php?page=barang">Barang</a></h2>
                    <?= $jumlah_barang ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            <div class="card border-primary">
                    <div class="card-body">
                    <h2><a href="index.php?page=transaksi">Transaksi</a></h2>
                    0
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
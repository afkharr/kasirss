<?php

$pdo = koneksi::connect();


$sqlBarang = 'SELECT COUNT(*) FROM barang';
$resultBarang = $pdo->query($sqlBarang);
$jumlah_barang = $resultBarang->fetchColumn();

$sqlJenisBarang = 'SELECT COUNT(*) FROM jenis_barang';
$resultJenisBarang = $pdo->query($sqlJenisBarang);
$jumlah_jenis_barang = $resultJenisBarang->fetchColumn();

$sqlSupplier = 'SELECT COUNT(*) FROM supplier';
$resultSupplier = $pdo->query($sqlSupplier);
$jumlah_supplier = $resultSupplier->fetchColumn();

$sqlTransaksi = 'SELECT COUNT(*) FROM transaksi';
$resultTransaksi = $pdo->query($sqlTransaksi);
$jumlah_transaksi = $resultTransaksi->fetchColumn();

$sqlMember = 'SELECT COUNT(*) FROM member';
$resultMember = $pdo->query($sqlMember);
$jumlah_member = $resultMember->fetchColumn();

$sqlUser = 'SELECT COUNT(*) FROM user';
$resultUser = $pdo->query($sqlUser);
$jumlah_User = $resultUser->fetchColumn();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=user" style="text-decoration: none;">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        User</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_User ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=member" style="text-decoration: none;">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Member</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_member ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=supplier" style="text-decoration: none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Supllier</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_supplier ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-truck fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=jenis_barang" style="text-decoration: none;">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Jenis Barang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_jenis_barang ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-tags fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=barang" style="text-decoration: none;">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Barang</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_barang ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <a href="index.php?page=transaksi" style="text-decoration: none;">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Transaksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_transaksi ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
    </div>

</div>
<!-- /.container-fluid -->
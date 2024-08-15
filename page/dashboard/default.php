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
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Barang <span
                            class="float-right"><?= $jumlah_barang ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                            aria-valuenow="<?= $jumlah_barang ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">User<span
                            class="float-right"><?= $jumlah_User ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Member<span
                            class="float-right"><?= $jumlah_member ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%"
                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Transaksi <span
                            class="float-right"><?= $jumlah_transaksi ?></span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Supplier <span
                            class="float-right"><?= $jumlah_supplier ?></span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                            aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                            src="assets/img/undraw_posting_photo.svg" alt="...">
                    </div>
                    <p>WEB INI SAYA BUAT DENGAN MENGGUNAKAN KONSEP PDO OOP DAN SQL INJECTION <a
                            target="_blank" rel="nofollow" href="http://localhost/kasirss/index.php">CEK</a>,
                        COBA LIHAT DI BAWAH NI</p>
                    <a target="_blank" rel="nofollow" href="http://localhost/kasirss/index.php">KLIK DISINI &rarr;</a>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php
session_start();
include("database/config.php");
include("database/class/auth.php");

$pdo = koneksi::connect();
$user = Auth::getInstance($pdo);

if (!$user->isLoggedIn()) {
    $login = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
    switch ($login) {
        case 'login':
            include('auth/login.php');
            break;
        case 'register':
            include('auth/register.php');
            break;
        case 'forgot-password':
            include('auth/forgot-password.php');
            break;
        default:
            include('auth/login.php');
            break;
    }
} else {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Kasirss</title>
        <?php include 'layouts/load_css.php'; ?>
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Header -->
            <?php include 'layouts/header.php'; ?>
            <!-- Sidebar -->

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <?php
                    $page = isset($_GET["page"]) ? $_GET["page"] : 'dashboard';
                    switch ($page) {
                        case 'user':
                            include('page/user/default.php');
                            break;
                        case 'member':
                            include('page/member/default.php');
                            break;
                        case 'barang':
                            include('page/barang/default.php');
                            break;
                        case 'jenis_barang':
                            include('page/jenis_barang/default.php');
                            break;
                        case 'supplier':
                            include('page/supplier/default.php');
                            break;
                        case 'transaksi':
                            include('page/transaksi/default.php');
                            break;
                        case 'dashboard':
                        default:
                            include('page/dashboard/default.php');
                            break;
                    }
                    ?>
                </section>
            </div>

            <!-- Footer -->
            <?php include 'layouts/footer.php'; ?>
        </div>

        <?php include 'layouts/load_js.php'; ?>
    </body>

    </html>
<?php
}

?>
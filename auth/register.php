<?php

require_once 'database/config.php';
require_once 'database/class/auth.php';

$pdo = Koneksi::connect();
$auth = Auth::getInstance($pdo);

if (isset($_POST["register"])) {
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $role = $_POST["role"];

    if (empty($username) || empty($password) || empty($email) || empty($nama)) {
        header("Location: index.php?auth=register&alert=err1");
        exit();
    }


    if ($auth->cekUsernameDanEmail($username, $email) == true) {

        header("Location: index.php?auth=register&alert=err3");
    } else if ($auth->register($username, $password, $email, $nama, $role)) {
        $success = true;
        header("Location: index.php?auth=register&alert=success");
    } else {
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Account</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php
            if (isset($_GET['alert'])) {
                switch ($_GET['alert']) {
                    case 'success':
                        echo "Swal.fire({
                            icon: 'success',
                            title: 'Registrasi Berhasil',
                            text: 'Anda telah berhasil terdaftar. Silakan login.'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php?auth=login.php';
                            }
                            });";
                        break;
                    case 'err1':
                        echo "Swal.fire({
                            icon: 'warning',
                            title: 'Isi dulu bg!!',
                            showConfirmButton: false,
                            timer: 2500
                        });";
                        break;
                    case 'err3':
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'Username sudah digunakan!',
                            text: 'Silakan pilih username lain.',
                            showConfirmButton: false,
                            timer: 3000
                        });";
                        break;
                }
            }
            ?>
        });
    </script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nama">Name</label>
                                        <input id="nama" type="text" class="form-control" name="nama" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="role">Role</label>
                                        <select id="role" class="form-control selectric" name="role">
                                            <option value="super_admin">Super Admin</option>
                                            <option value="admin">Admin</option>
                                            <option value="kasir">Kasir</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="password">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" autocomplete="off">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block" name="register">
                                    Register Account
                                </button>
                                <hr>
                            </form>
                            <div class="text-center">
                                <a class="small" href="index.php?page=login">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>
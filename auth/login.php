<?php


require_once 'database/config.php';
require_once 'database/class/auth.php';

if (isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $pdo = Koneksi::connect();
    $auth = Auth::getInstance($pdo);

    if (empty($email) || empty($password)) {
        header("Location: index.php?auth=login&alert=err1");
        exit();
    }

    if ($auth->login($email, $password)) {
        header("Location: index.php?auth=login&alert=berhasil");
        exit();
    } else {
        header("Location: index.php?auth=login&alert=err2");
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

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <section class="section">
        <?php if (isset($_GET['alert'])) : ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    <?php
                   if ($_GET['alert'] == "andalogout") {
                    ?>
                        Swal.fire({
                            icon: 'success',
                            title: 'Anda Keluar',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    <?php
                    } else if ($_GET['alert'] == "err1") {
                    ?>
                        Swal.fire({
                            icon: 'warning',
                            title: 'Isi dulu bg!',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    <?php
                    } else if ($_GET['alert'] == "err2") {
                    ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'email atau Password salah',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    <?php
                    }
                    ?>
                });
            </script>
        <?php endif; ?>

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-lg-5">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form class="user" action="" method="post">
                                            <div class="form-group">
                                                <label for="username">Email</label>
                                                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                            </div>
                                            <div class="text-right">
                                                <a class="small" href="index.php?auth=forgot-password">Forgot Password?</a>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Password</label>
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>

                                        </form>
                                        <hr>

                                        <div class="text-center">
                                            <a href="index.php?auth=register">Create One</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
    </section>
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
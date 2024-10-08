<?php
require_once 'database/config.php';
require_once 'database/class/auth.php';

$pdo = Koneksi::connect();
$auth = Auth::getInstance($pdo);

if (isset($_POST["reset"])) {
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if (empty($username) || empty($email) || empty($password)) {
        echo "<script>window.location = 'index.php?auth=forgot-password&alert=err1';</script>";
    } else if ($auth->forgotPassword($username, $email, $password)) {
        echo "<script>window.location = 'index.php?auth=forgot-password&alert=pass';</script>";
    } else {
        echo "<script>window.location = 'index.php?auth=forgot-password&alert=errPass';</script>";
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

    <title>forgot-password</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="post" action="">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input id="username" type="text" class="form-control" name="username" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label for="password"> New Password</label>
                                            <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" autocomplete="off">
                                        </div>
                                        <button type="submit" name="reset" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                        <div class="mt-5 text-muted text-center">
                                            <a href="index.php?auth=login">Back To Login Menu</a>
                                        </div>
                                    </form>
                                    <hr>
                                </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            <?php if (isset($_GET['alert'])) { ?>
                switch ("<?php echo $_GET['alert']; ?>") {
                    case "pass":
                        Swal.fire({
                            icon: "success",
                            title: 'Berhasil Mengganti Password!',
                            text: 'Anda telah berhasil terdaftar. Silakan login.'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'index.php?auth=login.php';
                            }
                        });
                        break;
                    case "errPass":
                        Swal.fire({
                            icon: "error",
                            title: 'Salah bg email nya!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        break;
                    case "err1":
                        Swal.fire({
                            icon: "warning",
                            title: 'Isi dulu bg!',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        break;
                        // Tambahkan case lain di sini jika diperlukan
                }
            <?php } ?>
        });
    </script>
</body>

</html>
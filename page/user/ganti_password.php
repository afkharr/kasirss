<?php
// Pastikan ada ID user
if (empty($_GET['id_user'])) {
    echo "<script>window.location.href = 'index.php?page=user'</script>";
    exit();
}

$id_user = $_GET['id_user'];

// Koneksi ke database dan mendapatkan instance user
$pdo = Koneksi::connect();
$user = User::getInstance($pdo);

$data = $user->getID($id_user);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=user'</script>";
    exit();
}

// Menyiapkan data untuk form
$username = htmlspecialchars($data['username']);
$password = htmlspecialchars($data['password']);
$email = htmlspecialchars($data['email']);
$nama = htmlspecialchars($data['nama']);
$role = ($data['role']);

// Menangani pengiriman form
if (isset($_POST['simpan'])) {
    $password_lama = htmlspecialchars($_POST['password_lama']);
    $password_baru = htmlspecialchars($_POST['password_baru']);

    // die(print_r($_POST));

    $konfirmasi_password_lama = password_verify($password_lama, $password);

    if ($konfirmasi_password_lama) {
        $user->gantiPasswordUser($id_user, $password_baru);
    } else {
        echo "<script>
        window.location.href = 'index.php?page=user&act=ganti_password&id_user={$id_user}&alert=err3';
        </script>";
        exit();
    }
}
?>


<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Ganti Password</h3>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Password Lama</label>
                    <input name="password_lama" type="password" class="form-control" placeholder="Password Lama" required>
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input name="password_baru" type="password" class="form-control" placeholder="Password Baru" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=user" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

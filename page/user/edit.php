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

// Menangani pengiriman form
if (isset($_POST['simpan'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $nama = htmlspecialchars($_POST['nama']);
    $role = ($_POST['role']);

    $result = $user->edit($id_user, $username, $password, $email, $nama, $role);
    
    if ($result) {
        echo "<script>window.location.href = 'index.php?page=user'</script>";
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="asset/plugins/fontawesome-free/css/all.min.css">
</head>
<body>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Edit User</h3>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>UserName</label>
                    <input name="username" type="text" class="form-control" placeholder="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="text" class="form-control" placeholder="password" value="<?php echo $password; ?>" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input name="nama" type="text" class="form-control" placeholder="nama" value="<?php echo $nama; ?>" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="super_admin" <?php if ($role == 'super_admin') echo 'selected'; ?>>super_admin</option>
                        <option value="admin" <?php if ($role == 'admin') echo 'selected'; ?>>admin</option>
                        <option value="kasir" <?php if ($role == 'kasir') echo 'selected'; ?>>kasir</option>
                    </select>
                </div>
               
                <div class="form-group">
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=user" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- AdminLTE JS -->
<script src="asset/dist/js/adminlte.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

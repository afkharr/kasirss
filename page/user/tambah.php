<?php
if ($_SESSION['user']['role'] == "kasir" || $_SESSION['user']['role'] == "admin") {
    echo "<script>
    window.location = 'index.php?alert=err2';
    </script>";}
?>

<?php
if (isset($_POST['simpan'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $email = htmlspecialchars($_POST['email']);
    $nama = htmlspecialchars($_POST['nama']);
    $role = ($_POST['role']);

    // Debugging output
    echo "Username: $username <br>";
    echo "Password: $password <br>";
    echo "Email: $email <br>";
    echo "Nama: $nama <br>";
    echo "Role: $role <br>";

    $pdo = Koneksi::connect();
    $supplier = User::getInstance($pdo);

    if ($supplier->tambah($username, $password, $email, $nama, $role)) {
        echo "<script>window.location.href = 'index.php?page=user'</script>";
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }

    Koneksi::disconnect();
}
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container mt-5">
            <div class="mb-4">
                <h3>Tambah User</h3>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Username</label>
                    <input name="username" type="text" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="super_admin">Super Admin</option>
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
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
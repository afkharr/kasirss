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
    $role = htmlspecialchars($_POST['role']);  // Juga tambahkan htmlspecialchars pada role untuk keamanan

    // Debugging output (ini bisa dihapus jika sudah tidak diperlukan)
    echo "Username: $username <br>";
    echo "Password: $password <br>";
    echo "Email: $email <br>";
    echo "Nama: $nama <br>";
    echo "Role: $role <br>";

    $pdo = Koneksi::connect();
    $user = User::getInstance($pdo);

    // Cek jika ada input yang kosong
    if (empty($username) || empty($password) || empty($email) || empty($nama) || empty($role)){
        echo '<script>window.location="index.php?page=user&alert=err1"</script>';
        exit();  // Tambahkan exit agar script berhenti jika ada input yang kosong
    }

    // Simpan data jika semua input terisi
    if ($user->tambah($username, $password, $email, $nama, $role)) {
        echo "<script>window.location.href = 'index.php?page=user&alert=success2'</script>";
        exit();  // Tambahkan exit agar script berhenti setelah redirect
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
                    <input name="username" type="text" class="form-control" placeholder="Username" >
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Password" >
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" type="email" class="form-control" placeholder="Email" >
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input name="nama" type="text" class="form-control" placeholder="Nama Lengkap" >
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" class="form-control" >
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
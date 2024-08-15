<?php

if (empty($_GET['id_member'])) {
    echo "<script> window.location.href = 'index.php?page=member' </script> ";
    exit();
}

$id_member = $_GET['id_member'];
$pdo = Koneksi::connect();
$member = Member::getInstance($pdo);

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $total_poin = $_POST['total_poin'];
    $no_telp = $_POST['no_telp'];

    if (empty($nama) || empty($alamat) || empty($jenis_kelamin) || empty($total_poin) || empty($no_telp)) {    
        echo '<script>window.location="index.php?page=member&alert=err1"</script>';
    }else{
        $result = $member->update($id_member, $nama, $alamat, $jenis_kelamin, $total_poin, $no_telp);

        if ($result) {
            echo '<script>window.location="index.php?page=member&alert=success2"</script>';
            exit();
        } else {
            echo "Terjadi kesalahan saat menyimpan data.";
        }
    }



}
$data = $member->getID($id_member);
if (!$data) {
    echo "<script>window.location.href = 'index.php?page=member'</script>";
    exit();
}

$nama = $data['nama'];
$alamat = $data['alamat'];
$jenis_kelamin = $data['jenis_kelamin'];
$total_poin = $data['total_poin'];
$no_telp = $data['no_telp'];

?>
<div class="container mt-5">
    <div class="mb-4">
        <h3>Edit Member</h3>
    </div>
    <form action="" method="post">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" value="<?php echo htmlspecialchars($nama); ?>" >
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat" value="<?php echo htmlspecialchars($alamat); ?>" >
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" >
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if (isset($jenis_kelamin) && $jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="total_poin">Total Poin</label>
            <input id="total_poin" name="total_poin" type="text" class="form-control" placeholder="Masukkan total poin" value="<?php echo htmlspecialchars($total_poin); ?>" >
        </div>
        <div class="form-group">
            <label for="no_telp">No Tlp</label>
            <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" value="<?php echo htmlspecialchars($no_telp); ?>" >
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=member" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
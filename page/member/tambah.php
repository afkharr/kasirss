<div class="container mt-5">
    <div class="mb-4">
        <h3>Tambah Member</h3>
    </div>

    <form action="" method="post">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input id="nama" name="nama" type="text" class="form-control" placeholder="Masukkan nama" >
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input id="alamat" name="alamat" type="text" class="form-control" placeholder="Masukkan alamat" >
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" >
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="total_poin">Total Poin</label>
            <input id="total_poin" name="total_poin" type="text" class="form-control" placeholder="Masukkan total poin" >
        </div>
        <div class="form-group">
            <label for="no_telp">No Tlp</label>
            <input id="no_telp" name="no_telp" type="text" class="form-control" placeholder="Masukkan nomor telepon" >
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=member" class="btn btn-secondary">Kembali</a>
        </div>

    </form>
</div>

<?php


if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $total_poin = $_POST['total_poin'];
    $no_telp = $_POST['no_telp'];



    $pdo = Koneksi::connect();
    $member = Member::getInstance($pdo);
    if (empty($nama) || empty($alamat) || empty($jenis_kelamin) || empty($total_poin) || empty($no_telp)) {
        echo '<script>window.location="index.php?page=member&alert=err1"</script>'; 
    } else if ($member->add($nama, $alamat, $jenis_kelamin, $total_poin, $no_telp)) {
        echo '<script>window.location="index.php?page=member&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>
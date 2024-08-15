<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Jenis Barang</h3>
        <a href="index.php?page=jenis_barang&act=tambah" class="btn btn-primary">Tambah Jenis Barang</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>NAMA Jenis BARANG</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $sql = 'SELECT * FROM jenis_barang';
                foreach ($pdo->query($sql) as $row) {
                ?>
                    <tr>
                        <td><?php echo $row['nama_jenis_barang']; ?></td>
                        <td>
                            <a href="index.php?page=jenis_barang&act=edit&id_jenis_barang=<?php echo $row['id_jenis_barang'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?page=jenis_barang&act=hapus&id_jenis_barang=<?php echo $row['id_jenis_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus data ini ?')">Hapus</a>
                        </td>
                    </tr>
                <?php
                }
                koneksi::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>
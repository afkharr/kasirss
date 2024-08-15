<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Transaksi</h3>
        <a href="index.php?page=transaksi&act=tambah" class="btn btn-primary">Tambah Transaksi</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nominal</th>
                    <th>Total</th>
                    <th>Tgl Waktu</th>
                    <th>Kembalian</th>
                    <th>Total Diskon</th>
                    <th>Aksi</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $pdo = koneksi::connect();
                $sql = 'SELECT * FROM transaksi';
                foreach ($pdo->query($sql) as $row) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nominal']); ?></td>
                        <td><?php echo htmlspecialchars($row['total']); ?></td>
                        <td><?php echo htmlspecialchars($row['tgl_waktu']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_diskon']); ?></td>
                        <td><?php echo htmlspecialchars($row['kembalian']); ?></td>
                        <td>
                            <a href="index.php?page=transaksi&act=edit&id_transaksi=<?php echo htmlspecialchars($row['id_transaksi']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?page=transaksi&act=hapus&id_transaksi=<?php echo htmlspecialchars($row['id_transaksi']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a>
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
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
        <div>
            <a href="index.php?cetak=struk" target="_blank" class="btn btn-primary mr-2">Cetak</a>
            <a href="index.php?page=transaksi&act=tambah" class="btn btn-primary">Tambah Transaksi</a>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">Tanggal</th>
                            <th style="text-align: center; vertical-align: middle;">Nama</th>
                            <th style="text-align: center; vertical-align: middle;">Invoice</th>
                            <th style="text-align: center; vertical-align: middle;">Total Kesuluruhan</th>
                            <th style="text-align: center; vertical-align: middle;">catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo = Koneksi::connect();
                        $transaksi = Transaksi::getInstance($pdo);
                        $datatransaksi = $transaksi->getAll();
                        foreach ($datatransaksi as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['invoice']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_keseluruhan']); ?></td>
                                <td><?php echo htmlspecialchars($row['catatan']); ?></td>
                            </tr>
                        <?php
                        }
                        Koneksi::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
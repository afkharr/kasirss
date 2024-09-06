<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Barang</h1>
        <a href="index.php?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a>
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
                            <th style="text-align: center; vertical-align: middle;">No.</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Barang</th>
                            <th style="text-align: center; vertical-align: middle;">Jenis Barang</th>
                            <th style="text-align: center; vertical-align: middle;">Harga Satuan</th>
                            <th style="text-align: center; vertical-align: middle;">Stok Barang</th>
                            <th style="text-align: center; vertical-align: middle;">Gambar Barang</th>
                            <th style="text-align: center; vertical-align: middle;">Supplier</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo = Koneksi::connect();
                        $barang = Barang::getInstance($pdo);
                        $dataBarang = $barang->getAll();
                        $no = 1;
                        foreach ($dataBarang as $row) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_jenis_barang']); ?></td>
                                <td><?php echo htmlspecialchars($row['harga_barang']); ?></td>
                                <td><?php echo htmlspecialchars($row['stok_barang']); ?></td>
                                <td>
                                    <?php
                                    $gambarPath = 'assets/image/img/' . htmlspecialchars($row['gambar']);
                                    if (file_exists($gambarPath)) {
                                        echo '<img src="' . $gambarPath . '" class="img-fluid" width="200">';
                                    } else {
                                        echo 'Gambar tidak ditemukan';
                                    }
                                    ?>
                                </td>
                                <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a href="index.php?page=barang&act=edit&id_barang=<?php echo htmlspecialchars($row['id_barang']) ?>" class="btn btn-warning btn-sm mx-2">Edit</a>
                                        <a class="btn btn-danger btn-sm mx-2" onclick="hapus_barang(<?= $row['id_barang'] ?>)">Hapus</a>
                                    </div>
                                </td>

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
<script>
    function hapus_barang(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-primary mx-4',
                cancelButton: 'btn btn-danger mx-4'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Hapus Data Pembelian',
            text: "Data kamu nggak bisa kembali lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, menghapus !',
            cancelButtonText: 'Tidak, batal !',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    'Hapus!',
                    'File kamu telah dihapus.',
                    'success'
                )
                window.location.href = 'index.php?page=barang&act=hapus&id_barang=' + id;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Batal',
                    'File kamu masih aman :)',
                    'error'
                )
            }
        })
    }
</script>
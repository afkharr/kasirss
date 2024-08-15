<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Barang</h3>
        <a href="index.php?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga Satuan</th>
                    <th>Stok Barang</th>
                    <th>Gambar Barang</th>
                    <th>Supplier</th>
                    <th>Aksi</th>
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
                        <td>
                            <a href="index.php?page=barang&act=edit&id_barang=<?php echo htmlspecialchars($row['id_barang']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a class="btn btn-danger btn-sm" onclick="hapus_barang(<?= $row['id_barang'] ?>)">Hapus</a>
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
<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Jenis Barang</h1>
        <a href="index.php?page=jenis_barang&act=tambah" class="btn btn-primary">Tambah Jenis Barang</a>
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
                            <th style="text-align: center; vertical-align: middle;">No</th>
                            <th style="text-align: center; vertical-align: middle;">Nama Jenis Barang</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pdo = koneksi::connect();
                        $jenis_barang = Jenisbarang::getInstance($pdo);
                        $dataJenisbarang = $jenis_barang->getAll();
                        $no = 1;
                        foreach ($dataJenisbarang as $row) {
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo htmlspecialchars($row['nama_jenis_barang']); ?></td>
                                <td>
                                    <a href="index.php?page=jenis_barang&act=edit&id_jenis_barang=<?php echo $row['id_jenis_barang'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a class="btn btn-danger btn-sm" onclick="hapus_barang(<?= $row['id_jenis_barang'] ?>)">Hapus</a>
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
                window.location.href = 'index.php?page=jenis_barang&act=hapus&id_jenis_barang=' + id;
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
<?php
if ($_SESSION['user']['role'] == "kasir") {
    echo "<script>
    window.location = 'index.php?alert=err2';
    </script>";
}
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <h1 class="h3 mb-2 text-gray-800">Supplier</h1>
        <a href="index.php?page=supplier&act=tambah" class="btn btn-primary">Tambah Supplier</a>
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
                            <th style="text-align: center; vertical-align: middle;">Nama Supplier</th>
                            <th style="text-align: center; vertical-align: middle;">Alamat Supplier</th>
                            <th style="text-align: center; vertical-align: middle;">No Tlp</th>
                            <th style="text-align: center; vertical-align: middle;">No Rekening</th>
                            <th style="text-align: center; vertical-align: middle;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $pdo = Koneksi::connect();
                        $supplier = Supplier::getInstance($pdo);
                        $dataSupplier = $supplier->getAll();
                        $no = 1;

                        foreach ($dataSupplier as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                                <td><?php echo htmlspecialchars($row['alamat_supplier']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_rekening']); ?></td>
                                <td>
                                    <a href="index.php?page=supplier&act=edit&id_supplier=<?php echo htmlspecialchars($row['id_supplier']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a class="btn btn-danger btn-sm" onclick="hapus_supplier(<?= $row['id_supplier'] ?>)">Hapus</a>
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
    function hapus_supplier(id) {
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
                window.location.href = 'index.php?page=supplier&act=hapus&id_supplier=' + id;
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
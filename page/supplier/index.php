<?php
if ($_SESSION['user']['role'] == "kasir") {
    echo "<script>
    window.location = 'index.php?alert=err2';
    </script>";}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Supplier</h3>
        <a href="index.php?page=supplier&act=tambah" class="btn btn-primary">Tambah Supplier</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>No Tlp</th>
                    <th>No Rekening</th>
                    <th>Aksi</th>
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
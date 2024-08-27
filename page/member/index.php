<div class="container-fluid">
    <div class="d-flex justify-content-between mb-4">
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Member</h1>
        <a href="index.php?page=member&act=tambah" class="btn btn-primary">Tambah Member</a>
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
                            <th style="text-align: center; vertical-align: middle;">Nama</th>
                            <th style="text-align: center; vertical-align: middle;">Alamat</th>
                            <th style="text-align: center; vertical-align: middle;">Jenis Kelamin</th>
                            <th style="text-align: center; vertical-align: middle;">Total Poin</th>
                            <th style="text-align: center; vertical-align: middle;">No Tlp</th>
                            <th style="text-align: center; vertical-align: middle;">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $pdo = Koneksi::connect();
                        $member = Member::getInstance($pdo);
                        $dataMember = $member->getAll();
                        $no = 1;

                        foreach ($dataMember as $row) {
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                                <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                <td><?php echo htmlspecialchars($row['total_poin']); ?></td>
                                <td><?php echo htmlspecialchars($row['no_telp']); ?></td>

                                <td>
                                    <a href="index.php?page=member&act=edit&id_member=<?php echo $row['id_member'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a class="btn btn-danger btn-sm" onclick="hapus_member(<?= $row['id_member'] ?>)">Hapus</a>
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
    function hapus_member(id) {
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
                window.location.href = 'index.php?page=member&act=hapus&id_member=' + id;
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
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h3>Member</h3>
        <a href="index.php?page=member&act=tambah" class="btn btn-primary">Tambah Member</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Total Poin</th>
                    <th>No Tlp</th>
                    <th>aksi</th>
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
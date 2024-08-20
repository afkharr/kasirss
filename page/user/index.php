<?php
if ($_SESSION['user']['role'] == "kasir" || $_SESSION['user']['role'] == "admin") {
    echo "<script>
    window.location = 'index.php?alert=err2';
    </script>";
}
?>


<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>User</h3>
        <a href="index.php?page=user&act=tambah" class="btn btn-primary">Tambah User</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = Koneksi::connect();
                $cruduser = User::getInstance($pdo);
                $dataUser = $cruduser->getAll();

                if ($dataUser && is_array($dataUser)) {
                    foreach ($dataUser as $row) {
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <!-- <td><?php echo htmlspecialchars($row['password']); ?></td> -->
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td>
                                <a href="index.php?page=user&act=edit&id_user=<?php echo htmlspecialchars($row['id_user']); ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm" onclick="hapus_user(<?= $row['id_user'] ?>)">Hapus</a>

                                </a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="6">Tidak ada data yang ditemukan</td></tr>';
                }

                Koneksi::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
        function hapus_user(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary mx-4',
                    cancelButton: 'btn btn-danger mx-4'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Hapus Data User',
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
                    window.location.href = 'index.php?page=user&act=hapus&id_user=' + id;
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
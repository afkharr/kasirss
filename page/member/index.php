<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
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
                        <th>Actions</th>
                    </tr>

                </thead>
                <tbody>
                <?php
                    $pdo = koneksi::connect();
                    $sql ='SELECT * FROM member';
                    foreach ($pdo->query($sql) as $row) {
                    ?> 
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                            <td><?php echo htmlspecialchars($row['total_poin']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_telp']); ?></td>

                            <td>
                                <a href="index.php?page=member&act=edit&id_member=<?php echo $row['id_member'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=member&act=hapus&id_member=<?php echo $row['id_member'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus data ini ?')">Hapus</a>
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
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                    $pdo = koneksi::connect();
                    $sql ='SELECT * FROM supplier';
                    foreach ($pdo->query($sql) as $row) {
                    ?>  
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_supplier']); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat_supplier']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_telp']); ?></td>
                            <td><?php echo htmlspecialchars($row['no_rekening']); ?></td>
                            <td>
                                <a href="index.php?page=supplier&act=edit&id_supplier=<?php echo htmlspecialchars($row['id_supplier']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=supplier&act=hapus&id_supplier=<?php echo htmlspecialchars($row['id_supplier']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda ingin menghapus data ini?')">Hapus</a>
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

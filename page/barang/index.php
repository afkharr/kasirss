<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Barang</h3>
            <a href="index.php?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NAMA BARANG</th>
                        <th>JUMLAH BARANG</th>
                        <th>HARGA SATUAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pdo = koneksi::connect();
                    $sql ='SELECT * FROM barang';
                    foreach ($pdo->query($sql) as $row) {
                    ?>  
                        <tr>
                            <td><?php echo $row['nama_barang']; ?></td>
                            <td><?php echo $row['stok_barang']; ?></td>
                            <td><?php echo $row['harga_barang']; ?></td>
                            <td>
                                <a href="index.php?page=barang&act=edit&id_barang=<?php echo $row['id_barang'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=barang&act=hapus&id_barang=<?php echo $row['id_barang'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus data ini ?')">Hapus</a>
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

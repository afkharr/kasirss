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
    <div class="d-flex justify-content-between mb-4">
        <h3>Tabel Barang</h3>
        <a href="index.php?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a>
    </div>
    <div>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Stok Barang</th>
                    <th>Gambar Barang</th>
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
                        <td><?php echo $no++?></td>
                        <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                        <td><?php echo htmlspecialchars($row['harga_barang']); ?></td>
                        <td><?php echo htmlspecialchars($row['stok_barang']); ?></td>
                        <td>
                        <?php
                        $gambarPath = 'page/barang/img/' . htmlspecialchars($row['gambar']);
                        if (file_exists($gambarPath)) {
                            echo '<img src="' . $gambarPath . '" class="img-fluid" width="200">';
                        } else {
                            echo 'Gambar tidak ditemukan';
                        }
                        ?>
                        </td>
                        <td>
                            <a href="index.php?page=barang&act=edit&id_barang=<?php echo htmlspecialchars($row['id_barang']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?page=barang&act=hapus&id_barang=<?php echo htmlspecialchars($row['id_barang']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

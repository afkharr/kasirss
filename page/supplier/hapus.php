<?php
 if(empty($_GET['id_supplier'])) echo "<script> window.location.href = 'index.php?page=supplier' </script> ";

 $id_supplier = $_GET['id_supplier'];

 $pdo = koneksi::connect();
 $sql = "DELETE FROM supplier WHERE id_supplier = ?";
 $q = $pdo->prepare($sql);
 $q->execute(array($id_supplier));
 koneksi::disconnect();
 echo "<script> window.location.href = 'index.php?page=supplier' </script> ";
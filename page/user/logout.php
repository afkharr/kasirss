<?php
  $pdo = Koneksi::connect();
  $auth = Auth::getInstance($pdo);
  
  if ($auth->logout()) {
    echo "<script>window.location.href='index.php?alert=andalogout'</script>";
}
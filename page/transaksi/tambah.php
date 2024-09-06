    <?php
    session_start();
    if ($_SESSION['user']['role'] == "superadmin" || $_SESSION['user']['role'] == "admin") {
        echo "<script> window.location = 'index.php?alert=err2'; </script>";
    }
    ?>

<?php

include_once "../../database/config.php";
include_once "../../database/class/transaksi.php";
include_once "../../database/class/barang.php";
include_once "../../database/class/member.php";

$data = json_decode(file_get_contents('php://input'), true);

$transaksiData = $data['transaksi'];
$transaksiDetailsData = $data['transaksiDetails'];

$pdo = koneksi::connect();
$transaksi = Transaksi::getInstance($pdo);
$barang = Barang::getInstance($pdo);
$member = Member::getInstance($pdo);

try {
    // Mulai transaksi
    $pdo->beginTransaction();

    // Simpan transaksi
    $idTransaksi = $transaksi->insertTransaksi(
        $transaksiData['tanggal'],
        $transaksiData['id_kasir'],
        $transaksiData['id_member'],
        $transaksiData['invoice'],
        $transaksiData['subtotal'],
        $transaksiData['total_keseluruhan'],
        $transaksiData['nominal'],
        $transaksiData['diskon'],
        $transaksiData['kembalian'],
        $transaksiData['catatan']
    );

    // Simpan detail transaksi dan kurangi stok barang
    foreach ($transaksiDetailsData as $detail) {
        // Cek stok barang sebelum menyimpan detail transaksi
        $stokBarang = $barang->getStokBarang($detail['id_barang']); // Asumsikan ada fungsi getStokBarang()
        if ($stokBarang < $detail['qty']) {
            throw new Exception("stok_err"); // Lempar pengecualian jika stok tidak cukup
        }

        // Simpan detail transaksi
        $transaksi->insertTransaksiDetails(
            $idTransaksi,
            $detail['id_barang'],
            $detail['qty'],
            $detail['harga'],
            $detail['total_harga']
        );

        // Kurangi stok barang
        $barang->kurangiStok($detail['id_barang'], $detail['qty']);
    }

    // Tambahkan poin ke member, jika member bukan "Umum"
    $id_member = $transaksiData['id_member'];
    // $memberUmum = $member->getUmum(); // Asumsikan ini mendapatkan ID untuk member "Umum"
    $id_member = $transaksiData['id_member'];
    if ($id_member) {
        $total_transaksi = $transaksiData['total_keseluruhan'];
        $total_poin = floor($total_transaksi / 10000);

        $memberData = $member->getID($id_member);
        if (!$memberData) {
            throw new Exception("Member tidak ditemukan.");
        }

        $total_poin_baru = $memberData['total_poin'] + $total_poin;

        error_log("ID Member: $id_member, Poin Lama: " . $memberData['total_poin'] . ", Poin Baru: $total_poin_baru");
        $member->tambahPoin($id_member, $total_poin_baru);
        error_log("Update poin berhasil untuk ID Member: $id_member");
    }

    // Commit transaksi
    $pdo->commit();

    // Jika berhasil
// Setelah commit transaksi, kirimkan id_transaksi sebagai bagian dari respons
echo json_encode([
    'success' => true,
    'id_transaksi' => $idTransaksi
]);
} catch (Exception $e) {
    // Rollback transaksi jika ada kesalahan
    $pdo->rollBack();

    // Cek jika pengecualian adalah "stok_err"
    if ($e->getMessage() === "stok_err") {
        echo json_encode(['success' => false, 'message' => 'Stok barang tidak mencukupi']);
    } else {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>

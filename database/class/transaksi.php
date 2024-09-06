<?php

class Transaksi
{
    private static $instance = null;
    private $pdo;

    private function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new self($pdo);
        }
        return self::$instance;
    }

    public function generateKodeNota()
    {
        // Query untuk mendapatkan nomor nota terbesar
        $query = "SELECT MAX(invoice) as kodeTerbesar11 FROM transaksi";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $datanya = $stmt->fetch(PDO::FETCH_ASSOC);
        $kodenota = $datanya['kodeTerbesar11'];

        // Ambil urutan dari nomor nota
        $urutan = (int) substr($kodenota, 9, 3);
        $urutan++;

        // Format tanggal
        $tgl = date("jnyGi");

        // Inisial huruf untuk nomor nota
        $huruf = "AD";

        // Hasil akhir nomor nota
        $kodeCart = $huruf . $tgl . sprintf("%03s", $urutan);

        return $kodeCart;
    }

    public function insertTransaksi($tanggal, $id_kasir, $id_member, $invoice, $subtotal, $total_keseluruhan, $nominal, $diskon, $kembalian, $catatan)
    {
        $query = "INSERT INTO transaksi (tanggal, id_kasir, id_member, invoice, subtotal, total_keseluruhan, nominal, diskon, kembalian, catatan)
              VALUES (:tanggal, :id_kasir, :id_member, :invoice, :subtotal, :total_keseluruhan, :nominal, :diskon, :kembalian, :catatan)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':tanggal' => $tanggal,
            ':id_kasir' => $id_kasir,
            ':id_member' => $id_member,
            ':invoice' => $invoice,
            ':subtotal' => $subtotal,
            ':total_keseluruhan' => $total_keseluruhan,
            ':nominal' => $nominal,
            ':diskon' => $diskon,
            ':kembalian' => $kembalian,
            ':catatan' => $catatan
        ]);

        return $this->pdo->lastInsertId();
    }

    public function insertTransaksiDetails($id_transaksi, $id_barang, $qty, $harga, $total_harga)
    {
        $query = "INSERT INTO transaksi_detail (id_transaksi, id_barang, qty, harga, total_harga)
              VALUES (:id_transaksi, :id_barang, :qty, :harga, :total_harga)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id_transaksi' => $id_transaksi,
            ':id_barang' => $id_barang,
            ':qty' => $qty,
            ':harga' => $harga,
            ':total_harga' => $total_harga
        ]);
    }

    public function getAll()
    {
        try {
            $stmt = $this->pdo->prepare("SELECT transaksi.*, member.nama, transaksi_detail.id_barang, transaksi_detail.qty, transaksi_detail.harga
                                         FROM transaksi
                                         LEFT JOIN member ON member.id_member = transaksi.id_member
                                         LEFT JOIN transaksi_detail ON transaksi_detail.id_transaksi = transaksi.id_transaksi;");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Iterasi untuk mengubah id_barang menjadi nama_barang
            foreach ($data as &$row) {
                // Mengubah id_barang menjadi nama_barang
                $row['nama_barang'] = $this->getNamaBarangById($row['id_barang']);

                // Menambahkan qty dan harga ke dalam hasil
                $row['qty'] = $row['qty'];
                $row['harga'] = $row['harga'];
            }

            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getNamaBarangById($id_barang)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT nama_barang FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(':id_barang', $id_barang, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data ? $data['nama_barang'] : null;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

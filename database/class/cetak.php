<?php

class Cetak
{
    private static $instance = null;
    private $pdo;

    // Constructor for database connection
    private function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Singleton pattern to get instance
    public static function getInstance($pdo)
    {
        if (self::$instance === null) {
            self::$instance = new self($pdo);
        }
        return self::$instance;
    }

    // Method to get transaction details by transaction ID
    public function getTransactionById($id_transaksi)
    {
        try {
            $stmt = $this->pdo->prepare("
                SELECT transaksi.*, member.nama as member_name, transaksi_detail.id_barang, barang.nama_barang, transaksi_detail.qty, transaksi_detail.harga,  transaksi_detail.total_harga
                FROM transaksi
                LEFT JOIN member ON member.id_member = transaksi.id_member
                LEFT JOIN transaksi_detail ON transaksi_detail.id_transaksi = transaksi.id_transaksi
                LEFT JOIN barang ON barang.id_barang = transaksi_detail.id_barang
                WHERE transaksi.id_transaksi = :id_transaksi
            ");
            $stmt->bindParam(':id_transaksi', $id_transaksi, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                throw new Exception("Transaction not found for ID: $id_transaksi");
            }

            return $data;
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Method to generate the new invoice code
    public function generateKodeNota()
    {
        try {
            // Query to get the largest invoice number
            $query = "SELECT MAX(invoice) as kodeTerbesar11 FROM transaksi";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $datanya = $stmt->fetch(PDO::FETCH_ASSOC);
            $kodenota = $datanya['kodeTerbesar11'];

            // Extract and increment the number part of the invoice
            $urutan = (int) substr($kodenota, 9, 3);
            $urutan++;

            // Format the new invoice code
            $tgl = date("jnyGi");  // Date-based prefix
            $huruf = "AD";  // Prefix letters
            $kodeCart = $huruf . $tgl . sprintf("%03s", $urutan);  // Final code

            return $kodeCart;
        } catch (PDOException $e) {
            echo "Error generating invoice code: " . $e->getMessage();
            return false;
        }
    }
}

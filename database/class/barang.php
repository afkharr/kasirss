<?php

class Barang
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Barang($pdo);
        }
        return self::$instance;
    }

    public function updateWithoutImage($id_barang, $nama_barang, $id_jenis_barang, $harga_barang, $stok_barang, $id_supplier)
    {
        try {
            $stmt = $this->db->prepare("UPDATE barang SET nama_barang=:nama_barang, id_jenis_barang=:id_jenis_barang, harga_barang=:harga_barang, stok_barang=:stok_barang, id_supplier=:id_supplier WHERE id_barang=:id_barang");

            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->bindParam(":id_supplier", $id_supplier);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION TAMBAH BARANG START
    public function add($nama_barang, $id_jenis_barang, $harga_barang, $stok_barang, $gambar, $id_supplier)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO barang (nama_barang, id_jenis_barang, harga_barang, stok_barang, gambar, id_supplier) VALUES (:nama_barang, :id_jenis_barang, :harga_barang, :stok_barang, :gambar,  :id_supplier)");
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_barang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_barang = :id_barang");
            $stmt->execute(array(":id_barang" => $id_barang));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH BARANG END

    // FUNCTION EDIT BARANG START
    public function update($id_barang, $nama_barang, $id_jenis_barang, $harga_barang, $stok_barang, $gambar, $id_supplier)
    {
        try {
            $stmt = $this->db->prepare("UPDATE barang SET nama_barang = :nama_barang, id_jenis_barang = :id_jenis_barang, harga_barang = :harga_barang, stok_barang = :stok_barang, gambar = :gambar, id_supplier = :id_supplier WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->bindParam(":nama_barang", $nama_barang);
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":harga_barang", $harga_barang);
            $stmt->bindParam(":stok_barang", $stok_barang);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT BARANG END

    // FUNCTION DELETE BARANG START
    public function delete($id_barang)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE BARANG END

    // FUNCTION GET ALL BARANG START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT barang.*, jenis_barang.nama_jenis_barang, supplier.nama_supplier
                                        FROM barang
                                        LEFT JOIN jenis_barang ON jenis_barang.id_jenis_barang = barang.id_jenis_barang
                                        LEFT JOIN supplier ON supplier.id_supplier = barang.id_supplier;
                                        ");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // FUNCTION GET ALL BARANG END

    public function getAllJenisBarang()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM jenis_barang");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAllSupplier()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM supplier");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function kurangiStok($id_barang, $jumlah)
    {
        try {
            // Cek apakah stok mencukupi
            $stmt = $this->db->prepare("SELECT stok_barang FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data['stok_barang'] < $jumlah) {
                throw new Exception("stok_err");
            }

            // Lakukan pengurangan stok
            $stmt = $this->db->prepare("UPDATE barang SET stok_barang = stok_barang - :jumlah WHERE id_barang = :id_barang");
            $stmt->bindParam(":jumlah", $jumlah);
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Function to get the stock of a specific item
    public function getStokBarang($id_barang)
    {
        try {
            $stmt = $this->db->prepare("SELECT stok_barang FROM barang WHERE id_barang = :id_barang");
            $stmt->bindParam(":id_barang", $id_barang);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $data['stok_barang'];
            } else {
                throw new Exception("Barang tidak ditemukan");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

<?php

class Supplier
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
            self::$instance = new Supplier($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH SUPPLIER START
    public function add($nama_supplier, $alamat_supplier, $no_telp, $no_rekening)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO supplier (nama_supplier, alamat_supplier, no_telp, no_rekening) VALUES (:nama_supplier, :alamat_supplier, :no_telp, :no_rekening)");
            $stmt->bindParam(":nama_supplier", $nama_supplier);
            $stmt->bindParam(":alamat_supplier", $alamat_supplier);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":no_rekening", $no_rekening);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_supplier)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM supplier WHERE id_supplier = :id_supplier");
            $stmt->execute(array(":id_supplier" => $id_supplier));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH SUPPLIER END

    // FUNCTION EDIT SUPPLIER START
    public function update($id_supplier, $nama_supplier, $alamat_supplier, $no_telp, $no_rekening)
    {
        try {
            $stmt = $this->db->prepare("UPDATE supplier SET nama_supplier = :nama_supplier, alamat_supplier = :alamat_supplier, no_telp = :no_telp, no_rekening = :no_rekening WHERE id_supplier = :id_supplier");
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->bindParam(":nama_supplier", $nama_supplier);
            $stmt->bindParam(":alamat_supplier", $alamat_supplier);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->bindParam(":no_rekening", $no_rekening);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT SUPPLIER END

    // FUNCTION DELETE SUPPLIER START
    public function delete($id_supplier)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM supplier WHERE id_supplier = :id_supplier");
            $stmt->bindParam(":id_supllier", $id_supplier);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE SUPPLIER END

    // FUNCTION GET ALL SUPPLIER START
    public function getAll()
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
    // FUNCTION GET ALL SUPPLIER END
}
?>
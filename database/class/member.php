<?php

class Member
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
            self::$instance = new Member($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH SUPPLIER START
    public function add($nama, $alamat, $jenis_kelamin, $total_poin, $no_telp)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO member (nama, alamat, jenis_kelamin, total_poin, no_telp) VALUES (:nama, :alamat, :jenis_kelamin, :total_poin, :no_telp)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":total_poin", $total_poin);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_member)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM member WHERE id_member = :id_member");
            $stmt->execute(array(":id_member" => $id_member));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH SUPPLIER END

    // FUNCTION EDIT SUPPLIER START
    public function update($id_member, $nama, $alamat, $jenis_kelamin, $total_poin, $no_telp)
    {
        try {
            $stmt = $this->db->prepare("UPDATE member SET nama = :nama, alamat = :alamat, jenis_kelamin = :jenis_kelamin, total_poin = :total_poin, no_telp = :no_telp WHERE id_member = :id_member");
            $stmt->bindParam(":id_member", $id_member);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":total_poin", $total_poin);
            $stmt->bindParam(":no_telp", $no_telp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT SUPPLIER END

    // FUNCTION DELETE SUPPLIER START
    public function delete($id_member)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM member WHERE id_member = :id_member");
            $stmt->bindParam(":id_member", $id_member);
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
            $stmt = $this->db->prepare("SELECT * FROM member");
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
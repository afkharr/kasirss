<?php

class Jenisbarang
{
        private $db;
        private static $instance = null;

        public function __construct($db_conn)
        {
            $this->db =$db_conn;
        }

        public static function getInstance($pdo)
        {
            if(self::$instance == null){
                self::$instance = new Jenisbarang($pdo);
            }

            return self::$instance;
        }

         // FUNCTION TAMBAH Jenis Barang START
    public function add($nama_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO jenis_barang (nama_jenis_barang) VALUES (:nama_jenis_barang)");
            $stmt->bindParam(":nama_jenis_barang", $nama_jenis_barang);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM jenis_barang WHERE id_jenis_barang = :id_jenis_barang");
            $stmt->execute(array(":id_jenis_barang" => $id_jenis_barang));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH Jenis Barang END

    // FUNCTION UPDATE START 

    public function update($id_jenis_barang, $nama_jenis_barang)
    {
        try {
            $stmt = $this->db->prepare("UPDATE jenis_barang SET nama_jenis_barang=:nama_jenis_barang WHERE id_jenis_barang=:id_jenis_barang");
    
            $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
            $stmt->bindParam(":nama_jenis_barang", $nama_jenis_barang);
    
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION UPDATE END

     // FUNCTION DELETE Jenis Barang START
     public function delete($id_jenis_barang)
     {
         try {
             $stmt = $this->db->prepare("DELETE FROM jenis_barang WHERE id_jenis_barang = :id_jenis_barang");
             $stmt->bindParam(":id_jenis_barang", $id_jenis_barang);
             $stmt->execute();
             return true;
         } catch (PDOException $e) {
             echo $e->getMessage();
             return false;
         }
     }
     // FUNCTION DELETE Jenis Barang END

     // FUNCTION GET ALL Jenis Barang START
    public function getAll()
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
    // FUNCTION GET ALL Jenis Barang END
}

?>
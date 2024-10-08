<?php

class User
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
            self::$instance = new User($pdo);
        }
        return self::$instance;
    }

    // function for menambahkan user dimulaiiiii 
    public function tambah($username, $password, $email, $nama, $role)
    {
        try {
            if ($this->cekUsernameDanEmail($username, $email)) {
                return false;
            }
            $stmt = $this->db->prepare("INSERT INTO user (username, password, email, nama, role) VALUES (:username, :password, :email, :nama, :role)");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_user)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE id_user = :id_user");
            $stmt->execute(array(":id_user" => $id_user));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for tambah user doneee

    // function for mengedit user dimulaiiiii 
    public function edit($id_user, $username, $email, $nama, $role)
    {
        try {
            $stmt = $this->db->prepare("UPDATE user SET  username = :username, email = :email, nama = :nama, role = :role WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for edit user doneee

    // function for menghapus user dimulaiiiii 
    public function hapus($id_user)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM user WHERE id_user = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menghapus user doneee

    // function for mendapatkan semua user dimulaiiiii 
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // function for menampilkan semua user doneee

    public function gantiPasswordUser($id_user, $password_baru)
    {

        try {
            $hash = password_hash($password_baru, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE id_user = :id_user");
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":id_user", $id_user);
            $stmt->execute();
            echo "<script>window.location.href ='index.php?page=user&alert=pass'</script>";
            exit ;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cekUsernameDanEmail($username, $email)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username AND email = :email");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $stmt->fetch();
            if ($stmt->rowCount()  > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

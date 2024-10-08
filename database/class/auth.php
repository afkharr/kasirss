<?php

// class untuk melakukan login dan register
class Auth
{
    private $db;
    private $error;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Auth($pdo);
        }
        return self::$instance;
    }

    public function login(string $email, string $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            // if ($data['password'] == $password) {
            //     $_SESSION['user'] = $data;
            //     header('location: index.php?');
            // } else {
            //     header('location: index.php?page=login&message=gagal');
            // }

            if (password_verify($password, $data['password'])) {
                $_SESSION['user'] = $data;
                return true;
            } else {
                return false;
            }

            // return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function register($username, $password, $email, $nama, $role)
    {
        try {

            $this->cekUsernameDanEmail($username, $email);
            // enkripsi
            // $hashPasswd = password_hash($password, PASSWORD_DEFAULT);
            //Masukkan user baru ke database
            $stmt = $this->db->prepare("INSERT INTO user(username, password, email, nama, role) 
                                        VALUES(:username ,:password, :email, :nama, :role)");
            $stmt->bindParam(":username", $username);
            // $stmt->bindParam(":password", $password); // GANTI METODE
            $stmt->bindParam(":password", password_hash($password, PASSWORD_BCRYPT));
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            if ($e->errorInfo[0] == 23000) {
                $this->error = "Email sudah digunakan!";
                return false;
            } else {
                echo $e->getMessage();
                return false;
            }
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

    public function forgotPassword($username, $email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username AND email = :email");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($data) {
                $this->NewPassword($username, $email, $password);
                echo "Username Dan Email sesuai passowrd diganti";
                return true;
            } else {
                echo "Username Dan Email yang dimasukkan tidak sesuai";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function NewPassword($username, $email, $password)
    {
        try {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->db->prepare("UPDATE user SET password = :password WHERE username = :username AND email = :email");
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        return true;
    }

    //pesan error
    public function getError()
    {
        return true;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user']);
    }
}

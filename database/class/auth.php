<?php

// class untuk melakukan login dan register
class Auth
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

            if ($data['password'] == $password) {
                $_SESSION['user'] = $data;
                header('location: index.php?');
            } else {
                header('location: index.php?page=login&message=gagal');
            }

            // return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

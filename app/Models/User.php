<?php
class User{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function findByEmail($email){

        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        // $stmt Ye ek PDOStatement object hai.
        $stmt = $this->conn->prepare($query);
        // yaha bind is liye kiya he takke jab function call ho findbyemail wala to jo email aye wo jaye idher
        $stmt->bindValue(':email', $email);
        // then excute 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        public function create($data){

        $query = "INSERT INTO users(role_id, first_name, last_name, email, phone, password)
        VALUES(:role_id, :first_name, :last_name, :email, :phone, :password)";

        $stmt = $this->conn->prepare($query);

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->bindValue(':role_id', $data['role_id']);
        $stmt->bindValue(':first_name', $data['first_name']);
        $stmt->bindValue(':last_name', $data['last_name']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':phone', $data['phone']);
        $stmt->bindValue(':password', $hashedPassword);

        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
    public function findByPhone($phone){

        $query = "SELECT * FROM users WHERE phone = :phone";
        $stmt = $this->conn->prepare($query);
        $stmt->bindparam(":phone", $phone);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
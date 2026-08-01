<?php

class Database{

    private $host = "localhost";
    private $db_name = "ecommerce_db";
    private $username = "root";
    private $password = "";

    public $conn;

    public function connect(){
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $exception){
            die("DataBase Connection Failed: " . $exception->getMessage());
        }
        return $this->conn;
    }

} 




?>
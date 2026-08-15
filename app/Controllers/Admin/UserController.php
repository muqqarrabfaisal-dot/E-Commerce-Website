<?php

    require_once __DIR__. '/../../Models/user.php';
    require_once __DIR__. '/../../../config/database.php';

class UserController{

    private $user;


    public function __construct()
    {
        $db = new Database();
        $pdo = $db->connect();
        $this->user = new User($pdo);
    }


    public function findAll(){
        $result = $this->user->findAll();
        return $result;
    }


    public function storeUser(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }
        
        $role_id = (int)$_POST['role_id'];
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = $_POST['password'];

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($password)) {
            return [
                'success' => false,
                'message' => 'All fields are required'
            ];
        }

        $emailresult = $this->user->findByEmail($email);

        if ($emailresult) {
            return [
                'success' => false,
                'message' => "Email Already Exists"
            ];
        }

        $phoneresult = $this->user->findByPhone($phone);

        if ($phoneresult) {
            return [
                'success' => false,
                'message' => "Phone Number Already Exists"
            ];
        }

        $data = [
            'role_id' => $role_id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
        ];

        $result = $this->user->create($data);

        if ($result) {
            return [
                'success' => true,
                'message' => "Data Inserted Successfully"
            ];
        }else {
            return [
                'success' => false,
                'message' => "Falied To Insert Data"
            ];
        }
    }

    public function updateUser(){
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $id = (int)$_POST['id'];
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone)) {
            return[
                'success' => false,
                'message' => "All Fields Are Required"
            ];
        }

        $emailresult = $this->user->findByEmailExceptId($id,$email);

        if ($emailresult) {
            return[
                'success' => false,
                'message' => "email Already Excists"
            ];
        }

        $phoneresult = $this->user->findByPhoneExceptId($id,$phone);
        
        if ($phoneresult) {
            return[
                'success' => false,
                'message' => "Phone Number Is Already Excists"
            ];
        }

        $data = [
            'id' => $id,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'phone' => $phone
        ];

        $result = $this->user->updateUser($data);

        if ($result) {
            return [
                'success' => true,
                'message' => "Updated Successfully"
            ];
        }else {
            return[
                'success' => false,
                'message' => "Not Updated"
            ];
        }
    }

    public function deleteUser(){
        if ($_SERVER["REQUEST_METHOD"] !="POST") {
            return;
        }

        $id = (int)$_POST['id'];

        $result = $this->user->deleteUser($id);

        if ($result) {
            return[
                'success' => true,
                'message' => "User Deleted"
            ];
        }else{
            return[
                'success' => false,
                'message' => "Deleting Failed"
            ];
        }

    }



}






?>
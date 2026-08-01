<?php

class RoleMiddleware{

    public function handle($roleId){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role_id'])) {
            header("Location: login.php");
            exit;
        }

        if ($_SESSION['role_id'] != $roleId) {
            header("Location: login.php");
            exit;
        } 
    }

}



?>
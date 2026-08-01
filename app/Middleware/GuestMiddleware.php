<?php

class GuestMiddleware{

    public function handle(){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['id'])) {
            
        if ($_SESSION['role_id'] == 1) {
            header("Location: index.php");
            exit;
        }
        if ($_SESSION['role_id'] == 2) {
            header("Location: index.php");
            exit;
        }
        }

    }


}


?>
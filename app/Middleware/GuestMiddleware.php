<?php

class GuestMiddleware{

    public function handle($roleid,$redirect){

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['id']) && $_SESSION['role_id'] == $roleid) {
            header("Location: $redirect");
            exit;
        }

    }


}


?>
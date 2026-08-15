<?php

require_once '../../../app/Controllers/admin/UserController.php';

$usercontroller = new UserController();
echo json_encode($usercontroller->storeUser());








?>
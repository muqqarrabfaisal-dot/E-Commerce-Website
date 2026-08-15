<?php

require_once '../../../app/Controllers/admin/UserController.php';

$usercontrol = new UserController();

echo json_encode($usercontrol->deleteUser());



?>
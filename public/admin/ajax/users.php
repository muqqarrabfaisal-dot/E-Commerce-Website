<?php

require_once '../../../app/Controllers/admin/UserController.php';

$userContoller = new UserController();

echo json_encode($userContoller->findAll());

?>
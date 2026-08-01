<?php

require_once '../../../app/Controllers/Admin/CategoryController.php';

$categorycontroller = new CategoryController();
$categories = $categorycontroller->getCategories();

header('Content-Type: application/json');

echo json_encode($categories);


?>

<?php


require_once '../../../app/Controllers/Admin/ProductController.php';

$productcontroller = new ProductController();
echo json_encode($productcontroller->updateProduct());






?>
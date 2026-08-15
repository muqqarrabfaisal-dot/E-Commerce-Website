<?php
header('Content-Type: application/json');

require_once '../../../app/Controllers/Admin/ProductController.php';

$product = new ProductController();

echo json_encode($product->storeProduct());


?>
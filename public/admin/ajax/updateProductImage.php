<?php

require_once '../../../app/Controllers/Admin/ProductController.php';

$product = new ProductController();

echo json_encode($product->updateProductImage());
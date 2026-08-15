<?php

require_once '../../../app/Controllers/Admin/ProductController.php';

$productcontrol = new ProductController();

echo json_encode($productcontrol->getCategoryName());

?>
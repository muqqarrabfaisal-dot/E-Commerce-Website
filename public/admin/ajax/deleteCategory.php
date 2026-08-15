<?php

require_once '../../../app/Controllers/admin/CategoryController.php';


$catcontoll = new CategoryController();
echo json_encode($catcontoll->deleteCategory());










?>
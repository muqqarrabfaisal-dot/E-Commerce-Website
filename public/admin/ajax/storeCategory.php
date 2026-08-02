<?php

require_once '../../../app/Controllers/admin/CategoryController.php';
        
    $categorycontroller = new CategoryController();
    echo json_encode($categorycontroller->storeCategory());





?>
<?php

require_once '../../../app/Controllers/Admin/OrderController.php';

$ordercontroller = new OrderController();

if ($_SERVER["REQUEST_METHOD"] === "GET"){
    echo json_encode($ordercontroller->findAll());
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $orderId = $_POST['order_id'] ?? null;
    $status = $_POST['status'] ?? null;

    if (!$orderId || !$status) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid Data"
        ]);
        exit;
    }
        $result = $ordercontroller->updateOrderStatus($orderId,$status);
    
    echo json_encode([
        "status" => $result
    ]);
    exit;
}
?>
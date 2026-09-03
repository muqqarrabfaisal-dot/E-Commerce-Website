<?php

require_once '../../../app/Controllers/Admin/OrderController.php';

$ordercontroller = new OrderController();

$orderId = $_GET["id"] ?? null;

if (!$orderId) {
    echo json_encode([
        "status" => false,
        "message" => "Order Id is Required"
    ]);
    exit;
}

$order = $ordercontroller->findById($orderId);
$orderItems = $ordercontroller->findOrderItems($orderId);

echo json_encode([
    'status' => true,
    'order' => $order,
    'items' => $orderItems
]);

exit;

?>
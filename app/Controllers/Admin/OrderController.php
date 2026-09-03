<?php

    require_once __DIR__. '/../../Models/Order.php';
    require_once __DIR__. '/../../../config/database.php';

class OrderController{
    private $order;

    public function __construct()
    {
        $db = new Database();
        $pdo = $db->connect();
        $this->order = new Order($pdo);
    }

    public function findAll(){
        return $this->order->findAll();
    }
    
    public function updateOrderStatus($orderId, $status){
        return $this->order->updateOrderStatus($orderId, $status);
    }

    public function findById($orderId){
        return $this->order->findById($orderId);
    }

    public function findOrderItems($orderId){
        return $this->order->findOrderItems($orderId);
    }
}




?>
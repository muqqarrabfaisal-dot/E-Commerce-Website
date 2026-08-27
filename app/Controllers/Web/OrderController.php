<?php

    require_once __DIR__. '/../../Models/Order.php';
    require_once __DIR__. '/../../../config/database.php';

class OrderController{

    private $order;

    public function __construct(){
        $db = new Database();
        $pdo = $db->connect();
        $this->order = new Order($pdo);
    }

    public function placeOrder($data,$products,$cart){
        $orderId = $this->order->createOrder($data);

        foreach ($products as $product) {
            
            $productId = $product['id'];
            $quantity = $cart[$productId];

            $price = (float)$product['price'];  

            $subtotal = $price * $quantity;

            $itemData = [
                'order_id'    => $orderId,
                'product_id'  => $productId,
                'product_name'=> $product['product_name'],
                'price'       => $price,
                'quantity'    => $quantity,
                'subtotal'    => $subtotal
            ];

            $this->order->createOrderItem($itemData);
        }

        return $orderId;
    }


}


?>
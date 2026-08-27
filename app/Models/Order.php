<?php

class Order{

private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

public function createOrder($data)
{
    $query = "INSERT INTO orders
    (user_id,first_name,last_name,email,address,city,country,zip_code,phone,order_notes,payment_method,total_amount)
    VALUES
    (:user_id,:first_name,:last_name,:email,:address,:city,:country,:zip_code,:phone,:order_notes,:payment_method,:total_amount)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(":user_id", $data['user_id']);
    $stmt->bindValue(":first_name", $data['first_name']);
    $stmt->bindValue(":last_name", $data['last_name']);
    $stmt->bindValue(":email", $data['email']);
    $stmt->bindValue(":address", $data['address']);
    $stmt->bindValue(":city", $data['city']);
    $stmt->bindValue(":country", $data['country']);
    $stmt->bindValue(":zip_code", $data['zip_code']);
    $stmt->bindValue(":phone", $data['phone']);
    $stmt->bindValue(":order_notes", $data['order_notes']);
    $stmt->bindValue(":payment_method", $data['payment_method']);
    $stmt->bindValue(":total_amount", $data['total_amount']);

    $stmt->execute();

    return $this->conn->lastInsertId();
}

public function createOrderItem($data)
{
    $query = "INSERT INTO order_items
    (order_id,product_id,product_name,price,quantity,subtotal)
    VALUES
    (:order_id,:product_id,:product_name,:price,:quantity,:subtotal)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindValue(":order_id", $data['order_id']);
    $stmt->bindValue(":product_id", $data['product_id']);
    $stmt->bindValue(":product_name", $data['product_name']);
    $stmt->bindValue(":price", $data['price']);
    $stmt->bindValue(":quantity", $data['quantity']);
    $stmt->bindValue(":subtotal", $data['subtotal']);

    $stmt->execute();

    return $stmt->rowCount() > 0;
}







}




?>
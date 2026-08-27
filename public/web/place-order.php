<?php

session_start();

require_once '../../app/Controllers/Web/ProductController.php';
require_once '../../app/Controllers/Web/OrderController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: checkout.php");
    exit;
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    header("Location: cart.php");
    exit;
}

$ids = array_keys($cart);

$productController = new ProductController();

$products = $productController->cartProducts($ids);

if (empty($products)) {
    header("Location: cart.php");
    exit;
}

$grandTotal = 0;

foreach ($products as $product) {

    $productId = $product['id'];

    $quantity = (int)$cart[$productId];

    $price = (float)$product['price'];

    $subtotal = $price * $quantity;

    $grandTotal += $subtotal;
}

$userId = $_SESSION['id'] ?? null;

$data = [

    'user_id'       => $userId,

    'first_name'    => trim($_POST['first_name'] ?? ''),

    'last_name'     => trim($_POST['last_name'] ?? ''),

    'email'         => trim($_POST['email'] ?? ''),

    'address'       => trim($_POST['address'] ?? ''),

    'city'          => trim($_POST['city'] ?? ''),

    'country'       => trim($_POST['country'] ?? ''),

    'zip_code'      => trim($_POST['zip_code'] ?? ''),

    'phone'         => trim($_POST['phone'] ?? ''),

    'order_notes'   => trim($_POST['order_notes'] ?? ''),

    'payment_method' => $_POST['payment_method'] ?? '',

    'total_amount'  => $grandTotal

];

if (
    empty($data['first_name']) ||
    empty($data['last_name']) ||
    empty($data['email']) ||
    empty($data['address']) ||
    empty($data['city']) ||
    empty($data['country']) ||
    empty($data['zip_code']) ||
    empty($data['phone']) ||
    empty($data['payment_method'])
) {

    die("Please fill all required fields.");

}

$orderController = new OrderController();

$orderId = $orderController->placeOrder(
    $data,
    $products,
    $cart
);

unset($_SESSION['cart']);

header("Location: order-success.php?id=" . $orderId);
exit;

?>
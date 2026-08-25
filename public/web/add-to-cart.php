<?php

session_start();

require_once '../../app/Controllers/Web/ProductController.php';

$productId = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if (!$productId || !is_numeric($productId)) {
    header("Location: index.php");
    exit;
}

$quantity = (int)$quantity;

if ($quantity < 1) {
    $quantity = 1;
}

$productController = new ProductController();

$product = $productController->show($productId);

if (!$product) {
    header("Location: index.php");
    exit;
}

$stock = (int)$product['quantity'];

if ($stock < 1) {
    header("Location: detail.php?id=" . $productId);
    exit;
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$currentQuantity = $_SESSION['cart'][$productId] ?? 0;

$newQuantity = $currentQuantity + $quantity;

if ($newQuantity > $stock) {
    $newQuantity = $stock;
}

$_SESSION['cart'][$productId] = $newQuantity;

header("Location: detail.php?id=" . $productId);
exit;

?>
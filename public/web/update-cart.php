<?php

session_start();

$productId = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? null;

if (!$productId || !is_numeric($productId)) {
    header("Location: cart.php");
    exit;
}

$quantity = (int)$quantity;

if ($quantity < 1) {
    unset($_SESSION['cart'][$productId]);
} else {
    $_SESSION['cart'][$productId] = $quantity;
}

header("Location: cart.php");
exit;
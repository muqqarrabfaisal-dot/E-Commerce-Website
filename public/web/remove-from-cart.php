<?php

session_start();

$productId = $_GET['id'] ?? null;

if (!$productId || !is_numeric($productId)) {
    header("Location: cart.php");
    exit;
}

$productId = (int)$productId;

if (isset($_SESSION['cart'][$productId])) {
    unset($_SESSION['cart'][$productId]);
}

header("Location: cart.php");
exit;

?>
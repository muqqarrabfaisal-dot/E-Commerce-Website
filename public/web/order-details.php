<?php

session_start();

require_once '../../app/Controllers/Web/OrderController.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: my-orders.php");
    exit;
}

$userId = $_SESSION['id'];

$orderId = (int)$_GET['id'];

$orderController = new OrderController();

$order = $orderController->getOrderByUser($orderId, $userId);

if (!$order) {
    die("Access Denied!");
}

$orderItems = $orderController->orderItems($orderId);

?>
<?php include("layout/header.php"); ?>

<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Order Details</h3>

                <ul class="breadcrumb-tree">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="my-orders.php">My Orders</a></li>
                    <li class="active">Order Details</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="section">
    <div class="container">

        <div class="section-title">
            <h3 class="title">
                Order #<?php echo $orderId; ?>
            </h3>
        </div>


        <?php if (empty($orderItems)): ?>

            <p>No products found for this order.</p>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table">

                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($orderItems as $item): ?>

                            <tr>

                                <td>
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </td>

                                <td>
                                    $<?php echo number_format($item['price'], 2); ?>
                                </td>

                                <td>
                                    <?php echo (int)$item['quantity']; ?>
                                </td>

                                <td>
                                    $<?php echo number_format($item['subtotal'], 2); ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>


        <a href="my-orders.php" class="primary-btn">
            Back to My Orders
        </a>

    </div>
</div>


<?php include("layout/footer.php"); ?>
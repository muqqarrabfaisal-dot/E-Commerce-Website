<?php
session_start();

require_once '../../app/Controllers/Web/OrderController.php';

// Check user login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
$userId = $_SESSION['id'];

$ordercontroller = new OrderController();

$orders = $ordercontroller->myOrders($userId);

?>
<?php include("layout/header.php"); ?>

<div class="section">
    <div class="container">

        <div class="section-title">
            <h3 class="title">My Orders</h3>
        </div>

        <?php if (empty($orders)): ?>

            <p>You have not placed any orders yet.</p>

        <?php else: ?>

            <table class="table">

                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($orders as $order): ?>

                        <tr>

                            <td>
                                #<?php echo $order['id']; ?>
                            </td>

                            <td>
                                $<?php echo number_format($order['total_amount'], 2); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($order['payment_method']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($order['status']); ?>
                            </td>

                            <td>
                                <?php echo $order['created_at']; ?>
                            </td>

                            <td>
                                <a href="order-details.php?id=<?php echo $order['id']; ?>" 
                                   class="primary-btn">
                                    View Details
                                </a>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

    </div>
</div>

<?php include("layout/footer.php"); ?>
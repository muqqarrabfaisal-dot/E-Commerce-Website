<?php

session_start();

$orderId = $_GET['id'] ?? null;

?>

<?php include("layout/header.php"); ?>


<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h3 class="breadcrumb-header">
                    Order Success
                </h3>

                <ul class="breadcrumb-tree">

                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li class="active">
                        Order Success
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>
<!-- /BREADCRUMB -->


<!-- SECTION -->
<div class="section">

    <div class="container">

        <div class="row">

            <div class="col-md-12 text-center">

                <div class="order-success">

                    <i
                        class="fa fa-check-circle"
                        style="font-size: 70px; margin-bottom: 20px;"
                    ></i>

                    <h2>
                        Order Placed Successfully!
                    </h2>

                    <p>
                        Thank you for your order.
                    </p>

                    <?php if ($orderId): ?>

                        <h4>
                            Order ID:
                            #<?php echo (int)$orderId; ?>
                        </h4>

                    <?php endif; ?>

                    <br>

                    <a
                        href="index.php"
                        class="primary-btn"
                    >
                        Continue Shopping
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- /SECTION -->


<?php include("layout/footer.php"); ?>
<?php
session_start();
require_once '../../app/Controllers/Web/ProductController.php';

$cart = $_SESSION['cart'] ?? [];

$ids = array_keys($cart);

$productcontroller = new ProductController();

$products = $productcontroller->cartProducts($ids);

?>

<?php include("layout/header.php");?>

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <h3 class="breadcrumb-header">Shopping Cart</h3>

                <ul class="breadcrumb-tree">

                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li class="active">
                        Shopping Cart
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

            <!-- CART -->
            <div class="col-md-8">

                <div class="section-title">

                    <h3 class="title">Your Cart</h3>

                </div>


                <?php if (empty($products)): ?>

                    <div class="cart-empty">

                        <h3>Your cart is empty</h3>

                        <p>
                            You haven't added any products to your cart yet.
                        </p>

                        <a href="index.php" class="primary-btn">
                            Continue Shopping
                        </a>

                    </div>

                <?php else: ?>


                    <?php

                    $grandTotal = 0;

                    foreach ($products as $product):

                        $productId = $product['id'];

                        $cartQuantity = $cart[$productId];

                        $price = (float)$product['price'];

                        $subtotal = $price * $cartQuantity;

                        $grandTotal += $subtotal;

                    ?>

                        <!-- CART PRODUCT -->
                        <div class="cart-product">

                            <!-- IMAGE -->
                            <div class="cart-product-img">

                                <img
                                    src="../uploads/products/<?php echo htmlspecialchars($product['image']); ?>"
                                    alt="<?php echo htmlspecialchars($product['product_name']); ?>"
                                >

                            </div>


                            <!-- DETAILS -->
                            <div class="cart-product-details">

                                <h3 class="cart-product-name">

                                    <a href="detail.php?id=<?php echo (int)$product['id']; ?>">

                                        <?php echo htmlspecialchars($product['product_name']); ?>

                                    </a>

                                </h3>

                                <p class="cart-category">

                                    <?php echo htmlspecialchars($product['category_name']); ?>

                                </p>

                                <h4 class="cart-price">

                                    $<?php echo number_format($price, 2); ?>

                                </h4>

                            </div>


                            <!-- QUANTITY -->
<div class="cart-product-qty">

    <span>Qty</span>

    <form action="update-cart.php" method="POST" class="cart-quantity">

        <input
            type="hidden"
            name="product_id"
            value="<?php echo (int)$productId; ?>"
        >

        <!-- MINUS -->
        <button
            type="submit"
            name="quantity"
            value="<?php echo (int)$cartQuantity - 1; ?>"
            <?php echo $cartQuantity <= 1 ? 'disabled' : ''; ?>
        >
            -
        </button>

        <!-- CURRENT QUANTITY -->
        <span>
            <?php echo (int)$cartQuantity; ?>
        </span>

        <!-- PLUS -->
        <button
            type="submit"
            name="quantity"
            value="<?php echo (int)$cartQuantity + 1; ?>"
            <?php echo $cartQuantity >= (int)$product['quantity'] ? 'disabled' : ''; ?>
        >
            +
        </button>

    </form>

</div>


                            <!-- SUBTOTAL -->
                            <div class="cart-product-total">

                                <span>Total</span>

                                <strong>
                                    $<?php echo number_format($subtotal, 2); ?>
                                </strong>

                            </div>


                            <!-- REMOVE -->
                            <div class="cart-product-remove">
                                <a href="remove-from-cart.php?id=<?php echo (int)$product['id']; ?>"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <!-- /CART PRODUCT -->


                    <?php endforeach; ?>


                    <!-- CONTINUE SHOPPING -->
                    <div class="cart-actions">

                        <a href="index.php" class="primary-btn">

                            <i class="fa fa-arrow-left"></i>

                            Continue Shopping

                        </a>

                    </div>


                <?php endif; ?>

            </div>
            <!-- /CART -->


            <!-- CART SUMMARY -->
            <?php if (!empty($products)): ?>

                <div class="col-md-4">

                    <div class="cart-summary">

                        <div class="section-title text-center">

                            <h3 class="title">Cart Summary</h3>

                        </div>


                        <div class="summary-row">

                            <span>Products</span>

                            <strong>
                                <?php echo count($products); ?>
                            </strong>

                        </div>


                        <div class="summary-row">

                            <span>Shipping</span>

                            <strong>FREE</strong>

                        </div>


                        <div class="summary-divider"></div>


                        <div class="summary-total">

                            <span>Total</span>

                            <strong>
                                $<?php echo number_format($grandTotal, 2); ?>
                            </strong>

                        </div>


                        <a href="checkout.php" class="primary-btn checkout-btn">

                            Proceed to Checkout

                            <i class="fa fa-arrow-right"></i>

                        </a>

                    </div>

                </div>






                
    <!-- YAHAN CART SUMMARY -->
    <div class="cart-summary">

        <h3>Cart Summary</h3>

        <div class="summary-row">
            <span>Subtotal</span>
            <strong>
                $<?php echo number_format($grandTotal, 2); ?>
            </strong>
        </div>

        <div class="summary-row">
            <span>Shipping</span>
            <strong>FREE</strong>
        </div>

        <hr>

        <div class="summary-row total">
            <span>Total</span>
            <strong>
                $<?php echo number_format($grandTotal, 2); ?>
            </strong>
        </div>

        <a href="checkout.php" class="primary-btn">
            Proceed to Checkout
        </a>

    </div>


            <?php endif; ?>
            <!-- /CART SUMMARY -->

            

        </div>

    </div>

</div>

<!-- /SECTION -->


<?php include("layout/footer.php"); ?>
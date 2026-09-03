<?php

require_once '../../app/Middleware/AuthMiddleware.php';
require_once '../../app/Controllers/Web/ProductController.php';
require_once '../../app/Controllers/Web/OrderController.php';

$auth = new AuthMiddleware();
$auth->handle();

$cart = $_SESSION['cart'] ?? [];

$ids = array_keys($cart);

$productcontroller = new ProductController();

$products = $productcontroller->cartProducts($ids);

?>

<?php include("layout/header.php"); ?>


<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">

            <div class="col-md-12">

                <h3 class="breadcrumb-header">Checkout</h3>

                <ul class="breadcrumb-tree">

                    <li>
                        <a href="index.php">Home</a>
                    </li>

                    <li class="active">
                        Checkout
                    </li>

                </ul>

            </div>

        </div>
        <!-- /row -->

    </div>
    <!-- /container -->

</div>
<!-- /BREADCRUMB -->


<!-- SECTION -->
<div class="section">

    <!-- container -->
    <div class="container">

        <!-- FORM -->
        <form action="place-order.php" method="POST">

            <!-- row -->
            <div class="row">


                <!-- LEFT SIDE -->
                <div class="col-md-7">


                    <!-- Billing Details -->
                    <div class="billing-details">

                        <div class="section-title">

                            <h3 class="title">
                                Billing address
                            </h3>

                        </div>


                        <!-- First Name -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="text"
                                name="first_name"
                                placeholder="First Name"
                                required
                            >

                        </div>


                        <!-- Last Name -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="text"
                                name="last_name"
                                placeholder="Last Name"
                                required
                            >

                        </div>


                        <!-- Email -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="email"
                                name="email"
                                placeholder="Email"
                                required
                            >

                        </div>


                        <!-- Address -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="text"
                                name="address"
                                placeholder="Address"
                                required
                            >

                        </div>


                        <!-- City -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="text"
                                name="city"
                                placeholder="City"
                                required
                            >

                        </div>


                        <!-- Country -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="text"
                                name="country"
                                placeholder="Country"
                                required
                            >

                        </div>


                        <!-- ZIP Code -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="text"
                                name="zip_code"
                                placeholder="ZIP Code"
                                required
                            >

                        </div>


                        <!-- Phone -->
                        <div class="form-group">

                            <input
                                class="input"
                                type="tel"
                                name="phone"
                                placeholder="Telephone"
                                required
                            >

                        </div>


                        <!-- Create Account -->
                        <div class="form-group">

                            <div class="input-checkbox">

                                <input
                                    type="checkbox"
                                    id="create-account"
                                >

                                <label for="create-account">

                                    <span></span>

                                    Create Account?

                                </label>


                                <div class="caption">

                                    <p>
                                        Create an account for faster checkout.
                                    </p>

                                    <input
                                        class="input"
                                        type="password"
                                        name="password"
                                        placeholder="Enter Your Password"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /Billing Details -->



                    <!-- Shipping Details -->
                    <div class="shiping-details">

                        <div class="section-title">

                            <h3 class="title">
                                Shipping address
                            </h3>

                        </div>


                        <div class="input-checkbox">

                            <input
                                type="checkbox"
                                id="shiping-address"
                            >

                            <label for="shiping-address">

                                <span></span>

                                Ship to a different address?

                            </label>


                            <div class="caption">


                                <!-- First Name -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="text"
                                        name="shipping_first_name"
                                        placeholder="First Name"
                                    >

                                </div>


                                <!-- Last Name -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="text"
                                        name="shipping_last_name"
                                        placeholder="Last Name"
                                    >

                                </div>


                                <!-- Email -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="email"
                                        name="shipping_email"
                                        placeholder="Email"
                                    >

                                </div>


                                <!-- Address -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="text"
                                        name="shipping_address"
                                        placeholder="Address"
                                    >

                                </div>


                                <!-- City -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="text"
                                        name="shipping_city"
                                        placeholder="City"
                                    >

                                </div>


                                <!-- Country -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="text"
                                        name="shipping_country"
                                        placeholder="Country"
                                    >

                                </div>


                                <!-- ZIP -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="text"
                                        name="shipping_zip_code"
                                        placeholder="ZIP Code"
                                    >

                                </div>


                                <!-- Phone -->
                                <div class="form-group">

                                    <input
                                        class="input"
                                        type="tel"
                                        name="shipping_phone"
                                        placeholder="Telephone"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- /Shipping Details -->



                    <!-- Order Notes -->
                    <div class="order-notes">

                        <textarea
                            class="input"
                            name="order_notes"
                            placeholder="Order Notes"
                        ></textarea>

                    </div>
                    <!-- /Order notes -->


                </div>
                <!-- /LEFT SIDE -->



                <!-- RIGHT SIDE -->
                <div class="col-md-5 order-details">


                    <div class="section-title text-center">

                        <h3 class="title">
                            Your Order
                        </h3>

                    </div>



                    <div class="order-summary">


                        <!-- HEADER -->
                        <div class="order-col">

                            <div>
                                <strong>PRODUCT</strong>
                            </div>

                            <div>
                                <strong>TOTAL</strong>
                            </div>

                        </div>



                        <!-- PRODUCTS -->
                        <div class="order-products">

                            <?php

                            $grandTotal = 0;

                            foreach ($products as $product):

                                $productId = $product['id'];

                                $cartQuantity = $cart[$productId];

                                $price = (float)$product['price'];

                                $subTotal = $price * $cartQuantity;

                                $grandTotal += $subTotal;

                            ?>

                                <div class="order-col">

                                    <div>

                                        <?php echo (int)$cartQuantity; ?>x

                                        <?php echo htmlspecialchars(
                                            $product['product_name']
                                        ); ?>

                                    </div>

                                    <div>

                                        $<?php echo number_format(
                                            $subTotal,
                                            2
                                        ); ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        </div>
                        <!-- /Products -->



                        <!-- SHIPPING -->
                        <div class="order-col">

                            <div>
                                Shipping
                            </div>

                            <div>

                                <strong>
                                    FREE
                                </strong>

                            </div>

                        </div>



                        <!-- TOTAL -->
                        <div class="order-col">

                            <div>

                                <strong>
                                    TOTAL
                                </strong>

                            </div>

                            <div>

                                <strong class="order-total">

                                    $<?php echo number_format(
                                        $grandTotal,
                                        2
                                    ); ?>

                                </strong>

                            </div>

                        </div>


                    </div>
                    <!-- /Order Summary -->



                    <!-- PAYMENT METHOD -->
                    <div class="payment-method">


                        <!-- Bank Transfer -->
                        <div class="input-radio">

                            <input
                                type="radio"
                                name="payment_method"
                                value="bank_transfer"
                                id="payment-1"
                                required
                            >

                            <label for="payment-1">

                                <span></span>

                                Direct Bank Transfer

                            </label>

                            <div class="caption">

                                <p>
                                    Pay directly through bank transfer.
                                </p>

                            </div>

                        </div>



                        <!-- Cheque -->
                        <div class="input-radio">

                            <input
                                type="radio"
                                name="payment_method"
                                value="cheque"
                                id="payment-2"
                            >

                            <label for="payment-2">

                                <span></span>

                                Cheque Payment

                            </label>

                            <div class="caption">

                                <p>
                                    Pay using cheque.
                                </p>

                            </div>

                        </div>



                        <!-- Paypal -->
                        <div class="input-radio">

                            <input
                                type="radio"
                                name="payment_method"
                                value="paypal"
                                id="payment-3"
                            >

                            <label for="payment-3">

                                <span></span>

                                Paypal System

                            </label>

                            <div class="caption">

                                <p>
                                    Pay using PayPal.
                                </p>

                            </div>

                        </div>


                    </div>
                    <!-- /Payment Method -->



                    <!-- TOTAL HIDDEN VALUE -->
                    <input
                        type="hidden"
                        name="total_amount"
                        value="<?php echo htmlspecialchars($grandTotal); ?>"
                    >



                    <!-- TERMS -->
                    <div class="input-checkbox">

                        <input
                            type="checkbox"
                            id="terms"
                            name="terms"
                            value="1"
                            required
                        >

                        <label for="terms">

                            <span></span>

                            I've read and accept the

                            <a href="#">
                                terms & conditions
                            </a>

                        </label>

                    </div>



                    <!-- PLACE ORDER -->
                    <button
                        type="submit"
                        class="primary-btn order-submit"
                    >

                        Place order

                        <i class="fa fa-arrow-right"></i>

                    </button>


                </div>
                <!-- /RIGHT SIDE -->


            </div>
            <!-- /row -->

        </form>
        <!-- /FORM -->

    </div>
    <!-- /container -->

</div>
<!-- /SECTION -->


<?php include("layout/footer.php"); ?>
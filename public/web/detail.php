<?php 

	require_once '../../app/Controllers/Web/ProductController.php';

	$productontrol = new ProductController();

	$id = $_GET['id'] ?? null;

	if (!$id || !is_numeric($id)) {
		header("Location: index.php");
		exit;
	}
	$product = $productontrol->show($id);

	if (!$product) {
		header("Location: index.php");
		exit;
	}

	$related = $productontrol->related($product['category_id'],$product['id']);

	include("layout/header.php");

?>
	<!-- BREADCRUMB -->
	<div id="breadcrumb" class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb-tree">
						<li><a href="index.php">Home</a></li>
						<li><a href="#">All Categories</a></li>
						<li><a href="store.php">Products</a></li>
						<li><a href="#"><?php echo htmlspecialchars($product['category_name'] ?? 'Category');?></a></li>
						<li class="active"><?php echo htmlspecialchars($product['product_name']);?></li>
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
			<!-- row -->
			<div class="row">
				<!-- Product main img -->
				<div class="col-md-5 ">
					<div id="product-main-img">
						<div class="product-preview">
							<img src="<?php echo '../uploads/products/' . htmlspecialchars($product['image']);?>"
							alt="<?php echo htmlspecialchars($product['product_name']);?>">
						</div>
					</div>
				</div>
				<!-- /Product main img -->

				<!-- /Product thumb imgs -->

				<!-- Product details -->
				<div class="col-md-5">
					<div class="product-details">
						<h2 class="product-name"><?php echo htmlspecialchars($product['product_name']);?></h2>
						<div>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o"></i>
							</div>
							<a class="review-link" href="#">10 Review(s) | Add your review</a>
						</div>
						<div>
							<h3 class="product-price">$<?php echo htmlspecialchars($product['price']);?>
								<?php if ((int)$product['quantity'] > 0) : ?>
									<span class="product-available">In Stock</span>
								<?php else:?>
									<span class="product-available"> Out Of Stock </span>
								<?php endif; ?>
							</h3>
						</div>
						<p><?php echo htmlspecialchars($product['description']); ?></p>

						<!-- <div class="product-options">
							<label>
								Size
								<select class="input-select">
									<option value="0">X</option>
								</select>
							</label>
							<label>
								Color
								<select class="input-select">
									<option value="0">Red</option>
								</select>
							</label>
						</div> -->
					<?php
						$cartQuantity = $_SESSION['cart'][$product['id']] ?? 0;
						$availableQuantity = (int)$product['quantity'] - (int)$cartQuantity;
						?>

							<form action="add-to-cart.php" method="POST">

								<div class="add-to-cart">

									<div class="qty-label">
										Qty

										<div class="input-number">

											<input
												type="number"
												name="quantity"
												value="1"
												min="1"
												max="<?php echo $availableQuantity; ?>"
											>

											<span class="qty-up">+</span>
											<span class="qty-down">-</span>

										</div>
									</div>

									<input
										type="hidden"
										name="product_id"
										value="<?php echo (int)$product['id']; ?>"
									>

									<button class="add-to-cart-btn">
										<i class="fa fa-shopping-cart"></i>
										add to cart
									</button>

								</div>

							</form>

						<ul class="product-btns">
							<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
							<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
						</ul>

						<ul class="product-links">
							<li>Category:</li>
							<li><a href="#">Headphones</a></li>
							<li><a href="product.php">Products</a></li>
						</ul>

						<ul class="product-links">
							<li>Share:</li>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-envelope"></i></a></li>
						</ul>

					</div>
				</div>
				<!-- /Product details -->

				<!-- Product tab -->
				<div class="col-md-12">
					<div id="product-tab">
						<!-- product tab nav -->
						<ul class="tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							<li><a data-toggle="tab" href="#tab2">Details</a></li>
							<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
						</ul>
						<!-- /product tab nav -->

						<!-- product tab content -->
						<div class="tab-content">
							<!-- tab1  -->
							<div id="tab1" class="tab-pane fade in active">
								<div class="row">
									<div class="col-md-12">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
											non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										</p>
									</div>
								</div>
							</div>
							<!-- /tab1  -->

							<!-- tab2  -->
							<div id="tab2" class="tab-pane fade in">
								<div class="row">
									<div class="col-md-12">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
											tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
											quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
											consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
											cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
											non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										</p>
									</div>
								</div>
							</div>
							<!-- /tab2  -->

							<!-- tab3  -->
							<div id="tab3" class="tab-pane fade in">
								<div class="row">
									<!-- Rating -->
									<div class="col-md-3">
										<div id="rating">
											<div class="rating-avg">
												<span>4.5</span>
												<div class="rating-stars">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
											</div>
											<ul class="rating">
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
													</div>
													<div class="rating-progress">
														<div style="width: 80%;"></div>
													</div>
													<span class="sum">3</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div style="width: 60%;"></div>
													</div>
													<span class="sum">2</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div></div>
													</div>
													<span class="sum">0</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div></div>
													</div>
													<span class="sum">0</span>
												</li>
												<li>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
														<i class="fa fa-star-o"></i>
													</div>
													<div class="rating-progress">
														<div></div>
													</div>
													<span class="sum">0</span>
												</li>
											</ul>
										</div>
									</div>
									<!-- /Rating -->

									<!-- Reviews -->
									<div class="col-md-6">
										<div id="reviews">
											<ul class="reviews">
												<li>
													<div class="review-heading">
														<h5 class="name">John</h5>
														<p class="date">27 DEC 2018, 8:0 PM</p>
														<div class="review-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
															do eiusmod tempor incididunt ut labore et dolore magna
															aliqua</p>
													</div>
												</li>
												<li>
													<div class="review-heading">
														<h5 class="name">John</h5>
														<p class="date">27 DEC 2018, 8:0 PM</p>
														<div class="review-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
															do eiusmod tempor incididunt ut labore et dolore magna
															aliqua</p>
													</div>
												</li>
												<li>
													<div class="review-heading">
														<h5 class="name">John</h5>
														<p class="date">27 DEC 2018, 8:0 PM</p>
														<div class="review-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o empty"></i>
														</div>
													</div>
													<div class="review-body">
														<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
															do eiusmod tempor incididunt ut labore et dolore magna
															aliqua</p>
													</div>
												</li>
											</ul>
											<ul class="reviews-pagination">
												<li class="active">1</li>
												<li><a href="#">2</a></li>
												<li><a href="#">3</a></li>
												<li><a href="#">4</a></li>
												<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
											</ul>
										</div>
									</div>
									<!-- /Reviews -->

									<!-- Review Form -->
									<div class="col-md-3">
										<div id="review-form">
											<form class="review-form">
												<input class="input" type="text" placeholder="Your Name">
												<input class="input" type="email" placeholder="Your Email">
												<textarea class="input" placeholder="Your Review"></textarea>
												<div class="input-rating">
													<span>Your Rating: </span>
													<div class="stars">
														<input id="star5" name="rating" value="5" type="radio"><label
															for="star5"></label>
														<input id="star4" name="rating" value="4" type="radio"><label
															for="star4"></label>
														<input id="star3" name="rating" value="3" type="radio"><label
															for="star3"></label>
														<input id="star2" name="rating" value="2" type="radio"><label
															for="star2"></label>
														<input id="star1" name="rating" value="1" type="radio"><label
															for="star1"></label>
													</div>
												</div>
												<button class="primary-btn">Submit</button>
											</form>
										</div>
									</div>
									<!-- /Review Form -->
								</div>
							</div>
							<!-- /tab3  -->
						</div>
						<!-- /product tab content  -->
					</div>
				</div>
				<!-- /product tab -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	
<!-- Section -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- Section Title -->
            <div class="col-md-12">
                <div class="section-title text-center">
                    <h3 class="title">Related Products</h3>
                </div>
            </div>

            <!-- Related Products -->
            <?php foreach ($related as $item): ?>

                <div class="col-md-3 col-xs-6">
                    <div class="product">

                        <!-- Product Image -->
                        <div class="product-img">
                            <img
                                src="<?php echo '../uploads/products/' . htmlspecialchars($item['image']); ?>"
                                alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                            >
                        </div>

                        <!-- Product Body -->
                        <div class="product-body">

                            <p class="product-category">
                                <?php echo htmlspecialchars($item['category_name']); ?>
                            </p>

                            <h3 class="product-name">
                                <a href="detail.php?id=<?php echo $item['id']; ?>">
                                    <?php echo htmlspecialchars($item['product_name']); ?>
                                </a>
                            </h3>

                            <h4 class="product-price">
                                $<?php echo htmlspecialchars($item['price']); ?>
                            </h4>

                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>

                            <div class="product-btns">

                                <button class="add-to-wishlist">
                                    <i class="fa fa-heart-o"></i>
                                    <span class="tooltipp">
                                        add to wishlist
                                    </span>
                                </button>

                                <button class="add-to-compare">
                                    <i class="fa fa-exchange"></i>
                                    <span class="tooltipp">
                                        add to compare
                                    </span>
                                </button>

                                <button class="quick-view">
                                    <i class="fa fa-eye"></i>
                                    <span class="tooltipp">
                                        quick view
                                    </span>
                                </button>

                            </div>

                        </div>

                        <!-- Add To Cart -->
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn">
                                <i class="fa fa-shopping-cart"></i>
                                add to cart
                            </button>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /Section -->

	<!-- /NEWSLETTER -->
<?php include("layout/footer.php"); ?>

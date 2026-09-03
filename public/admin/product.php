<?php

require_once '../../app/Middleware/AuthMiddleware.php';
require_once '../../app/Middleware/RoleMiddleware.php';

$auth = new AuthMiddleware();
$auth->handle();

$role = new RoleMiddleware();
$role->handle(1);

include('layout/header.php');

?>


        <!-- User FORM -->
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">

                <h4 class="card-title">Add Product</h4>

                <form id="productForm" method="post" enctype="multipart/form-data">

                <select name="category_id" id="category_id" class="form-control">
                    <option value="">Select Category</option>
                </select>

                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>

                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                

                <button type="submit" class="btn btn-primary btn-block">
                    Save Product
                </button>

                </form>

            </div>
            </div>
        </div>


        <!-- CATEGORY TABLE -->
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">

                <h4 class="card-title">All Products</h4>

                <div id="product-grid"></div>

            </div>
            </div>
        </div>

        </div>
    </div>

    <?php include('layout/footer.php'); ?>
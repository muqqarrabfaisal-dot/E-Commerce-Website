<?php

require_once '../../app/Middleware/AuthMiddleware.php';
require_once '../../app/Middleware/RoleMiddleware.php';

$auth = new AuthMiddleware();
$auth->handle();

$role = new RoleMiddleware();
$role->handle(1);

include('layout/header.php');

?>
<div class="col-md-10 grid-margin stretch-card">

    <div class="card">

        <div class="card-body">

            <h4 class="card-title">Order Details</h4>

            <div id="order-details"></div>

        </div>

<?php include('layout/footer.php'); ?>
    </div>

</div>

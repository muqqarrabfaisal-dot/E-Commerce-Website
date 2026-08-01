<?php
session_start();
require_once '../../app/Controllers/Web/AuthController.php';
require_once '../../app/Middleware/GuestMiddleware.php';

$guest = new GuestMiddleware();
$guest->handle();

$auth = new AuthController();
$auth->login();

?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.bootstrapdash.com/star-admin2-free/dist/vertical-default-light/pages/samples/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Mar 2026 13:12:31 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Star Admin2 </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="assets/images/logo.svg" alt="logo">
              </div>
              
              <?php if (isset($_SESSION['success'])): ?> 
              <div class="alert alert-success"><?php echo $_SESSION['success'];  ?></div>
              <?php unset($_SESSION['success'])?>
              <?php endif; ?>

              <?php if (isset($_SESSION['error'])): ?> 
              <div class="alert alert-danger"><?php echo $_SESSION['error'];  ?></div>
              <?php unset($_SESSION['error'])?>
              <?php endif; ?>
              


              <form class="pt-3" method="POST" action="">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1"
                    placeholder="Password">
                </div>
                <div class="mt-3 d-grid gap-2">
                  <input type="submit" Value="LOGIN" name="btnlogin" class="btn btn-block btn-primary btn-lg fw-medium auth-form-btn">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

<!-- Mirrored from demo.bootstrapdash.com/star-admin2-free/dist/vertical-default-light/pages/samples/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 Mar 2026 13:12:31 GMT -->
</html>
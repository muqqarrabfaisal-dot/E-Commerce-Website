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

            <h4 class="card-title">Add User</h4>

            <form id="userForm" method="post">

              <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required>
              </div>
              
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
              </div>
              
              <div class="form-group">
                <label>email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              
              <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" required>
              </div>
              
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <select name="role_id">

              <option value="1">Admin</option>
              <option value="2">Customer</option>

              </select>

              <button type="submit" class="btn btn-primary btn-block">
                Save User
              </button>

            </form>

          </div>
        </div>
      </div>


      <!-- CATEGORY TABLE -->
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <h4 class="card-title">All User</h4>

            <div id="user-grid"></div>

          </div>
        </div>
      </div>

    </div>
  </div>

<?php include('layout/footer.php'); ?>
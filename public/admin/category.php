    <?php
    session_start();
    

    include('layout/header.php'); 
    ?>


      <!-- CATEGORY FORM -->
      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <h4 class="card-title">Add Category</h4>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <form id="categoryForm" method="post">

              <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="category_name" class="form-control" required>
              </div>

              <div class="form-group">
                <label>Status</label>

                <select name="status" class="form-control" required>
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
              </div>

              <div class="form-group">
                <label>Description</label>

                <textarea name="description" rows="5" class="form-control" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-block">
                Save Category
              </button>

            </form>

          </div>
        </div>
      </div>


      <!-- CATEGORY TABLE -->
      <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">

            <h4 class="card-title">All Categories</h4>

            <div id="js-grid"></div>

          </div>
        </div>
      </div>

    </div>
  </div>

<?php include('layout/footer.php'); ?>
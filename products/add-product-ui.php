<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
session_start();
  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit();
  }
  include_once 'includes/dbconnect.php';
include '../includes/base_page/head.php';
?>



<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container" data-layout="container">
      <!--nav starts here -->
      <?php
      include '../includes/base_page/nav.php';
      ?>

      <div class="content">
        <?php
        include '../navbar-shared.php';
        ?>

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <h5 class="p-2">Add New Product</h5>
        <!-- Content is to start here -->
        <form>
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label class="form-label" for="product_code">Product Code*</label>
                  <input type="text" class="form-control" name="product_code" id="product_code" readonly>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="product_name">Product Name*</label>
                  <input type="text" class="form-control" name="product_name" id="product_name" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <!-- Make Combo -->
                  <label class="form-label" for="product_category">Category*</label>
                  <input type="text" class="form-control" name="product_category" id="product_category" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col">
                  <!-- Make Combo -->
                  <label class="form-label" for="product_unit">Unit*</label>
                  <input type="text" class="form-control" name="product_unit" id="product_unit" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="product_image">Product Image*</label>
                  <input class="form-control" id="product_image" name="product_image" type="file" accept="image/*" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product Levels -->
          <h5 class="p-2 mt-4">Product Levels</h5>
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label class="form-label" for="min_level">Minimum Level*</label>
                  <input type="number" class="form-control" name="min_level" id="min_level" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="max_level">Maximum Level*</label>
                  <input type="number" class="form-control" name="max_level" id="max_level" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="reorder">Reorder Level*</label>
                  <input type="number" class="form-control" name="reorder" id="reorder" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
            </div>
          </div>


          <!-- Tax -->
          <h5 class="p-2 mt-4">Tax</h5>
          <div class="card">
            <div class="card-body fs--1 p-4">
              <label for="tax_type">Tax Type*</label><br />
              <div class="border-dashed pt-3 pl-3 w-25">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" id="inclusive" type="radio" name="tax_type" value="inclusive" required />
                  <label class="form-check-label" for="inclusive">Inclusive</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" id="exclusive" type="radio" name="tax_type" value="exclusive" required />
                  <label class="form-check-label" for="exclusive">Exclusive</label>
                </div>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="w-75"></div>
              <!-- Tax table -->
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">Default Purchase Price</th>
                    <th scope="col">Profit Margin(%)</th>
                    <th scope="col">Default Selling Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="row">
                        <div class="col">
                          <label class="form-label" for="dpp_exc_tax">Exc. Tax*</label>
                          <input type="number" class="form-control" name="dpp_exc_tax" id="dpp_exc_tax" required>
                          <div class="invalid-feedback">This field cannot be left blank.</div>
                        </div>
                        <div class="col">
                          <label class="form-label" for="dpp_inc_tax">Inc. Tax*</label>
                          <input type="number" class="form-control" name="dpp_inc_tax" id="dpp_inc_tax" required>
                          <div class="invalid-feedback">This field cannot be left blank.</div>
                        </div>
                    </td>
                    <td>
                      <label class="form-label" for="profit_margin">*</label>
                      <div class="input-group mb-3 col col-md-2">
                        <input type="number" class="form-control" name="profit_margin" aria-describedby="margin-percentage-label" id="profit_margin" required>
                        <span class="input-group-text" id="margin-percentage-label">%</span>
                      </div>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </td>
                    <td>
                      <label class="form-label" for="dsp_price">Exc. Tax*</label>
                      <input type="number" class="form-control" name="dsp_price" id="dsp_price" required>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <input type="submit" class="btn btn-primary m-2" value="Submit">
        </form>
        <!-- Content ends here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->



        <!-- =========================================================== -->
        <!-- Footer Begin -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
</body>

</html>

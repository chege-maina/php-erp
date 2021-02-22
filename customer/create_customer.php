<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<?php

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
        <div id="alert-div"></div>
        <h5 class="p-2">Add Customer</h5>

        <form name="add_product" id="add_product" onsubmit="return sendEverything();">
          <div class="card">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->
            <div class="card-body fs--1 p-4 position-relative">
              <div class="row">
                <div class="col">
                  <label for="name" class="form-label">Name*</label>
                  <input name="name" class="form-control" type="text" placeholder="Name" id="sup_nm" required>
                </div>
                <div class="col">
                  <label for="email" class="form-label">Email*</label>
                  <input name="email" class="form-control" type="email" placeholder="Email" id="sup_email" required>
                </div>
                <div class="col">
                  <label for="tel_no" class="form-label">Telephone Number*</label>
                  <input name="tel_no" class="form-control" type="tel" placeholder="Tel No" id="sup_tel" required>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <label for="postal_address" class="form-label">Postal Address*</label>
                  <input name="postal_address" id="sup_postal" class="form-control" type="text" placeholder="Postal Address" required>
                </div>
                <div class="col">
                  <label for="physical_address" class="form-label">Physical Address*</label>
                  <input name="physical_address" id="sup_physical_address" class="form-control" type="text" placeholder="Physical Address" required>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label for="tax_id" class="form-label">Customer Tax ID*</label>
                  <input name="tax_id" id="sup_tax_id" class="form-control" placeholder="Tax ID" type="text" required>
                </div>
                <div class="col">
                  <label for="payment_terms" class="form-label">Payment Terms*</label>
                  <input name="payment_terms" id="payment_terms" class="form-control" placeholder="Payment Terms" type="number" required>
                </div>

                <div class="col">
                  <label for="browser" class="form-label ">Credit Limit </label>
                  <div class="input-group">
                    <input type="number" class="form-control" id="requisitionable_item">
                    <input type="button" value="%" class="btn btn-link disabled">
                  </div>
                </div>
              </div>
              <div class="col mt-3">
                <input type="submit" class="btn btn-falcon-primary mr-1" name="submit" id="submit" value="Submit">
              </div>
            </div>
          </div>

      </div>
      </form>

      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <?php
      include '../includes/base_page/footer.php';
      ?>
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
include_once '../includes/dbconnect.php';
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
        <h5 class="p-2">Pay Bill</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->

        <div class="card mt-3">
          <div class="card-body fs--1 p-4">
            <div class="row">

              <div class="col">
                <label for="#" class="form-label">Select Supplier </label>
                <div class="input-group">
                  <select name="supplier" id="supplier_name" class="form-select">
                  </select>
                  <button type="button" class="btn btn-primary" onclick="selectSupplier();">Select</button>
                </div>
              </div>
              <div class="col">
                <div class="col flex-row-reverse">
                  <div class="col">
                    <label for="amt" class="form-label">Amount Payable*</label>
                    <input type="number" name="amt" id="amt" class="form-control" required readonly>
                  </div>
                </div>
                <!-- Content is to start here -->
              </div>
            </div>

            <!-- Content is to start here -->
            <hr>
            <div class="row">
              <div class="col">
                <div class="col">
                  <label for="supplier" class="form-label">Supplier*</label>
                  <input type="supplier" name="supplier" id="supplier" class="form-control" required readonly>
                </div>
              </div>

              <div class="col">
                <label for="cheque_number" class="form-label">Cheque Number*</label>
                <input type="number" name="cheque_number" id="cheque_number" class="form-control" required>
              </div>

              <div class="col">
                <label for="#" class="form-label">Bank Name </label>
                <div class="input-group">
                  <select name="bank_name" id="bank_name" class="form-select">
                  </select>
                </div>
              </div>
            </div>
          </div>
          <!-- Content ends here -->
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                Pay Bill
              </button>
            </div>
            <!-- Content ends here -->
          </div>

        </div>

        <!-- Additional cards can be added here -->
      </div>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- body ends here -->
      <!-- =========================================================== -->

      <script>


      </script>


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
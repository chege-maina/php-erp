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
        <div id="alert-div"></div>
        <h5 class="p-2">Purchase Bill</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <form onsubmit="">
          <div class="card mt-3">
            <div class="card-body fs--1 p-4">
              <div class="row">

                <div class="col">
                  <label for="#" class="form-label">Select Employee </label>
                  <div class="input-group">
                    <input list="employee" name="employee" id="employee_name" class="form-select" required>
                    <datalist id="employee"></datalist>
                    <button type="button" class="btn btn-primary" onclick="selectSupplier();">Select</button>
                  </div>
                </div>
                <div class="col">
                  <label for="#" class="form-label">Attendance Date</label>
                  <input type="date" id="att_date" class="form-control" required>
                </div>
              </div>
              <!-- Content is to start here -->
              <hr>
              <div class="card-header">Employee Details</div>
              <div class="row">
                <div class="col">
                  <label for="employee_no" class="form-label">Employee No#</label>
                  <input type="text" name="employee_no" id="employee_no" class="form-control" required readonly>
                </div>

                <div class="col">
                  <label for="branch" class="form-label">Branch</label>
                  <input type="text" name="branch" id="branch" class="form-control" required readonly>
                </div>

                <div class="col">
                  <label for="designation" class="form-label">Designation</label>
                  <input type="text" name="designation" id="designation" class="form-control" required readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label for="#" class="form-label">Shift </label>
                  <div class="input-group">
                    <input list="shift" name="supplier" id="shift_type" class="form-select" required>
                    <datalist id="shift"></datalist>
                  </div>
                </div>
                <div class="col">
                  <label for="#" class="form-label">Status </label>
                  <div class="input-group">
                    <input list="status" name="status" id="status_type" class="form-select" required>
                    <datalist id="status"></datalist>
                  </div>
                </div>
                <div class="col d-flex align-items-end">
                  <div class="pr-4">
                    <input type="checkbox" name="late" class="form-check-input" value="" checked>
                    <label for="late" class="form-check-label"> Late Entry</label>
                  </div>
                  <div class="pr-2">
                    <input type="checkbox" name="early" class="form-check-input" value="" checked>
                    <label for="early" class="form-check-label"> Early Exit</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-1">
              <div class="d-flex flex-row-reverse">
                <button class="btn btn-falcon-primary btn-sm m-2" id="submit">
                  Submit
                </button>
              </div>
              <!-- Content ends here -->
            </div>

          </div>
        </form>

        <!-- Additional cards can be added here -->
      </div>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- body ends here -->
      <!-- =========================================================== -->

      <script>
        const supplier_name = document.querySelector("#supplier_name");
        const supplier = document.querySelector("#supplier");
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
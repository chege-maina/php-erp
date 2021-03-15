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


        <div id="alert-div"></div>
        <h5 class="p-2" id="title-header">Salary Details

        </h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <div class="row m-3">
              <div class="col">
                <label for="employment" class="form-label">Employment Type</label>
                <select name="employment" id="employment" class="form-select">
                  <option value="Regular">Regular(open-ended)</option>
                </select>
              </div>
              <div class="col">
                <label for="currency" class="form-label">Payment Currency</label>
                <select name="currency" id="currency" class="form-select">
                  <option value="KES">KES</option>
                  <option value="JPY">JPY</option>
                </select>
              </div>
              <div class="col">
                <label for="shift" class="form-label">Work Shift</label>
                <select name="shift" id="shift" class="form-select">
                  <option value="Regular">Regular shift</option>
                </select>
              </div>
            </div>
            <div class="row m-3">
              <div class="col">
                <label class="form-label" for="salary">Monthly Salary(KES)</label>
                <input type="number" class="form-control" name="salary" id="salary" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label for="monthly" class="form-label">Monthly</label>
                <div class="input-group">
                  <span class="input-group-text is-static">Monthly</span>
                  <select name="monthly" id="monthly" class="form-select">
                    <option value="basic">Basic Pay</option>
                    <option value="consolidated">Consolidated</option>
                    <option value="net">Net Pay</option>
                  </select>
                </div>
              </div>
              <div class="col">
                <label for="off_days" class="form-label">Off Days</label>
                <select name="off_days" id="off_days" class="form-select" disabled>
                  <option value="SUNDAY">SUNDAY</option>
                  <option value="MONDAY">MONDAY</option>
                </select>
              </div>
            </div>
            <div class="row m-3">
              <div class="col">
                <label for="income_tax" class="form-label">Income Tax</label>
                <select name="income_tax" id="income_tax" class="form-select" disabled>
                  <option value="none">NONE</option>
                  <option value="primary">P.A.Y.E Primary Employee</option>
                  <option value="secondary">P.A.Y.E Secondary Employee</option>
                </select>
              </div>
              <div class="col">
                <label for="vehicle2"> Deduct NHIF</label>
                <input type="checkbox" name="vehicle3" value="Boat" checked>
                <label for="vehicle3"> Deduct NSSF</label>
                <input type="checkbox" name="vehicle3" value="Boat" checked>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body fs--1 p-4">
            <div class="card-header"><b>Tax Exemption</b></div>
          </div>
        </div>

        <script>
          $(document).ready(function() {
            $('#contrib').multiselect();
          });
        </script>
        <?php
        include '../includes/base_page/footer.php';
        ?>

        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
</body>

</html>
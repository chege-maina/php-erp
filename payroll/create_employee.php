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
        <h5 class="p-2" id="title-header">Add New Employee

        </h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <div class="row">
              <div class="col">
                <label class="form-label" for="product_name">First Name*</label>
                <input type="text" class="form-control" name="first_name" id="first_name" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="product_name">Middle Name*</label>
                <input type="text" class="form-control" name="middle_name" id="middle_name" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="product_name">Last Name*</label>
                <input type="text" class="form-control" name="last_name" id="last_name" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col">
                <label class="form-label" for="last_name">Date of Birth*</label>
                <input type="date" class="form-control" name="date" id="date" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col ">
                <label for="residence" class="form-label">Residential Status</label>
                <select name="residence" id="el_branch" class="form-select">
                  <option value="Resident">Resident</option>
                  <option value="Resident">Resident</option>
                </select>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <label class="form-label" for="photo">Passport Photo</label>
                <input class="form-control" id="photo" name="photo" type="file" accept="image/*" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="national_id">National ID NO.*</label>
                <input type="number" class="form-control" name="national_id" id="national_id" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="pin_no">PIN NO.*</label>
                <input type="number" class="form-control" name="pin_no" id="pin_no" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <label class="form-label" for="nssf_no">NSSF NO.*</label>
                <input type="number" class="form-control" name="nssf_no" id="nssf_no" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="nhif_no">NHIF NO.*</label>
                <input type="number" class="form-control" name="nhif_no" id="nhif_no" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col">
                <button class="btn btn-falcon-primary btn-sm m-2" id="submit">
                  Submit
                </button>
              </div>
            </div>
            <!-- Content ends here -->

          </div>
          <?php
          include '../includes/base_page/footer.php';
          ?>
          <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
          <!-- Footer End -->
          <!-- =========================================================== -->
</body>

</html>
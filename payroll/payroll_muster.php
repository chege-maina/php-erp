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
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2">Payroll Master</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row justify-content-between">
              <div class="col">
                <label class="form-label" for="b_month">Select Month*</label>
                <select class="form-select" name="b_month" id="b_month">
                  <option value disabled selected>
                    -- Select Month --
                  </option>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November">November</option>
                  <option value="December">December</option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>

              <div class="col">
                <label class="form-label" for="b_year">Select Year*</label>
                <select class="form-select" name="b_year" id="b_year">
                  <option value disabled selected>
                    -- Select Year --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>

            <div class="row justify-content-between">
              <div class="col">
                <label class="form-label" for="b_month">Select NHIF Schedule*</label>
                <select class="form-select" name="b_nhif" id="b_nhif">
                  <option value disabled selected>
                    -- Select NHIF Schedule --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>

              <div class="col">
                <label class="form-label" for="b_year">Select P.A.Y.E Schedule*</label>
                <select class="form-select" name="b_paye" id="b_paye">
                  <option value disabled selected>
                    -- Select P.A.Y.E Schedule --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>
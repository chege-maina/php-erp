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

      <?php
      include '../base_page/data_list_select.php';
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
            <div class="row">
              <div class="col">
                <label for="" class="form-label">Name</label>
                <input class="form-control" name="asset_name" type="text" id="asset_name" required />
              </div>
              <div class="col">
                <label for="reg_no" class="form-label">RegNo/Serial No</label>
                <input class="form-control" name="reg_no" type="number" id="reg_no" required />
              </div>
              <div class="col">
                <label for="tag_no" class="form-label">Tag No</label>
                <input class="form-control" name="tag_no" type="number" id="tag_no" required />
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label class="form-label" for="branch">Select Branch*</label>
                <select class="form-select" name="branch" id="branch" required>
                  <option value disabled selected>
                    -- Select Branch --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="asset_grp">Asset Group*</label>
                <select class="form-select" name="asset_grp" id="asset_grp" required>
                  <option value disabled selected>
                    -- Select Asset Group --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="unit">Unit*</label>
                <select class="form-select" name="unit" id="unit" required>
                  <option value disabled selected>
                    -- Select Unit --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <label for="comment" class="form-label"> Description</label>
                <textarea class="form-control" id="comment" aria-label="With textarea" required></textarea>
              </div>
              <div class="col">
                <label for="weight" class="form-label">weight </label>
                <div class="input-group">
                  <input class="form-control" id="weight" name="weight" type="number"></input>
                  <span class="input-group-text">
                    MT
                  </span>
                </div>
              </div>
            </div>
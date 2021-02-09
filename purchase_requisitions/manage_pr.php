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
        <h4 class="mb-0 p-2">Manage Requisition</h4>
        <div class="card mb-1">
          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body position-relative">

            <div class="row">
              <div class="col">
                <label for="requisition_number" class="form-label">Requisition No.</label>
                <input type="number" name="requisition_number" id="requisition_number" class="form-control" required readonly>
              </div>
              <div class="col">
                <label for="requisition_date" class="form-label">Date</label>
                <input type="date" name="requisition_name" id="requisition_name" class="form-control" required readonly>
              </div>
              <div class="col">
                <label for="created_by" class="form-label">Created By</label>
                <input type="text" name="created_by" id="created_by" class="form-control" required readonly>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col col-md-4">
                <label for="branch" class="form-label">Branch</label>
                <input type="text" name="branch" id="branch" class="form-control" required readonly>
              </div>
              <div class="col-auto mt-4 pt-2">
                <span class="fw-bold">Status: </span>
                <span id="status" class="badge rounded-pill badge-soft-success">Status</span>
              </div>
            </div>

          </div>
        </div>


        <div class="card">

          <div class="card-header bg-light">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->

            <div class="table-responsive">
              <table class="table table-sm fs--1 mb-0">
                <thead>
                  <tr>
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Balance</th>
                    <th>Units</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody id="table_body"></tbody>
              </table>
            </div>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>

        <div class="card mt-1 mb-3 h-xxl-100">
          <div class="card-body">
            <div class="row justify-content-between align-items-center">
              <div class="col-auto">
                <button class="btn btn-falcon-success btn-sm mr-2">
                  <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
                  Approve
                </button>
                <button class="btn btn-falcon-danger btn-sm">
                  <span class="fas fa-times mr-1" data-fa-transform="shrink-3"></span>
                  Reject
                </button>
              </div>
            </div>
          </div>
        </div>


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

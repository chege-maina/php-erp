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
        <h3 class="mb-0 p-2">Purchase Order Supplier</h3>
        <div class="card mb-1">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body position-relative">


            <div class="row">
              <div class="col">
                <label for="branch" class="form-label">Branch</label>
                <input type="text" name="po_branch" id="po_branch" class="form-control" required readonly>
              </div>
              <div class="col">
                <label for="supplier" class="form-label">Supplier</label>
                <select name="supplier" id="supplier" class="form-select">
                  <option value="Supplier">Supplier 1</option>
                </select>
              </div>
              <div class="col-auto d-flex align-items-end">
                <button class="btn btn-falcon-primary ">Create Purchase Order</button>
              </div>
            </div>

          </div>
        </div>


        <div class="card">

          <div class="card-header bg-light">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-2">
            <!-- Content is to start here -->

            <div class="table-responsive">
              <table class="table table-sm table-striped fs--1 mb-0">
                <thead>
                  <tr>
                    <th>Product Code</th>
                    <th class="w-25">Product Name</th>
                    <th>Units</th>
                    <th class="col-lg-1">Quantity</th>
                    <th class="col-lg-2">Suggested Supplier</th>
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
                <button class="btn btn-falcon-success btn-sm mr-2" id="approve_req">
                  <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
                  Approve
                </button>
                <button class="btn btn-falcon-danger btn-sm" id="reject_req" onclick="rejectRequisition();">
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

        <script>
          const po_branch = document.querySelector("#po_branch");
          const table_items = [];

          window.addEventListener('DOMContentLoaded', (event) => {
            if (sessionStorage.length === 0) {
              location.href = "./select_po.php";
            }

            // Get passed branch
            const branch = sessionStorage.getItem('branch');
            // Clear data
            sessionStorage.clear();
            po_branch.value = branch;

            // Make fetch request
            const formData = new FormData();
            formData.append("branch", branch);
            fetch('../includes/load_purchase_items.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', result);
                table_items = result;
              })
              .catch(error => {
                console.error('Error:', error);
              });
          });


          // function updateTable() {

          // }
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

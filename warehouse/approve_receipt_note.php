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

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="mb-2">Approve Receipt Note</h5>


        <div class="card">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>

          <div class="card-body fs--1 p-4 position-relative">



            <div class="row">
              <div class="col">
                <select class="form-select form-select-sm" name="product_category" id="product_category" required>
                  <option value disabled selected>
                    -- Select Receipt Note Number --
                  </option>
                </select>
              </div>
              <div class="col">
                <button class="btn btn-falcon-primary btn-sm" id="selectReceipt" onclick="selectReceipt();">
                  Select
                </button>
              </div>
            </div>
            <hr>


            <div class="row flex">
              <div class="col">
                <label for="supplier_name" class="form-label">Receipt Note Number*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">Supplier Name*</label>
                <input type="text" name="po_number" id="po_number" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">LPO Number*</label>
                <input type="text" name="po_number" id="po_number" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">Invoice/Delivery Note No.*</label>
                <input type="text" name="po_number" id="po_number" class="form-control" readonly>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <label for="time" class="form-label">Time</label>
                <!-- autofill current date  -->
                <input type="time" id="receipt_time" class="form-control" readonly>
              </div>

              <div class="col">
                <label for="date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
              </div>
            </div>

            <!-- Content is to start here -->
            <!-- Content ends here -->
          </div>
        </div>
        <!-- Additional cards can be added here -->

        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-2">
            <div class="table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Units</th>
                    <th scope="col">Quantity Received</th>
                    <th scope="col">Unit Cost</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>

          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                Approve
              </button>
            </div>
            <!-- Content ends here -->
          </div>

        </div>


        <script>
          let receipt_time = document.querySelector("#receipt_time");

          function d_toString(value) {
            return value < 10 ? '0' + value : String(value);
          }
          document.addEventListener('DOMContentLoaded', function() {
            const date = new Date();
            let month = d_toString(date.getMonth() + 1);
            let day = d_toString(date.getDate());
            let hours = d_toString(date.getHours());
            let minutes = d_toString(date.getMinutes());

            receipt_time.value = hours + ":" + minutes;
          });
        </script>

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

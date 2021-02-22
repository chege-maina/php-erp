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
        <h5 class="p-2">Create Sales Quotation</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row b-3">
              <div class="col">
                <label for="date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="time" class="form-label">Time</label>
                <!-- autofill current date  -->
                <input type="time" id="time" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="#" class="form-label">Valid Until </label>
                <div class="input-group">
                  <select name="date" id="date" type="date" class="form-select">
                  </select>
                  <button type="button" class="btn btn-primary">Date</button>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <label for="#" class="form-label">Select Customer </label>
                <div class="input-group">
                  <select name="customer" id="customer_name" class="form-select">
                  </select>
                  <button type="button" class="btn btn-primary">Select</button>
                </div>
              </div>
              <div class="col">
                <label for="browser" class="form-label">Add Items to Quotation</label>
                <div class="input-group">
                  <input list="requisitionable_items" id="requisitionable_item" class="form-select">
                  <datalist id="requisitionable_items" class="bg-light"></datalist>
                  <input type="button" value="+" class="btn btn-primary">
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr>
        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-2">

            <div class=" table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Units</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Cost</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>

            <div class="row m-3">
              <div class="col text-right fw-bold">
                Total Before Tax</div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="number" readonly id="total_before_tax" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Tax 16 %
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="number" readonly id="tax_pc" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Quotation
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="number" readonly id="po_total" />
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                Submit
              </button>
            </div>
            <!-- Content ends here -->
          </div>
        </div>
      </div>
    </div>
    <!-- Additional cards can be added here -->
    </div>
    </div>

    <?php
    include '../includes/base_page/footer.php';
    ?>

    <script>
      const po_time = document.querySelector("#time");

      function d_toString(value) {
        return value < 10 ? '0' + value : String(value);
      }

      document.addEventListener('DOMContentLoaded', function() {
        const date = new Date();
        let month = d_toString(date.getMonth() + 1);
        let day = d_toString(date.getDate());
        let hours = d_toString(date.getHours());
        let minutes = d_toString(date.getMinutes());


        time.value = hours + ":" + minutes;
      });
    </script>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- Footer End -->
    <!-- =========================================================== -->
</body>

</html>
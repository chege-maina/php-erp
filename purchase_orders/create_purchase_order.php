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
        <h5 class="p-2">Create Purchase Order</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="requisition_number" class="form-label">Purchase Order Number*</label>
                <input type="number" name="requisition_number" id="requisition_number" class="form-control">
              </div>
              <div class="col">
                <label for="requisition_date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" name="requisition_date" id="requisition_date" class="form-control">
              </div>
              <div class="col">
                <label for="requisition_time" class="form-label">Time</label>
                <!-- autofill current time  -->
                <input type="time" name="requisition_time" id="requisition_time" class="form-control">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label for="supplier" class="form-label">Supplier*</label>
                <select name="supplier" id="supplier" class="form-select">
                  <option value="a">a</option>
                  <option value="b">b</option>
                </select>
              </div>
            </div>
            <div class="row my-3">
              <div class="col">

                <div class="dropdown font-sans-serif position-static">
                  <button class="btn text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customer-dropdown-0" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                    Items to Requisition
                  </button>
                  <div class="dropdown-menu dropdown-menu-left border py-0" aria-labelledby="customer-dropdown-0">
                    <div class="bg-white py-2">
                      <table class="table table-hover">

                        <thead>
                          <tr>
                            <th>Product Name</th>
                            <th>Product Balance</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Tanks</td>
                            <td>2</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Product Code</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Units</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">
                    <tr>
                      <th>033</th>
                      <td>Roto</td>
                      <td>Pieces</td>
                      <td>3</td>
                    </tr>
                    <tr>
                      <th>033</th>
                      <td>Mabati</td>
                      <td>Pieces</td>
                      <td>3</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
          const requisition_date = document.querySelector("#requisition_date");
          const requisition_number = document.querySelector("#requisition_number");
          const requisition_time = document.querySelector("#requisition_time");
          const reorderble_items = document.querySelector("#reorderble_items");
          const table_body = document.querySelector("#table_body");
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
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
        <h5 class="p-2">Inventory Management</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row pb-2">
              <div class="col">
                <label for="req_date" class="form-label">From </label>
                <input type="date" name="req_date" id="req_date" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="req_date" class="form-label">To </label>
                <input type="date" name="req_date" id="req_date" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="status" class="form-label">Status*</label>
                <select name="status" id="status" class="form-select">
                  <option value="approved">Approved</option>
                  <option value="pending">Pending</option>
                </select>
              </div>
              <div class="col">
                <label class="form-label">Filters</label>
                <button class="form-control" class="btn btn-falcon-primary mr-1 mb-1" type="button">Filter
                </button>
              </div>

            </div>
          </div>
          <table class="table mt-2">
            <thead>
              <tr>
                <th>Requisition Number*</th>
                <th>Date </th>
                <th>Created By</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="table_body">
              <tr>
                <th>033</th>
                <td>2-4-2021</td>
                <td>Kesav</td>
                <td> </td>
              </tr>
            </tbody>
          </table>
          <!-- Content ends here -->
        </div>
        <!-- Additional cards can be added here -->
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
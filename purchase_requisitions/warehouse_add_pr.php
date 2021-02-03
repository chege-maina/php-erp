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
        <h5 class="p-2">Add Purchase Requisition</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <form>
              <div class="row">
                <div class="col">
                  <label for="requisition_number" class="form-label">Requisition Number*</label>
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
              <div class="row my-3">
                <div class="col">
                  <div class="input-group mb-3">
                    <select name="reorderble_items" id="reorderble_items" class="form-select">
                      <option value="tanks">tanks</option>
                    </select>
                    <button class="input-group-button btn btn-primary">
                      Add
                    </button>
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
                    <tbody>
                      <tr>
                        <th>033</th>
                        <td>Roto</td>
                        <td>Pieces</td>
                        <td>3</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </form>
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
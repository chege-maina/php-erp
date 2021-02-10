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
        <div id="alert-div"></div>
        <h5 class="p-2">Add Supplier</h5>

        <form method="POST" onsubmit="return doInsert(this);">
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">

                <div class="col">
                  <label for="name" class="form-label">Name*</label>
                  <input name="name" class="form-control" placeholder="Name" required>
                </div>
                <div class="col">
                  <label for="email" class="form-label">Email*</label>
                  <input name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col">
                  <label for="tel_no" class="form-label">Telephone Number*</label>
                  <input name="tel_no" class="form-control" placeholder="Tel No" required>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <label for="postal_address" class="form-label">Postal Address*</label>
                  <input name="postal_address" class="form-control" placeholder="Postal Address" required>
                </div>
                <div class="col">
                  <label for="physical_address" class="form-label">Physical Address*</label>
                  <input name="physical_address" class="form-control" placeholder="Physical Address" required>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label for="tax_id" class="form-label">Supplier Tax ID*</label>
                  <input name="tax_id" class="form-control" placeholder="Tax ID" required>
                </div>
                <div class="col">
                  <label for="payment_terms" class="form-label">Payment Terms*</label>
                  <input name="payment_terms" class="form-control" placeholder="Credit Limit" required>
                </div>

                <div class="col">
                  <label for="browser" class="form-label ">Add Supplier Items </label>
                  <div class="input-group">
                    <input list="requisitionable_items" id="requisitionable_item" class="form-select">
                    <datalist id="requisitionable_items" class="bg-light"></datalist>
                    <input type="button" value="+" class="btn btn-primary " onclick="addItem();">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-4">
              <div class="row my-3">
                <div class="col">
                  <table class="table table-striped" id="table_id">
                    <thead>
                      <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col" class="w-25">Product Cost</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    </tbody>
                  </table>
                </div>
              </div>

              <input type="submit" class="btn btn-falcon-primary mt-2" name="submit" id="submit" value="Insert" onclick="newFunction()">
            </div>
          </div>
      </div>
      </form>



      <script>
        function doInsert(form) {

          var name = form.name.value;
          var email = form.email.value;
          var tel_no = form.tel_no.value;
          var postal_address = form.postal_address.value;
          var physical_address = form.physical_address.value;
          var tax_id = form.tax_id.value;
          var payment_terms = form.payment_terms.value;

          var ajax = new XMLHttpRequest();
          ajax.open("POST", "Http.php", true);
          ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

          ajax.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
              alert(this.responseText);
          };

          ajax.send("name=" + name + "&email=" + email + "&tel_no=" + tel_no + "&address=" + address + "&tax_id=" + tax_id + "&postal_address=" + postal_address + "&physical_address=" + physical_address + "&payment_terms=" + payment_terms + "&do_insert=1");
          return false;
        }
      </script>

      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <?php
      include '../includes/base_page/footer.php';
      ?>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- Footer End -->
      <!-- =========================================================== -->
    </div>
    </div>
</body>

</html>
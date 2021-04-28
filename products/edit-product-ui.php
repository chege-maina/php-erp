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
        <h5 class="mb-3">Product Details</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class=" row mb-3">
              <div class="col">
                <label class="form-label" for="p_code">Product Code</label>
                <input class="form-control" id="p_code" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="p_name">Product Name</label>
                <input class="form-control" id="p_name" type="text" required readonly />
              </div>
            </div>
            <div class=" row mb-3">
              <div class="col">
                <label class="form-label" for="p_group">Group</label>
                <input class="form-control" id="p_group" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="p_sub_group">Sub Group</label>
                <input class="form-control" id="p_sub_group" type="text" required readonly />
              </div>
            </div>
            <div class=" row mb-3">
              <div class="col">
                <label class="form-label" for="p_units">Purchasing Unit</label>
                <input class="form-control" id="p_units" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="p_conversion">Conversion Value</label>
                <input class="form-control" id="p_conversion" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="s_units">Selling Unit</label>
                <input class="form-control" id="s_units" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="weight">Weight</label>
                <input class="form-control" id="weight" type="text" required readonly />
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class=" row mb-3">
              <div class="col">
                <label class="form-label" for="tax_pc">Tax %</label>
                <input class="form-control" id="tax_pc" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="amt_bf_tax">Amount Before Tax</label>
                <input class="form-control" id="amt_bf_tax" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="p_inc_tax">Inclusive Tax</label>
                <input class="form-control" id="p_inc_tax" type="text" required readonly />
              </div>
            </div>
            <div class=" row mb-3">
              <div class="col">
                <label class="form-label" for="p_selling_price">Selling Price</label>
                <input class="form-control" id="p_selling_price" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="p_sub_group">Selling Price (Bulk)</label>
                <input class="form-control" id="p_sub_group" type="text" required readonly />
              </div>
              <div class="col">
                <label class="form-label" for="p_margin">Profit Margin %</label>
                <input class="form-control" id="p_margin" type="text" required readonly />
              </div>
            </div>
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

        <script>
          window.addEventListener('DOMContentLoaded', (event) => {
            let p_code = window.sessionStorage.getItem("Product_Code");
            if (p_code === null) {
              location.href = "product-listing-ui.php";
            }

            const formData = new FormData();
            formData.append("code", p_code);
            fetch('../includes/load_item_approval.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', JSON.stringify(result, null, '\t'));
              })
              .catch(error => {
                console.error('Error:', error);
              });
          });
        </script>
</body>

</html>

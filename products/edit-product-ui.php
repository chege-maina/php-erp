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
            <div class="col col-auto">
              <small><strong>Status:</strong></small>
              <span id="product_status"></span>
            </div>
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
                <label class="form-label" for="p_selling_price_bulk">Selling Price (Bulk)</label>
                <input class="form-control" id="p_selling_price_bulk" type="text" required readonly />
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

        <div class="card mt-1">
          <div class="card-body fs--1 p-2">
            <button class="btn btn-falcon-success btn-sm mr-2" id="approve_button">
              <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
              Approve
            </button>
            <button class="btn btn-falcon-danger btn-sm" id="reject_button">
              <span class="fas fa-times mr-1" data-fa-transform="shrink-3"></span>
              Reject
            </button>
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

        <script>
          const p_code = document.querySelector("#p_code");
          const p_name = document.querySelector("#p_name");
          const p_group = document.querySelector("#p_group");
          const p_sub_group = document.querySelector("#p_sub_group");
          const p_units = document.querySelector("#p_units");
          const p_conversion = document.querySelector("#p_conversion");
          const s_units = document.querySelector("#s_units");
          const weight = document.querySelector("#weight");
          const tax_pc = document.querySelector("#tax_pc");
          const amt_bf_tax = document.querySelector("#amt_bf_tax");
          const p_inc_tax = document.querySelector("#p_inc_tax");
          const p_selling_price = document.querySelector("#p_selling_price");
          const p_selling_price_bulk = document.querySelector("#p_selling_price_bulk");
          const p_margin = document.querySelector("#p_margin");
          const product_status = document.querySelector("#product_status");

          const approve_button = document.querySelector("#approve_button");
          const reject_button = document.querySelector("#reject_button");


          window.addEventListener('DOMContentLoaded', (event) => {
            let pr_code = window.sessionStorage.getItem("Product_Code");
            if (pr_code === null) {
              location.href = "product-listing-ui.php";
            }

            const formData = new FormData();
            formData.append("code", pr_code);
            fetch('../includes/load_item_approval.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                if (result.length <= 0) {
                  return;
                }
                res = result[0];
                console.log("Result", JSON.stringify(res, null, "  "));
                p_code.value = res.code;
                p_name.value = res.name;
                p_group.value = res.group;
                p_sub_group.value = res.sub_group;
                p_units.value = res.purchase_unit;
                s_units.value = res.selling_unit;
                tax_pc.value = res.tax;
                amt_bf_tax.value = res.bf_tax;
                p_selling_price.value = res.default_sp;
                p_selling_price_bulk.value = res.default_sp_bulk;
                p_inc_tax.value = res.inc_tax;
                p_margin.value = res.margin;
                p_conversion.value = res.conversion

                // About to show status
                switch (res.status) {
                  case "pending":
                    product_status.innerHTML = `<span class="badge badge-soft-secondary">Pending</span>`;
                    break;
                  case "active":
                    product_status.innerHTML = `<span class="badge badge-soft-success">Active</span>`;
                    approve_button.disabled = true;
                    reject_button.disabled = true;
                    break;
                  case "rejected":
                    product_status.innerHTML = `<span class="badge badge-soft-warning">Rejected</span>`;
                    approve_button.disabled = true;
                    break;
                }
              })
              .catch(error => {
                console.error('Error:', error);
              });
          });
        </script>
</body>

</html>

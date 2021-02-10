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
                <button class="btn btn-falcon-primary ">Create Purchase Order</button>
              </div>
            </div>
          </div>
        </div>


        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->

        <script>
          const po_branch = document.querySelector("#po_branch");
          const table_body = document.querySelector("#table_body");
          let table_items = [];

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
                updateTable();
              })
              .catch(error => {
                console.error('Error:', error);
              });
          });


          function updateTable() {
            table_body.innerHTML = "";
            table_items.forEach(value => {

              const this_row = document.createElement("tr");

              const prd_code = document.createElement("td");
              prd_code.appendChild(document.createTextNode(value["code"]));
              prd_code.classList.add("align-middle");

              const prd_name = document.createElement("td");
              prd_name.appendChild(document.createTextNode(value["name"]));
              prd_name.classList.add("align-middle");

              const unit = document.createElement("td");
              unit.appendChild(document.createTextNode(value["unit"]));
              unit.classList.add("align-middle");

              const qty = document.createElement("td");
              qty.appendChild(document.createTextNode(value["qty"]));
              qty.classList.add("align-middle");

              const supplierWrapper = document.createElement("td");

              const supplierInput = document.createElement("input");
              supplierInput.setAttribute('id', "s-" + value["code"] + "-" + value["name"]);
              supplierInput.setAttribute('list', "dl-" + value["code"] + "-" + value["name"]);
              supplierInput.classList.add("form-select", "form-select-sm");
              supplierInput.setAttribute('onchange', "console.log(this.value);");
              supplierInput.setAttribute('value', value['suppliers'][0]['supplier']);
              supplierInput.setAttribute('onclick', "this.select();");

              const supplierDatalist = document.createElement("datalist");
              supplierDatalist.setAttribute('id', "dl-" + value["code"] + "-" + value["name"]);

              let i = 0;
              value['suppliers'].forEach(value => {
                let opt = document.createElement("option");

                if (i === 0) {
                  opt.setAttribute("selected", "");
                }

                i++;

                opt.appendChild(
                  document.createTextNode(
                    "Cost " + value["cost"]
                  )
                );
                opt.setAttribute("value", value["supplier"]);
                supplierDatalist.appendChild(opt);
              });

              console.log(value["suppliers"]);
              supplierWrapper.append(supplierInput, supplierDatalist);
              supplierWrapper.classList.add("align-middle");

              this_row.append(prd_code, prd_name, unit, qty, supplierWrapper);
              table_body.appendChild(this_row);
            });

          }
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

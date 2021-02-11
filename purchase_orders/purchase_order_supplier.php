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
                <button class="btn btn-falcon-primary" onclick="createPurchaseOrder();">Create Purchase Order</button>
              </div>
            </div>
          </div>
        </div>


        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->

        <script>
          const po_branch = document.querySelector("#po_branch");
          const supplier = document.querySelector("#supplier");
          const table_body = document.querySelector("#table_body");
          let table_items = [];
          let selectedProductSuppliers = {};

          function createPurchaseOrder() {
            console.log("Item Prices", selectedProductSuppliers);
            if (!supplier.value) {
              supplier.focus();
              return;
            }

            let table_body_items = []
            table_body.childNodes.forEach(row => {

              let i = 0;
              let product_row = {};
              row.childNodes.forEach(cell => {
                switch (i) {
                  case 0:
                    product_row['p_code'] = cell.innerHTML;
                    break;
                  case 1:
                    product_row['p_name'] = cell.innerHTML;
                    break;
                  case 2:
                    product_row['p_units'] = cell.innerHTML;
                    break;
                  case 3:
                    product_row['p_quantity'] = cell.innerHTML;
                    break;
                  case 4:
                    product_row['p_sup'] = cell.firstChild.value;
                    product_row['p_cost'] = selectedProductSuppliers[product_row['p_code']][product_row['p_sup']];
                    break;
                }

                i++;
                i = i >= 5 ? 0 : i;

              });

              if (product_row['p_sup'] === supplier.value) {
                table_body_items.push(product_row);
              }
            });

            sessionStorage.setItem('branch', po_branch.value);
            sessionStorage.setItem('supplier', supplier.value);
            sessionStorage.setItem('items', JSON.stringify(table_body_items));
            console.log(table_body_items);
            location.href = "create_purchase_order.php";
          }

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


          function updateSuppliers() {
            let supplier_list = new Map();
            supplier.innerHTML = "";
            const supplier_inputs = document.querySelectorAll("#table_body input");
            supplier_inputs.forEach(s_input => {
              const value = s_input.value.trim();
              if (value === "") {
                return;
              }
              supplier_list.set(value, value);
            });

            console.log(supplier_list);

            let opt = document.createElement("option");
            opt.appendChild(document.createTextNode("-- Select Supplier --"));
            opt.setAttribute("value", "");
            opt.setAttribute("disabled", "");
            opt.setAttribute("selected", "");
            supplier.appendChild(opt);

            supplier_list.forEach(value => {
              opt = document.createElement("option");

              opt.appendChild(
                document.createTextNode(
                  value
                )
              );
              opt.setAttribute("value", value);
              supplier.appendChild(opt);
            });


          }


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
              supplierInput.setAttribute('onchange', "updateSuppliers()");
              supplierInput.setAttribute('value', value['suppliers'][0]['supplier']);
              supplierInput.setAttribute('onclick', "this.select();");


              let item_suppliers = {};

              const supplierDatalist = document.createElement("datalist");
              supplierDatalist.setAttribute('id', "dl-" + value["code"] + "-" + value["name"]);

              value['suppliers'].forEach(supl => {
                let opt = document.createElement("option");

                opt.appendChild(
                  document.createTextNode(
                    "Cost " + supl["cost"]
                  )
                );
                opt.setAttribute("value", supl["supplier"]);
                supplierDatalist.appendChild(opt);

                item_suppliers[supl['supplier']] = supl["cost"];
              });


              // Store this, will need when submitting form
              selectedProductSuppliers[value['code']] = item_suppliers;


              console.log(value["suppliers"]);
              supplierWrapper.append(supplierInput, supplierDatalist);
              supplierWrapper.classList.add("align-middle");

              this_row.append(prd_code, prd_name, unit, qty, supplierWrapper);
              table_body.appendChild(this_row);
            });

            updateSuppliers();
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

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit();
}
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
        <h5 class="p-2">Add Purchase Requisition</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
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
                <label for="browser" class="form-label">Items to Requisition</label>
                <div class="input-group">
                  <input list="requisitionable_items" id="requisitionable_item" class="form-select">
                  <datalist id="requisitionable_items" class="bg-light"></datalist>
                  <input type="button" value="+" class="btn btn-primary" onclick="addItem();">
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
                      <th scope="col" class="w-25">Quantity</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">
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
          let all_requisitionable_items = {};
          let items_in_combobox = {};
          let items_in_table = {};

          // const items_in_requisitionable_item
          const requisitionable_item = document.querySelector("#requisitionable_item");
          const requisitionable_items_datalist = document.querySelector("#requisitionable_items");
          const requisition_date = document.querySelector("#requisition_date");
          const requisition_number = document.querySelector("#requisition_number");
          const requisition_time = document.querySelector("#requisition_time");
          const table_body = document.querySelector("#table_body");

          document.addEventListener('DOMContentLoaded', function() {
            // Fetch items and balance
            fetch('../includes/requisition_items.php')
              .then(response => response.json())
              .then(data => {
                data.forEach((value) => {
                  all_requisitionable_items[value["product_name"]] = {
                    name: value["product_name"],
                    code: value["product_code"],
                    unit: value["unit"],
                    balance: value["balance"]
                  };
                });
                items_in_combobox = all_requisitionable_items;
                updateReqItems();
              });
          });

          function updateReqItems() {
            // Clear datalist
            requisitionable_items_datalist.innerHTML = "";
            requisitionable_item.value = "";
            for (let item in items_in_combobox) {
              console.log(items_in_combobox[item]);
              let opt = document.createElement("option");
              opt.appendChild(
                document.createTextNode(
                  "Remaining " + items_in_combobox[item]["balance"] +
                  " " + items_in_combobox[item]["unit"]
                )
              );
              opt.setAttribute("value", items_in_combobox[item]["name"]);
              requisitionable_items_datalist.appendChild(opt);
            }
          }

          function addItem() {
            const item_to_add = all_requisitionable_items[requisitionable_item.value]
            if (!item_to_add) {
              return;
            }
            console.log(item_to_add);
            let tr = document.createElement("tr");
            // Id will be like 1Tank
            tr.setAttribute("id", item_to_add["code"] + item_to_add["name"]);

            let code_td = document.createElement("td");
            code_td.appendChild(document.createTextNode(item_to_add["code"]));
            code_td.classList.add("align-middle");

            let name_td = document.createElement("td");
            name_td.appendChild(document.createTextNode(item_to_add["name"]));
            name_td.classList.add("align-middle");

            let units_td = document.createElement("td");
            units_td.appendChild(document.createTextNode(item_to_add["unit"]));
            units_td.classList.add("align-middle");

            let quantity = document.createElement("input");
            quantity.setAttribute("type", "number");
            quantity.setAttribute("required", "");
            quantity.classList.add("form-control", "form-control-sm", "align-middle");
            let quantityWrapper = document.createElement("td");
            quantityWrapper.classList.add("m-2");
            quantityWrapper.appendChild(quantity);

            let actionWrapper = document.createElement("td");
            actionWrapper.classList.add("m-2");
            let action = document.createElement("button");
            action.setAttribute("id", item_to_add["name"]);
            action.setAttribute("onclick", "removeItem(this.id);");
            let icon = document.createElement("span");
            icon.classList.add("fas", "fa-minus", "mt-1");
            action.appendChild(icon);
            action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
            actionWrapper.appendChild(action);

            tr.append(code_td, name_td, units_td, quantityWrapper, actionWrapper);
            table_body.appendChild(tr);

            delete items_in_combobox[item_to_add["name"]];
            updateReqItems();
          }

          function removeItem(item) {
            console.log(item);
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
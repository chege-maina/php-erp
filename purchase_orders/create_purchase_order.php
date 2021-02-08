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

<!DOCTYPE html>
<html lang="en-US" dir="ltr">


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
        <h5 class="p-2">Add Purchase Order</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="supplier_name" class="form-label">Supplier Name*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control">
              </div>
              <div class="col">
                <label for="purchase_date" class="form-label">Purchase Date</label>
                <!-- autofill current date  -->
                <input type="date" name="purchase_date" id="purchase_date" class="form-control">
              </div>
              <div class="col">
                <label for="invoice_number" class="form-label">Invoice Number*</label>
                <input type="number" name="invoice_number" id="invoice_number" class="form-control">
              </div>
              <div class="col">
                <label for="payment_type" class="form-label">Payment Type*</label>
                <select name="payment_type" id="payment_type" class="form-select">
                  <option value="M-pesa">M-pesa</option>
                  <option value="Cash">Cash</option>
                  <option value="Visa">Visa</option>
                </select>
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <label for="browser" class="form-label">Items to Purchase</label>
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
          </div>
          <!-- Content ends here -->
          <div class="row ">
            <div class="col">
              <table class="table">
                <tbody id="table_body">
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <th scope="col">Total</th>
                    <td>
                      <input class="form-control form-control-sm" type="text" placeholder="Total" value="" required />
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <th scope="col">Discount</th>
                    <td>
                      <input class="form-control form-control-sm" type="text" placeholder="Discount" value="" required />
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <th scope="col">Grand Total</th>
                    <td>
                      <input class="form-control form-control-sm" type="text" placeholder="Grand Total" value="" required />
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <th scope="col">Paid Amount</th>
                    <td>
                      <input class="form-control form-control-sm" type="text" placeholder="Paid Amount" value="" required />
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <th scope="col">Due Amount</th>
                    <td>
                      <input class="form-control form-control-sm" type="text" placeholder="Due Amount" value="" required />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col">
            <button class="btn btn-falcon-primary btn-sm m-3" role="button"> Submit </button>
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
          const purchase_date = document.querySelector("#purchase_date");
          const supplier_name = document.querySelector("#supplier_name");
          const invoice_number = document.querySelector("#invoice_number");
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
                items_in_combobox = {
                  ...all_requisitionable_items
                };
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

          function updateTable() {
            table_body.innerHTML = "";
            for (let item in items_in_table) {

              let tr = document.createElement("tr");
              // Id will be like 1Tank
              tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

              let code_td = document.createElement("td");
              code_td.appendChild(document.createTextNode(items_in_table[item]["code"]));
              code_td.classList.add("align-middle");

              let name_td = document.createElement("td");
              name_td.appendChild(document.createTextNode(items_in_table[item]["name"]));
              name_td.classList.add("align-middle");

              let units_td = document.createElement("td");
              units_td.appendChild(document.createTextNode(items_in_table[item]["unit"]));
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
              action.setAttribute("id", items_in_table[item]["name"]);
              action.setAttribute("onclick", "removeItem(this.id);");
              let icon = document.createElement("span");
              icon.classList.add("fas", "fa-minus", "mt-1");
              action.appendChild(icon);
              action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
              actionWrapper.appendChild(action);

              tr.append(code_td, name_td, units_td, quantityWrapper, actionWrapper);
              table_body.appendChild(tr);

            }
            return;
          }

          function addItem() {
            const item_to_add = all_requisitionable_items[requisitionable_item.value];
            if (!item_to_add) {
              return;
            }

            items_in_table[requisitionable_item.value] = item_to_add;
            console.log("Now in table: ", items_in_table);

            console.log(item_to_add);

            delete items_in_combobox[item_to_add["name"]];
            updateTable();
            updateReqItems();
          }

          function removeItem(item) {
            console.log("Before", all_requisitionable_items);
            delete items_in_table[String(item)];
            console.log("After: ", items_in_table);
            const item_to_add = all_requisitionable_items[item];
            console.log("Removing", item_to_add);
            items_in_combobox[item] = item_to_add;
            updateTable();
            updateReqItems();
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

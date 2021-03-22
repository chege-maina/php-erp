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

        <form name="add_product" id="add_product" onsubmit="return sendEverything();">
          <div class="card">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->
            <div class="card-body fs--1 p-4 position-relative">
              <div class="row">
                <div class="col">
                  <label for="name" class="form-label">Name*</label>
                  <input name="name" class="form-control" type="text" placeholder="Name" id="sup_nm" required>
                </div>
                <div class="col">
                  <label for="email" class="form-label">Email*</label>
                  <input name="email" class="form-control" type="email" placeholder="Email" id="sup_email" required>
                </div>
                <div class="col">
                  <label for="tel_no" class="form-label">Telephone Number*</label>
                  <input name="tel_no" class="form-control" type="tel" placeholder="Tel No" id="sup_tel" required>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <label for="postal_address" class="form-label">Postal Address*</label>
                  <input name="postal_address" id="sup_postal" class="form-control" type="text" placeholder="Postal Address" required>
                </div>
                <div class="col">
                  <label for="physical_address" class="form-label">Physical Address*</label>
                  <input name="physical_address" id="sup_physical_address" class="form-control" type="text" placeholder="Physical Address" required>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label for="tax_id" class="form-label">Supplier Tax ID*</label>
                  <input name="tax_id" id="sup_tax_id" class="form-control" placeholder="Tax ID" type="text" required>
                </div>
                <div class="col">
                  <label for="payment_terms" class="form-label">Payment Terms*</label>
                  <input name="payment_terms" id="payment_terms" class="form-control" placeholder="Payment Terms" type="number" required>
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
            <div class="card-header bg-light">
              <h6>Supplier Products</h6>
            </div>
            <div class="card-body fs--1 px-3">
              <table class="table table-striped table-sm" id="table_id">
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
              <input type="submit" class="btn btn-falcon-primary mr-1" name="submit" id="submit" value="Submit">

              <button class="btn ml-2 btn-falcon-warning" type="button" id="clear-table" onclick="clearTable();">
                <span class="fas fa-eraser mr-1" data-fa-transform="shrink-3"></span>
                Clear Table
              </button>

            </div>
          </div>
      </div>
      </form>

      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <?php
      include '../includes/base_page/footer.php';
      ?>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- Footer End -->
      <!-- =========================================================== -->
    </div>
    </div>



    <script>
      let all_requisitionable_items = {};
      let items_in_combobox = {};
      let items_in_table = {};


      // const items_in_requisitionable_item
      const requisitionable_item = document.querySelector("#requisitionable_item");
      const requisitionable_items_datalist = document.querySelector("#requisitionable_items");
      const table_body = document.querySelector("#table_body");

      const sup_nm = document.querySelector("#sup_nm");
      const sup_email = document.querySelector("#sup_email");
      const sup_tel = document.querySelector("#sup_tel");
      const sup_postal = document.querySelector("#sup_postal");
      const sup_physical_address = document.querySelector("#sup_physical_address");
      const sup_tax_id = document.querySelector("#sup_tax_id");
      const payment_terms = document.querySelector("#payment_terms");

      document.addEventListener('DOMContentLoaded', function() {
        // console.log(user_name);
        // Fetch items and balance
        fetch('../includes/load_items.php')
          .then(response => response.json())
          .then(data => {
            data.forEach((value) => {
              all_requisitionable_items[value["name"]] = {
                name: value["name"]

              };
            });
            items_in_combobox = {
              ...all_requisitionable_items
            };
            console.log(data);
            updateReqItems();
          });
      });

      function updateReqItems() {
        // Clear datalist
        requisitionable_items_datalist.innerHTML = "";
        requisitionable_item.value = "";
        for (let item in items_in_combobox) {
          // console.log(items_in_combobox[item]);
          let opt = document.createElement("option");
          // opt.appendChild(
          // document.createTextNode(
          // "Remaining " + items_in_combobox[item]["name"]
          // )
          // );
          opt.setAttribute("value", items_in_combobox[item]["name"]);
          requisitionable_items_datalist.appendChild(opt);
        }
      }


      function updateTable() {
        table_body.innerHTML = "";

        for (let item in items_in_table) {

          let tr = document.createElement("tr");
          // Id will be like 1Tank

          let name = document.createElement("td");
          name.appendChild(document.createTextNode(items_in_table[item]["name"]));
          name.classList.add("align-middle");


          let cost = document.createElement("input");
          cost.setAttribute("type", "number");
          cost.setAttribute("required", "");
          cost.classList.add("form-control", "form-control-sm", "align-middle");
          cost.setAttribute("data-ref", items_in_table[item]["name"]);
          cost.setAttribute("min", 1);
          // make sure the cost is always greater than 0
          cost.setAttribute("onfocusout", "this.value = this.value <= 0 ? 1 : this.value;");
          cost.setAttribute("onkeyup", "addCostToReqItem(this.dataset.ref, this.value);");
          cost.setAttribute("onclick", "this.select();");
          items_in_table[item]['cost'] = ('cost' in items_in_table[item] && items_in_table[item]['cost'] > 0) ?
            items_in_table[item]['cost'] : 1;
          cost.value = items_in_table[item]['cost'];
          let costWrapper = document.createElement("td");
          costWrapper.classList.add("m-2");
          costWrapper.appendChild(cost);

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

          tr.append(name, cost, actionWrapper);
          table_body.appendChild(tr);

        }
        return;
      }

      function addCostToReqItem(item, value) {
        items_in_table[item]['cost'] = value;
        console.log(value);
      }

      function addItem() {
        const item_to_add = all_requisitionable_items[requisitionable_item.value];
        if (!item_to_add) {
          return;
        }

        items_in_table[requisitionable_item.value] = item_to_add;
        // console.log("Now in table: ", items_in_table);

        // console.log(item_to_add);

        delete items_in_combobox[item_to_add["name"]];
        updateTable();
        updateReqItems();
      }

      function removeItem(item) {
        items_in_table[item]['cost'] = 0;
        delete items_in_table[String(item)];
        const item_to_add = all_requisitionable_items[item];
        items_in_combobox[item] = item_to_add;
        updateTable();
        updateReqItems();
      }

      function clearTable() {
        items_in_table = {};
        items_in_combobox = {
          ...all_requisitionable_items
        };
        updateTable();
        updateReqItems();
      }

      function sendEverything() {
        let table_items = [];
        for (let item in items_in_table) {
          table_items.push(items_in_table[item]);
        }
        if (table_items.length == 0) {
          const alertVar =
            `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> Cannot submit empty table.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
          var divAlert = document.querySelector("#alert-div");
          divAlert.innerHTML = alertVar;
          divAlert.scrollIntoView();
          return false;
        } else {
          console.log(table_items);
          const formData = new FormData();

          formData.append("name", sup_nm.value);
          formData.append("email", sup_email.value);
          formData.append("tel_no", sup_tel.value);
          formData.append("postal_address", sup_postal.value);
          formData.append("physical_address", sup_physical_address.value);
          formData.append("tax_id", sup_tax_id.value);
          formData.append("payment_terms", payment_terms.value);

          formData.append("table_items", JSON.stringify(table_items));

          // Send the data
          fetch('../includes/add_supplier.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(data => {
              console.log("from server", data);
              // return false;
              const alertVar =
                `<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> ${data}
          <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
          </div>`;
              var divAlert = document.querySelector("#alert-div");
              divAlert.innerHTML = alertVar;
              divAlert.scrollIntoView();
              setTimeout(function() {
                location.reload();
              }, 2500);
            })
            .catch(error => {
              console.error(error);
            });
          return false;
        }
      }
    </script>
</body>

</html>

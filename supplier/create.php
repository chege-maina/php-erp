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
              <h6 class="p-2">Supplier Products</h6>
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
              <input type="submit" class="btn btn-falcon-primary mt-2" name="submit" id="submit" value="Insert">

              <button class="btn btn-falcon-primary" id="submit" onclick="sendTableData();">
                <span class="fas fa-save mr-1" data-fa-transform="shrink-3"></span>
                Create Requisition
              </button>
              <button class="btn ml-2 btn-falcon-warning" id="clear-table" onclick="clearTable();">
                <span class="fas fa-eraser mr-1" data-fa-transform="shrink-3"></span>
                Clear Table
              </button>

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

      <script>
        let all_requisitionable_items = {};
        let items_in_combobox = {};
        let items_in_table = {};

        // const items_in_requisitionable_item
        const requisitionable_item = document.querySelector("#requisitionable_item");
        const requisitionable_items_datalist = document.querySelector("#requisitionable_items");
        const table_body = document.querySelector("#table_body");

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
            opt.appendChild(
              document.createTextNode(
                "Remaining " + items_in_combobox[item]["name"]
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

        function sendTableData() {
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
            return;
          } else {
            console.log(table_items);
            const formData = new FormData();
            formData.append("name", user_name);

            // TODO: Remove this from here and from the subsequent php
            formData.append("requisition_number", -1);

            formData.append("table_items", JSON.stringify(table_items));

            // Send the data
            fetch('../includes/load_items.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                console.log("from server", data);
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
          }
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
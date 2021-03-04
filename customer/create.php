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
        <h5 class="p-2">Add Customer</h5>

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
                  <label for="tax_id" class="form-label">Customers Tax ID*</label>
                  <input name="tax_id" id="sup_tax_id" class="form-control" placeholder="Tax ID" type="text" required>
                </div>
                <div class="col">
                  <label for="payment_terms" class="form-label">Payment Terms(Days)*</label>
                  <input name="payment_terms" id="payment_terms" class="form-control" placeholder="Payment Terms" type="number" required>
                </div>
                <div class="col">
                  <label for="credit" class="form-label">Credit Limit*</label>
                  <input name="credit_limit" id="credit_limit" class="form-control" placeholder="Credit Limit" type="number" required>
                </div>
              </div>
            </div>
          </div>
          <div class="card mt-1">
            <div class="card-header bg-light">
            </div>
            <div class="card-body fs--1 px-3">
              <input type="submit" class="btn btn-falcon-primary mr-1" name="submit" id="submit" value="Submit">

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
      const credit_limit = document.querySelector("#credit_limit");

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

        updateReqItems();
      }

      function removeItem(item) {
        items_in_table[item]['cost'] = 0;
        delete items_in_table[String(item)];
        const item_to_add = all_requisitionable_items[item];
        items_in_combobox[item] = item_to_add;

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
          formData.append("limit", credit_limit.value);

          formData.append("table_items", JSON.stringify(table_items));

          // Send the data
          fetch('../includes/add_customer.php', {
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
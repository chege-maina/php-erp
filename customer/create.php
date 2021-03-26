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

        <?php
        include '../base_page/data_list_select.php';
        ?>

        <div id="alert-div"></div>
        <h5 class="p-2">Add Customer</h5>

        <form name="add_customer" id="add_customer" onsubmit="return sendEverything();">
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
                <div class="col">
                  <label for="#" class="form-label">Select Sales Rep </label>
                  <div class="input-group">
                    <input list="suppliers" name="supplier" id="supplier_name" class="form-select" required>
                    <datalist id="suppliers"></datalist>
                  </div>
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

        </form>
      </div>
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
      // const items_in_requisitionable_item
      const suppliers = document.querySelector("#suppliers");
      const supplier_name = document.querySelector("#supplier_name");

      const add_customer = document.querySelector("#add_customer");
      const sup_nm = document.querySelector("#sup_nm");
      const sup_email = document.querySelector("#sup_email");
      const sup_tel = document.querySelector("#sup_tel");
      const sup_postal = document.querySelector("#sup_postal");
      const sup_physical_address = document.querySelector("#sup_physical_address");
      const sup_tax_id = document.querySelector("#sup_tax_id");
      const payment_terms = document.querySelector("#payment_terms");
      const credit_limit = document.querySelector("#credit_limit");

      window.addEventListener('DOMContentLoaded', (event) => {

        initSelectElement("#suppliers", "-- Select Currency --");
        populateSelectElement("#suppliers", '../includes/load_sales_rep.php', "name");

      });


      function sendEverything() {

        const formData = new FormData();
        formData.append("sales_rep", supplier_name.value);
        formData.append("name", sup_nm.value);
        formData.append("email", sup_email.value);
        formData.append("tel_no", sup_tel.value);
        formData.append("postal_address", sup_postal.value);
        formData.append("physical_address", sup_physical_address.value);
        formData.append("tax_id", sup_tax_id.value);
        formData.append("terms", payment_terms.value);
        formData.append("limit", credit_limit.value);

        // Send the data
        fetch('../includes/add_customer.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            console.log("from server", data);
            if (data.message == "success") {
              const alertVar =
                `<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Customer added successfully
          <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
          </div>`;
              var divAlert = document.querySelector("#alert-div");
              divAlert.innerHTML = alertVar;
              divAlert.scrollIntoView();

              setTimeout(function() {
                location.reload();
              }, 2500);
            } else {
              const alertVar =
                `<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Customer not saved.
          <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
          </div>`;
              var divAlert = document.querySelector("#alert-div");
              divAlert.innerHTML = alertVar;
              divAlert.scrollIntoView();
            }
          })
          .catch(error => {
            console.error(error);
          });
        return false;
      }
    </script>
</body>

</html>
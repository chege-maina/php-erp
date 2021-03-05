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
        <div id="alert-div"></div>
        <h5 class="p-2">Purchase Bill</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <form onsubmit="return submitForm()">
          <div class="card mt-3">
            <div class="card-body fs--1 p-4">
              <div class="row">

                <div class="col">
                  <label for="#" class="form-label">Select Supplier </label>
                  <div class="input-group">
                    <input list="suppliers" name="supplier" id="supplier_name" class="form-select" required>
                    <datalist id="suppliers"></datalist>
                    <button type="button" class="btn btn-primary" onclick="selectSupplier();">Select</button>
                  </div>
                </div>
                <div class="col">
                  <div class="col flex-row-reverse">
                    <div class="col">
                      <label for="amt" class="form-label">Amount Payable*</label>
                      <input type="number" name="amt" id="amt" class="form-control" required readonly>
                    </div>
                  </div>
                  <!-- Content is to start here -->
                </div>

                <div class="col">
                  <label for="#" class="form-label">Cheque Date</label>
                  <input type="date" id="date" class="form-control" required>
                </div>
              </div>

              <!-- Content is to start here -->
              <hr>
              <div class="row">
                <div class="col">
                  <div class="col">
                    <label for="supplier" class="form-label">Supplier*</label>
                    <input type="supplier" name="supplier" id="supplier" class="form-control" required readonly>
                  </div>
                </div>

                <div class="col">
                  <label for="cheque_number" class="form-label">Cheque Number*</label>
                  <input type="number" name="cheque_number" id="cheque_number" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label for="#" class="form-label">Bank Name </label>
                  <div class="input-group">
                    <select name="bank_name" id="bank_name" class="form-select" required>
                    </select>
                  </div>
                </div>
                <div class="col">
                  <label for="#" class="form-label">Cheque Type </label>
                  <div class="input-group">
                    <select name="type" id="type" class="form-select" required>
                      <option value="" disabled selected hidden>-- Select Cheque Type --</option>
                      <option value="inhouse">Inhouse</option>
                      <option value="interbank">Interbank</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-1">
              <div class="d-flex flex-row-reverse">
                <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                  Pay Bill
                </button>
              </div>
              <!-- Content ends here -->
            </div>

          </div>
        </form>

        <!-- Additional cards can be added here -->
      </div>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- body ends here -->
      <!-- =========================================================== -->

      <script>
        const supplier_name = document.querySelector("#supplier_name");
        const supplier = document.querySelector("#supplier");
        const bank_name = document.querySelector('#bank_name');

        const type = document.querySelector('#type');
        const amt = document.querySelector('#amt');
        const cheque_no = document.querySelector('#cheque_number');

        function submitForm() {
          if (!supplier_name.value) {
            supplier_name.focus();
            return false;
          }

          if (!date.value) {
            date.focus();
            return;
          }

          if (!cheque_no.value) {
            cheque_no.focus();
            return;
          }

          if (!bank_name.value) {
            bank_name.focus();
            return;
          }
          const sn = supplier_name.value.split("#")[1].trim();
          console.log("Submitting");


          const formData = new FormData();
          formData.append("rem_no", sn);
          formData.append("supplier", supplier.value);
          formData.append("amount", amt.value);
          formData.append("cheque_no", cheque_no.value);
          formData.append("bank", bank_name.value);
          formData.append("cheque_type", type.value);
          formData.append("date", date.value);
          fetch('../includes/add_payment.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(result => {
              console.log('Success:', result);

              const alertVar =
                `<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> ${result}
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
              console.error('Error:', error);
            });
          return false;
        }

        const selectSupplier = () => {
          if (!supplier_name.value) {
            supplier_name.focus();
            return;
          }

          const sn = supplier_name.value.split("#")[1].trim();

          const formData = new FormData();
          formData.append("rem_no", sn);
          fetch('../includes/payment_load.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              supplier.value = result[0]["name"];
              amt.value = result[0]["amount"];
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }

        window.addEventListener('DOMContentLoaded', (event) => {
          const formData = new FormData();

          fetch('../includes/load_rem_num_pay.php')
            .then(response => response.json())
            .then(result => {
              console.log(result)
              let opt = document.createElement("option");

              result.forEach((supplier) => {
                opt = document.createElement("option");
                opt.value = "Remittance # " + supplier["rem_num"];
                opt.appendChild(document.createTextNode(supplier["date"] + " : " + supplier["supplier"]));
                suppliers.appendChild(opt);
              });

            })
            .catch((error) => {
              console.error('Error:', error);
            });


          fetch('../includes/load_bank.php')
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);

              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Bank --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              bank_name.appendChild(opt);

              result.forEach((bank) => {
                opt = document.createElement("option");
                opt.value = bank["name"];
                opt.appendChild(document.createTextNode(bank["name"]));
                bank_name.appendChild(opt);
              });
            })
            .catch(error => {
              console.error('Error:', error);
            });


        });
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
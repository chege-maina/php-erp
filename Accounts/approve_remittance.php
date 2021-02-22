l<?php
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
        <div id="alert-div">
        </div>
        <h5 class="p-2">Approve Remittance Advice</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->

        <div class="card mt-3">
          <div class="card-body fs--1 p-4">
            <div class="row">

              <div class="col">
                <label for="#" class="form-label">Select Supplier </label>
                <div class="input-group">
                  <input list="suppliers" name="supplier" id="supplier_name" class="form-select">
                  <datalist id="suppliers"></datalist>
                  <button type="button" class="btn btn-primary" onclick="selectSupplier();">Select</button>
                </div>
              </div>
              <div class="col">

                <div class="col flex-row-reverse">
                  <div class="col">
                    <label for="req_date" class="form-label">Date </label>
                    <input type="date" name="req_date" id="rem_date" class="form-control" readonly>
                  </div>
                </div>
                <!-- Content is to start here -->

              </div>
            </div>
            <!-- Content is to start here -->
          </div>
          <hr>
          <div class="m-2 mb-2">
            <div class="table-responsive">
              <table class="table table-sm table-striped" id="table-main">
                <thead>
                  <tr>
                    <th class="w-25">Due Date</th>
                    <th>Invoice Number</th>
                    <th>Amount Due</th>
                    <th>WHT</th>
                    <th>Amount Payable</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Total Amount</div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="text" readonly id="total_before_tax" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Less 2% VAT With Held
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="text" readonly id="tax_pc" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Net Payable
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="text" readonly id="po_total" />
              </div>
            </div>
          </div>
          <!-- Content ends here -->
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-success btn-sm m-2" id="submit" onclick="submitPO();">
                Approve
              </button>
            </div>
            <!-- Content ends here -->
          </div>

        </div>

        <!-- Additional cards can be added here -->
      </div>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- body ends here -->
      <!-- =========================================================== -->

      <script>
        const rem_date = document.querySelector("#rem_date");
        const supplier_name = document.querySelector("#supplier_name");
        const suppliers = document.querySelector("#suppliers");
        const table_body = document.querySelector("#table_body");

        const total_before_tax = new AutoNumeric("#total_before_tax", {
          currencySymbol: '',
          minimumValue: 0
        });
        const tax_pc = new AutoNumeric("#tax_pc", {
          currencySymbol: '',
          minimumValue: 0
        });
        const po_total = new AutoNumeric("#po_total", {
          currencySymbol: '',
          minimumValue: 0
        });

        let table_items;

        function submitPO() {
          if (!supplier_name.value) {
            supplier_name.focus();
            return;
          }

          const sn = supplier_name.value.split("#")[1].trim();
          console.log(sn);

          const formData = new FormData();
          formData.append("rem_no", sn);
          formData.append("checker", "approve");
          fetch('../includes/update_rem.php', {
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
                location.href = "select_po.php"
              }, 2500);
            })
            .catch(error => {
              console.error('Error:', error);
            });

        }


        function d_toString(value) {
          return value < 10 ? '0' + value : String(value);
        }



        window.addEventListener('DOMContentLoaded', (event) => {
          const formData = new FormData();

          fetch('../includes/load_rem_num.php')
            .then(response => response.json())
            .then(result => {
              console.log(result)
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Supplier --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              suppliers.appendChild(opt);

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

        });

        const selectSupplier = () => {
          if (!supplier_name.value) {
            supplier_name.focus();
            return;
          }

          const sn = supplier_name.value.split("#")[1].trim();

          const formData = new FormData();
          formData.append("rem_no", sn);
          fetch('../includes/load_rem_approval.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              total_before_tax.set(result[0]["amount"]);
              tax_pc.set(result[0]["wht"]);
              po_total.set(result[0]["payable"]);
              rem_date.value = result[0]["date"];
              [...table_items] = result[0].table_items;
              updateTable(table_items);
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }


        let updateTable = (data) => {
          table_body.innerHTML = "";
          console.log("Ladadida", "Commodore ", data);
          data.forEach(value => {

            const this_row = document.createElement("tr");

            // =================================================================
            // Cell 1
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const due_date = document.createElement("td");
            due_date.appendChild(document.createTextNode(value["due_date"]));
            due_date.classList.add("align-middle");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================


            // =================================================================
            // Cell 2
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const invoice_no = document.createElement("td");
            invoice_no.appendChild(document.createTextNode(value["invoice_no"]));
            invoice_no.classList.add("align-middle");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================


            // =================================================================
            // Cell 3
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const amount = document.createElement("td");
            const amount_input = document.createElement("input");
            // --
            amount_input.setAttribute("type", "text");
            amount_input.classList.add("form-control", "form-control-sm");
            // --
            const amount_input_an = new AutoNumeric(amount_input, {
              currencySymbol: '',
              minimumValue: 0
            });
            // --
            amount_input_an.set(value["amount_due"]);
            amount_input.setAttribute("readonly", "");
            amount.appendChild(amount_input)
            amount.classList.add("align-middle");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================

            // =================================================================
            // Cell 4
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const wht = document.createElement("td");
            const wht_input = document.createElement("input");
            // --
            wht_input.setAttribute("type", "text");
            wht_input.setAttribute("readonly", "");
            wht_input.classList.add("form-control", "form-control-sm");
            // --
            const wht_input_an = new AutoNumeric(wht_input, {
              currencySymbol: '',
              minimumValue: 0
            });
            // --
            wht_input_an.set(value["wht"]);
            wht.appendChild(wht_input);
            wht.classList.add("align-middle");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================


            // =================================================================
            // Cell 5
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const amount_due = document.createElement("td");
            const amount_due_input = document.createElement("input");
            // --
            amount_due_input.setAttribute("type", "text");

            amount_due_input.setAttribute("readonly", "");
            amount_due_input.classList.add("form-control", "form-control-sm");
            // --
            const amount_due_input_an = new AutoNumeric(amount_due_input, {
              currencySymbol: '',
              minimumValue: 0
            });
            // --

            amount_due_input_an.set(value["payable"]);
            amount_due.appendChild(amount_due_input);
            amount_due.classList.add("align-middle", "col", "col-auto");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================


            // =================================================================
            // Cell 6
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-

            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================

            this_row.append(due_date, invoice_no, amount, wht, amount_due);
            table_body.appendChild(this_row);


          });

        }

        function detailedView(req_no) {
          sessionStorage.setItem('req_no', req_no);
          window.location.href = "#.php";
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
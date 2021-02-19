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
        <h5 class="p-2">Generate Remittance Advice</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->

        <div class="card mt-3">
          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>

          <div class="card-body fs--1 p-4 pb-2 position-relative">
            <div class="row">

              <div class="col">
                <label for="#" class="form-label">Select Supplier </label>
                <div class="input-group">
                  <select name="supplier" id="supplier_name" class="form-select">
                  </select>
                  <button type="button" class="btn btn-primary" onclick="selectSupplier();">Select</button>
                </div>
              </div>
              <div class="col">

                <div class="col flex-row-reverse">
                  <div class="col">
                    <label for="req_date" class="form-label">Date </label>
                    <input type="text" name="req_date" id="req_date_from" class="form-control" readonly>

                  </div>
                </div>
                <!-- Content is to start here -->

              </div>

              <div class="col">
                <label for="bills" class="form-label">Show Bills Due</label>
                <select name="bills" id="status" class="form-select">
                  <option value="all">Show All</option>
                  <option value="bills_due">Show Bills Due</option>
                </select>
              </div>
              <div class="col-auto d-flex align-items-end">
                <button class="btn btn-falcon-primary" type="button" onclick="filterRequisitions();">
                  <span class="fas fa-filter mr-1" data-fa-transform="shrink-3"></span>Filter
                </button>
              </div>
            </div>

            <hr>
            <div class="d-flex flex-row-reverse mt-3">
              <div class="form-check form-switch border rounded-1">
                <input class="form-check-input" id="wht_checkbox" type="checkbox" />
                <label class="form-check-label" for="wht_checkbox">
                  Calculate Witholding Tax
                </label>
              </div>
            </div>

          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-4 position-relative">
            <div class="table-responsive">
              <table class="table table-sm table-striped" id="table-main">
                <thead>
                  <tr>
                    <th>Due Date</th>
                    <th>Invoice Number</th>
                    <th class="col col-auto">Amount Due</th>
                    <th class="col-lg-2">WHT</th>
                    <th>Amount Payable</th>
                    <th>Actions</th>
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
                <input class="form-control form-control-sm text-right" type="number" readonly id="total_before_tax" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Less 2% VAT With Held
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="number" readonly id="tax_pc" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Net Payable
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="number" readonly id="po_total" />
              </div>
            </div>
          </div>
          <!-- Content ends here -->
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                Create
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
        const table_body = document.querySelector("#table_body");
        const supplier_name = document.querySelector("#supplier_name");
        let table_items;

        function d_toString(value) {
          return value < 10 ? '0' + value : String(value);
        }


        function updateDateFilters() {
          const fromDate = new Date(req_date_from.value);
          const toDate = new Date(req_date_to.value);
          if (fromDate > toDate) {
            let month = d_toString(fromDate.getMonth() + 1);
            let day = d_toString(fromDate.getDate() + 1);
            req_date_to.value = String(fromDate.getFullYear()) + '-' + month + '-' + day;
          }
          req_date_to.setAttribute("min", fromDate);

          console.log("From: ", fromDate.getDate(), " To: ", req_date_to.value);
        }


        window.addEventListener('DOMContentLoaded', (event) => {
          const formData = new FormData();

          fetch('../includes/load_supplier_remittance.php')
            .then(response => response.json())
            .then(result => {
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Supplier --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              supplier_name.appendChild(opt);

              result.forEach((supplier) => {
                opt = document.createElement("option");
                opt.value = supplier["supplier_name"];
                opt.appendChild(document.createTextNode(opt.value));
                supplier_name.appendChild(opt);
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

          console.log(supplier_name.value);
          const formData = new FormData();
          formData.append("supplier", supplier_name.value.trim());
          fetch('../includes/load_remittance_static.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              [...table_items] = result;
              updateTable(table_items);
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }

        let updateTable = (data) => {
          table_body.innerHTML = "";
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
            amount_input_an.set(value["amount"]);
            amount.appendChild(amount_input)
            amount.classList.add("align-middle");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================

            // =================================================================
            // Cell 4
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const amount_due = document.createElement("td");
            const amount_due_input = document.createElement("input");
            // --
            amount_due_input.setAttribute("type", "text");
            amount_due_input.classList.add("form-control", "form-control-sm");
            // --
            const amount_due_input_an = new AutoNumeric(amount_due_input, {
              currencySymbol: '',
              minimumValue: 0
            });
            // --
            amount_due.appendChild(amount_due_input);
            amount_due.classList.add("align-middle", "col", "col-auto");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================

            // =================================================================
            // Cell 5
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const wht = document.createElement("td");
            const wht_input = document.createElement("input");
            // --
            wht_input.setAttribute("type", "text");
            wht_input.classList.add("form-control", "form-control-sm");
            // --
            const wht_input_an = new AutoNumeric(amount_input, {
              currencySymbol: '',
              minimumValue: 0
            });
            // --
            wht_input_an.set(value["amount"]);
            wht.appendChild(wht_input);
            wht.classList.add("align-middle");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================


            // =================================================================
            // Cell 6
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const req_actions = document.createElement("td");
            const btn = document.createElement("button");
            btn.setAttribute("onclick", "detailedView(" + value["invoice_no"] + ")");
            btn.appendChild(document.createTextNode("Manage"));
            btn.classList.add("btn", "btn-falcon-primary", "btn-sm");
            req_actions.appendChild(btn);
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================

            this_row.append(due_date, invoice_no, amount, amount_due, wht, req_actions);
            table_body.appendChild(this_row);


          });

        }

        function detailedView(req_no) {
          sessionStorage.setItem('req_no', req_no);
          window.location.href = "#.php";
        }

        function filterRequisitions() {
          const formData = new FormData();
          formData.append("date1", req_date_from.value);
          formData.append("date2", req_date_to.value);
          // formData.append("status", r_status.value);
          formData.append("branch", user_branch);
          fetch('../includes/#  .php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              updateTable(result);
            })
            .catch(error => {
              console.error('Error:', error);
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

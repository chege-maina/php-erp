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
        <h5 class="p-2">Edit Receipt Advice</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->

        <div class="card mt-3">
          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>

          <div class="card-body fs--1 p-4 pb-2 position-relative">
            <div class="row">

              <div class="col">
                <label for="#" class="form-label">Select Customer </label>
                <div class="input-group">
                  <select name="supplier" id="supplier_name" class="form-select">
                  </select>
                  <button type="button" class="btn btn-primary" onclick="selectSupplier();">Select</button>
                </div>
              </div>
              <div class="col">

                <div class="col flex-row-reverse">
                  <div class="col">
                    <label for="date" class="form-label">Date</label>
                    <!-- autofill current date  -->
                    <input type="date" value="<?php echo date("Y-m-d"); ?>" id="remmitance_date" class="form-control" readonly>

                  </div>
                </div>
                <!-- Content is to start here -->

              </div>
            </div>

            <hr>
            <div class="d-flex flex-row-reverse mt-3">
              <div class="form-check form-switch border rounded-1">
                <input class="form-check-input" id="wht_checkbox" type="checkbox" onchange="updateWHT(this);" />
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
                <input type="number" class="form-control hide-this" name="total_before_tax" id="total_before_tax" required>
                <input type="text" class="form-control form-control-sm text-right" id="total_before_tax_helper" required readonly>
                <script>
                  let total_before_tax_helper;
                  window.addEventListener('DOMContentLoaded', (event) => {
                    [, total_before_tax_helper] = commify('#total_before_tax', '#total_before_tax_helper');
                  });
                </script>
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Less 2% VAT With Held
              </div>
              <div class="col col-auto">
                <input type="number" class="form-control hide-this" name="total_wht" id="total_wht" required>
                <input type="text" class="form-control form-control-sm text-right" id="total_wht_helper" required readonly>
                <script>
                  window.addEventListener('DOMContentLoaded', (event) => {
                    [, total_wht_helper] = commify('#total_wht', '#total_wht_helper');
                  });
                </script>
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Net Receivable
              </div>
              <div class="col col-auto">
                <input type="number" class="form-control hide-this" name="amount_due" id="amount_due" required>
                <input type="text" class="form-control form-control-sm text-right" id="amount_due_helper" required readonly>
                <script>
                  window.addEventListener('DOMContentLoaded', (event) => {
                    [, amount_due_helper] = commify('#amount_due', '#amount_due_helper');
                  });
                </script>
              </div>
            </div>
          </div>
          <!-- Content ends here -->
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="generateRemittance();">
                Edit
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
        const remmitance_date = document.querySelector("#remmitance_date");
        let table_items;


        function generateRemittance() {
          if (net_total <= 0) {
            return;
          }

          if (!remmitance_date.value) {
            remmitance_date.focus()
            return;
          }


          let table_items_sendable = [];
          table_items.forEach((item) => {
            if (item["included"]) {
              table_items_sendable.push({
                p_invoice: item["invoice_no"],
                p_payable: item["amount_due"],
                p_amount: item["amount"],
                p_wht: item["wht"],
                p_due: item["due_date"],
              })
            }
          });

          const formData = new FormData();
          formData.append("date", remmitance_date.value);
          formData.append("supplier", supplier_name.value);
          formData.append("amount", amount_total);
          formData.append("wht", wht_total);
          formData.append("payable", net_total);
          formData.append("user", user_name);
          formData.append("table_items", JSON.stringify(table_items_sendable));

          fetch('../includes/add_receipt_adv.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);

              window.setTimeout(() => {
                //TODO:  Show result
                location.reload();
              }, 2500);
            })
            .catch(error => {
              console.error('Error:', error);
            });
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

          fetch('../includes/load_customer_receiptadv.php')
            .then(response => response.json())
            .then(result => {
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Customer --"));
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
          fetch('../includes/load_receipt_static.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              [...table_items] = result;
              calculateTableData(table_items, false)
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }


        let calculateWHT = false;

        function updateWHT(elem) {
          if (!table_items) {
            elem.checked = false;
            return;
          }

          calculateWHT = elem.checked;
          calculateTableData(table_items, elem.checked);
        }

        let calculateTableData = (data, calc_wht) => {
          let table_items_tmp = [];
          let i = 0;

          data.forEach(value => {
            table_items_tmp.push({
              due_date: value["due_date"],
              invoice_no: value["invoice_no"],
              amount: value["amount"],
              wht: calc_wht ? (Number(value["amount"]) * 0.02 / 1.16) : 0,
              amount_due: calc_wht ? (Number(value["amount"]) * 1.14 / 1.16) : value["amount"],
              included: false,
              uid: String(Math.floor(Math.random() * 10000000))
            });
          });

          table_items = [];
          [...table_items] = table_items_tmp;
          updateTable(table_items);
        }

        function updateTableData(data) {
          let table_items_tmp = [];
          let i = 0;

          data.forEach(value => {
            table_items_tmp.push({
              due_date: value["due_date"],
              invoice_no: value["invoice_no"],
              amount: value["amount"],
              wht: calculateWHT ? (Number(value["amount"]) * 0.02 / 1.16) : 0,
              amount_due: calculateWHT ? (Number(value["amount"]) * 1.14 / 1.16) : value["amount"],
              included: value["included"],
              uid: value["uid"]
            });
          });

          table_items = [];
          [...table_items] = table_items_tmp;
          console.log("Table items", table_items);
          updateTable(table_items);
        }

        let amount_total = 0;
        let wht_total = 0;
        let net_total = 0;

        function updateTotals() {
          amount_total = 0;
          wht_total = 0;
          net_total = 0;

          table_items.forEach((item) => {
            if (item["included"]) {
              amount_total += Number(item["amount"])
              wht_total += Number(item["wht"])
              net_total += Number(item["amount_due"])
            }
          });
          total_before_tax_helper.set(amount_total);
          total_wht_helper.set(wht_total);
          amount_due_helper.set(net_total);
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
            amount_due_input_an.set(value["amount_due"]);
            amount_due.appendChild(amount_due_input);
            amount_due.classList.add("align-middle", "col", "col-auto");
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================


            // =================================================================
            // Cell 6
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            const req_actions = document.createElement("td");
            const req_actions_div = document.createElement("div");
            req_actions_div.classList.add("form-check", "form-switch", "pt-1");
            const check_wht = document.createElement("input");
            check_wht.setAttribute("type", "checkbox");
            check_wht.setAttribute("id", value["uid"]);
            check_wht.setAttribute("onchange", "toggleRow('" + value["uid"] + "', this.checked)");
            check_wht.appendChild(document.createTextNode("Manage"));
            check_wht.classList.add("form-check-input");
            if (value["included"]) {
              check_wht.setAttribute("checked", "");
            }
            req_actions_div.appendChild(check_wht);
            req_actions.appendChild(req_actions_div);
            // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
            // =================================================================

            this_row.append(due_date, invoice_no, amount, wht, amount_due, req_actions);
            table_body.appendChild(this_row);


          });

          updateTotals();
        }

        function toggleRow(uid, checked) {
          let i = 0;
          table_items.forEach(item => {
            if (uid === item["uid"]) {
              console.log(uid, checked);
              table_items[i]["included"] = checked;
            }
            i++;
          });

          updateTableData(table_items, calculateWHT);
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
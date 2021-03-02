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
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2">Create Invoice</h5>
        <div class="card">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 pr-2 position-relative">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="lpo_number" class="form-label">Sales Order Number</label>
                <input type="text" name="lpo_number" id="lpo_number" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="supplier_name" class="form-label">Customer Name*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="terms_of_payment" class="form-label">Terms of Payment(Days)</label>
                <input type="text" name="terms_of_payment" id="terms_of_payment" class="form-control" readonly>
              </div>
            </div>
            <hr>
            <div class="row mt-3">
              <div class="col">
                <label for="bill_date" class="form-label">Date*</label>
                <!-- autofill current date  -->
                <input type="date" id="bill_date" value="<?php echo date("Y-m-d") ?>" class="form-control" readonly required onchange="updateDueDate();">
              </div>
              <div class="col">
                <label for="date_due" class="form-label">Bill Due*</label>
                <!-- autofill current date  -->
                <input type="date" id="date_due" class="form-control" required readonly>
              </div>
              <div class="col">
                <label for="amount_due" class="amount_due-label">Amount Due*</label>
                <input type="number" class="form-control hide-this" name="amount_due" id="amount_due">
                <input type="text" class="form-control" id="amount_due_helper" required>
                <script>
                  let amount_due, amount_due_helper;
                  window.addEventListener('DOMContentLoaded', (event) => {
                    [amount_due, amount_due_helper] = commify('#amount_due', '#amount_due_helper');
                  });
                </script>
              </div>
            </div>
          </div>
        </div>


        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-2">
            <div class="table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Units</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Tax</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>

            <div class="row m-3">
              <div class="col text-right fw-bold">
                Total Before Tax</div>
              <div class="col col-auto">
                <input type="text" class="form-control text-right" id="total_before_tax" readonly required>
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Tax 16 %
              </div>
              <div class="col col-auto">
                <input type="text" class="form-control text-right" id="tax_pc" readonly required>
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Transport Cost
              </div>
              <div class="col col-auto">
                <input type="number" class="form-control text-right" id="transport" required>
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Total
              </div>
              <div class="col col-auto">
                <input type="text" class="form-control text-right" id="po_total" readonly required>
              </div>
            </div>
          </div>
        </div>


        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="postBill();">
                Submit
              </button>
            </div>
            <!-- Content ends here -->
          </div>

        </div>

        <!-- Additional cards can be added here -->


      </div>
    </div>


    <script>
      let invoice_number = -1;
      const lpo_number = document.querySelector("#lpo_number");

      const purchase_order_number = document.querySelector("#purchase_order_number");
      const purchase_order_number_items = document.querySelector("#purchase_order_number_items");

      const supplier_name = document.querySelector("#supplier_name");

      const terms_of_payment = document.querySelector("#terms_of_payment");
      // const delivery_no = document.querySelector("#delivery_no");
      const bill_date = document.querySelector("#bill_date");
      const bill_number = document.querySelector("#bill_number");
      const date_due = document.querySelector("#date_due");
      const table_body = document.querySelector("#table_body");
      const amount_due_helper_v = document.querySelector("#amount_due_helper");
      let table_items_data = [];
      let receipt_no;

      const total_before_tax_e = document.querySelector("#total_before_tax");
      const total_before_tax = new AutoNumeric('#total_before_tax', {
        currencySymbol: '',
        minimumValue: 0
      });

      const tax_pc_e = document.querySelector("#tax_pc");
      const tax_pc = new AutoNumeric('#tax_pc', {
        currencySymbol: '',
        minimumValue: 0
      });

      const po_total_e = document.querySelector("#po_total");
      const po_total = new AutoNumeric('#po_total', {
        currencySymbol: '',
        minimumValue: 0
      });

      function postBill() {
        if (!terms_of_payment.value) {
          purchase_order_number.focus();
          return;
        }

        if (!date_due.value) {
          date_due.focus();
          return;
        }

        if (!bill_number.value) {
          bill_number.focus();
          return;
        }


        if (!amount_due.value || Number(amount_due.value) !== Number(po_total.getNumericString())) {
          amount_due_helper_v.focus();
          return;
        }

        const formData = new FormData();
        formData.append("po_number", lpo_number.value);
        formData.append("supplier", supplier_name.value);
        formData.append("terms", terms_of_payment.value);
        //  formData.append("del_no", delivery_no.value);
        formData.append("date", bill_date.value);
        formData.append("due", date_due.value);
        formData.append("invoice", bill_number.value);
        formData.append("total", po_total.getNumericString());
        formData.append("totalbft", total_before_tax.getNumericString());
        formData.append("tax", tax_pc.getNumericString());
        formData.append("receipt_no", receipt_no);
        formData.append("user", user_name);
        formData.append("table_items", JSON.stringify(table_items_data));

        fetch('../includes/add_purchasebill.php', {
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

            window.setTimeout(() => {
              divAlert.innerHTML = "";
              location.reload();
            }, 2500);
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }

      window.addEventListener('DOMContentLoaded', (event) => {
        if (sessionStorage.length === 0) {
          location.href = "create_invoice.php";
        }

        // Get passed requisition number
        invoice_number = sessionStorage.getItem('req_no');

        sessionStorage.clear();

        lpo_number.value = invoice_number;

        const formData = new FormData();

        fetch('../includes/load_purchase_billNo.php')
          .then(response => response.json())
          .then(data => {
            console.log(data);
            data.forEach((value) => {
              const opt = document.createElement("option");
              opt.value = value["lpo_number"];
              purchase_order_number_items.appendChild(opt);
            })
          })
          .catch((error) => {
            console.error('Error:', error);
          });

        formData.append("po_number", invoice_number);

        fetch('../includes/load_sales_bill.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(result => {
            console.log("Selected", result);
            if (result.length === 0) {
              console.log("Empty array received");
              return;
            }
            result = result[0];
            //  po_total = result["receipt_no"];
            invoice_number.value = result["po_number"];
            supplier_name.value = result["supplier_name"];
            terms_of_payment.value = result["terms"];
            bill_date.setAttribute("min", result["date"])
            updateTable(result["table_data"]);
          })
          .catch(error => {
            console.error('Error:', error);
          });

      });



      function updateTable(result) {
        console.log('Result:', result);
        table_body.innerHTML = "";

        let cumulative_total = 0;

        result.forEach((data) => {


          let tmp_row = {
            "p_code": data["product_code"],
            "p_name": data["product_name"],
            "p_units": data["product_unit"],
            "p_quantity": data["product_qty"],
            "p_cost": data["product_cost"],
            "p_total": data["product_total"]
          }
          table_items_data.push(tmp_row);

          let tr = document.createElement("tr");
          // Id will be like 1Tank
          tr.setAttribute("id", data["product_code"] + data["product_name"]);

          let code_td = document.createElement("td");
          code_td.appendChild(document.createTextNode(data["product_code"]));
          code_td.classList.add("align-middle");

          let name_td = document.createElement("td");
          name_td.appendChild(document.createTextNode(data["product_name"]));
          name_td.classList.add("align-middle", "w-25");

          let product_cost = document.createElement("td");
          product_cost.appendChild(document.createTextNode(data["product_cost"]));
          product_cost.classList.add("align-middle");

          let units_td = document.createElement("td");
          units_td.appendChild(document.createTextNode(data["product_unit"]));
          units_td.classList.add("align-middle");

          let qty_td = document.createElement("td");
          qty_td.appendChild(document.createTextNode(data["product_qty"]));
          qty_td.classList.add("align-middle");

          let tax_td = document.createElement("td");
          tax_td.appendChild(document.createTextNode(data["product_tax"]));
          tax_td.classList.add("align-middle");

          let product_total = document.createElement("td");
          product_total.appendChild(document.createTextNode(data["product_total"]));
          product_total.classList.add("align-middle");

          cumulative_total += Number(data["product_total"]);

          let product_qty = document.createElement("td");
          product_qty.appendChild(document.createTextNode(data["product_qty"]));
          product_qty.classList.add("align-middle");


          tr.append(code_td, name_td, units_td, product_qty, tax_td, product_cost, product_total);
          table_body.appendChild(tr);
        });

        total_before_tax.set(cumulative_total);
        tax_pc.set(cumulative_total * 0.16);
        po_total.set(cumulative_total * 1.16);
      }

      function updateDueDate() {
        if (!terms_of_payment.value) {
          return;
        }
        const billDate = new Date(bill_date.value);
        const dateV = addDays(billDate, terms_of_payment.value);
        let month = d_toString(dateV.getMonth() + 1);
        let day = d_toString(dateV.getDate());
        date_due.value = String(dateV.getFullYear()) + '-' + month + '-' + day;
      }
    </script>

    <?php
    include '../includes/base_page/footer.php';
    ?>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- Footer End -->
    <!-- =========================================================== -->
</body>

</html>
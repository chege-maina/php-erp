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
        <h5 class="p-2">Post Purchase Bill </h5>
        <div class="card">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 pr-2 position-relative">

            <div class="col col-md-5 my-4">
              <div class="input-group">
                <input list="purchase_order_number_items" id="purchase_order_number" class="form-select form-select-sm">
                <datalist id="purchase_order_number_items" class="bg-light"></datalist>
                <button class="input-group-btn btn btn-primary btn-sm" id="lpoNumber" onclick="selectLPONumber();">
                  Select
                </button>
              </div>
            </div>

            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="lpo_number" class="form-label">LPO Number</label>
                <input type="text" name="lpo_number" id="lpo_number" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="supplier_name" class="form-label">Supplier Name*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="terms_of_payment" class="form-label">Terms of Payment(Days)</label>
                <input type="text" name="terms_of_payment" id="terms_of_payment" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="delivery_no" class="form-label">Invoice / Delivery Note Number</label>
                <input type="text" id="delivery_no" class="form-control" readonly>
              </div>

            </div>
            <hr>
            <div class="row mt-3">
              <div class="col">
                <label for="bill_date" class="form-label">Date*</label>
                <!-- autofill current date  -->
                <input type="date" id="bill_date" class="form-control" required>
              </div>

              <div class="col">
                <label for="date" class="form-label">Bill Due*</label>
                <!-- autofill current date  -->
                <input type="text" id="date_due" class="form-control" required readonly>
              </div>
              <div class="col">
                <label for="invoice_n" class="form-label">Enter Bill Number*</label>
                <input type="text" id="bill_number" class="form-control" required>
              </div>
              <div class="col">
                <label for="amount_due" class="amount_due-label">Amount Due*</label>
                <input type="text" name="amount_due" id="amount_due" class="form-control" required>
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
                    <th scope="col">Unit Cost</th>
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
                <input class="form-control form-control-sm text-right" type="number" readonly id="total_before_tax" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Tax 16 %
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="number" readonly id="tax_pc" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Purchase Order Total
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="number" readonly id="po_total" />
              </div>
            </div>
          </div>
        </div>


        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                Post Bill
              </button>
            </div>
            <!-- Content ends here -->
          </div>

        </div>

        <!-- Additional cards can be added here -->


      </div>
    </div>

    <script>
      const purchase_order_number = document.querySelector("#purchase_order_number");
      const purchase_order_number_items = document.querySelector("#purchase_order_number_items");

      const supplier_name = document.querySelector("#supplier_name");
      const lpo_number = document.querySelector("#lpo_number");
      const terms_of_payment = document.querySelector("#terms_of_payment");
      const delivery_no = document.querySelector("#delivery_no");
      const bill_date = document.querySelector("#bill_date");
      const bill_number = document.querySelector("#bill_number");
      const date_due = document.querySelector("#date_due");
      const amount_due = document.querySelector("#amount_due");
      const table_body = document.querySelector("#table_body");

      window.addEventListener('DOMContentLoaded', (event) => {
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
      });

      const selectLPONumber = () => {
        if (!purchase_order_number.value) {
          purchase_order_number.focus();
          return;
        }
        const formData = new FormData();
        formData.append("po_number", purchase_order_number.value);
        fetch('../includes/load_purchasebill_static.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(result => {
            result = result[0];
            lpo_number.value = result["po_number"];
            supplier_name.value = result["supplier_name"];
            delivery_no.value = result["delivery_note"];
            terms_of_payment.value = result["terms"];
            console.log('Success:', result);
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }


      function updateTable(result) {
        console.log('Result:', result);
        table_body.innerHTML = "";

        let enableButtons = true;

        result.forEach((data) => {

          let tr = document.createElement("tr");
          // Id will be like 1Tank
          tr.setAttribute("id", data["code"] + data["name"]);

          let code_td = document.createElement("td");
          code_td.appendChild(document.createTextNode(data["code"]));
          code_td.classList.add("align-middle");

          let name_td = document.createElement("td");
          name_td.appendChild(document.createTextNode(data["name"]));
          name_td.classList.add("align-middle", "w-25");

          let balance_td = document.createElement("td");
          balance_td.appendChild(document.createTextNode(data["balance"]));
          balance_td.classList.add("align-middle");

          let units_td = document.createElement("td");
          units_td.appendChild(document.createTextNode(data["unit"]));
          units_td.classList.add("align-middle");

          let qty_td = document.createElement("td");
          qty_td.appendChild(document.createTextNode(data["qty"]));
          qty_td.classList.add("align-middle");

          let status_td = document.createElement("td");
          let status_body = document.createElement("div");
          let status_text = ("availability" in data) ? data["availability"] : "...";

          switch (status_text) {
            case "available":
              status_body.innerHTML = `<span class="badge badge-soft-success">available</span>`;
              break;
            case "...":
              status_body.innerHTML = `<span class="badge badge-soft-secondary">...</span>`;
              enableButtons = false;
              break;
            default:
              status_body.innerHTML = `<span class="badge badge-soft-danger">not available</span>`;
              enableButtons = false;
              break;
          }

          // status_body.innerHTML = "Yees";
          status_td.appendChild(status_body);
          status_td.classList.add("align-middle");


          let quantity = document.createElement("input");
          quantity.setAttribute("type", "number");
          quantity.setAttribute("required", "");
          quantity.setAttribute("readonly", "");
          let id_suffix = data["name"].replace(" ", "_s_s_s_") + "-" + data["code"];
          quantity.setAttribute("id", "q-" + id_suffix);
          quantity.classList.add("form-control", "form-control-sm", "align-middle");
          // quantity.setAttribute("data-ref", da["name"]);
          quantity.setAttribute("min", 1);
          // make sure the quantity is always greater than 0
          quantity.setAttribute("onfocusout", "this.value = this.value <= 0 ? 1 : this.value;");
          // quantity.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value);");
          // quantity.setAttribute("onclick", "this.select();");
          quantity.value = data["qty"];
          let quantityWrapper = document.createElement("td");
          quantityWrapper.classList.add("m-2");
          quantityWrapper.appendChild(quantity);



          let actionWrapper = document.createElement("td");
          actionWrapper.classList.add("m-2");


          let actionDiv = document.createElement("div");
          actionDiv.classList.add("row");

          let reject = document.createElement("button");
          full_id = "r-" + id_suffix;
          reject.setAttribute("id", "r-" + id_suffix);
          reject.setAttribute("onclick", "actionRespond('" + full_id + "');");
          reject.setAttribute("data-toggle", "tooltip");
          reject.setAttribute("title", "Reject");
          let icon_r = document.createElement("span");
          icon_r.classList.add("fas", "fa-times", "mt-1", "fa-sm");
          reject.appendChild(icon_r);
          reject.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");
          reject.disabled = result.length <= 1;


          actionDiv.append(reject);
          actionWrapper.appendChild(actionDiv);

          tr.append(code_td, name_td, balance_td, quantityWrapper, units_td, status_td, actionWrapper);
          table_body.appendChild(tr);

        });

        if (enableButtons) {
          approve_req.removeAttribute("disabled");
          console.log("enabling btn")
        } else {
          approve_req.setAttribute("disabled", "");
          console.log("disabling btn")
        }
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

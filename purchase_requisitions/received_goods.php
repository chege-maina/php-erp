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
        <h5 class="p-2">Create Receipt Note</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row flex">
              <div class="col">
                <label for="supplier_name" class="form-label">Supplier Name*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">LPO Number*</label>
                <input type="text" name="po_number" id="po_number" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="time" class="form-label">Time</label>
                <!-- autofill current date  -->
                <input type="time" id="time" class="form-control" readonly>
              </div>

            </div>
            <div class="row pb-2 ">
              <div class="col-sm-3 mt-2 ">
                <label for="invoice" class="form-label">Enter Invoice No./Delivery Note No.*</label>
                <input type="text" name="invoice" id="invoice" class="form-control" onchange="this.value=this.value.toUpperCase();">
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-4">
            <div class="row my-1">
              <div class="col">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Product Code</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Units</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Quantity Received</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row my-3">
              <div class="col">
                <div class="col">
                  <button class="btn btn-falcon-primary btn-sm m-2" role="button" onclick="createReceiptNote();"> Submit </button>
                </div>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
        </div>
        <!-- Additional cards can be added here -->
      </div>
    </div>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- body ends here -->
    <!-- =========================================================== -->
    <script>
      const supplier_name = document.querySelector("#supplier_name");
      const p_number = document.querySelector("#po_number");
      const po_date = document.querySelector("#date");
      const po_time = document.querySelector("#time");
      const po_invoice = document.querySelector("#invoice");

      function createReceiptNote() {
        let table_body_items = [];
        let error_detected = false;
        table_body.childNodes.forEach(row => {

          let i = 0;
          let product_row = {};
          row.childNodes.forEach(cell => {
            switch (i) {
              case 0:
                product_row['p_code'] = cell.innerHTML;
                break;
              case 1:
                product_row['p_name'] = cell.innerHTML;
                break;
              case 2:
                product_row['p_units'] = cell.innerHTML;
                break;
              case 3:
                product_row['p_quantity'] = cell.innerHTML;
                break;
              case 4:
                const test_val = Number(cell.firstChild.value);
                if (test_val <= 0 || test_val > Number(product_row['p_quantity'])) {
                  cell.firstChild.focus();
                  error_detected = true;
                }
                product_row['p_quantity_received'] = cell.firstChild.value;
                break;
            }

            i++;
            i = i >= 5 ? 0 : i;

          });

          // if (product_row['p_sup'] === supplier.value) {
          table_body_items.push(product_row);
          // }
        });

        if (error_detected) {
          return;
        } else if (po_invoice.value.trim() === "") {
          po_invoice.focus();
          return
        }
        console.log(table_body_items);

        const formData = new FormData();
        formData.append("supplier_name", supplier_name.value);
        formData.append("po_number", p_number.value);
        formData.append("date", po_date.value);
        formData.append("branch", user_branch);
        formData.append("user", user_name);
        formData.append("time", po_time.value);
        formData.append("invoice", po_invoice.value);
        formData.append("table_items", JSON.stringify(table_body_items));

        fetch('../includes/add_items_supplier.php', {
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
              location.href = "manage_received_goods.php"
            }, 2500);

          })
          .catch(error => {
            console.error('Error:', error);
          });

      }

      function updateTable(result) {
        console.log('Result:', result);
        table_body.innerHTML = "";
        // return;
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

          let units_td = document.createElement("td");
          units_td.appendChild(document.createTextNode(data["unit"]));
          units_td.classList.add("align-middle");

          let qty_td = document.createElement("td");
          qty_td.appendChild(document.createTextNode(data["qty"]));
          qty_td.classList.add("align-middle");


          let quantity = document.createElement("input");
          quantity.setAttribute("type", "number");
          quantity.setAttribute("required", "");
          quantity.setAttribute("max", data["qty"]);
          quantity.setAttribute("id", "q-" + data["name"] + "-" + data["code"]);
          quantity.classList.add("form-control", "form-control-sm", "align-middle");
          // quantity.setAttribute("data-ref", da["name"]);
          quantity.setAttribute("min", 1);
          // make sure the quantity is always greater than 0
          quantity.setAttribute("onfocusout", "this.value = this.value <= 0 ? 1 : this.value;");
          // quantity.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value);");
          // quantity.setAttribute("onclick", "this.select();");
          // quantity.value = data["qty"];
          let quantityWrapper = document.createElement("td");
          quantityWrapper.classList.add("m-2", "form-control-sm", "col-lg-2");
          quantityWrapper.appendChild(quantity);

          tr.append(code_td, name_td, units_td, qty_td, quantityWrapper);
          table_body.appendChild(tr);

        });
      }

      document.addEventListener('DOMContentLoaded', function() {
        const date = new Date();
        let month = d_toString(date.getMonth() + 1);
        let day = d_toString(date.getDate());
        let hours = d_toString(date.getHours());
        let minutes = d_toString(date.getMinutes());


        time.value = hours + ":" + minutes;
      });
      document.addEventListener('DOMContentLoaded', function() {
        const po_vals = sessionStorage.getItem('val');
        let po_number = po_vals.split("^")[0];
        p_number.value = po_number;
        supplier_name.value = po_vals.split('^')[1];

        const formData = new FormData();
        formData.append("po_number", po_number);


        fetch('../includes/receive_goods_manage_items.php', {
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

      });
      // Clear datalist
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
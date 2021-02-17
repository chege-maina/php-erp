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

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="mb-2">Approve Receipt Note</h5>


        <div class="card">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>

          <div class="card-body fs--1 p-4 position-relative">



            <div class="row">
              <div class="col col-md-5">
                <div class="input-group">
                  <select class="form-select form-select-sm" name="product_category" id="receipt_note_no" required>
                    <option value disabled selected>
                      -- Select Receipt Note Number --
                    </option>
                  </select>
                  <button class="input-group-btn btn btn-primary btn-sm" id="selectReceipt" onclick="selectReceipt();">
                    Select
                  </button>
                </div>
              </div>
            </div>
            <hr>


            <div class="row flex">
              <div class="col">
                <label for="supplier_name" class="form-label">Receipt Note Number*</label>
                <input type="text" name="receipt_note_nbr" id="receipt_note_nbr" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">Supplier Name*</label>
                <input type="text" name="po_number" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">LPO Number*</label>
                <input type="text" name="po_number" id="lpo_number" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">Invoice/Delivery Note No.*</label>
                <input type="text" name="po_number" id="invoice_number" class="form-control" readonly>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col">
                <label for="time" class="form-label">Time</label>
                <!-- autofill current date  -->
                <input type="time" id="receipt_time" class="form-control" readonly>
              </div>

              <div class="col">
                <label for="date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" id="receipt_date" class="form-control" readonly>
              </div>
            </div>

            <!-- Content is to start here -->
            <!-- Content ends here -->
          </div>
        </div>
        <!-- Additional cards can be added here -->

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
                    <th scope="col">Quantity Received</th>
                    <th scope="col">Units</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>

          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit_btn" onclick="approveReceipt();" disabled>
                Approve
              </button>
            </div>
            <!-- Content ends here -->
          </div>

        </div>


        <script>
          const receipt_note_no = document.querySelector('#receipt_note_no');
          const table_body = document.querySelector('#table_body');
          const receipt_note_nbr = document.querySelector('#receipt_note_nbr');
          const supplier_name = document.querySelector('#supplier_name');
          const lpo_number = document.querySelector('#lpo_number');
          const invoice_number = document.querySelector('#invoice_number');
          const receipt_time = document.querySelector('#receipt_time');
          const receipt_date = document.querySelector('#receipt_date');
          const submit_btn = document.querySelector('#submit_btn');

          function approveReceipt() {
            console.log("yay");
            const formData = new FormData();
            formData.append("receipt_no", receipt_note_nbr.value);

            // <strong>Success!</strong> ${[>result['message']<]}
            const alertVar =
              `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Approved
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
            var divAlert = document.querySelector("#alert-div");
            divAlert.innerHTML = alertVar;
            divAlert.scrollIntoView();

            window.setTimeout(() => {
              location.href = "manage_tr.php"
            }, 2500);

            return;

            fetch('https://example.com/profile/avatar', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', result);
              })
              .catch(error => {
                console.error('Error:', error);
              });
          }

          function selectReceipt() {
            if (!receipt_note_no.value) {
              receipt_note_no.focus();
              return;
            }
            console.log("Selecting: ", receipt_note_no.value)

            loadReceiptNoteData(receipt_note_no.value);
          }

          document.addEventListener('DOMContentLoaded', function() {
            fetch('../includes/load_receiptnote.php')
              .then(response => response.json())
              .then(data => {
                console.log(data);
                data.forEach((value) => {
                  console.log("Here", value);
                  let opt = document.createElement("option");
                  opt.appendChild(document.createTextNode(value['receipt_no'].toLowerCase()));
                  opt.value = value['receipt_no'].toLowerCase();
                  receipt_note_no.appendChild(opt);
                });
              });
          });


          function loadReceiptNoteData(receipt_no) {
            const formData = new FormData();
            formData.append("receipt_no", receipt_no);
            fetch('../includes/approve_receiptnote_items.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', result.length);
                if (result.length > 0) {
                  submit_btn.removeAttribute("disabled");
                } else {
                  submit_btn.setAttribute("disabled", "");
                }
                result = result[0];

                // Update fields
                receipt_note_nbr.value = result['receipt_no'];
                supplier_name.value = result['supplier'];
                lpo_number.value = result['po_number'];
                invoice_number.value = result['invoice'];
                receipt_time.value = result['time'];
                receipt_date.value = result['date'];
                updateTable(result["products"]);
              })
              .catch(error => {
                console.error('Error:', error);
              });
          }


          function updateTable(result) {
            console.log('Populating:', result);
            table_body.innerHTML = "";

            let enableButtons = true;

            result.forEach((data) => {

              let tr = document.createElement("tr");
              // Id will be like 1Tank
              // tr.setAttribute("id", data["code"] + data["name"]);

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

              tr.append(code_td, name_td, qty_td, units_td);
              table_body.appendChild(tr);
            });

          }
        </script>

        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->



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

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

        <div id="main-body">
          <!-- =========================================================== -->
          <!-- body begins here -->
          <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
          <div id="alert-div"></div>
          <h3 class="mb-0 p-2">Manage Transfer</h3>
          <div class="card mb-1">

            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->

            <div class="card-body position-relative">

              <div class="row">
                <div class="col-lg-8 mb-3">
                  <h5>Transfer Number <span id="req_no" class="text-info h2 mr-3"></span></h5>
                </div>

                <div class="col-lg-4 mb-3">

                  <div class="col">
                    <!-- Make Combo -->

                    <label class="form-label" for="product_branch">Branch To Transfer From</label>
                    <div class="input-group">

                      <select class="form-select" name="product_branch" id="product_branch" required>
                        <option value disabled selected>
                          -- Branch --
                        </option>
                      </select>
                      <div class="invalid-tooltip">This field cannot be left blank.</div>

                      <!-- Button trigger modal -->
                      <div class=".col-6 col-lg-4">
                        <button type="button" class="btn btn-primary input-group-btn" onclick="checkAvailability();">
                          Select
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Content is to start here -->

                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label for="requisition_date" class="form-label">Date</label>
                  <input type="date" name="requisition_name" id="requisition_date" class="form-control" required readonly>
                </div>
                <div class="col">
                  <label for="created_by" class="form-label">Created By</label>
                  <input type="text" name="created_by" id="created_by" class="form-control" required readonly>
                </div>

                <div class="col col-md-4">
                  <label for="req_branch" class="form-label">Branch</label>
                  <input type="text" name="req_branch" id="req_branch" class="form-control" required readonly>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-auto">
                  <span class="fw-bold mr-2">Status: </span>
                  <span id="requisition_status"></span>
                </div>
              </div>

            </div>
          </div>


          <div class="card">

            <div class="card-header bg-light">
              <h6>Products</h6>
            </div>
            <div class="card-body fs--1 p-2">
              <!-- Content is to start here -->

              <div class="table-responsive">
                <table class="table table-sm table-striped fs--1 mb-0">
                  <thead>
                    <tr>
                      <th class="col-lg-1">Code</th>
                      <th class="w-25">Name</th>
                      <th>Balance</th>
                      <th class="col-lg-1">Quantity</th>
                      <th>Units</th>
                      <th class="col-lg-2">Availability</th>
                      <th class="col-lg-3">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="table_body"></tbody>
                </table>
              </div>
              <!-- Content ends here -->
            </div>
            <!-- Additional cards can be added here -->
          </div>

          <div class="card mt-1 mb-3 h-xxl-100">
            <div class="card-body">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <button class="btn btn-falcon-success btn-sm mr-2" id="approve_req" onclick="approveRequisition();" disabled>
                    <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
                    Approve
                  </button>
                  <button class="btn btn-falcon-danger btn-sm" id="reject_req" onclick="rejectRequisition();">
                    <span class="fas fa-times mr-1" data-fa-transform="shrink-3"></span>
                    Reject
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
          <!-- body ends here -->
          <!-- =========================================================== -->
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            updateComboBoxes();
          });

          const product_branch = document.querySelector("#product_branch");

          function updateComboBoxes() {
            // Clear it
            product_branch.innerHTML = "";
            // Add the no-selectable item first
            let opt = document.createElement("option");
            opt.appendChild(document.createTextNode("-- Select  --"));
            opt.setAttribute("value", "");
            opt.setAttribute("disabled", "");
            opt.setAttribute("selected", "");
            product_branch.appendChild(opt);
            // Populate categories combobox
            fetch('../includes/load_branch.php')
              .then(response => response.json())
              .then(data => {
                data.forEach((value) => {
                  let opt = document.createElement("option");
                  opt.appendChild(document.createTextNode(value['branch'].toUpperCase()));
                  opt.value = value['branch'].toUpperCase();
                  product_branch.appendChild(opt);
                });
              });

            // Clear it

          }

          let reqNo = -1;
          let reqStatus = "";
          const req_no = document.querySelector("#req_no");
          const requisition_date = document.querySelector("#requisition_date");
          const created_by = document.querySelector("#created_by");
          const branch = document.querySelector("#req_branch");
          const requisition_status = document.querySelector("#requisition_status");
          const table_body = document.querySelector("#table_body");
          let table_items_data = [];


          function checkAvailability() {
            if (!product_branch.value) {
              product_branch.focus();
              return;
            }
            console.log("Table items", table_items_data);
            const formData = new FormData();
            formData.append("trans_number", reqNo);
            formData.append("branch", product_branch.value);

            fetch('../includes/transfer_balance.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {

                result.forEach(row => {
                  let j = 0;
                  table_items_data.forEach((t_row) => {
                    if (row["product_name"] == t_row["name"]) {
                      console.log("Match found");
                      table_items_data[j]["availability"] =
                        row["message"] === "right" ?
                        "available" : "not available";
                    }
                    j++;
                  });
                })

                updateTable(table_items_data);
                console.log('Success:', result);
              })
              .catch(error => {
                console.error('Error:', error);
              });

          }

          window.addEventListener('DOMContentLoaded', (event) => {
            if (sessionStorage.length === 0) {
              location.href = "./manage_transfer.php";
            }

            // Get passed requisition number
            reqNo = sessionStorage.getItem('req_no');
            // Clear data
            sessionStorage.clear();

            // Load the requisition item for the number
            const formData = new FormData();
            formData.append("req_no", reqNo)
            fetch('../includes/transfer_manage.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                data = result[0];
                req_no.appendChild(document.createTextNode(data["req_no"]));
                requisition_date.value = data["date"];
                branch.value = data["branch"];
                created_by.value = data["user"];
                reqStatus = data['status'];
                switch (data["status"]) {
                  case "pending":
                    requisition_status.innerHTML = `<span class="badge badge-soft-secondary">Pending</span>`;
                    break;
                  case "approved":
                    requisition_status.innerHTML = `<span class="badge badge-soft-success">Approved</span>`;
                    break;
                  case "rejected":
                    requisition_status.innerHTML = `<span class="badge badge-soft-warning">Rejected</span>`;
                    break;
                  case "authorized":
                    requisition_status.innerHTML = `<span class="badge badge-soft-warning">Authorized</span>`;
                    break;
                  case "released":
                    requisition_status.innerHTML = `<span class="badge badge-soft-warning">Released</span>`;
                    break;
                  case "received":
                    requisition_status.innerHTML = `<span class="badge badge-soft-warning">Received</span>`;
                    break;
                }

                // Nested fetch start
                fetchTableItems();
                // Nested fetch end


              })
              .catch(error => {
                console.error('Error:', error);
              });

          });

          function disableAllButtons() {
            const buttons = document.querySelectorAll("div#main-body button");
            console.log("Buttons", buttons);
            buttons.forEach(button => {
              button.disabled = true;
            })
          }

          function fetchTableItems() {
            const formData = new FormData();
            formData.append("req_no", reqNo)
            fetch('../includes/transfer_manage_items.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {

                [...table_items_data] = result;
                updateTable(result);

                // Disable buttons if necessary
                if (reqStatus !== "pending") {
                  disableAllButtons();
                }
              })
              .catch(error => {
                console.error('Error:', error);
              });

          }


          const approve_req = document.querySelector("#approve_req");

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

          function rejectRequisition() {
            if (!confirm("Are you sure you want to reject?")) {
              return;
            }
            console.log("Rejecting");

            disableAllButtons();

            const formData = new FormData();
            formData.append("checker", "req_rejected");
            formData.append("name", "");
            formData.append("branch", "-1");
            // formData.append("qty", -1);
            formData.append("req_no", reqNo);

            fetch('../includes/update_transfer.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                const alertVar =
                  `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> ${result['message']}
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                var divAlert = document.querySelector("#alert-div");
                divAlert.innerHTML = alertVar;
                divAlert.scrollIntoView();

                window.setTimeout(() => {
                  location.href = "manage_tr.php"
                }, 2500);

              })
              .catch(error => {
                console.error('Error:', error);
              });


            formData.append("product_branch", product_branch.value);
            formData.append("req_no", reqNo);

            fetch('../includes/transfer_balance.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                const alertVar =
                  `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> ${result['message']}
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                var divAlert = document.querySelector("#alert-div");
                divAlert.innerHTML = alertVar;
                divAlert.scrollIntoView();

                window.setTimeout(() => {
                  location.href = "manage_tr.php"
                }, 2500);

              })
              .catch(error => {
                console.error('Error:', error);
              });
          }


          function approveRequisition() {
            if (!confirm("Are you sure you want to approve?")) {
              return;
            }
            console.log("Rejecting");

            disableAllButtons();

            const formData = new FormData();
            formData.append("checker", "approve_req");
            formData.append("name", "");
            formData.append("branch", product_branch.value);
            // formData.append("qty", -1);
            formData.append("req_no", reqNo);

            fetch('../includes/update_transfer.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                // console.log(result);
                const alertVar =
                  `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> ${result['message']}
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                var divAlert = document.querySelector("#alert-div");
                divAlert.innerHTML = alertVar;
                divAlert.scrollIntoView();

                window.setTimeout(() => {
                  location.href = "manage_tr.php"
                }, 2500);

              })
              .catch(error => {
                console.error('Error:', error);
              });


            // const product_branch = document.querySelector("#product_branch");
            // formData.append("product_branch", product_branch.value);
            // formData.append("req_no", reqNo);

            // fetch('../includes/transfer_balance.php', {
            // method: 'POST',
            // body: formData
            // })
            // .then(response => response.json())
            // .then(result => {
            // const alertVar =
            // `<div class="alert alert-success alert-dismissible fade show" role="alert">
            // <strong>Success!</strong> ${result['message']}
            // <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
            // </div>`;
            // var divAlert = document.querySelector("#alert-div");
            // divAlert.innerHTML = alertVar;
            // divAlert.scrollIntoView();

            // window.setTimeout(() => {
            // location.href = "manage_tr.php"
            // }, 2500);

            // })
            // .catch(error => {
            // console.error('Error:', error);
            // });


          }

          function actionRespond(value) {
            value = value.split("-");

            const btn_reject = document.querySelector("#r-" + value[1] + "-" + value[2]);
            value[1] = value[1].replace("_s_s_s_", " ");
            if (value[0] == "r") {
              // Reject item
              if (!confirm("Are you sure you want to reject?")) {
                return;
              }

              console.log("Rejecting");
              const formData = new FormData();
              formData.append("checker", "item_rejected");
              formData.append("name", value[1].trim());
              formData.append("branch", "-1");
              // formData.append("qty", qtt.value);
              console.log(value[1].trim(), " vs ", reqNo);
              formData.append("req_no", reqNo);

              fetch('../includes/update_transfer.php', {
                  method: 'POST',
                  body: formData
                })
                .then(response => response.json())
                .then(result => {
                  const alertVar =
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> ${result['message']}
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                  var divAlert = document.querySelector("#alert-div");
                  divAlert.innerHTML = alertVar;
                  divAlert.scrollIntoView();
                  // On submit reload table
                  fetchTableItems();

                  window.setTimeout(() => {
                    divAlert.innerHTML = "";
                  }, 2500);
                })
                .catch(error => {
                  console.error('Error:', error);
                });

            }
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

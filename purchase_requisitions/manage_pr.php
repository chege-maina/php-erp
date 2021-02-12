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
          <h3 class="mb-0 p-2">Manage Requisition</h3>
          <div class="card mb-1">

            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->

            <div class="card-body position-relative">


              <div class="col-lg-8 mb-3">
                <h5>Requisition Number <span id="req_no" class="text-info h2 mr-3"></span></h5>
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
                  <button class="btn btn-falcon-success btn-sm mr-2" id="approve_req" onclick="approveRequisition();">
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
          let reqNo = -1;
          let reqStatus = "";
          const req_no = document.querySelector("#req_no");
          const requisition_date = document.querySelector("#requisition_date");
          const created_by = document.querySelector("#created_by");
          const branch = document.querySelector("#req_branch");
          const requisition_status = document.querySelector("#requisition_status");
          const table_body = document.querySelector("#table_body");

          window.addEventListener('DOMContentLoaded', (event) => {
            if (sessionStorage.length === 0) {
              location.href = "./manage_requisitions_ui.php";
            }

            // Get passed requisition number
            reqNo = sessionStorage.getItem('req_no');
            // Clear data
            sessionStorage.clear();

            // Load the requisition item for the number
            const formData = new FormData();
            formData.append("req_no", reqNo)
            fetch('../includes/requisition_manage.php', {
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
            fetch('../includes/requisition_manage_items.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
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


          function updateTable(result) {
            console.log('Result:', result);
            table_body.innerHTML = "";

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


              let quantity = document.createElement("input");
              quantity.setAttribute("type", "number");
              quantity.setAttribute("required", "");
              quantity.setAttribute("readonly", "");
              quantity.setAttribute("id", "q-" + data["name"] + "-" + data["code"]);
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

              // data-toggle="tooltip" data-placement="top" title="Tooltip on top"
              let edit = document.createElement("button");
              edit.setAttribute("id", "e-" + data["name"] + "-" + data["code"]);
              edit.setAttribute("onclick", "actionRespond(this.id);");
              edit.setAttribute("data-toggle", "tooltip");
              edit.setAttribute("title", "Edit");
              let icon = document.createElement("span");
              icon.classList.add("fas", "fa-pencil-alt", "mt-1", "fa-sm");
              edit.appendChild(icon);
              edit.classList.add("btn", "btn-falcon-primary", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");

              let save = document.createElement("button");
              save.setAttribute("id", "s-" + data["name"] + "-" + data["code"]);
              save.setAttribute("onclick", "actionRespond(this.id);");
              save.setAttribute("data-toggle", "tooltip");
              save.setAttribute("title", "Save");
              save.disabled = true;
              let icon_s = document.createElement("span");
              icon_s.classList.add("fas", "fa-save", "mt-1", "fa-sm");
              save.appendChild(icon_s);
              save.classList.add("btn", "btn-falcon-primary", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");

              let cancel = document.createElement("button");
              cancel.setAttribute("id", "c-" + data["name"] + "-" + data["code"]);
              cancel.setAttribute("onclick", "actionRespond(this.id);");
              cancel.setAttribute("data-toggle", "tooltip");
              cancel.setAttribute("title", "Cancel");
              cancel.disabled = true;
              let icon_c = document.createElement("span");
              icon_c.classList.add("fas", "fa-ban", "mt-1", "fa-sm");
              cancel.appendChild(icon_c);
              cancel.classList.add("btn", "btn-falcon-primary", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");


              let reject = document.createElement("button");
              reject.setAttribute("id", "r-" + data["name"] + "-" + data["code"]);
              reject.setAttribute("onclick", "actionRespond(this.id);");
              reject.setAttribute("data-toggle", "tooltip");
              reject.setAttribute("title", "Reject");
              let icon_r = document.createElement("span");
              icon_r.classList.add("fas", "fa-times", "mt-1", "fa-sm");
              reject.appendChild(icon_r);
              reject.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");
              reject.disabled = result.length <= 1;


              actionDiv.append(edit, save, cancel, reject);
              actionWrapper.appendChild(actionDiv);

              tr.append(code_td, name_td, balance_td, quantityWrapper, units_td, actionWrapper);
              table_body.appendChild(tr);

            });
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
            formData.append("qty", -1);
            formData.append("req_no", reqNo);

            fetch('../includes/update_requisition.php', {
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
                  location.href = "manage_pr.php"
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
            formData.append("qty", -1);
            formData.append("req_no", reqNo);

            fetch('../includes/update_requisition.php', {
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
                  location.href = "manage_pr.php"
                }, 2500);

              })
              .catch(error => {
                console.error('Error:', error);
              });


          }

          function actionRespond(value) {
            value = value.split("-");
            console.log(value);
            // Get the quantity input in the same row
            const qtt = document.querySelector("#q-" + value[1] + "-" + value[2]);
            const btn_save = document.querySelector("#s-" + value[1] + "-" + value[2]);
            const btn_edit = document.querySelector("#e-" + value[1] + "-" + value[2]);
            const btn_cancel = document.querySelector("#c-" + value[1] + "-" + value[2]);
            const btn_reject = document.querySelector("#r-" + value[1] + "-" + value[2]);

            if (value[0] == "e") {
              // Edit item
              qtt.removeAttribute("readonly");
              btn_save.disabled = false;
              btn_cancel.disabled = false;
              btn_edit.disabled = true;
            } else if (value[0] == "c") {
              // Cancel edit

              // reload table
              fetchTableItems();
              qtt.setAttribute("readonly", "");

              btn_save.disabled = true;
              btn_cancel.disabled = true;
              btn_edit.disabled = false;
            } else if (value[0] == "r") {
              // Reject item
              if (!confirm("Are you sure you want to reject?")) {
                return;
              }

              console.log("Rejecting");
              const formData = new FormData();
              formData.append("checker", "item_rejected");
              formData.append("name", value[1]);
              formData.append("qty", qtt.value);
              formData.append("req_no", reqNo);

              fetch('../includes/update_requisition.php', {
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

            } else if (value[0] == "s") {


              console.log("Saving");
              const formData = new FormData();
              formData.append("checker", "item_qty");
              // TODO: Take these and in corresponding if cases to above the if to avoid copypasting
              formData.append("name", value[1]);
              formData.append("qty", qtt.value);
              formData.append("req_no", reqNo);

              fetch('../includes/update_requisition.php', {
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



              // If page is reloading, this is no longer needed. Delete

              // Save item
              qtt.setAttribute("readonly", "");

              btn_save.disabled = true;
              btn_cancel.disabled = true;
              btn_edit.disabled = false;
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
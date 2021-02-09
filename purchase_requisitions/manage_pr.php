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
        <h3 class="mb-0 p-2">Manage Requisition</h3>
        <div class="card mb-1">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body position-relative">


            <div class="col-lg-8 mb-3">
              <h5>Requisition Number <span id="req_no" class="text-info"></span></h5>
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
              <table class="table table-sm fs--1 mb-0">
                <thead>
                  <tr>
                    <th>Product Code</th>
                    <th class="w-25">Product Name</th>
                    <th class="col-lg-1">Balance</th>
                    <th>Quantity</th>
                    <th>Units</th>
                    <th class="col-lg-2">Actions</th>
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
                <button class="btn btn-falcon-success btn-sm mr-2" id="approve_req">
                  <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
                  Approve
                </button>
                <button class="btn btn-falcon-danger btn-sm" id="reject_req">
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

        <script>
          const req_no = document.querySelector("#req_no");
          const requisition_date = document.querySelector("#requisition_date");
          const created_by = document.querySelector("#created_by");
          const branch = document.querySelector("#req_branch");
          const requisition_status = document.querySelector("#requisition_status");
          const table_body = document.querySelector("#table_body");

          window.addEventListener('DOMContentLoaded', (event) => {
            const formData = new FormData();
            formData.append("req_no", 1)
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
                fetch('../includes/requisition_manage_items.php', {
                    method: 'POST',
                    body: formData
                  })
                  .then(response => response.json())
                  .then(result => {
                    updateTable(result);
                  })
                  .catch(error => {
                    console.error('Error:', error);
                  });
                // Nested fetch end

              })
              .catch(error => {
                console.error('Error:', error);
              });

          });


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
              edit.setAttribute("id", "e " + data["name"] + " " + data["code"]);
              edit.setAttribute("onclick", "actionRespond(this.id);");
              edit.setAttribute("data-toggle", "tooltip");
              edit.setAttribute("title", "Edit");
              let icon = document.createElement("span");
              icon.classList.add("fas", "fa-pencil-alt", "mt-1", "fa-sm");
              edit.appendChild(icon);
              edit.classList.add("btn", "btn-falcon-primary", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");

              let save = document.createElement("button");
              save.setAttribute("id", "s " + data["name"] + " " + data["code"]);
              save.setAttribute("onclick", "actionRespond(this.id);");
              save.setAttribute("data-toggle", "tooltip");
              save.setAttribute("title", "Save");
              let icon_s = document.createElement("span");
              icon_s.classList.add("fas", "fa-save", "mt-1", "fa-sm");
              save.appendChild(icon_s);
              save.classList.add("btn", "btn-falcon-primary", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");

              let cancel = document.createElement("button");
              cancel.setAttribute("id", "c " + data["name"] + " " + data["code"]);
              cancel.setAttribute("onclick", "actionRespond(this.id);");
              cancel.setAttribute("data-toggle", "tooltip");
              cancel.setAttribute("title", "Cancel");
              let icon_c = document.createElement("span");
              icon_c.classList.add("fas", "fa-ban", "mt-1", "fa-sm");
              cancel.appendChild(icon_c);
              cancel.classList.add("btn", "btn-falcon-primary", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");


              let reject = document.createElement("button");
              reject.setAttribute("id", "r " + data["name"] + " " + data["code"]);
              reject.setAttribute("onclick", "actionRespond(this.id);");
              reject.setAttribute("data-toggle", "tooltip");
              reject.setAttribute("title", "Reject");
              let icon_r = document.createElement("span");
              icon_r.classList.add("fas", "fa-times", "mt-1", "fa-sm");
              reject.appendChild(icon_r);
              reject.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill", "mr-2", "col", "col-auto");


              actionDiv.append(edit, save, cancel, reject);
              actionWrapper.appendChild(actionDiv);

              tr.append(code_td, name_td, balance_td, quantityWrapper, units_td, actionWrapper);
              table_body.appendChild(tr);

            });
          }

          function actionRespond(value) {
            console.log(value.split(" "));
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

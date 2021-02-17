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
          <h3 class="mb-0 p-2">Accept Transfer Item</h3>
          <div class="card mb-1">

            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->

            <div class="card-body position-relative">

              <div class="row">
                <div class="col-lg-8 mb-3">
                  <h5>Transfer Number <span id="req_no" class="text-info h2 mr-3"></span></h5>
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

                <div class="col">
                  <label for="req_branch" class="form-label">Branch Transfering</label>
                  <input type="text" name="req_branch" id="req_branch" class="form-control" required readonly>
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
                      <th>Code</th>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Units</th>
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
                  <button class="btn btn-falcon-success btn-sm mr-2" id="checker" onclick="releaseTransfer();">
                    <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
                    Accept
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
          <!-- body ends here -->
          <!-- =========================================================== -->
        </div>

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



<script>
  let reqNo = -1;
  let reqStatus = "";
  const req_no = document.querySelector("#req_no");
  const requisition_date = document.querySelector("#requisition_date");
  const created_by = document.querySelector("#created_by");
  const branch = document.querySelector("#req_branch");
  //const branch_from = document.querySelector("#branch_from");
  const requisition_status = document.querySelector("#requisition_status");
  const checker = document.querySelector("#checker");
  const table_body = document.querySelector("#table_body");

  window.addEventListener('DOMContentLoaded', (event) => {
    if (sessionStorage.length === 0) {
      location.href = "receive_transfer_item.php";
    }

    // Get passed requisition number
    reqNo = sessionStorage.getItem('req_no');
    // Clear data
    // sessionStorage.clear();

    // Load the requisition item for the number
    const formData = new FormData();
    formData.append("req_no", reqNo)
    req_no.appendChild(document.createTextNode(reqNo));
    fetch('../includes/load_accept_items.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        if (result.length <= 0) {
          console.log("Empty data");
          return;
        }
        data = result[0];
        req_no.appendChild(document.createTextNode(data["req_no"]));
        reqNo = data["req_no"];
        requisition_date.value = data["date"];
        branch.value = data["branch"];
        // branch_from.value = data["branch_from"];
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
    formData.append("po_number", reqNo)

    fetch('../includes/receieve_approval.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        console.log("Haha, The wawa", data);
        updateTable(data);

        // Disable buttons if necessary
        if (reqStatus !== "pending") {
          //  disableAllButtons();
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });

  }

  let updateTable = (data) => {
    table_body.innerHTML = "";
    data.forEach(value => {
      const this_row = document.createElement("tr");

      const code = document.createElement("td");
      code.appendChild(document.createTextNode(value["code"]));
      code.classList.add("align-middle");

      const name = document.createElement("td");
      name.appendChild(document.createTextNode(value["name"]));
      name.classList.add("align-middle");

      const unit = document.createElement("td");
      unit.appendChild(document.createTextNode(value["unit"]));
      unit.classList.add("align-middle");

      const qty = document.createElement("td");
      qty.appendChild(document.createTextNode(value["qty"]));
      qty.classList.add("align-middle");

      const req_status = document.createElement("td");
      const tmp_status = value["status"];
      const badge = document.createElement("span");
      badge.appendChild(document.createTextNode(tmp_status));
      badge.classList.add("badge", "rounded-pill");
      // <span class="badge rounded-pill badge-soft-primary">Primary</span>
      if (tmp_status == "pending") {
        badge.classList.add("badge-soft-secondary");
      } else if (tmp_status == "approved") {
        badge.classList.add("badge-soft-success");
      } else if (tmp_status == "rejected") {
        badge.classList.add("badge-soft-danger");
      }


      this_row.append(code, name, unit, qty);
      table_body.appendChild(this_row);
    });

  }

  function releaseTransfer() {
    if (!confirm("Are you sure you want to approve?")) {
      return;
    }
    console.log("Rejecting");

    disableAllButtons();

    const formData = new FormData();
    formData.append("transfer_no", reqNo);
    formData.append("checker", "..");

    fetch('../includes/#.php', {
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
          location.href = "#.php"
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

      fetch('../includes/#.php', {
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

      fetch('../includes/#.php', {
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

</html>

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

        <?php
        include '../base_page/data_list_select.php';
        ?>

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2">NHIF Rates</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row">

              <div class="col col-md-4">
                <label for="#" class="form-label">Insert Year</label>
                <select name="adv_year" id="adv_year" class="form-select" onchange="updateTableData();" required>
                  <option value disabled selected>Select Year</option>
                </select>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>

            <hr>
            <div class="col col-auto mt-2">
              <small><strong>Status:</strong></small>
              <span id="supplier_status"></span>
            </div>
            <hr>

            <div class="row">
              <div class="col">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Rate</th>
                    </tr>
                  </thead>
                  <tbody id="c_table_body">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-3 px-4">
            <button type="button" class="btn btn-falcon-success btn-sm mr-2" id="approve_button" onclick="submitForm('approve')">
              <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
              Approve
            </button>
            <button type="button" class="btn btn-falcon-danger btn-sm" id="reject_button" onclick="submitForm('reject')">
              <span class="fas fa-times mr-1" data-fa-transform="shrink-3"></span>
              Reject
            </button>
          </div>
        </div>

      </div>
      <?php
      include '../includes/base_page/footer.php';
      ?>
    </div>
  </main>
</body>

</html>
<script>
  const c_table_body = document.querySelector("#c_table_body");
  let table_items = [];
  const adv_year = document.querySelector("#adv_year");
  const supplier_status = document.querySelector("#supplier_status");


  let updateTable = (data) => {

    c_table_body.innerHTML = "";
    console.log("Ladadida", "Commodore ", data);
    data.forEach(value => {

      let tr = document.createElement("tr");

      //  From
      const from = document.createElement("td");
      from.appendChild(document.createTextNode(value["from"]));
      from.classList.add("align-middle");

      // To
      const to = document.createElement("td");
      to.appendChild(document.createTextNode(value["to"]));
      to.classList.add("align-middle");


      // Rate
      const rate = document.createElement("td");
      rate.appendChild(document.createTextNode(value["rate"]));
      rate.classList.add("align-middle");

      tr.append(
        from,
        to,
        rate,
      );
      c_table_body.appendChild(tr);
    });
    return;
  }

  function updateTableData(data) {
    const formData = new FormData();
    formData.append("year", adv_year.value);

    fetch('load_nhif_items_approval.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log(result);
        if ('message' in result) {
          // If we are getting a message means there is an error
          return;
        }
        console.log('Success:', result);


        [...table_items] = result[0].tablesitems;
        updateTable(table_items);


      })
      .catch(error => {
        console.error('Error:', error);
      });

  }


  window.addEventListener('DOMContentLoaded', (event) => {
    populateSelectElement("#adv_year", '../payroll/load_nhif_year.php', "year");


  });

  let s_id;

  function submitForm(action) {
    const formData = new FormData();
    formData.append("s_id", s_id);
    formData.append("action", action);
    fetch('./approve_reject_nhif.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log('Server says:', result);

        if (result["message"] == "success") {
          const alertVar =
            `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Saved changes.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
          var divAlert = document.querySelector("#alert-div");
          divAlert.innerHTML = alertVar;
          divAlert.scrollIntoView();
          setTimeout(function() {
            location.href = "./nhif_listing_ui.php";
          }, 2500);
        } else {
          const alertVar =
            `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Could not save changes.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
          var divAlert = document.querySelector("#alert-div");
          divAlert.innerHTML = alertVar;
          divAlert.scrollIntoView();
        }

        return false;
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }


  window.addEventListener('DOMContentLoaded', (event) => {

    s_id = sessionStorage.getItem("Description");

    const formData = new FormData();
    formData.append("s_id", s_id);

    fetch('load_nhif_items_approval.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log(result);
        if ('message' in result) {
          // If we are getting a message means there is an error
          return;
        }
        console.log('Success:', result);
        result = result[0];
        // About to show status

        switch (result.status) {
          case "pending":
            supplier_status.innerHTML = `<span class="badge badge-soft-secondary">Pending</span>`;
            break;
          case "active":
            supplier_status.innerHTML = `<span class="badge badge-soft-success">Active</span>`;
            approve_button.disabled = true;
            reject_button.disabled = true;
            break;
          case "rejected":
            supplier_status.innerHTML = `<span class="badge badge-soft-warning">Rejected</span>`;
            reject_button.disabled = true;
            break;
        }


      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
</script>
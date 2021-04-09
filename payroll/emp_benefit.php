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
        <h5 class="p-2">Advance Salary</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row justify-content-between">
              <div class="col-sm-5 my-3">
                <!-- Make Combo -->
                <label class="form-label" for="branch">Select Benefit/Deduction*</label>
                <div class="input-group">
                  <select class="form-select" name="branch" id="benefit_select">
                    <option value disabled selected>
                      -- Select Benefit/Deduction --
                    </option>
                  </select>
                  <div class="invalid-tooltip">This field cannot be left blank.</div>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary input-group-btn" onclick="addItem()">
                    +
                  </button>

                </div>
              </div>
              <div class="col col-md-5 my-3">
                <label for="#" class="form-label">Insert Month and Year</label>
                <div class="input-group">
                  <select class="form-select" id="month" required>
                    <option disabled selected value>--Select Month--</option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                  </select>
                  <input style="width:25px;" type="number" name="adv_year" id="adv_year" class="form-control" required>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Benefits</h6>
          </div>
          <div class="card-body fs--1 p-2">

            <div class=" table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Employee Number</th>
                    <th scope="col">First Name </th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Fixed Amount</th>
                    <th scope="col">Qty(Days/Hours)</th>
                    <th scope="col">Rate(Ksh/Day or Hour)</th>
                    <th scope="col">Earnings(Total Kshs)</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <script>
          const benefit_select = document.querySelector("#benefit_select");

          let items_in_table_a = {};
          let branch_dict = {};
          const table_body = document.querySelector("#table_body");

          fetch('../payroll/load_dem_benefits.php')
            .then(response => response.json())
            .then(data => {
              console.log(data);
              data.forEach((value) => {
                let opt = document.createElement("option");
                opt.appendChild(document.createTextNode(value['benefit'] + " (" + value['type'] + ")"));
                opt.value = value['benefit'] + " (" + value['type'] + ")";
                benefit_select.appendChild(opt);

                // Update dicts
                branch_dict[value.benefit + " (" + value['type'] + ")"] = value.benefit + value.type;
                items_in_table_a = {};
                console.log("hohoho", benefit_select);
                updateBranchSelect();
                // updateTable();

                // removeSpinner();
              });
            });

          function updateBranchSelect() {
            // Clear it
            benefit_select.innerHTML = "";
            // Add the no-selectable item first
            opt = document.createElement("option");
            opt.appendChild(document.createTextNode("-- Select Benefits/ Deductions --"));
            opt.setAttribute("value", "");
            opt.setAttribute("disabled", "");
            opt.setAttribute("selected", "");
            benefit_select.appendChild(opt);
            // Populate combobox
            for (key in branch_dict) {
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode(key));
              opt.value = key;
              benefit_select.appendChild(opt);
            }
          }
        </script>
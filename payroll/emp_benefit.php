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
        <h5 class="p-2">Earnings and Deductions</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row justify-content-between">
              <div class="col-sm-5 my-3">
                <!-- Make Combo -->
                <label class="form-label" for="benefit_select">Select Benefit/Deduction*</label>
                <div class="input-group">
                  <select class="form-select" name="benefit_select" id="benefit_select">
                    <option value disabled selected>
                      -- Select Benefit/Deduction --
                    </option>
                  </select>
                  <div class="invalid-tooltip">This field cannot be left blank.</div>

                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary input-group-btn" onclick="SearchItem();">
                    Search
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
                    <th scope="col"> Name </th>
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

        <?php
        include '../includes/base_page/footer.php';
        ?>

        <!--first script -->
        <script>
          const benefit_select = document.querySelector("#benefit_select");

          let items_in_table = {};
          let employee_benefits = {};
          let select_data = {};
          const table_body = document.querySelector("#table_body");

          function SearchItem() {

            if (!benefit_select.value) {
              return;
            }
            const benefit_var = employee_benefits[benefit_select.value].benefit;
            const type_var = employee_benefits[benefit_select.value].type;
            console.log(`Rasta is the truth: ${benefit_var} : ${type_var}`);

            const select = {

              qty: 0,
              rate: 0,
              f_amt: 0,
            }
            console.log(select);

            getEmployee(type_var, benefit_var);
            // updateEmployeeSelect();


          }

          fetch('../payroll/load_dem_benefits.php')
            .then(response => response.json())
            .then(data => {
              console.log(data);
              data.forEach((value) => {
                let opt = document.createElement("option");
                opt.appendChild(document.createTextNode(value['benefit'] + " (" + value['type'] + ")"));

                benefit_select.appendChild(opt);

                // Update dicts
                select_data[value['benefit'] + " (" + value['type'] + ")"] = value['benefit']
                employee_benefits[value['benefit'] + " (" + value['type'] + ")"] = {
                  type: value.type,
                  benefit: value.benefit
                };
                items_in_table = {};

                updateBranchSelect();
                // updateTable();

                // removeSpinner();
              });
              // console.log("hohoho", benefit_select);
              console.log("fill me", employee_benefits);
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
            for (key in select_data) {
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode(key));
              opt.value = key;
              benefit_select.appendChild(opt);
            }
          }
        </script>

        <!--second script -->

        <script>
          // the table items now 

          const month = document.querySelector("#month");
          const adv_year = document.querySelector("#adv_year");

          function getEmployee(type, benefit) {

            const formData = new FormData();
            formData.append("benefit", benefit);
            formData.append("type", type);
            fetch('../payroll/load_emp_dedct.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                items_in_table = {};
                result.forEach(row => {
                  items_in_table[row.emp_no] = {
                    emp_no: row.emp_no,
                    emp_name: row.emp_name,
                  };
                });
                updateTable();
              })
              .catch(error => {
                console.error('Error:', error);
              });
          }



          function updateEmployeeSelect() {
            // Clear it
            benefit_select.value = "";

            // Populate combobox
            for (key in employee_benefits) {
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode(select_data[key]));
              opt.value = key;
              benefit_select.appendChild(opt);
            }
          }

          function updateTable() {
            console.log("Rasta ", items_in_table);
            table_body.innerHTML = "";
            for (let item in items_in_table) {
              console.log("Jah");

              let tr = document.createElement("tr");
              // Id will be like 1Tank
              // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

              let employee_no = document.createElement("td");
              employee_no.appendChild(document.createTextNode(items_in_table[item].emp_no));
              employee_no.classList.add("align-middle");


              let firstname = document.createElement("td");
              firstname.appendChild(document.createTextNode(items_in_table[item].emp_name));
              firstname.classList.add("align-middle");

              // defined fixed amount 

              let f_amt = document.createElement("input");
              f_amt.setAttribute("type", "number");
              f_amt.setAttribute("required", "");
              f_amt.classList.add("form-control", "form-control-sm", "align-middle");
              // f_amt.setAttribute("data-ref", items_in_table[item]["name"]);
              f_amt.setAttribute("min", 0);
              // f_amt.setAttribute("max", items_in_table[item]['max']);

              // make sure the f_amt is always greater than 0
              // f_amt.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              // f_amt.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
              f_amt.setAttribute("onclick", "this.select();");
              items_in_table[item]['amount'] = ('amount' in items_in_table[item] && items_in_table[item]['f_amt'] >= 0) ?
                items_in_table[item]['amount'] : 0;
              f_amt.value = items_in_table[item]['amount'];

              f_amt.addEventListener("input", (event) => {
                items_in_table[item].f_amt = Number(event.target.value);
              })
              let f_amtWrapper = document.createElement("td");
              f_amtWrapper.classList.add("m-2", "col-2");
              f_amtWrapper.appendChild(f_amt);


              // Define Quantity 

              let qty = document.createElement("input");
              qty.setAttribute("type", "number");
              qty.setAttribute("required", "");
              qty.classList.add("form-control", "form-control-sm", "align-middle");
              // qty.setAttribute("data-ref", items_in_table[item]["name"]);
              qty.setAttribute("min", 0);
              // qty.setAttribute("max", items_in_table[item]['max']);

              // make sure the qty is always greater than 0
              // qty.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              // qty.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
              qty.setAttribute("onclick", "this.select();");
              items_in_table[item]['amount'] = ('amount' in items_in_table[item] && items_in_table[item]['qty'] >= 0) ?
                items_in_table[item]['amount'] : 0;
              qty.value = items_in_table[item]['amount'];

              qty.addEventListener("input", (event) => {
                items_in_table[item].qty = Number(event.target.value);
              })
              let qtyWrapper = document.createElement("td");
              qtyWrapper.classList.add("m-2", "col-2");
              qtyWrapper.appendChild(qty);

              // Define Rate 



              // CONTINUE FROM HERE RUTH

              let rate = document.createElement("input");
              rate.setAttribute("type", "number");
              rate.setAttribute("required", "");
              rate.classList.add("form-control", "form-control-sm", "align-middle");
              // rate.setAttribute("data-ref", items_in_table[item]["name"]);
              rate.setAttribute("min", 0);
              // rate.setAttribute("max", items_in_table[item]['max']);

              // make sure the rate is always greater than 0
              // rate.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              // rate.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
              rate.setAttribute("onclick", "this.select();");
              items_in_table[item]['amount'] = ('amount' in items_in_table[item] && items_in_table[item]['rate'] >= 0) ?
                items_in_table[item]['amount'] : 0;
              rate.value = items_in_table[item]['amount'];

              rate.addEventListener("input", (event) => {
                items_in_table[item].rate = Number(event.target.value);
              })
              let rateWrapper = document.createElement("td");
              rateWrapper.classList.add("m-2", "col-2");
              rateWrapper.appendChild(rate);

              // earnings 

              let earnings = document.createElement("input");
              earnings.setAttribute("type", "number");
              earnings.setAttribute("required", "");
              earnings.classList.add("form-control", "form-control-sm", "align-middle");
              // earnings.setAttribute("data-ref", items_in_table[item]["name"]);
              earnings.setAttribute("min", 0);
              // earnings.setAttribute("max", items_in_table[item]['max']);

              // make sure the earnings is always greater than 0
              // earnings.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              // earnings.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
              earnings.setAttribute("onclick", "this.select();");
              items_in_table[item]['amount'] = ('amount' in items_in_table[item] && items_in_table[item]['earnings'] >= 0) ?
                items_in_table[item]['amount'] : 0;
              earnings.value = items_in_table[item]['amount'];

              earnings.addEventListener("input", (event) => {
                items_in_table[item].earnings = Number(event.target.value);
              })
              let earningsWrapper = document.createElement("td");
              earningsWrapper.classList.add("m-2", "col-2");
              earningsWrapper.appendChild(earnings);
              // end of editable values 


              let actionWrapper = document.createElement("td");
              actionWrapper.classList.add("m-2");
              let action = document.createElement("button");
              action.setAttribute("id", item);
              action.setAttribute("onclick", "removeItem(this.id);");

              action.appendChild(document.createTextNode("-"));
              action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
              actionWrapper.appendChild(action);;

              tr.append(employee_no,
                firstname,
                f_amtWrapper,
                qtyWrapper,
                rateWrapper,
                earningsWrapper,
                actionWrapper
              );
              table_body.appendChild(tr);

            }
            return;
          }


          function removeItem(item) {
            delete items_in_table[String(item)];

            //  const employee_subtext =
            //    "National ID No# " + all_employees[item]["nat"] + "  Employee No# " + all_employees[item]["job"];
            //  employee_dict[item] = employee_subtext;

            updateTable();
            updateEmployeeSelect();
          }

          function validateQuantity(elmt, value, max) {
            value = Number(value);
            max = Number(max);
            elmt.value = elmt.value <= 0 ? 1 : elmt.value;
            elmt.value = elmt.value > max ? max : elmt.value;
          }
        </script>
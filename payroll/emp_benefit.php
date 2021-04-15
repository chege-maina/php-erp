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
                <select class="form-select" name="benefit_select" id="benefit_select" onchange="SearchItem();">
                  <option value disabled selected>
                    -- Select Benefit/Deduction --
                  </option>
                </select>
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
                  <input style="width:15px;" type="number" name="adv_year" id="adv_year" class="form-control" min="1900" max="2999" required>
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
                    <th scope="col">Total(Kshs)</th>
                    <th scope="col">Action</th>
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
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                Submit
              </button>
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
            table_body.innerHTML = "";
            for (let item in items_in_table) {

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
              let r_id = "_s_s_s_" + uuidv4();

              let f_amt = document.createElement("input");
              f_amt.id = "famt" + r_id;
              f_amt.setAttribute("type", "number");
              f_amt.setAttribute("required", "");
              f_amt.classList.add("form-control", "form-control-sm", "align-middle");
              f_amt.setAttribute("data-ref", items_in_table[item]["emp_no"]);
              f_amt.setAttribute("min", 0);
              f_amt.setAttribute("max", items_in_table[item]['max']);

              // make sure the f_amt is always greater than 0
              //  f_amt.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              f_amt.setAttribute("onkeyup", "calculateEarnings(this.dataset.ref, this.id);");
              f_amt.setAttribute("onchange", "calculateEarnings(this.dataset.ref, this.id);");
              f_amt.setAttribute("onclick", "this.select();");
              items_in_table[item]['f_amt'] = ('f_amt' in items_in_table[item] && items_in_table[item]['f_amt'] >= 0) ?
                items_in_table[item]['f_amt'] : 0;
              f_amt.value = items_in_table[item]['f_amt'];
              let f_amtWrapper = document.createElement("td");
              f_amtWrapper.classList.add("m-2", "col-md-2");
              f_amtWrapper.appendChild(f_amt);


              // Define Quantity 


              let qty = document.createElement("input");
              qty.id = "qty" + r_id;
              qty.setAttribute("type", "number");
              qty.setAttribute("required", "");
              qty.classList.add("form-control", "form-control-sm", "align-middle");
              qty.setAttribute("data-ref", items_in_table[item]["emp_no"]);
              qty.setAttribute("min", 0);
              qty.setAttribute("max", items_in_table[item]['max']);

              // make sure the qty is always greater than 0
              //   qty.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              qty.setAttribute("onkeyup", "calculateEarnings(this.dataset.ref, this.id);");
              qty.setAttribute("onchange", "calculateEarnings(this.dataset.ref, this.id);");
              qty.setAttribute("onclick", "this.select();");
              items_in_table[item]['qty'] = ('qty' in items_in_table[item] && items_in_table[item]['qty'] >= 0) ?
                items_in_table[item]['qty'] : 0;
              qty.value = items_in_table[item]['qty'];
              let qtyWrapper = document.createElement("td");
              qtyWrapper.classList.add("m-2", "col-md-2");
              qtyWrapper.appendChild(qty);

              // Define Rate 


              let rate = document.createElement("input");
              rate.id = "rate" + r_id;
              rate.setAttribute("type", "number");
              rate.setAttribute("required", "");
              rate.classList.add("form-control", "form-control-sm", "align-middle");
              rate.setAttribute("data-ref", items_in_table[item]["emp_no"]);
              rate.setAttribute("min", 0);
              rate.setAttribute("max", items_in_table[item]['max']);

              // make sure the rate is always greater than 0
              //  rate.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
              rate.setAttribute("onkeyup", "calculateEarnings(this.dataset.ref, this.id);");
              rate.setAttribute("onchange", "calculateEarnings(this.dataset.ref, this.id);");
              rate.setAttribute("onclick", "this.select();");
              items_in_table[item]['rate'] = ('rate' in items_in_table[item] && items_in_table[item]['rate'] >= 0) ?
                items_in_table[item]['rate'] : 0;
              rate.value = items_in_table[item]['rate'];
              let rateWrapper = document.createElement("td");
              rateWrapper.classList.add("m-2", "col-md-2");
              rateWrapper.appendChild(rate);

              // earnings 


              let earnings = document.createElement("td");
              earnings.id = "earnings" + r_id;
              // earnings.setAttribute("id", "td-" + items_in_table[item]["emp_no"]);
              items_in_table[item]["earnings"] = ((Number(items_in_table[item]["f_amt"])) + (Number(items_in_table[item]["qty"]) * Number(items_in_table[item]["rate"]))).toFixed(2);
              earnings.appendChild(document.createTextNode(items_in_table[item]["earnings"]));
              earnings.classList.add("align-middle");

              // do not forget this earnings 

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
                earnings,
                actionWrapper
              );
              table_body.appendChild(tr);

            }
            return;
          }

          function calculateEarnings(item, id) {
            // Get the UUID
            const uuid = id.split("_s_s_s_")[1];
            let f_amt = "famt" + "_s_s_s_" + uuid;
            let qty = "qty" + "_s_s_s_" + uuid;
            let rate = "rate" + "_s_s_s_" + uuid;
            let earnings = "earnings" + "_s_s_s_" + uuid;
            let earnings_val = 0;

            f_amt = document.querySelector("#" + f_amt);
            qty = document.querySelector("#" + qty);
            rate = document.querySelector("#" + rate);
            earnings = document.querySelector("#" + earnings);

            if (Number(f_amt.value) > 0) {
              qty.value = 0;
              rate.value = 0;
              qty.setAttribute("readonly", "");
              rate.setAttribute("readonly", "");

              // The earning is the f_amt 
              earnings_val = Number(f_amt.value);
            } else {
              qty.removeAttribute("readonly");
              rate.removeAttribute("readonly");

              // The earning is a function of qty and rate
              earnings_val = Number(qty.value) * Number(rate.value)
            }
            earnings.innerHTML = numberWithCommas(earnings_val);

            for (key in items_in_table) {
              if (items_in_table[key]['emp_no'] === item) {

                items_in_table[key]['qty'] = Number(qty.value);
                items_in_table[key]['rate'] = Number(rate.value);
                items_in_table[key]['f_amt'] = Number(f_amt.value);
                items_in_table[key]['earnings'] = earnings_val;

              }
            }
          }

          function submitForm() {
            const month = document.querySelector("#month");
            const adv_year = document.querySelector("#adv_year");

            if (!month.validity.valid) { // Validation 1
              month.focus();
              month.scrollIntoView();
              return;
            } else if (!adv_year.validity.valid) { // Validation 2
              adv_year.focus();
              adv_year.scrollIntoView();
              return;
            }

            const table_items = [];
            for (let key in items_in_table) {
              if (items_in_table[key].earnings <= 0) {
                console.log("No fam");
                const alertVar = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> ${items_in_table[key]['emp_name']} Should have earnings > 0.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                var divAlert = document.querySelector("#alert-div");
                divAlert.innerHTML = alertVar;
                divAlert.scrollIntoView();
                return;
              }
              table_items.push(items_in_table[key]);
            }

            if (table_items.length == 0) {
              benefit_select.focus();
              benefit_select.scrollIntoView();
              return;
            }

            const benefit_var = employee_benefits[benefit_select.value].benefit;
            const type_var = employee_benefits[benefit_select.value].type;

            console.log("====================================================")
            console.log("****************************************************")
            console.log("table_items", JSON.stringify(table_items, null, 2));
            console.log("month", month.value);
            console.log("year", adv_year.value);
            console.log("benefit", benefit_var);
            console.log("type", type_var);
            console.log("****************************************************")
            console.log("====================================================")




            const formData = new FormData();
            formData.append("table_items", JSON.stringify(table_items));
            formData.append("month", month.value);
            formData.append("year", adv_year.value);
            formData.append("benefit", benefit_var);
            formData.append("type", type_var);

            fetch('add_benefits_month.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                if (data == "Created Successfully..") {
                  const alertVar =
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Records saved successfully.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                  var divAlert = document.querySelector("#alert-div");
                  divAlert.innerHTML = alertVar;
                  divAlert.scrollIntoView();
                  setTimeout(function() {
                    location.reload();
                  }, 2500);

                } else {
                  const alertVar =
                    `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Record could not be saved.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                  var divAlert = document.querySelector("#alert-div");
                  divAlert.innerHTML = alertVar;
                  divAlert.scrollIntoView();
                }
              })
              .catch(error => {
                console.error('Error:', error);
              });
          }

          // let cumulative_total = () => {

          //       let quotation_total = 0;
          //      items_in_table.forEach(item => {
          //       console.log("Yaaah", item);

          //     quotation_total += Number(item.earnings);
          //   });

          // }


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

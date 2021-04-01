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
      <form onsubmit="return submitForm();">
        <style>
          .hide-this {
            display: none;
          }
        </style>

        <h5 class="p-2">Company Loans</h5>

        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row pb-2 ">
              <div class="col">
                <label for="exp_date" class="form-label">Date </label>
                <input type="date" name="exp_date" id="exp_date" class="form-control" required>
              </div>
              <div class="col">
                <label for="#" class="form-label">Select Employee </label>
                <div class="input-group">
                  <input list="employee" name="employee_name" id="employee_name" class="form-select" required>
                  <datalist id="employee"></datalist>
                  <button type="button" class="btn btn-primary" onclick="selectEmployee();">Select</button>
                </div>
              </div>
            </div>
            <div class="row">

              <div class="col">
                <label for="design" class="form-label">Designation </label>
                <input type="text" name="design" id="design" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="department" class="form-label">Department</label>
                <input type="text" name="department" id="department" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="emp_no" class="form-label">Emp No#</label>
                <input type="text" name="emp_no" id="emp_no" class="form-control" readonly>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <label for="#" class="form-label">Loan Type</label>
                <select class="form-select" id="loan_type" onchange="descriptionChanged()" required>
                  <option disabled selected value>--Select Loan Type--</option>
                  <option value="loan">Company Loan</option>
                  <option value="damage">Company Damage</option>
                </select>
              </div>
              <div class="col">
                <label for="#" class="form-label">Description</label>

                <div id="desc1">
                  <select class="form-select" id="desc_1">
                    <option disabled selected value>--Select the description--</option>
                    <option value="fees">School Fees</option>
                    <option value="medical">Medical</option>
                    <option value="develop">Development</option>
                  </select>
                </div>
                <div id="desc2" class="hide-this">
                  <select class="form-select" id="desc_2">
                    <option disabled selected value>--Select the description--</option>
                    <option value="fuel">Fuel</option>
                    <option value="lost">Good Lost</option>
                    <option value="workshop">Workshop</option>
                    <option value="types">Types</option>
                    <option value="breaks">Breakages</option>
                  </select>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <label for="#" class="form-label">Initial Amount</label>
                <div class="input-group">
                  <span class="input-group-text is-static">KES</span>
                  <input type="number" class="form-control" name="init_amt" id="init_amt" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
              <!--
              <div class="col">
                <label for="#" class="form-label">Balance</label>
                <div class="input-group">
                  <span class="input-group-text is-static">KES</span>
                  <input type="number" class="form-control" name="balance" id="balance" required readonly>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
              -->
              <div class="col">
                <label for="#" class="form-label">Installment Amount</label>
                <div class="input-group">
                  <span class="input-group-text is-static">KES</span>
                  <input type="number" class="form-control" name="installment" id="installment" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
              <div class="col">
                <label for="#" class="form-label">Interest</label>
                <div class="input-group">
                  <span class="input-group-text is-static">%</span>
                  <input type="number" class="form-control" name="interest" id="interest" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <label for="issue_date" class="form-label">Issued Date </label>
                <input type="date" name="issue_date" id="issue_date" class="form-control" required>
              </div>
              <div class="col">
                <label for="begin_date" class="form-label">Start Date </label>
                <input type="date" name="begin_date" id="begin_date" class="form-control" required>
              </div>
              <div class="col">
                <label for="#" class="form-label">Interest Type</label>
                <select class="form-select" id="interest_type" required>
                  <option disabled selected value>--Select Interest Type--</option>
                  <option value="none">None</option>
                  <option value="straight">Straight-Line</option>
                  <option value="reducing">Reducing Balance</option>
                </select>
              </div>
              <div class="col">
                <label for="#" class="form-label">Fringe Benefit Tax</label>
                <select class="form-select" id="fringe" required>
                  <option disabled selected value>--Select Fringe Tax--</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
                </select>
              </div>
            </div>
            <button class="btn btn-falcon-primary btn-sm my-2" id="submit">
              Submit
            </button>
          </div>
        </div>
      </form>
    </div>

    <?php
    include '../includes/base_page/footer.php';
    ?>
  </div>
  </body>

</html>

<script>
  const employee = document.querySelector("#employee");

  const exp_date = document.querySelector("#exp_date");
  const employee_name = document.querySelector("#employee_name");
  const design = document.querySelector("#design");
  const department = document.querySelector("#department");
  const emp_no = document.querySelector("#emp_no");
  const loan_type = document.querySelector("#loan_type");
  const desc = document.querySelector("#desc");
  const desc1 = document.querySelector("#desc1");
  const desc2 = document.querySelector("#desc2");
  const select_1 = document.querySelector("#desc_1");
  const select_2 = document.querySelector("#desc_2");
  const init_amt = document.querySelector("#init_amt");
  const balance = document.querySelector("#balance");
  const installment = document.querySelector("#installment");
  const interest = document.querySelector("#interest");
  const issue_date = document.querySelector("#issue_date");
  const begin_date = document.querySelector("#begin_date");
  const interest_type = document.querySelector("#interest_type");
  const fringe = document.querySelector("#fringe");


  const all_employees = {};

  function getLoansDetails() {
    let e_id = employee_name.value.split("#")[1].trim();
    let tmp = {
      date: exp_date.value,
      emp_name: employee_name.value,
      designation: design.value,
      department: department.value,
      emp_no: emp_no.value,
      loan_type: loan_type.value,
      desc: loan_type.value == "loan" ? select_1.value : select_2.value,
      amount: init_amt.value,
      balance: init_amt.value,
      installment: installment.value,
      pc_interest: interest.value,
      issue_date: issue_date.value,
      start_date: begin_date.value,
      int_type: interest_type.value,
      fringe_tax: fringe.value,

    }
    return tmp;
  }

  function submitForm() {

    const formData = new FormData();

    console.log("=======================================");
    console.log("Submitting");
    console.log("=======================================");

    for (key in getLoansDetails()) {
      formData.append(key, getLoansDetails()[key]);
    }


    fetch('add_company_loans.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(result => {
        console.log('Success:', result);

        setTimeout(function() {
          location.reload();
        }, 2500);

      })
      .catch(error => {
        console.error('Error:', error);
      });

    return false;
  }

  function descriptionChanged() {
    const select_1 = document.querySelector("#desc_1");
    const select_2 = document.querySelector("#desc_2");
    select_1.value = null;
    select_2.value = null;
    switch (loan_type.value) {
      case "loan":
        desc1.classList.remove('hide-this');
        desc2.classList.add('hide-this');
        break;
      case "damage":
        desc1.classList.add('hide-this');
        desc2.classList.remove('hide-this');
        break;
    }

  }



  const selectEmployee = () => {
    if (!employee_name.value) {
      employee_name.focus();
      return;
    }

    const sn = employee_name.value.split("#")[1].trim();


    const formData = new FormData();
    formData.append("nat_id", sn);
    fetch('../payroll/loans_load.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log('Success:', result);
        emp_no.value = result[0]["job_number"];
        department.value = result[0]["section"];
        design.value = result[0]["job"];
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }


  window.addEventListener('DOMContentLoaded', (event) => {
    const formData = new FormData();

    fetch('../payroll/load_employee.php')
      .then(response => response.json())
      .then(result => {
        console.log(result)
        let opt = document.createElement("option");

        result.forEach((employees) => {
          opt = document.createElement("option");
          opt.appendChild(document.createTextNode(employees["fname"] + " " + employees["lname"]));
          opt.value = "National ID No# " + employees["national_id"];
          all_employees[employees["fname"] + " " + employees["lname"]] = employees["national_id"];
          employee.appendChild(opt);
        });

      })
      .catch((error) => {
        console.error('Error:', error);
      });

  });
</script>
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
        <h5 class="p-2">Payroll Master</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row justify-content-between my-3">
              <div class="col">
                <label class="form-label" for="b_month">Select Month*</label>
                <select class="form-select" name="b_month" id="b_month">
                  <option value disabled selected>
                    -- Select Month --
                  </option>
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
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>

              <div class="col">
                <label class="form-label" for="b_year">Select Year*</label>
                <select class="form-select" name="b_year" id="b_year">
                  <option value disabled selected>
                    -- Select Year --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>

            <div class="row justify-content-between my-3">
              <div class="col">
                <label class="form-label" for="b_month">Select NHIF Schedule*</label>
                <select class="form-select" name="b_nhif" id="b_nhif">
                  <option value disabled selected>
                    -- Select NHIF Schedule --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>

              <div class="col">
                <label class="form-label" for="b_year">Select P.A.Y.E Schedule*</label>
                <select class="form-select" name="b_paye" id="b_paye">
                  <option value disabled selected>
                    -- Select P.A.Y.E Schedule --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="b_create" onclick="">
                Create
              </button>
            </div>
          </div>
          <div class="card-body fs--1 p-2">
            <div class=" table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Employee Number</th>
                    <th scope="col">Employee Name </th>
                    <th scope="col"> Branch </th>
                    <th scope="col"> Department </th>
                    <th scope="col">Salary</th>
                    <th scope="col">Absenteeism</th>
                    <th scope="col"> Earnings </th>
                    <th scope="col"> P.A.Y.E</th>
                    <th scope="col"> N.S.S.F </th>
                    <th scope="col"> NHIF </th>
                    <th scope="col">Salary Advance</th>
                    <th scope="col"> Loans </th>
                    <th scope="col"> Other Deductions </th>
                    <th scope="col"> Net Pay </th>
                    <th scope="col"> Employee Contributions </th>
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
      </div>
    </div>
    <?php
    include '../includes/base_page/footer.php';
    ?>
    </div>
  </main>

  <!-- select options scripts -->

  <script>
    const b_paye = document.querySelector("#b_paye");
    const b_nhif = document.querySelector("#b_nhif");
    const b_year = document.querySelector("#b_year");
    const b_month = document.querySelector("#b_month");



    window.addEventListener('DOMContentLoaded', (event) => {

      populateSelectElement("#b_paye", '../payroll/#.php', "paye");
      populateSelectElement("#b_nhif", '../payroll/#.php', "nhif");
      populateSelectElement("#b_year", '../payroll/#.php', "year");
      populateSelectElement("#b_month", '../payroll/#.php', "month");

    });
  </script>

  <!-- table_items script-->


  <script>
    const table_body = document.querySelector("#table_body");
    let items_in_table = {};


    function updateTable() {
      console.log("Rasta ", items_in_table);
      table_body.innerHTML = "";
      for (let item in items_in_table) {

        let tr = document.createElement("tr");
        // Id will be like 1Tank
        // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

        // employee details
        let employee_no = document.createElement("td");
        employee_no.appendChild(document.createTextNode(items_in_table[item].job));
        employee_no.classList.add("align-middle");

        //employee  number 
        let firstname = document.createElement("td");
        firstname.appendChild(document.createTextNode(items_in_table[item].fname));
        firstname.classList.add("align-middle");

        // branch
        let secondname = document.createElement("td");
        secondname.appendChild(document.createTextNode(items_in_table[item].lname));
        secondname.classList.add("align-middle");

        //department
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //salary

        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //earnings
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //absenteeism
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //paye
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //nssf
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //salary advance
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //loans
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //other deductions
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        // net pay
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        //employee contribution 
        let national = document.createElement("td");
        national.appendChild(document.createTextNode(items_in_table[item].nat));
        national.classList.add("align-middle");
        // CONTINUE FROM HERE RUTH



        let actionWrapper = document.createElement("td");
        actionWrapper.classList.add("m-2");
        let action = document.createElement("button");
        action.setAttribute("id", items_in_table[item]["fname"] + " " + items_in_table[item]["lname"]);
        action.setAttribute("onclick", "removeItem(this.id);");
        let icon = document.createElement("span");
        icon.classList.add("fas", "fa-minus", "mt-1");
        action.appendChild(icon);
        action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
        actionWrapper.appendChild(action);

        tr.append(employee_no,
          firstname,
          secondname,
          national,
          opening_balanceWrapper,
          adv_date,
          actionWrapper
        );
        table_body.appendChild(tr);

      }
      return;
    }
  </script>
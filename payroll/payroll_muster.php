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
              <button class="btn btn-falcon-primary btn-sm m-2" id="b_create" onclick="selectRows();">
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
                    <th scope="col"> Earnings </th>
                    <th scope="col"> P.A.Y.E</th>
                    <th scope="col"> N.S.S.F </th>
                    <th scope="col"> NHIF </th>
                    <th scope="col">Salary Advance</th>
                    <th scope="col"> Other Deductions </th>
                    <th scope="col"> Employee Contributions </th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
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

      populateSelectElement("#b_paye", '../payroll/load_paye_schedule.php', "paye");
      populateSelectElement("#b_nhif", '../payroll/load_nhif_schedule.php', "nhif");
      populateSelectElement("#b_year", '../payroll/load_year.php', "year");
      populateSelectElement("#b_month", '../payroll/load_month.php', "month");

    });
  </script>

  <!-- table_items script-->


  <script>
    const table_body = document.querySelector("#table_body");



    let table_items;

    const selectRows = () => {
      const formData = new FormData();

      console.log("======================================");
      console.log("selected these");
      console.log("''''''''''''''''''''''''''''''''''''''");
      console.log("year", b_year.value);
      console.log("month", b_month.value);
      console.log("paye", b_paye.value);
      console.log("nhif", b_nhif.value);
      console.log("======================================");


      fetch('muster_roll.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          console.log('Success:', data);
          return;
          [...table_items] = data;
          updateTable(table_items);
        })
        .catch(error => {
          console.error('Error:', error);
        });

    }

    let updateTable = (data) => {
      table_body.innerHTML = "";
      console.log("Ladadida", "Commodore ", data);
      data.forEach(value => {

        const this_row = document.createElement("tr");
        // Id will be like 1Tank
        // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

        // employee details
        let employee_no = document.createElement("td");
        employee_no.appendChild(document.createTextNode(value["emp_no"]));
        employee_no.classList.add("align-middle");

        //employee  number 
        let name = document.createElement("td");
        name.appendChild(document.createTextNode(value["emp_name"]));
        name.classList.add("align-middle");

        // branch
        let branch = document.createElement("td");
        branch.appendChild(document.createTextNode(value["branch"]));
        branch.classList.add("align-middle");

        //department
        let department = document.createElement("td");
        department.appendChild(document.createTextNode(value["dept"]));
        department.classList.add("align-middle");
        //salary

        let salary = document.createElement("td");
        salary.appendChild(document.createTextNode(value["salary"]));
        salary.classList.add("align-middle");
        //earnings

        let earnings = document.createElement("td");
        earnings.appendChild(document.createTextNode(value["earnings"]));
        earnings.classList.add("align-middle");
        //absenteeism

        // let absent = document.createElement("td");
        // absent.appendChild(document.createTextNode(items_in_table[item].absent));
        // absent.classList.add("align-middle");

        //paye
        let paye = document.createElement("td");
        paye.appendChild(document.createTextNode(value["paye"]));
        paye.classList.add("align-middle");
        //nssf
        let nssf = document.createElement("td");
        nssf.appendChild(document.createTextNode(value["nssf"]));
        nssf.classList.add("align-middle");
        //nhif

        let nhif = document.createElement("td");
        nhif.appendChild(document.createTextNode(value["nhif"]));
        nhif.classList.add("align-middle");
        //salary advance
        let advance = document.createElement("td");
        advance.appendChild(document.createTextNode(value["advanced"]));
        advance.classList.add("align-middle");
        //loans

        //  let loans = document.createElement("td");
        // loans.appendChild(document.createTextNode(items_in_table[item].loans));
        // loans.classList.add("align-middle");


        //other deductions
        let deduct = document.createElement("td");
        deduct.appendChild(document.createTextNode(value["deductions"]));
        deduct.classList.add("align-middle");
        // net pay

        //  let netpay = document.createElement("td");
        // netpay.appendChild(document.createTextNode(items_in_table[item].netpay));
        // netpay.classList.add("align-middle");


        //employee contribution 
        let contrib = document.createElement("td");
        contrib.appendChild(document.createTextNode(value["employer_nssf"]));
        contrib.classList.add("align-middle");
        // CONTINUE FROM HERE RUTH



        this_row.append(employee_no,
          name,
          branch,
          department,
          salary,
          earnings,
          paye,
          nssf,
          nhif,
          advance,
          deduct,
          contrib,
        );
        table_body.appendChild(this_row);

      });
    }
  </script>
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
        <div id="alert-div"></div>
        <h5 class="p-2">Employee Attendance</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <form onsubmit="return submitForm();">
          <div class="card mt-3">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label for="#" class="form-label">Select Employee </label>
                  <div class="input-group">
                    <input list="employee" name="employee" id="employee_name" class="form-select" required>
                    <datalist id="employee"></datalist>
                    <button type="button" class="btn btn-primary" onclick="selectEmployee();">Select</button>
                  </div>
                </div>
                <div class="col">
                  <label for="#" class="form-label">Attendance Date</label>
                  <input type="date" id="att_date" class="form-control" required>
                </div>
              </div>
              <!-- Content is to start here -->
              <hr>
              <div class="card-header">Employee Details</div>
              <div class="row">
                <div class="col">
                  <label for="employee_no" class="form-label">Employee No#</label>
                  <input type="text" name="employee_no" id="employee_no" class="form-control" required readonly>
                </div>

                <div class="col">
                  <label for="branch" class="form-label">Branch</label>
                  <input type="text" name="branch" id="branch_name" class="form-control" required readonly>
                </div>

                <div class="col">
                  <label for="job_title" class="form-label">Designation</label>
                  <input type="text" name="job_title" id="job_title" class="form-control" required readonly>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label for="status" class="form-label">Status</label>
                  <select name="status" id="status" class="form-select" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="present">Present</option>
                    <option value="absent">Absent</option>
                    <option value="onleave">On Leave</option>
                    <option value="wrkfrmhm">Work From Home</option>
                    <option value="holiday">Holiday</option>
                    <option value="offday">Off Day</option>
                  </select>
                </div>
                <div class="col d-flex align-items-end">
                  <div class="pr-4">
                    <input type="checkbox" name="late" class="form-check-input" value="" checked id="late_entry">
                    <label for="late" class="form-check-label"> Late Entry</label>
                  </div>
                  <div class="pr-2">
                    <input type="checkbox" name="early" class="form-check-input" value="" checked id="early_exit">
                    <label for="early" class="form-check-label"> Early Exit</label>
                  </div>
                </div>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <div class="card mt-1">
            <div class="card-body fs--1 p-1">
              <div class="d-flex flex-row-reverse">
                <button class="btn btn-falcon-primary btn-sm m-2" id="submit">
                  Submit
                </button>
              </div>
              <!-- Content ends here -->
            </div>

          </div>
        </form>

        <!-- Additional cards can be added here -->
      </div>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- body ends here -->
      <!-- =========================================================== -->

      <script>
        const employee_name = document.querySelector("#employee_name");
        const employee = document.querySelector("#employee");
        const att_date = document.querySelector("#att_date");
        const employee_no = document.querySelector("#employee_no");
        const branch_name = document.querySelector("#branch_name");
        const job_title = document.querySelector("#job_title");
        const status = document.querySelector("#status");
        const late_entry = document.querySelector("#late_entry");
        const early_exit = document.querySelector("#early_exit");

        const all_employees = {};


        function getEmployeeDetails() {
          let e_id = employee_name.value.split("#")[1].trim();
          let tmp = {
            employee_name: employee_name.value,
            att_date: att_date.value,
            employee_no: employee_no.value,
            branch: branch_name.value,
            job_title: job_title.value,
            status: status.value,
            late_entry: late_entry.checked,
            early_exit: early_exit.checked,
          }
          return tmp;
        }

        function submitForm() {

          const formData = new FormData();

          console.log("=======================================");
          console.log("Submitting");
          console.log("=======================================");

          for (key in getEmployeeDetails()) {
            formData.append(key, getEmployeeDetails()[key]);
          }


          fetch('insert_attendance.php', {
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


        const selectEmployee = () => {
          if (!employee_name.value) {
            employee_name.focus();
            return;
          }

          const sn = employee_name.value.split("#")[1].trim();


          const formData = new FormData();
          formData.append("nat_id", sn);
          fetch('../payroll/attendance_load.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              console.log('Success:', result);
              employee_no.value = result[0]["job_number"];
              branch_name.value = result[0]["branch_name"];
              job_title.value = result[0]["job_title"];
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
                opt.value = "ID No# " + employees["national_id"];
                all_employees[employees["national_id"]] = employees["fname"] + " " + employees["lname"];
                employee.appendChild(opt);
              });

            })
            .catch((error) => {
              console.error('Error:', error);
            });

        });
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
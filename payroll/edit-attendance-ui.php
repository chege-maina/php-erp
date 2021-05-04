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
//include_once '../includes/dbconnect.php';
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
        //  include '../base_page/data_list_select.php';
        //  
        ?>
        <!-- =========================================================== -->
        <!-- body begins here -->
        <div id="alert-div"></div>
        <h5 class="p-2">Edit Employee Attendance</h5>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <form onsubmit="return submitForm();">
          <div class="card mt-3">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label for="#" class="form-label">Employee Name</label>
                  <input type="employee_name" id="employee_name" class="form-control" readonly required>
                </div>
                <div class="col">
                  <label for="#" class="form-label">Attendance Date</label>
                  <input type="date" id="att_date" class="form-control" readonly required>
                </div>
              </div>
              <!-- Content is to start here -->
              <hr>
              <div class="col col-auto mt-2">
                <small><strong>Status:</strong></small>
                <span id="supplier_status"></span>
              </div>

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
                <div class="col-3">
                  <label for="status" class="form-label">Status</label>
                  <input name="status" id="status" class="form-control" readonly required>
                </div>

              </div>
            </div>
          </div>
          <!-- Content ends here -->

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
        </form>

        <?php
        include '../includes/base_page/footer.php';
        ?>
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
        const description = document.querySelector("#status");
        const late_entry = document.querySelector("#late_entry");
        const early_exit = document.querySelector("#early_exit");
        const supplier_status = document.querySelector("#supplier_status");

        const all_employees = {};


        const approve_button = document.querySelector("#approve_button");
        const reject_button = document.querySelector("#reject_button");

        let s_id;

        function submitForm(action) {
          const formData = new FormData();
          formData.append("s_id", s_id);
          formData.append("action", action);
          fetch('./approve_reject_attendance.php', {
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
                  location.href = "./attendance_listing_ui.php";
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
          s_id = sessionStorage.getItem("Employee_No");

          const formData = new FormData();
          formData.append("s_id", s_id);

          fetch('load_attendance_details.php', {
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
              employee_name.value = result.employee_name;
              employee_no.value = result.employee_no;
              att_date.value = result.att_date;
              branch_name.value = result.branch;
              job_title.value = result.job_title;
              status.value = result.status;
              description.value = result.description;

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


      <!-- =========================================================== -->
      <!-- Footer Begin -->
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->

      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- Footer End -->
      <!-- =========================================================== -->
</body>

</html>
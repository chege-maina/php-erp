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

<style>
  .vertical {
    border-left: 1px solid black;
    height: 200px;
  }
</style>


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
        <h5 class="p-2">Employee Leave Application</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col-sm-8">
                <div class="row my-3">
                  <div class="col">
                    <label for="#" class="form-label">Select Employee </label>
                    <input list="employee" name="employee_name" id="employee_name" class="form-select" required onchange="employeeChanged();">
                    <datalist id="employee"></datalist>
                  </div>
                  <div class="col">
                    <label for="#" class="form-label">Select Leave Category </label>
                    <input list="category" name="leave_category" id="leave_category" class="form-select" required>
                    <datalist id="category"></datalist>
                  </div>
                </div>
                <div class="row justify-content-between my-3">

                  <div class="col">
                    <label for="startdate" class="form-label">From</label>
                    <!-- autofill current date  -->
                    <input type="date" name="startdate" id="startdate" class="form-control" required>
                  </div>

                  <div class="col">
                    <label for="enddate" class="form-label">To</label>
                    <!-- autofill current date  -->
                    <input type="date" name="enddate" id="enddate" class="form-control" required>
                  </div>
                  <!--other rows go here -->

                </div>
                <div class="row my-3">
                  <div class="col">
                    <label for="duration" class="form-label">Duration</label>
                    <div class="input-group">
                      <input type="number" name="duration" id="duration" class="form-control" required>
                      <span class="input-group-text">
                        Days
                      </span>
                    </div>
                  </div>

                  <div class="col">
                    <label for="formFile" class="form-label">Attach File</label>
                    <input class="form-control" type="file" id="formFile" multiple />
                  </div>
                </div>
                <div class="row my-3">
                  <div class="col">
                    <label for="comment" class="form-label">Comment </label>
                    <textarea class="form-control" id="comment" aria-label="With textarea"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class=" table-responsive">
                  <caption>
                    <h6>Balance for the Leave Type</h6>
                  </caption>
                  <table class="table table-sm table-striped mt-0">
                    <thead>
                      <tr>
                        <th scope="col">Balance</th>
                        <th scope="col">Earned</th>
                        <th scope="col">Used</th>
                        <th scope="col">Available</th>
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
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                Submit
              </button>
            </div>
            <!-- Content ends here -->
          </div>
        </div>

        <?php
        include '../includes/base_page/footer.php';
        ?>
      </div>
    </div>
  </main>
</body>
<script>
  const employee_name = document.querySelector("#employee_name");
  const employee = document.querySelector("#employee");
  const leave_category = document.querySelector("#leave_category");
  const category = document.querySelector("#category");
  const employee_leaves = {};
  var res = [];
  // const all_leave = {};

  window.addEventListener('DOMContentLoaded', (event) => {

    const formData = new FormData();

    fetch('../payroll/loadleave.php')
      .then(response => response.json())
      .then(result => {
        updateEmployeeDatalist(result);

        result.forEach(row => {
          employee_leaves[row['fname'] + " " + row['lname']] = row['leave'];
        });

      })

      .catch((error) => {
        console.error('Error:', error);
      });
  });

  function updateEmployeeDatalist(data) {
    data.forEach(row => {
      let opt = document.createElement("option");
      opt.appendChild(document.createTextNode("National ID No# " + row["nat"] + "  Employee No# " + row["job"]));
      opt.value = row["fname"] + " " + row["lname"];
      employee.appendChild(opt);
    });
  }

  function employeeChanged() {
    if (!employee_name.validity.valid) {
      employee_name.focus();
      return;
    }

    updateLeaveCategories(employee_leaves[employee_name.value]);
  }

  function updateLeaveCategories(data) {
    category.innerHTML = "";
    data.forEach(row => {
      let opt = document.createElement("option");
      opt.value = row["leave"];
      category.appendChild(opt);
    });
  }
</script>
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
        <div class="card">

          <div class="card-body">
            <button class="btn" onclick="showOnly('employee');">Create employee</button>
            <button class="btn" onclick="showOnly('salary');">Salary details</button>
            <button class="btn" onclick="showOnly('hr');">Hr Stuff</button>
            <button class="btn" onclick="showOnly('contact');">Contact stuff</button>
            <style>
              .hide-this {
                display: none;
              }
            </style>

            <div id="create_employee">
              Create employee
              <input class="form-control" type="text" name="" id="">
            </div>
            <div id="salary_details">
              Salary stuff
              <input class="form-control" type="text" name="" id="">
            </div>
            <div id="hr_details">
              Hr stuff
              <input class="form-control" type="text" name="" id="">
            </div>
            <div id="contact_details">
              Contact stuff
              <input class="form-control" type="text" name="" id="">
            </div>

            <script>
              const create_employee = document.querySelector("#create_employee");
              const salary_details = document.querySelector("#salary_details");
              const hr_details = document.querySelector("#hr_details");
              const contact_details = document.querySelector("#contact_details");

              function showOnly(val) {
                console.log(val)
                switch (val) {
                  case 'employee':
                    create_employee.classList.remove('hide-this');
                    salary_details.classList.add('hide-this');
                    hr_details.classList.add('hide-this');
                    contact_details.classList.add('hide-this');
                    break;
                  case 'salary':
                    create_employee.classList.add('hide-this');
                    salary_details.classList.remove('hide-this');
                    hr_details.classList.add('hide-this');
                    contact_details.classList.add('hide-this');
                    break;
                  case 'hr':
                    create_employee.classList.add('hide-this');
                    salary_details.classList.add('hide-this');
                    hr_details.classList.remove('hide-this');
                    contact_details.classList.add('hide-this');
                    break;
                  case 'contact':
                    create_employee.classList.add('hide-this');
                    salary_details.classList.add('hide-this');
                    hr_details.classList.add('hide-this');
                    contact_details.classList.remove('hide-this');
                    break;
                }
              }
            </script>
          </div>
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->



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

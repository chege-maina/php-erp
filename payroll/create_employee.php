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


        <div id="alert-div"></div>
        <h5 class="p-2" id="title-header">
          Employee Settings
        </h5>

        <div class="card mb-1">
          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->
          <div class="card-body position-relative">
            <?php
            include './new-button.php';
            ?>
          </div>
        </div>

        <div class="card">
          <div class="card-body fs--1 p-4">
            <div id="create_employee">
              <?php
              include "./employee_bio.php";
              ?>
            </div>
            <div id="salary_details" class="hide-this">
              <?php
              include "./salary_details.php";
              ?>
            </div>
            <div id="hr_details" class="hide-this">
              <?php
              include "./hr_details.php";
              ?>
            </div>
            <div id="contact_details" class="hide-this">
              <?php
              include "./contact_details.php";
              ?>
            </div>
            <!-- Content ends here -->

          </div>
        </div>

        <div class="card mt-1 p-1">
          <div class="row">
            <div class="col">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                Save
              </button>
            </div>
          </div>
        </div>
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->

        <script>
          const first_name = document.querySelector("#first_name");
          const middle_name = document.querySelector("#middle_name");
          const last_name = document.querySelector("#last_name");
          const gender = document.querySelector("#gender");
          const dob = document.querySelector("#dob");
          const residential_status = document.querySelector("#residential_status");
          const national_id = document.querySelector("#national_id");
          const pin_no = document.querySelector("#pin_no");
          const nssf_no = document.querySelector("#nssf_no");
          const nhif_no = document.querySelector("#nhif_no");
          const photo = document.querySelector("#photo");

          function submitForm() {

            if (!job_number.value) {
              job_number.focus()
              return;
            }

            if (!nhif_no.value) {
              nhif_no.focus()
              return;
            }
            if (!nssf_no.value) {
              nssf_no.focus()
              return;
            }
            if (!pin_no.value) {
              pin_no.focus()
              return;
            }
            if (!national_id.value) {
              national_id.focus()
              return;
            }
            if (!off_mail.value) {
              off_mail.focus()
              return;
            }
            if (!pers_mail.value) {
              pers_mail.focus()
              return;
            }
            if (!country.value) {
              country.focus()
              return;
            }
            if (!mobile_no.value) {
              mobile_no.focus()
              return;
            }
            if (!official_no.value) {
              official_no.focus()
              return;
            }
            if (!ext_no.value) {
              ext_no.focus()
              return;
            }
            if (!city_town.value) {
              city_town.focus()
              return;
            }
            if (!county.value) {
              county.focus()
              return;
            }
            if (!p_code.value) {
              p_code.focus()
              return;
            }

            const formData = new FormData();

            console.log("=======================================");
            console.log("Submitting");
            console.log("=======================================");

            let employee_bio_data = getEmployeeBio();
            for (key in employee_bio_data) {
              formData.append(key, employee_bio_data[key]);
              console.log(key, employee_bio_data[key]);
            }

            console.log("=======================================");

            let employee_salary_data = getSalaryDetails();
            for (key in employee_salary_data) {
              formData.append(key, employee_salary_data[key]);
              console.log(key, employee_salary_data[key]);
            }

            console.log("=======================================");

            let employee_contact_details = getContactDetails();
            for (key in employee_contact_details) {
              formData.append(key, employee_contact_details[key]);
              console.log(key, employee_contact_details[key]);
            }


            console.log("=======================================");

            let employee_hr_details = getHrDetails();
            for (key in employee_hr_details) {
              formData.append(key, employee_hr_details[key]);
              console.log(key, employee_hr_details[key]);
            }
            console.log("=======================================");

            fetch('insert_employee.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', result);
                if (data["message"] == "success") {
                  const alertVar =
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Employee added to the database.
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
              <strong>Error!</strong> ${data["desc"]}.
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
        </script>
</body>

</html>
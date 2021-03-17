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

        <form action="#" method="POST" onsubmit="return submitForm();">
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div id="create_employee">

                <div class="row">
                  <div class="col">
                    <label class="form-label" for="product_name">First Name*</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                  <div class="col">
                    <label class="form-label" for="product_name">Middle Name*</label>
                    <input type="text" class="form-control" name="middle_name" id="middle_name" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                  <div class="col">
                    <label class="form-label" for="product_name">Last Name*</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-select">
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                  <div class="col">
                    <label class="form-label" for="last_name">Date of Birth*</label>
                    <input type="date" class="form-control" name="date" id="dob" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                  <div class="col ">
                    <label for="residence" class="form-label">Residential Status</label>
                    <select name="residence" id="residential_status" class="form-select">
                      <option value="Resident">Resident</option>
                      <option value="Resident">Resident</option>
                    </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <label class="form-label" for="photo">Passport Photo</label>
                    <input class="form-control" id="photo" name="photo" type="file" accept="image/*" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                  <div class="col">
                    <label class="form-label" for="national_id">National ID NO.*</label>
                    <input type="number" class="form-control" name="national_id" id="national_id" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                  <div class="col">
                    <label class="form-label" for="pin_no">PIN NO.*</label>
                    <input type="number" class="form-control" name="pin_no" id="pin_no" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col">
                    <label class="form-label" for="nssf_no">NSSF NO.*</label>
                    <input type="number" class="form-control" name="nssf_no" id="nssf_no" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                  <div class="col">
                    <label class="form-label" for="nhif_no">NHIF NO.*</label>
                    <input type="number" class="form-control" name="nhif_no" id="nhif_no" required>
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                </div>

                <div class="row mt-2">
                  <div class="col">
                    <button class="btn btn-falcon-primary btn-sm m-2" id="submit">
                      Submit
                    </button>
                  </div>
                </div>
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
        </form>
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

            const formData = new FormData();

            formData.append("first_name", first_name.value);
            formData.append("middle_name", middle_name.value);
            formData.append("last_name", last_name.value);
            formData.append("gender", gender.value);
            formData.append("residential_status", residential_status.value);
            formData.append("national_id_no", national_id.value);
            formData.append("pin_no", pin_no.value);
            formData.append("nssf_no", nssf_no.value);
            formData.append("nhif_no", nhif_no.value);
            formData.append("date_of_birth", dob.value);

            formData.append("passport", photo.files[0]);

            fetch('./insert_employee.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                if (data["message"] == "success") {
                  const alertVar =
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Employee added to the database
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
            return false;
          }
        </script>
</body>

</html>

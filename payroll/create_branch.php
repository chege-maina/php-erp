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

        <?php
        include '../base_page/data_list_select.php';
        ?>
        <!--contenct comes here -->

        <div id="alert-div"></div>
        <h5 class="p-2">Create Branch</h5>

        <form onsubmit="return submitForm();">
          <div class="card">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->
            <div class="card-body fs--1 p-4 position-relative">
              <div class="row">

                <div class="col">
                  <label for="company_name" class="form-label">Name*</label>
                  <div class="field">
                    <div class="control">
                      <input class="form-control" type="text" id="company_name" name="company_name" placeholder="Name" required>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <label for="email" class="form-label">Email*</label>
                  <div class="field">
                    <p class="control has-icons-left">
                      <input class="form-control" type="branch_email" id="branch_email" name="branch_email" required placeholder="Email">
                    </p>
                  </div>
                </div>

                <div class="col">
                  <label for="tel_no" class="form-label">Telephone Number*</label>
                  <input name="tel_no" class="form-control" type="tel" placeholder="Tel No" id="tel" required>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <label for="postal_address" class="form-label">Postal Address*</label>
                  <input name="postal_address" id="sup_postal" class="form-control" type="text" placeholder="Postal Address" required>
                </div>
                <div class="col">
                  <label for="physical_address" class="form-label">Physical Address*</label>
                  <input name="physical_address" id="sup_physical_address" class="form-control" type="text" placeholder="Physical Address" required>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col">
                  <button class="btn btn-falcon-primary">Submit</button>
                </div>
              </div>

            </div>


          </div>
        </form>

        <?php
        include '../includes/base_page/footer.php';
        ?>
      </div>

    </div>

  </main>
  <script>
    const company_name = document.querySelector("#company_name");
    const branch_email = document.querySelector("#branch_email");
    const tel = document.querySelector("#tel");
    const sup_postal = document.querySelector("#sup_postal");
    const sup_physical_address = document.querySelector("#sup_physical_address");


    function submitForm() {
      console.log("submitting");


      const formData = new FormData();
      formData.append("name", company_name.value);
      formData.append("email", branch_email.value);
      formData.append("tel_no", tel.value);
      formData.append("postal_address", sup_postal.value);
      formData.append("physical_address", sup_physical_address.value);

      fetch('../payroll/add_branch.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(result => {
          console.log('Success:', result);
          if (result["message"] === "success") {
            showSuccessAlert("Record stored successfuly");
            reloadPage();
          } else {
            let msg = !("desc" in result) || result["desc"].trim() === "" ?
              "Record not stored" : result["desc"];
            showDangerAlert(msg);
            removeAlert();
          }
        })
        .catch(error => {
          console.error('Error:', error);
          showDangerAlert("Could not send data to server");
          removeAlert();
        });

      return false;
    }
  </script>
</body>

</html>
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
                      <input class="form-control" type="text" id="company_name" name="company_name" placeholder="Name" readonly>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <label for="email" class="form-label">Email*</label>
                  <div class="field">
                    <p class="control has-icons-left">
                      <input class="form-control" type="branch_email" id="branch_email" name="branch_email" readonly placeholder="Email">
                    </p>
                  </div>
                </div>

                <div class="col">
                  <label for="tel_no" class="form-label">Telephone Number*</label>
                  <input name="tel_no" class="form-control" type="tel" placeholder="Tel No" id="tel" readonly>
                </div>
              </div>
              <hr>
              <div class="col col-auto mt-2">
                <small><strong>Status:</strong></small>
                <span id="supplier_status"></span>
              </div>
              <hr>
              <div class="row mt-2">
                <div class="col">
                  <label for="postal_address" class="form-label">Postal Address*</label>
                  <input name="postal_address" id="sup_postal" class="form-control" type="text" placeholder="Postal Address" readonly>
                </div>
                <div class="col">
                  <label for="physical_address" class="form-label">Physical Address*</label>
                  <input name="physical_address" id="sup_physical_address" class="form-control" type="text" placeholder="Physical Address" readonly>
                </div>
              </div>
            </div>
          </div>
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
      </div>

    </div>

  </main>
  <script>
    const company_name = document.querySelector("#company_name");
    const branch_email = document.querySelector("#branch_email");
    const tel = document.querySelector("#tel");
    const sup_postal = document.querySelector("#sup_postal");
    const supplier_status = document.querySelector("#supplier_status");
    const sup_physical_address = document.querySelector("#sup_physical_address");

    let s_id;

    function submitForm(action) {
      const formData = new FormData();
      formData.append("s_id", s_id);
      formData.append("action", action);
      fetch('./approve_reject_branch.php', {
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
              location.href = "./branch_listing_ui.php";
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
      s_id = sessionStorage.getItem("Branch");

      const formData = new FormData();
      formData.append("s_id", s_id);

      fetch('load_branch_details.php', {
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
          company_name.value = result.branch_name;
          branch_email.value = result.email;
          tel.value = result.tel_no;
          sup_postal.value = result.postal_address;
          sup_physical_address.value = result.physical_address;

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
</body>

</html>
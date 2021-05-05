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
        <h5 class="p-2">Create Shift</h5>

        <form onsubmit="return submitForm();">
          <div class="card">
            <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
            </div>
            <!--/.bg-holder-->
            <div class="card-body fs--1 p-4 position-relative">
              <div class="row">
                <div class="col">
                  <label for="shift_name" class="form-label">Shift Name*</label>
                  <input name="shift_name" class="form-control" type="text" placeholder="Name" id="shift_name" readonly>
                </div>
                <div class="col">
                  <label for="start_time" class="form-label">Start Time *</label>
                  <input name="start_time" class="form-control" type="time" placeholder="Start Time" id="start_time" readonly>
                </div>
                <div class="col">
                  <label for="end_time" class="form-label">End Time*</label>
                  <input name="end_time" class="form-control" type="time" placeholder="End Time" id="end_time" readonly>
                </div>
              </div>
              <hr>
              <div class="col col-auto mt-2">
                <small><strong>Status:</strong></small>
                <span id="supplier_status"></span>
              </div>
              <hr>
              <div class="row">
                <div class="col">
                  <label for="work_hours" class="form-label">Working Hours*</label>
                  <input name="work_hours" class="form-control" type="number" placeholder="Work Hours" id="work_hours" readonly>
                </div>
                <div class="col">
                  <label for="non_work" class="form-label">Non-Working Hours*</label>
                  <input name="non_work" class="form-control" type="number" placeholder="Non-Working Hours" id="non_work" readonly>
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

          </div>
        </form>

        <?php
        include '../includes/base_page/footer.php';
        ?>
      </div>

    </div>

  </main>
  <script>
    const shift_name = document.querySelector("#shift_name");
    const start_time = document.querySelector("#start_time");
    const end_time = document.querySelector("#end_time");
    const work_hours = document.querySelector("#work_hours");
    const non_work = document.querySelector("#non_work");
    const supplier_status = document.querySelector("#supplier_status");
    let s_id;

    function submitForm(action) {
      const formData = new FormData();
      formData.append("s_id", s_id);
      formData.append("action", action);
      fetch('./approve_reject_shift.php', {
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
              location.href = "./shift_listing_ui.php";
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
      s_id = sessionStorage.getItem("Shift");

      const formData = new FormData();
      formData.append("s_id", s_id);

      fetch('load_shift_details.php', {
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
          shift_name.value = result.shift_name;
          start_time.value = result.start_time;
          end_time.value = result.end_time;
          work_hours.value = result.work_hours;
          non_work.value = result.non_work;;

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
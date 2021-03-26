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
                  <input name="shift_name" class="form-control" type="text" placeholder="Name" id="shift_name" required>
                </div>
                <div class="col">
                  <label for="start_time" class="form-label">Start Time *</label>
                  <input name="start_time" class="form-control" type="time" placeholder="Start Time" id="start_time" required>
                </div>
                <div class="col">
                  <label for="end_time" class="form-label">End Time*</label>
                  <input name="end_time" class="form-control" type="time" placeholder="End Time" id="end_time" required>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <label for="work_hours" class="form-label">Working Hours*</label>
                  <input name="work_hours" class="form-control" type="number" placeholder="Work Hours" id="work_hours" required>
                </div>
                <div class="col">
                  <label for="non_work" class="form-label">Non-Working Hours*</label>
                  <input name="non_work" class="form-control" type="number" placeholder="Non-Working Hours" id="non_work" required>
                </div>
              </div>
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

    function getShiftDetails() {
      let tmp = {
        shift_name: shift_name.value,
        start_time: start_time.value,
        end_time: end_time.value,
        work_hours: work_hours.value,
        non_work: non_work.value,
      }
      return tmp;
    }

    function submitForm() {

      const formData = new FormData();

      console.log("=======================================");
      console.log("Submitting");
      console.log("=======================================");

      for (key in getShiftDetails()) {
        formData.append(key, getShiftDetails()[key]);
      }


      fetch('insert_shift.php', {
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
  </script>
</body>

</html>
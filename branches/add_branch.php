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
        <div id="alert-div"></div>
        <h5 class="mb-2">Add Branch</h5>
        <form action="post" onsubmit="return submitForm()">
          <div class="card">
            <div class="card-body fs--1 p-4">
              <!-- Content is to start here -->

              <div class="row">
                <div class="col">
                  <label class="form-label" for="branch_name">Branch Name</label>
                  <input class="form-control" id="branch_name" type="text" required />
                </div>
                <div class="col">
                  <label class="form-label" for="email_address">Email</label>
                  <input class="form-control" id="email_address" type="email" required />
                </div>
                <div class="col">
                  <label class="form-label" for="tel_no">Telephone Number</label>
                  <input class="form-control" id="tel_no" type="tel" required />
                </div>
              </div>
              <div class="row mt-3">
                <div class="col">
                  <label class="form-label" for="postal_address">Postal Address</label>
                  <input class="form-control" id="postal_address" type="text" required />
                </div>
                <div class="col">
                  <label class="form-label" for="physical_address">Physical Address</label>
                  <input class="form-control" id="physical_address" type="text" required />
                </div>
              </div>

              <!-- Content ends here -->
            </div>
            <!-- Additional cards can be added here -->
          </div>

          <div class="card p-2 mt-1">
            <div class="row">
              <div class="col-auto">
                <button class="btn btn-falcon-primary btn-sm">Submit</button>
              </div>
            </div>
          </div>
        </form>
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

        <script>
          function submitForm() {
            console.log("Submitting");
            return false;
          }
        </script>
</body>

</html>

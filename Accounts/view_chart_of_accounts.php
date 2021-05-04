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
        <h5 class="mb-2">Chart of Accounts</h5>
        <div class="card mb-1">
          <div class="card-body p-4">
            <div class="row">
              <div class="col">
                <label class="form-label" for="start_date">From</label>
                <input id="start_date" class="form-control" type="date">
              </div>
              <div class="col">
                <label class="form-label" for="end_date">To</label>
                <input id="end_date" class="form-control" type="date">
              </div>
              <div class="col-auto"><button class="btn btn-falcon-primary">Filter</button></div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <?php include 'components/chart_tree_data_loader.php' ?>
            <?php include 'components/vc_tree.php' ?>

            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
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

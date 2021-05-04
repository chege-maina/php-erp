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
        <form action="#" onsubmit="return filterData()">
          <div class="card mb-1">
            <div class="card-body p-2 px-4">
              <div class="row">
                <div class="col">
                  <label class="form-label" for="start_date">From</label>
                  <input id="start_date" class="form-control" type="date" onchange="document.querySelector('#end_date').min = this.value" required>
                </div>
                <div class="col">
                  <label class="form-label" for="end_date">To</label>
                  <input id="end_date" class="form-control" type="date" required>
                </div>
                <div class=" col-auto d-flex align-items-end">
                  <button type="submit" class="btn btn-falcon-primary">Filter</button>
                </div>
              </div>
            </div>
          </div>
        </form>
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
        <script>
          const start_date = document.querySelector("#start_date");
          const end_date = document.querySelector("#end_date");

          function filterData() {
            const formData = new FormData();
            formData.append("from", start_date.value);
            formData.append("to", end_date.value);
            fetch('../includes/load_ledgers.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', result);
              })
              .catch(error => {
                console.error('Error:', error);
              });
            return false;
          }
        </script>
</body>

</html>

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

        window.sessionStorage.clear();
        <?php
        include './components/tree_data_loader.php';
        ?>

        <?php
        include './components/n_tree_functions.php';
        ?>

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <h5 class="mb-2">Add Ledger</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="mb-3">
              <label class="form-label" for="ledger_name">Ledger Name</label>
              <input class="form-control" id="ledger_name" type="text" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="group_name">Group Name</label>
              <input list="group_names" class="form-select" name="group_name" id="group_name">
              <datalist id="group_names">
              </datalist>
            </div>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>

        <div class="card p-2 mt-1">
          <div class="row">
            <div class="col-auto">
              <button class="btn btn-falcon-primary">Submit</button>
            </div>
          </div>
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
          const group_names = document.querySelector("#group_names");

          window.addEventListener("populate_groups", (event) => {
            const group_dictionary = JSON.parse(event.detail);

            for (key in group_dictionary) {
              const opt = document.createElement("option");
              opt.setAttribute("value", group_dictionary[key].code);
              opt.appendChild(document.createTextNode(group_dictionary[key].name));
              group_names.appendChild(opt);
            }
          });
        </script>



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

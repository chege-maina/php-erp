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
  <!--    COMPONENT:: Include it -->
  <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
  <script src="../assets/js/vue"></script>
  <script src="../components/vue-components/fdatatable-list/dist/fdatatable-list.min.js"></script>
  <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
  <!-- ===============================================-->

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
        <h4 class="mb-2">Ledger List</h4>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <div id="datatable">
            </div>
          </div>
          <!-- Additional cards can be added here -->
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->

        <script>
          let updateTable = (data) => {
            const datatable = document.querySelector("#datatable");

            if (data.length <= 0) {
              return;
            }

            datatable.innerHTML = "";

            const elem = document.createElement("fdatatable-list");
            elem.setAttribute("json_header", JSON.stringify(getHeaders(data)));
            elem.setAttribute("json_items", JSON.stringify(getItems(data)));

            elem.setAttribute("manage_key", "ledger_name");
            elem.setAttribute("manage_key_2", "group_code");
            elem.setAttribute("redirect", getBaseUrl() + "/Accounts/edit_ledger_ui.php");
            // elem.classList.add("is-fullwidth");
            datatable.appendChild(elem);
          };


          window.addEventListener('DOMContentLoaded', (event) => {

            fetch('./php_scripts/get_ledgers.php')
              .then(response => response.json())
              .then(data => {
                console.log(data);
                updateTable(data);
              })
              .catch((error) => {
                console.error('Error:', error);
              });
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

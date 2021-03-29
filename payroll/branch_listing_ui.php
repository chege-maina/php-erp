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
        <h5 class="mb-0">Branch Listing</h5>
        <!-- ===============================================-->
        <!--    COMPONENT:: Add it -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
        <div class="card mt-1">
          <div class="card-header bg-light">
            <h6 class="mb-0">Branches</h6>
          </div>
          <div class="card-body fs--1 p-2">
            <!-- Content is to start here -->
            <div id="datatable">
            </div>
          </div>
        </div>

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

            elem.setAttribute("manage_key", "name");
            elem.setAttribute("redirect", getBaseUrl() + "/payroll/edit-branch-ui.php");
            // elem.classList.add("is-fullwidth");
            datatable.appendChild(elem);
          };

          window.addEventListener('DOMContentLoaded', (event) => {

            fetch('../payroll/branch_listing.php')
              .then(response => response.json())
              .then(data => {
                updateTable(data);
              })
              .catch((error) => {
                console.error('Error:', error);
              });
          });
        </script>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
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
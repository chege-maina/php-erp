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
        include './components/tree_data_loader.php';
        ?>

        <?php
        include './components/n_tree_functions.php';
        ?>

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="mb-2">Add Ledger</h5>
        <form action="post" onsubmit="return submitForm()">
          <div class="card">
            <div class="card-body fs--1 p-4">
              <!-- Content is to start here -->
              <div class="mb-3">
                <label class="form-label" for="ledger_name">Ledger Name</label>
                <input class="form-control" id="ledger_name" type="text" required />
              </div>
              <div class="mb-3">
                <label class="form-label" for="group_code">Group</label>
                <input list="group_names" class="form-select" name="group_code" id="group_code" required>
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
        </form>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
          const group_names = document.querySelector("#group_names");
          const group_code = document.querySelector("#group_code");
          const ledger_name = document.querySelector("#ledger_name");

          let ln, gc;

          window.addEventListener("populate_groups", (event) => {
            const group_dictionary = JSON.parse(event.detail);

            for (key in group_dictionary) {
              const opt = document.createElement("option");
              opt.setAttribute("value", group_dictionary[key].code);
              opt.appendChild(document.createTextNode(group_dictionary[key].name));
              group_names.appendChild(opt);
            }

            ln = window.sessionStorage.getItem("ledger_name");
            gc = window.sessionStorage.getItem("group_code");

            if (ln == null || gc == null) {
              location.replace("../Accounts/ledger_listing_ui.php");
            }

            ledger_name.value = ln;
            group_code.value = gc;
          });

          function submitForm() {
            const formData = new FormData();
            formData.append("ledger_name", ledger_name.value);
            formData.append("group_code", group_code.value);
            formData.append("prev_name", ln);

            fetch('./php_scripts/edit_ledger_entry.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Server says:', result);

                if (result["message"] == "success") {
                  const alertVar =
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Record saved.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                  var divAlert = document.querySelector("#alert-div");
                  divAlert.innerHTML = alertVar;
                  divAlert.scrollIntoView();
                  setTimeout(function() {
                    location.reload();
                    location.href = "../Accounts/ledger_listing_ui.php";
                  }, 2500);
                } else {
                  const alertVar =
                    `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Could not save record.
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
                return false;
              });

            return false;
          }
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

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
        <h5 class="p-2">Select Purchase Order</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row pb-2 ">
              <div class="col-sm-4 ">
                <label for="branch" class="form-label">Branch</label>
                <select name="branch" id="el_branch" class="form-select">
                  <option value="MM1">MM1</option>
                  <option value="MM2">MM2</option>
                </select>
              </div>

              <div class="col-auto d-flex align-items-end">
                <button class="btn btn-falcon-primary" type="button" onclick="filterRequisitions();">
                  <span type="submit" class="fas fa-filter mr-1" data-fa-transform="shrink-3"></span>Filter
                </button>
              </div>


            </div>
          </div>
          <div class="m-2 mb-2">
            <table class="table table-sm table-striped" id="table-main">
              <thead>
                <tr>
                  <th>Branch</th>
                  <th>Approved Requisitions</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="table_body">
              </tbody>
            </table>
          </div>
          <!-- Content ends here -->
        </div>
        <!-- Additional cards can be added here -->
      </div>
      <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
      <!-- body ends here -->
      <!-- =========================================================== -->

      <script>
        const branch = document.querySelector("#el_branch");
        const table_body = document.querySelector("#table_body");

        let updateTable = (data) => {
          table_body.innerHTML = "";

          if (data[0]['count'] <= 0) {
            return;
          }

          data.forEach(value => {
            const this_row = document.createElement("tr");

            const branch = document.createElement("td");
            branch.appendChild(document.createTextNode(value["branch"]));
            branch.classList.add("align-middle");

            const count = document.createElement("td");
            count.appendChild(document.createTextNode(value["count"]));
            count.classList.add("align-middle");

            const req_actions = document.createElement("td");
            const btn = document.createElement("button");
            btn.appendChild(document.createTextNode("Create Purchase Order"));
            btn.classList.add("btn", "btn-falcon-primary", "btn-sm");
            req_actions.appendChild(btn);

            this_row.append(branch, count, req_actions);
            table_body.appendChild(this_row);

          });
        }
        window.addEventListener('DOMContentLoaded', (event) => {
          fetch('../includes/load_purchase_branch.php')
            .then(response => response.json())
            .then(data => {
              updateTable(data);
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        });

        function filterRequisitions() {
          const formData = new FormData();

          formData.append("branch", branch.value);
          console.log(branch);

          fetch('../includes/load_purchase_branch_filter.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.json())
            .then(result => {
              updateTable(result);
            })
            .catch(error => {
              console.error('Error:', error);
            });
        }
      </script>




      <?php
      include '../includes/base_page/footer.php';
      ?>
    </div>
</body>

</html>

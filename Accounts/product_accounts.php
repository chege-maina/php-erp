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

<style>
  .vertical {
    border-left: 1px solid black;
    height: 200px;
  }
</style>


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
        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2">Accounts Mapping</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-0 pt-3 pl-3 position-relative">
            <table class="table table-sm table-hover table-striped">
              <thead>
                <tr>
                  <th></th>
                  <th>Select COA Group</th>
                  <th>Select COA Ledger</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <span>When Purchasing</span>
                  </td>
                  <td>
                    <input type="text" name="accounts" id="accounts" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="ledger" id="ledger" required>
                      <option value disabled selected>
                        -- Select COA Ledger --
                      </option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>When Selling</span>
                  </td>
                  <td>
                    <input type="text" name="accounts" id="accounts" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="ledger" id="ledger" required>
                      <option value disabled selected>
                        -- Select COA Ledger --
                      </option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span>When Carrying Forward</span>
                  </td>
                  <td>
                    <input type="text" name="accounts" id="accounts" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="ledger" id="ledger" required>
                      <option value disabled selected>
                        -- Select COA Ledger --
                      </option>
                    </select>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                Submit
              </button>
            </div>
          </div>
        </div>
      </div>

      <?php
      include '../includes/base_page/footer.php';
      ?>
    </div>
  </main>
</body>

</html>
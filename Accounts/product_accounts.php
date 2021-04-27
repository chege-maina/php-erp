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
            <div class="col col-6 mt-3 pr-3">
              <label class="form-label" for="b_product">Select Product*</label>
              <input list="b_product" class="form-select" name="b_product" id="b_product" required>
              <datalist id="b_product">
              </datalist>
              <div class="invalid-tooltip">This field cannot be left blank.</div>
            </div>
            <hr>
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
                    <input type="text" name="t_purchase" id="t_purchase" value="050201" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="s_purchase" id="s_purchase" required>
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
                    <input type="text" name="t_sale" id="t_sale" value="040101" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="s_sale" id="s_sale" required>
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
                    <input type="text" name="t_fw" id="t_fw" value="010301" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="s_fw" id="s_fw" required>
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

<script>
  const t_purchase = document.querySelector("#t_purchase");
  const t_sale = document.querySelector("#t_sale");
  const t_fw = document.querySelector("#t_fw");
  const s_purchase = document.querySelector("#s_purchase ");
  const s_sale = document.querySelector("#s_sale");
  const s_fw = document.querySelector("#s_fw");
  const b_product = document.querySelector("#b_product");


  window.addEventListener('DOMContentLoaded', (event) => {

    populateSelectElement("#s_sale", '../includes/load_sale_ledger.php', "ledger");
    populateSelectElement("#s_fw", '../includes/load_forward_ledger.php', "ledger");
    populateSelectElement("#s_purchase", '../includes/load_purchase_ledger.php', "ledger");

  });
</script>

<script>
  let select_data = {};

  fetch('../includes/load_product_code.php')
    .then(response => response.json())
    .then(data => {

      console.log(data);
      data.forEach((value) => {
        const opt = document.createElement("option");
        opt.appendChild(document.createTextNode(value['code'] + " (" + value['name'] + ")"));

        b_product.appendChild(opt);

        select_data[value['code'] + " (" + value['name'] + ")"] = value['code']

        updateBranchSelect();
      })



    })


  function updateBranchSelect() {
    // Clear it
    b_product.innerHTML = "";
    // Add the no-selectable item first
    opt = document.createElement("option");
    opt.appendChild(document.createTextNode("-- Select Product --"));
    opt.setAttribute("value", "");
    opt.setAttribute("disabled", "");
    opt.setAttribute("selected", "");
    b_product.appendChild(opt);
    // Populate combobox

    for (key in select_data) {
      let opt = document.createElement("option");

      opt.setAttribute("value", select_data[key].code);
      opt.appendChild(document.createTextNode(select_data[key].name));
      b_product.appendChild(opt);
    }
  }
</script>
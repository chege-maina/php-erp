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
              <input list="employee" class="form-select" name="b_product" id="employee_name" required>
              <datalist id="employee">
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
              <tbody id="table_body">
                <tr>
                  <td>
                    <span id="purchase">When Purchasing</span>
                  </td>
                  <td>
                    <input type="text" name="t_purchase" id="t_purchase" value="050201" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="s_purchase" id="s_purchase" required>
                      <option value disabled selected>
                        -- Select COA Ledger --
                      </option>
                      <option value="One">one</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <span id="sell">When Selling</span>
                  </td>
                  <td>
                    <input type="text" name="t_sale" id="t_sale" value="040101" class="form-control" readonly required>
                  </td>
                  <td>
                    <select class="form-select form-select-sm" name="s_sale" id="s_sale" required>
                      <option value disabled selected>
                        -- Select COA Ledger --
                      </option>
                      <option value="two">two</option>
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
  const s_purchase = document.querySelector("#s_purchase ");
  const s_sale = document.querySelector("#s_sale");
  const products = document.querySelector("#products");

  window.addEventListener('DOMContentLoaded', (event) => {

    populateSelectElement("#s_sale", '../includes/load_sale_ledger.php', "ledger");
    populateSelectElement("#s_purchase", '../includes/load_purchase_ledger.php', "ledger");

  });
</script>

<script>
  const employee = document.querySelector("#employee");
  const employee_name = document.querySelector("#employee_name");
  const all_employees = {};
  let all_benefits = {};

  window.addEventListener('DOMContentLoaded', (event) => {
    // const all_employees = JSON.parse(event.detail);

    fetch('../includes/load_product_code.php')
      .then(response => response.json())
      .then(result => {
        console.log("result", result)
        let opt = document.createElement("option");
        employee.innerHTML = "";

        result.forEach((employees) => {
          all_employees[employees["code"] + " " + employees["name"]] = employees;

        });

        for (key in all_employees) {
          const opt = document.createElement("option");
          opt.setAttribute("value", all_employees[key].name);
          opt.appendChild(document.createTextNode(all_employees[key].code));
          employee.appendChild(opt);
          console.log("just trying", all_employees)
          console.log("hey", all_employees[key].name);
        }


      })
      .catch((error) => {
        console.error('Error:', error);
      });

  });
</script>

<script>
  const table_body = document.querySelector("#table_body");
  const tmp_obj = {};

  let totals = [];

  function getItems() {

    table_body.childNodes.forEach(item => {
      if (item.childNodes.length < 7) {
        return false;
      }

      const t_status = item.childNodes[1].childNodes[1].innerHTML;
      const t_group = item.childNodes[3].childNodes[1].value;
      const t_code = item.childNodes[5].childNodes[1].value;



      totals.push({
        status: t_status,
        group_code: t_group,
        ledger: t_code,
      });
    });

    console.log("Hey there ", totals);

    tmp_obj["table_items"] = JSON.stringify(totals);
    console.log("==================================");
    console.log("tmp_obj", tmp_obj);
    console.log("==================================");

    return tmp_obj

  }

  function submitForm() {

    if (!employee_name.value) {
      return;
    }

    if (!s_purchase.value) {
      return;
    }

    if (!s_sale.value) {
      return;
    }




    let tmp_obj = getItems();

    let employee_details = {};
    let found = false;
    for (let key in all_employees) {
      const row = all_employees[key];
      if (row.name === employee_name.value) {
        employee_details = row;
        found = true;
      }
    }
    if (!found) {
      employee_name.focus();
      return false;
    }

    const code_var = employee_details.code;
    const name_var = employee_details.name;

    const formData = new FormData();
    formData.append("code", code_var);
    formData.append("name", name_var);
    for (let key in tmp_obj) {
      formData.append(key, tmp_obj[key]);
    }

    fetch('../includes/add_product_mapping.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log('Success:', result);

        window.setTimeout(() => {
          //TODO:  Show result
          location.reload();
        }, 2500);
      })
      .catch(error => {
        console.error('Error:', error);
      });
  }
</script>
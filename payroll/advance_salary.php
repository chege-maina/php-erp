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
        <div id="alert-div"></div>
        <h5 class="p-2">Advance Salary</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col col-md-5 my-4">
                <label for="#" class="form-label">Select Employee </label>
                <div class="input-group">
                  <input list="employee" name="employee_name" id="employee_name" class="form-select" required>
                  <datalist id="employee"></datalist>
                  <button type="button" class="btn btn-primary input-group-btn" onclick="addData()">
                    +
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Benefits</h6>
          </div>
          <div class="card-body fs--1 p-2">

            <div class=" table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Employee Number</th>
                    <th scope="col">First Name </th>
                    <th scope="col">Last Name</th>
                    <th scope="col">National ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date Issued</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                Submit
              </button>
            </div>
            <!-- Content ends here -->
          </div>
        </div>
      </div>
    </div>
    <!-- Additional cards can be added here -->
    </div>
    </div>
    <?php
    include '../includes/base_page/footer.php';
    ?>


    <script>
      //datalist 

      const employee = document.querySelector("#employee");
      const employee_name = document.querySelector("#employee_name");
      const all_employees = {};
      let employee_dict = {};
      let items_in_table = {};

      window.addEventListener('DOMContentLoaded', (event) => {
        const formData = new FormData();

        fetch('../payroll/load_bfemployee.php')
          .then(response => response.json())
          .then(result => {
            console.log(result)
            let opt = document.createElement("option");
            console.log(all_employees);
            result.forEach((employees) => {
              const employee_subtext =
                "National ID No# " + employees["nat"] + "  Employee No# " + employees["job"];
              const employee_key = employees["fname"] + " " + employees["lname"];
              employee_dict[employee_key] = employee_subtext;
              all_employees[employee_key] = employees;
              updateEmployeeSelect();
            });

          })
          .catch((error) => {
            console.error('Error:', error);
          });

      });
    </script>

    <script>
      const table_body = document.querySelector("#table_body");

      function addData() {
        if (!employee_name.value) {
          return;
        }


        const employee_row_to_add = all_employees[employee_name.value];
        items_in_table[employee_name.value] = employee_row_to_add;

        delete employee_dict[employee_name.value];

        updateTable();
        updateEmployeeSelect();
      }

      function updateEmployeeSelect() {
        // Clear it
        employee_name.value = "";
        employee.innerHTML = "";

        // Populate combobox
        for (key in employee_dict) {
          let opt = document.createElement("option");
          opt.appendChild(document.createTextNode(employee_dict[key]));
          opt.value = key;
          employee.appendChild(opt);
        }
      }

      function updateTable() {
        console.log("Rasta ", items_in_table);
        return;
        table_body.innerHTML = "";
        for (let item in items_in_table) {

          let tr = document.createElement("tr");
          // Id will be like 1Tank
          // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

          let employee_no = document.createElement("td");
          employee_no.appendChild(document.createTextNode(items_in_table[item].branch));
          employee_no.classList.add("align-middle");


          let firstname = document.createElement("td");
          firstname.appendChild(document.createTextNode(items_in_table[item].branch));
          firstname.classList.add("align-middle");


          let secondname = document.createElement("td");
          secondname.appendChild(document.createTextNode(items_in_table[item].branch));
          secondname.classList.add("align-middle");


          let national = document.createElement("td");
          national.appendChild(document.createTextNode(items_in_table[item].branch));
          national.classList.add("align-middle");


          let opening_balance = document.createElement("input");
          opening_balance.setAttribute("type", "number");
          opening_balance.setAttribute("required", "");
          opening_balance.classList.add("form-control", "form-control-sm", "align-middle");
          // opening_balance.setAttribute("data-ref", items_in_table[item]["name"]);
          opening_balance.setAttribute("min", 0);
          // opening_balance.setAttribute("max", items_in_table[item]['max']);

          // make sure the opening_balance is always greater than 0
          // opening_balance.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
          // opening_balance.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
          opening_balance.setAttribute("onclick", "this.select();");
          items_in_table[item]['opening_balance'] = ('opening_balance' in items_in_table[item] && items_in_table[item]['opening_balance'] >= 0) ?
            items_in_table[item]['opening_balance'] : 0;
          opening_balance.value = items_in_table[item]['opening_balance'];

          opening_balance.addEventListener("input", (event) => {
            items_in_table[item].opening_balance = Number(event.target.value);
          })
          let opening_balanceWrapper = document.createElement("td");
          opening_balanceWrapper.classList.add("m-2", "col-2");
          opening_balanceWrapper.appendChild(opening_balance);

          let adv_date = document.createElement("input");
          adv_date.setAttribute("type", "date");
          adv_date.setAttribute("required", "");
          adv_date.classList.add("form-control", "form-control-sm", "align-middle");
          // opening_balance.setAttribute("data-ref", items_in_table[item]["name"]);
          adv_date.setAttribute("onclick", "this.select();");

          let adv_dateWrapper = document.createElement("td");
          adv_dateWrapper.classList.add("m-2", "col-2");
          adv_dateWrapper.appendChild(adv_date);



          let actionWrapper = document.createElement("td");
          actionWrapper.classList.add("m-2");
          let action = document.createElement("button");
          action.setAttribute("id", items_in_table[item]["branch"]);
          action.setAttribute("onclick", "removeItem(this.id);");
          let icon = document.createElement("span");
          icon.classList.add("fas", "fa-minus", "mt-1");
          action.appendChild(icon);
          action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
          actionWrapper.appendChild(action);

          tr.append(employee_no,
            firstname,
            secondname,
            national,
            opening_balanceWrapper,
            adv_date,
            actionWrapper
          );
          table_body.appendChild(tr);

        }
        return;
      }

      function removeItem(item) {
        delete items_in_table[String(item)];
        employee_dict[item] = item;

        updateTable();
        updateEmployeeSelect();
      }


      function validateQuantity(elmt, value, max) {
        value = Number(value);
        max = Number(max);
        elmt.value = elmt.value <= 0 ? 1 : elmt.value;
        elmt.value = elmt.value > max ? max : elmt.value;
      }
    </script>

    <script>
      function getItems() {
        const tmp_obj = {};
        const table_body = document.querySelector("#table_body");
        const employee_name = document.querySelector("#employee_name");
        const benefits = [];

        table_body.childNodes.forEach(row => {
          const k_benefit = row.childNodes[0].innerHTML;
          benefits.push({
            benefit: k_benefit
          });
        });

        for (let key in all_employees[employee_name.value]) {
          tmp_obj[key] = all_employees[employee_name.value][key];
        }

        tmp_obj["table_items"] = JSON.stringify(benefits);
        console.log("==================================");
        console.log(tmp_obj);
        console.log("==================================");

        return tmp_obj
      }

      function submitForm() {
        let tmp_obj = getItems();

        const formData = new FormData();
        formData.append("type", "benefit");
        for (let key in tmp_obj) {
          formData.append(key, tmp_obj[key]);
        }

        // fetch goes here

        fetch('add_emoployee_benededuc.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(result => {
            console.log('Success:', result);

            setTimeout(function() {
              location.reload();
            }, 2500);

          })
          .catch(error => {
            console.error('Error:', error);
          });

        return false;
      }
    </script>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- Footer End -->
    <!-- =========================================================== -->
</body>

</html>
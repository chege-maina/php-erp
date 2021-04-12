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
        <h5 class="p-2">Leave Assignment</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">
            <!-- Content is to start here -->
            <div class="row justify-content-between">
              <div class="col">
                <label for="#" class="form-label">Select Employee </label>
                <input list="employee" name="employee_name" id="employee_name" class="form-select" required>
                <datalist id="employee"></datalist>
              </div>
              <div class="col">
                <!-- Make Combo -->
                <label class="form-label" for="branch">Leave Category*</label>
                <div class="input-group">
                  <button type="button" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addBenefit">
                    Add
                  </button>
                  <select class="form-select" name="branch" id="benefit_select">
                    <option value disabled selected>
                      -- Select Leave Category --
                    </option>
                  </select>
                  <div class="invalid-tooltip">This field cannot be left blank.</div>
                  <!-- Button trigger modal -->
                  <input type="button" value="+" class="btn btn-primary" onclick="addItem();">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Leave Categorys</h6>
          </div>
          <div class="card-body fs--1 p-2">

            <div class=" table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Leave Category</th>
                    <th scope="col">Number of Days</th>
                    <th scope="col">Opening Balance</th>
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

    <div class="modal fade" id="addBenefit" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog" role="document">

        <div class="modal-content border-0">
          <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
            <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-0">
            <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
              <h4 class="mb-1" id="addUnitLabel">Add Leave Category</h4>
            </div>
            <div class="p-4">
              <!-- Category Form -->
              <form id="add_bf_frm" name="add_bf_frm">
                <div class="p2">
                  <label for="modal_benefit_name" class="form-label">Leave Name*</label>
                  <input type="text" name="modal_benefit_name" id="modal_benefit_name" class="form-control" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_bf_submit" name="add_bf_submit" data-dismiss="modal">
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php
    include '../includes/base_page/footer.php';
    ?>

    <script>
      //Benefit module

      $(document).ready(function() {
        $('#add_bf_submit').click(function(e) {
          e.preventDefault();
          var cat_name = $('#modal_benefit_name').val();
          var data1 = {
            modal_benefit_name: cat_name
          }

          if (cat_name == '') {
            alert("Please complete form!")
          } else {
            var conf = confirm("Do You Want to Add a New Leave Category?")
            if (conf) {
              $.ajax({
                url: "../payroll/add_leave.php",
                method: "POST",
                data: data1,
                success: function(data) {
                  $('#add_bf_frm')[0].reset();
                  //$('form').trigger("reset");
                  if (data == 'New Leave Category Added Successfully') {
                    updateComboBoxes();
                  }
                  alert(data)
                }
              })

            }
          }
        })
      })

      const benefit_select = document.querySelector("#benefit_select");

      let items_in_table_a = {};
      let branch_dict = {};
      const table_body = document.querySelector("#table_body");

      fetch('../payroll/load_leave.php')
        .then(response => response.json())
        .then(data => {
          data.forEach((value) => {
            let opt = document.createElement("option");
            opt.appendChild(document.createTextNode(value['branch']));
            opt.value = value['branch'];
            benefit_select.appendChild(opt);
            // Update dicts
            branch_dict[value.branch] = value.branch;
            items_in_table_a = {};

            updateBranchSelect();
            updateTable();

            // removeSpinner();
          });
        });

      function updateBranchSelect() {
        // Clear it
        benefit_select.innerHTML = "";
        // Add the no-selectable item first
        opt = document.createElement("option");
        opt.appendChild(document.createTextNode("-- Select Leave Category --"));
        opt.setAttribute("value", "");
        opt.setAttribute("disabled", "");
        opt.setAttribute("selected", "");
        benefit_select.appendChild(opt);
        // Populate combobox
        for (key in branch_dict) {
          let opt = document.createElement("option");
          opt.appendChild(document.createTextNode(key));
          opt.value = key;
          benefit_select.appendChild(opt);
        }
      }


      // end of module 

      // begin the table section 

      function updateTable() {
        table_body.innerHTML = "";
        for (let item in items_in_table_a) {

          let tr = document.createElement("tr");

          let leave_name = document.createElement("td");
          leave_name.appendChild(document.createTextNode(items_in_table_a[item].branch));
          leave_name.classList.add("align-middle");

          // define number of days 
          let num_days = document.createElement("input");
          num_days.setAttribute("type", "number");
          num_days.setAttribute("required", "");
          num_days.classList.add("form-control", "form-control-sm", "align-middle");
          // num_days.setAttribute("data-ref", items_in_table_a[item]["name"]);
          num_days.setAttribute("min", 0);
          // num_days.setAttribute("max", items_in_table_a[item]['max']);

          // make sure the num_days is always greater than 0
          // num_days.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
          // num_days.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
          num_days.setAttribute("onclick", "this.select();");
          items_in_table_a[item]['num_days'] = ('num_days' in items_in_table_a[item] && items_in_table_a[item]['num_days'] >= 0) ?
            items_in_table_a[item]['num_days'] : 0;
          num_days.value = items_in_table_a[item]['num_days'];

          num_days.addEventListener("input", (event) => {
            items_in_table_a[item].num_days = Number(event.target.value);
          })
          let num_daysWrapper = document.createElement("td");
          num_daysWrapper.classList.add("m-2", "col-2");
          num_daysWrapper.appendChild(num_days);

          // define opening balance 
          let opening_balance = document.createElement("input");
          opening_balance.setAttribute("type", "number");
          opening_balance.setAttribute("required", "");
          opening_balance.classList.add("form-control", "form-control-sm", "align-middle");
          // opening_balance.setAttribute("data-ref", items_in_table_a[item]["name"]);
          opening_balance.setAttribute("min", 0);
          // opening_balance.setAttribute("max", items_in_table_a[item]['max']);

          // make sure the opening_balance is always greater than 0
          // opening_balance.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
          // opening_balance.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
          opening_balance.setAttribute("onclick", "this.select();");
          items_in_table_a[item]['opening_balance'] = ('opening_balance' in items_in_table_a[item] && items_in_table_a[item]['opening_balance'] >= 0) ?
            items_in_table_a[item]['opening_balance'] : 0;
          opening_balance.value = items_in_table_a[item]['opening_balance'];

          opening_balance.addEventListener("input", (event) => {
            items_in_table_a[item].opening_balance = Number(event.target.value);
          })
          let opening_balanceWrapper = document.createElement("td");
          opening_balanceWrapper.classList.add("m-2", "col-2");
          opening_balanceWrapper.appendChild(opening_balance);


          let actionWrapper = document.createElement("td");
          actionWrapper.classList.add("m-2");
          let action = document.createElement("button");
          action.setAttribute("id", items_in_table_a[item]["branch"]);
          action.setAttribute("onclick", "removeItem(this.id);");
          let icon = document.createElement("span");
          icon.classList.add("fas", "fa-minus", "mt-1");
          action.appendChild(icon);
          action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
          actionWrapper.appendChild(action);

          tr.append(leave_name,
            num_daysWrapper,
            opening_balanceWrapper,
            actionWrapper
          );
          table_body.appendChild(tr);


          // tr.append(branch_name, balance_td, units_td, quantityWrapper, actionWrapper);
          // table_body.appendChild(tr);

        }
        return;

      }

      function addItem() {
        if (!benefit_select.value) {
          return;
        }



        const branch_pricing = {
          branch: branch_dict[benefit_select.value],

          num_days: 0,
          opening_balance: 0,
        }
        console.log("branch_pricing", branch_pricing);
        items_in_table_a[benefit_select.value] = branch_pricing;

        delete branch_dict[benefit_select.value];

        updateTable();
        updateBranchSelect();
      }

      function removeItem(item) {
        delete items_in_table_a[String(item)];
        branch_dict[item] = item;

        updateTable();
        updateBranchSelect();
      }
    </script>

    <script>
      //datalist 

      const employee = document.querySelector("#employee");
      const employee_name = document.querySelector("#employee_name");
      const all_employees = {};

      window.addEventListener('DOMContentLoaded', (event) => {
        const formData = new FormData();

        fetch('../payroll/load_bfemployee.php')
          .then(response => response.json())
          .then(result => {
            console.log(result)
            let opt = document.createElement("option");

            result.forEach((employees) => {
              opt = document.createElement("option");
              opt.appendChild(document.createTextNode("National ID No# " + employees["nat"] + "  Employee No# " + employees["job"]));
              opt.value = employees["fname"] + " " + employees["lname"];
              all_employees[employees["fname"] + " " + employees["lname"]] = employees;
              employee.appendChild(opt);
            });

          })
          .catch((error) => {
            console.error('Error:', error);
          });

      });

      function getItems() {
        const tmp_obj = {};
        const table_body = document.querySelector("#table_body");
        const employee_name = document.querySelector("#employee_name");
        const benefits = [];

        table_body.childNodes.forEach(row => {
          const k_leave = row.childNodes[0].innerHTML;
          const k_num_days = row.childNodes[1].childNodes[0].value;
          const k_opening = row.childNodes[2].childNodes[0].value;
          benefits.push({
            empleave: k_leave,
            num_days: k_num_days,
            opening_balance: k_opening
          });
        });

        for (let key in all_employees[employee_name.value]) {
          tmp_obj[key] = all_employees[employee_name.value][key];
        }

        tmp_obj["table_items"] = JSON.stringify(benefits);
        console.log("==================================");
        console.log("try mee", tmp_obj);
        console.log("==================================");

        return tmp_obj
      }

      function submitForm() {
        let tmp_obj = getItems();

        const formData = new FormData();
        // formData.append("type", "deduction");
        for (let key in tmp_obj) {
          formData.append(key, tmp_obj[key]);
        }

        // fetch goes here

        fetch('add_empleave.php', {
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

      function validateQuantity(elmt, value, max) {
        value = Number(value);
        max = Number(max);
        elmt.value = elmt.value <= 0 ? 1 : elmt.value;
        elmt.value = elmt.value > max ? max : elmt.value;
      }
    </script>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- Footer End -->
    <!-- =========================================================== -->
</body>

</html>
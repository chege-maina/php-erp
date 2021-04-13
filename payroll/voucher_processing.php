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

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2">Voucher Processing</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row my-2">
              <div class="col">
                <label for="startdate" class="form-label">Date</label>
                <input type="date" name="startdate" id="startdate" class="form-control" required>
              </div>
              <div class="col">
                <label class="form-label" for="voucher">Select Voucher Type</label>
                <select class="form-select" name="voucher" id="voucher">
                  <option value disabled selected>
                  <option value="1">Journal</option>
                  <option value="2">Contract</option>
                  <option value="3">Credit</option>
                  <option value="3">Debit/option>
                  <option value="3">Expense</option>
                  <option value="3">Bank Reconciliation</option>
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col col-auto">
                <button type="button" class="btn btn-sm btn-primary" onclick="addItem();">
                  Add Row
                </button>
              </div>
            </div>
            <div class="row my-2">
              <div class=" table-responsive">
                <table class="table table-sm table-striped mt-0">
                  <thead>
                    <tr>
                      <th scope="col">Select Ledger</th>
                      <th scope="col">KES</th>
                      <th scope="col">Debit/Credit</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="c_table_body">
                  </tbody>
                </table>
              </div>
            </div>
            <hr>
            <div class="row my-2">
              <div class="col">
                <label for="duration" class="form-label">Voucher Description/Remarks </label>
                <textarea class="form-control" id="comment" aria-label="With textarea"></textarea>
              </div>
            </div>
            <hr>
            <div class="row my-2">
              <div class="col">
                <label for="debit" class="form-label">Total</label>
                <div class="input-group">
                  <input type="number" name="debit" id="debit" class="form-control" required>
                  <span class="input-group-text">
                    Debit
                  </span>
                </div>
              </div>
              <div class="col">
                <label for="credit" class="form-label">Total</label>
                <div class="input-group">
                  <input type="number" name="credit" id="credit" class="form-control" required>
                  <span class="input-group-text">
                    Credit
                  </span>
                </div>
              </div>
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
          </div>
        </div>
      </div>
    </div>
  </main>
</body>

<script>
  const items_in_table = {};
  const c_table_body = document.querySelector("#c_table_body");
  const ledgers = ['kuku', 'nyama', 'ugali'];

  function addLedgerOptions(elem) {
    ledgers.forEach(ledger => {
      const opt = document.createElement("option");
      opt.value = ledger;
      opt.appendChild(document.createTextNode(ledger));
      elem.appendChild(opt);
    })
  }

  function updateTable() {
    c_table_body.innerHTML = "";
    console.log(items_in_table);
    for (let item in items_in_table) {

      let tr = document.createElement("tr");

      // imagine this as the select ledger

      let kin_name = document.createElement("select");
      kin_name.setAttribute("required", "");
      kin_name.setAttribute("value", items_in_table[item].name);
      kin_name.classList.add("form-select", "form-select-sm", "align-middle");
      kin_name.addEventListener("change", event => {
        items_in_table[item].name = String(event.target.value);
      });
      addLedgerOptions(kin_name);
      let kin_name_wrapper = document.createElement("td");
      kin_name_wrapper.appendChild(kin_name);

      // imagine this as the KESH

      let num_days = document.createElement("input");
      num_days.setAttribute("type", "number");
      num_days.setAttribute("required", "");
      num_days.classList.add("form-control", "form-control-sm", "align-middle");
      // num_days.setAttribute("data-ref", items_in_table[item]["name"]);
      num_days.setAttribute("min", 0);
      // num_days.setAttribute("max", items_in_table[item]['max']);

      // make sure the num_days is always greater than 0
      // num_days.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // num_days.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      num_days.setAttribute("onclick", "this.select();");
      items_in_table[item]['num_days'] = ('num_days' in items_in_table[item] && items_in_table[item]['num_days'] >= 0) ?
        items_in_table[item]['num_days'] : 0;
      num_days.value = items_in_table[item]['num_days'];

      num_days.addEventListener("input", (event) => {
        items_in_table[item].num_days = Number(event.target.value);
      })
      let num_daysWrapper = document.createElement("td");
      num_daysWrapper.classList.add("m-2", "col-2");
      num_daysWrapper.appendChild(num_days);



      // imagine this as the debit or credit 

      let kin_phone = document.createElement("select");
      kin_phone.setAttribute("required", "");
      kin_phone.setAttribute("value", items_in_table[item].phone);
      kin_phone.classList.add("form-select", "form-select-sm", "align-middle");
      const opt1 = document.createElement("option");
      opt1.value = "Debit";
      opt1.appendChild(document.createTextNode("Debit"));

      const opt2 = document.createElement("option");
      opt2.value = "Credit";
      opt2.appendChild(document.createTextNode("Credit"));

      kin_phone.append(opt1, opt2);
      kin_phone.addEventListener("change", event => {
        items_in_table[item].phone = String(event.target.value);
      });
      let kin_phone_wrapper = document.createElement("td");
      kin_phone_wrapper.appendChild(kin_phone);

      let actionWrapper = document.createElement("td");
      actionWrapper.classList.add("m-2");
      let action = document.createElement("button");
      action.setAttribute("id", item);
      action.setAttribute("onclick", "removeItem(this.id);");

      action.appendChild(document.createTextNode("-"));
      action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
      actionWrapper.appendChild(action);

      tr.append(
        kin_name_wrapper,
        num_daysWrapper,
        kin_phone_wrapper,
        actionWrapper
      );
      c_table_body.appendChild(tr);
    }
    return;
  }


  function addItem() {
    const tmp = {
      name: "",
      num_days: 0,
      phone: "",
    }
    items_in_table[uuidv4()] = tmp;

    updateTable();
  }

  function removeItem(item) {
    delete items_in_table[String(item)];

    updateTable();
  }

  function validateQuantity(elmt, value, max) {
    value = Number(value);
    max = Number(max);
    elmt.value = elmt.value <= 0 ? 1 : elmt.value;
    elmt.value = elmt.value > max ? max : elmt.value;
  }
</script>
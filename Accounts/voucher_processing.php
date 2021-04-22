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
                  <option value disabled selected>-- Select Voucher --</option>
                  <option value="Journal">Journal</option>
                  <option value="Contra">Contra</option>
                  <option value="Credit">Credit</option>
                  <option value="Debit">Debit</option>\
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
                <label for="remarks" class="form-label">Voucher Description/Remarks*</label>
                <input name="remarks" class="form-control" style="height: 50px;" type="text" id="remarks" required>
              </div>
            </div>
            <hr>
            <div class="row my-2">
              <div class="col">
                <label for="debit" class="form-label">Total</label>
                <div class="input-group">
                  <input type="number" name="debit" id="debit" class="form-control" readonly required>
                  <span class="input-group-text">
                    Debit
                  </span>
                </div>
              </div>
              <div class="col">
                <label for="credit" class="form-label">Total</label>
                <div class="input-group">
                  <input type="number" name="credit" id="credit" class="form-control" readonly required>
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

      <?php
      include '../includes/base_page/footer.php';
      ?>

    </div>
  </main>
</body>

<script>
  const startdate = document.querySelector("#startdate");
  const voucher = document.querySelector("#voucher");
  const debit = document.querySelector("#debit");
  const credit = document.querySelector("#credit");
  const remarks = document.querySelector("#remarks");


  function getItems() {
    const tmp_obj = {};
    const types = [];
    c_table_body.childNodes.forEach(row => {

      const t_ledger = row.childNodes[0].childNodes[0].value;
      const t_kes = row.childNodes[1].childNodes[0].value;
      const t_credit = row.childNodes[2].childNodes[0].value;


      types.push({
        ledger: t_ledger,
        kes: t_kes,
        credit: t_credit,

      });
    });

    console.log("submitting", types);

    tmp_obj["table_items"] = JSON.stringify(types);
    console.log("==================================");
    console.log(tmp_obj);
    console.log("==================================");

    return tmp_obj
  }

  function submitForm() {

    if (!startdate.value) {
      return;
    }

    if (!voucher.value) {
      return;
    }

    if (!debit.value) {
      return;
    }

    if (!credit.value) {
      return;
    }

    if (!remarks.value) {
      return;
    }

    if (debit.value !== credit.value) {
      console.log("they are not equal ")
      return;
    }
    let tmp_obj = getItems();

    const formData = new FormData();
    formData.append("date", startdate.value);
    formData.append("type", voucher.value);
    formData.append("debit", debit.value);
    formData.append("credit", credit.value);
    formData.append("remarks", remarks.value);
    for (let key in tmp_obj) {
      formData.append(key, tmp_obj[key]);
    }

    // fetch goes here

    fetch('../includes/add_voucher.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.text())
      .then(result => {
        console.log('Success:', result);

        // setTimeout(function() {
        //   location.reload();
        // }, 2500);

      })
      .catch(error => {
        console.error('Error:', error);
      });

  }
</script>

<script>
  const items_in_table = {};
  const c_table_body = document.querySelector("#c_table_body");
  const ledgers = [];


  window.addEventListener('DOMContentLoaded', (event) => {
    fetch('../payroll/load_ledger_name.php')
      .then(response => response.json())
      .then(result => {

        console.log(result);

        result.forEach(row => {
          ledgers.push(row['ledger_name']);
        });

        console.log("hello", ledgers);

      })
      .catch((error) => {
        console.error('Error:', error);
      });

  });

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
        calculateDbCrTotals();
      })
      let num_daysWrapper = document.createElement("td");
      num_daysWrapper.classList.add("m-2", "col-2");
      num_daysWrapper.appendChild(num_days);



      // imagine this as the debit or credit 

      let account_type = document.createElement("select");
      account_type.setAttribute("required", "");
      account_type.setAttribute("value", items_in_table[item].phone);
      account_type.classList.add("form-select", "form-select-sm", "align-middle");
      account_type.addEventListener("change", event => {
        calculateDbCrTotals();
      });
      const opt1 = document.createElement("option");
      opt1.value = "Debit";
      opt1.appendChild(document.createTextNode("Debit"));

      const opt2 = document.createElement("option");
      opt2.value = "Credit";
      opt2.appendChild(document.createTextNode("Credit"));

      account_type.append(opt1, opt2);
      account_type.addEventListener("change", event => {
        items_in_table[item].phone = String(event.target.value);
      });
      let kin_phone_wrapper = document.createElement("td");
      kin_phone_wrapper.appendChild(account_type);

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

  function calculateDbCrTotals() {
    const table_body_elem = document.querySelector("#c_table_body");
    const accounts_totals = {
      Debit: 0,
      Credit: 0,
    }
    table_body_elem.childNodes.forEach(row => {
      accounts_totals[row.childNodes[2].childNodes[0].value] += Number(row.childNodes[1].childNodes[0].value);
    });
    console.log(accounts_totals);

    debit.value = accounts_totals.Debit;
    credit.value = accounts_totals.Credit;
  }


  function addItem() {
    const tmp = {
      name: "",
      num_days: 0,
      phone: "",
    }
    items_in_table[uuidv4()] = tmp;

    updateTable();
    calculateDbCrTotals();
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
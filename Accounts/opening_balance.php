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
        <h5 class="p-2">Add Opening Balances</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row my-2">
              <div class="col">
                <label class="form-label" for="account">Select Account</label>
                <select class="form-select" name="account" id="account">
                  <option value disabled selected>-- Select Account --</option>
                </select>
              </div>
              <div class="col">
                <label for="transdate" class="form-label">Transaction Date</label>
                <input type="date" name="transdate" id="transdate" class="form-control" required>
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
                      <th scope="col">Date</th>
                      <th scope="col">Voucher No#</th>
                      <th scope="col">Voucher Description</th>
                      <th scope="col">Amount</th>
                      <th scope="col">Debit/Credit</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="c_table_body">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!--card body -->

        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                Submit
              </button>
            </div>
          </div>
        </div>
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!--card content -->
      </div>
    </div>
  </main>
</body>

</html>

<script>
  const items_in_table = {};
  const c_table_body = document.querySelector("#c_table_body");
  const account = document.querySelector("#account");
  const transdate = document.querySelector("#transdate");

  window.addEventListener('DOMContentLoaded', (event) => {

    populateSelectElement("#account", '../payroll/load_ledger_name.php', "ledger_name");
  });

  function updateTable() {
    c_table_body.innerHTML = "";
    console.log(items_in_table);
    for (let item in items_in_table) {

      let tr = document.createElement("tr");



      // date
      let open_date = document.createElement("input");
      open_date.setAttribute("type", "date");
      open_date.setAttribute("required", "");
      open_date.classList.add("form-control", "form-control-sm", "align-middle");
      open_date.setAttribute("onclick", "this.select();");

      open_date.addEventListener("input", (event) => {
        items_in_table[item].open_date = event.target.value;
      })
      let open_dateWrapper = document.createElement("td");
      open_dateWrapper.classList.add("m-2", "col-2");
      open_dateWrapper.appendChild(open_date);

      // Vourcher Number

      let voucher_num = document.createElement("input");
      voucher_num.setAttribute("type", "number");
      voucher_num.setAttribute("required", "");
      voucher_num.classList.add("form-control", "form-control-sm", "align-middle");
      // voucher_num.setAttribute("data-ref", items_in_table[item]["name"]);
      voucher_num.setAttribute("min", 0);
      // voucher_num.setAttribute("max", items_in_table[item]['max']);

      // make sure the voucher_num is always greater than 0
      // voucher_num.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // voucher_num.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      voucher_num.setAttribute("onclick", "this.select();");
      items_in_table[item]['voucher_num'] = ('voucher_num' in items_in_table[item] && items_in_table[item]['voucher_num'] >= 0) ?
        items_in_table[item]['voucher_num'] : 0;
      voucher_num.value = items_in_table[item]['voucher_num'];

      voucher_num.addEventListener("input", (event) => {
        items_in_table[item].voucher_num = Number(event.target.value);
      })
      let voucher_numWrapper = document.createElement("td");
      voucher_numWrapper.classList.add("m-2", "col-2");
      voucher_numWrapper.appendChild(voucher_num);

      // Voucher Description

      let desc = document.createElement("input");
      desc.setAttribute("type", "text");
      desc.setAttribute("required", "");
      desc.classList.add("form-control", "form-control-sm", "align-middle");
      desc.setAttribute("onclick", "this.select();");

      desc.addEventListener("input", (event) => {
        items_in_table[item].desc = event.target.value;
      })
      let descWrapper = document.createElement("td");
      descWrapper.classList.add("m-2", "col-2");
      descWrapper.appendChild(desc);

      //Amount

      let amount = document.createElement("input");
      amount.setAttribute("type", "number");
      amount.setAttribute("required", "");
      amount.classList.add("form-control", "form-control-sm", "align-middle");
      // amount.setAttribute("data-ref", items_in_table[item]["name"]);
      amount.setAttribute("min", 0);
      // amount.setAttribute("max", items_in_table[item]['max']);

      // make sure the amount is always greater than 0
      // amount.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // amount.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      amount.setAttribute("onclick", "this.select();");
      items_in_table[item]['amount'] = ('amount' in items_in_table[item] && items_in_table[item]['amount'] >= 0) ?
        items_in_table[item]['amount'] : 0;
      amount.value = items_in_table[item]['amount'];

      amount.addEventListener("input", (event) => {
        items_in_table[item].amount = Number(event.target.value);
      })
      let amountWrapper = document.createElement("td");
      amountWrapper.classList.add("m-2", "col-2");
      amountWrapper.appendChild(amount);

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
        open_dateWrapper,
        voucher_numWrapper,
        descWrapper,
        amountWrapper,
        kin_phone_wrapper,
        actionWrapper
      );
      c_table_body.appendChild(tr);
    }
    return;
  }

  function addItem() {
    const tmp = {
      open_date: "",
      voucher_num: 0,
      desc: "",
      amount: 0,
      kin_phone: "",
    }
    items_in_table[uuidv4()] = tmp;

    updateTable();
  }

  function removeItem(item) {
    delete items_in_table[String(item)];

    updateTable();
  }

  function getItems() {
    const tmp_obj = {};
    const openings = [];
    c_table_body.childNodes.forEach(row => {

      const k_date = row.childNodes[0].childNodes[0].value;
      const k_voucher = row.childNodes[1].childNodes[0].value;
      const k_desc = row.childNodes[2].childNodes[0].value;
      const k_amount = row.childNodes[3].childNodes[0].value;
      const k_type = row.childNodes[4].childNodes[0].value;

      openings.push({
        date: k_date,
        voucher: k_voucher,
        desc: k_desc,
        amount: k_amount,
        type: k_type,

      });
    });

    console.log("submitting", openings);

    tmp_obj["table_items"] = JSON.stringify(openings);
    console.log("==================================");
    console.log(tmp_obj);
    console.log("==================================");

    return tmp_obj
  }

  function submitForm() {

    if (!account.value) {
      return;
    }

    if (!transdate.value) {
      return;
    }
    let tmp_obj = getItems();

    const formData = new FormData();
    formData.append("account", account.value);
    formData.append("date", transdate.value);
    for (let key in tmp_obj) {
      formData.append(key, tmp_obj[key]);
    }

    // fetch goes here

    fetch('#.php', {
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
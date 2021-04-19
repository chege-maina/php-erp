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
                <label class="form-label" for="voucher">Select Account</label>
                <select class="form-select" name="voucher" id="voucher">
                  <option value disabled selected>-- Select Account --</option>
                </select>
              </div>
              <div class="col">
                <label for="startdate" class="form-label">Transaction Date</label>
                <input type="date" name="startdate" id="startdate" class="form-control" required>
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

            <!--card body -->
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
      // opening_balance.setAttribute("data-ref", items_in_table[item]["name"]);
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


      //Amount

      let rate = document.createElement("input");
      rate.setAttribute("type", "number");
      rate.setAttribute("required", "");
      rate.classList.add("form-control", "form-control-sm", "align-middle");
      // rate.setAttribute("data-ref", items_in_table[item]["name"]);
      rate.setAttribute("min", 0);
      // rate.setAttribute("max", items_in_table[item]['max']);

      // make sure the rate is always greater than 0
      // rate.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // rate.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      rate.setAttribute("onclick", "this.select();");
      items_in_table[item]['rate'] = ('rate' in items_in_table[item] && items_in_table[item]['rate'] >= 0) ?
        items_in_table[item]['rate'] : 0;
      rate.value = items_in_table[item]['rate'];

      rate.addEventListener("input", (event) => {
        items_in_table[item].rate = Number(event.target.value);
      })
      let rateWrapper = document.createElement("td");
      rateWrapper.classList.add("m-2", "col-2");
      rateWrapper.appendChild(rate);

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
        kin_phone_wrapper,
        actionWrapper
      );
      c_table_body.appendChild(tr);
    }
    return;
  }
</script>
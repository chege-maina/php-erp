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
        <h5 class="p-2">Create Sales Quotation</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">
            <!-- Content is to start here -->
            <div class="row b-3">
              <div class="col">
                <label for="date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="time" class="form-label">Time</label>
                <!-- autofill current date  -->
                <input type="time" id="time" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="#" class="form-label">Valid Until </label>
                <input type="date" id="valid_until" class="form-control">
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <label for="browser" class="form-label">Select Customer</label>
                <input list="customerlist" id="customer" class="form-select">
                <datalist id="customerlist" class="bg-light"></datalist>
              </div>
              <div class="col">
                <label for="tax_pc" class="form-label">Tax*</label>
                <div class="input-group">
                  <select id="tax_pc" class="form-select" required>
                    <option value=null disabled selected>-- Select Tax -- </option>
                  </select>
                  <span class="input-group-text">%</span>
                </div>
              </div>
              <div class="col">
                <label for="browser" class="form-label">Add Items to Quotation</label>
                <div class="input-group">
                  <input list="items_quote" id="quotable_items" class="form-select" required>
                  <datalist id="items_quote" class="bg-light"></datalist>
                  <input type="button" value="+" class="btn btn-primary" onclick="addItem('#quotable_items');">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-2">

            <div class=" table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Units</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
              </table>
            </div>

            <div class="row m-3">
              <div class="col text-right fw-bold">
                Total Before Tax</div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="number" readonly id="total_before_tax" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Tax 16 %
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="number" readonly id="tax_pc" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Quotation
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="number" readonly id="po_total" />
              </div>
            </div>
          </div>
        </div>
        <div class="card mt-1">
          <div class="card-body fs--1 p-1">
            <div class="d-flex flex-row-reverse">
              <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
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
      const po_time = document.querySelector("#time");
      const valid_until = document.querySelector('#valid_until');
      const table_body = document.querySelector('#table_body');

      let all_items = {};
      let all_quotable_items = {};
      let table_items = [];

      function addItem(elem) {
        elem = document.querySelector(elem);
        if (!elem.validity.valid) {
          elem.focus();
          return;
        }

        const item_to_add = all_items[elem.value];
        if (!item_to_add) {
          return;
        }

        table_items.push(item_to_add);
        delete all_items[elem.value];
        updateTable();
        updateQuotableItems();
      }

      function removeItem(item) {

        for (key in table_items) {
          if (table_items[key].name === item) {
            table_items[key]['quantity'] = 0;
            table_items.pop(item);
          }
        }
        const item_to_add = all_quotable_items[item];
        all_items[item] = item_to_add;
        updateTable();
        updateQuotableItems();
      }

      function updateTable() {
        table_body.innerHTML = "";
        console.log("table", table_items);
        for (let item in table_items) {

          let tr = document.createElement("tr");
          // Id will be like 1Tank
          tr.setAttribute("id", table_items[item]["code"] + table_items[item]["name"]);

          let code_td = document.createElement("td");
          code_td.appendChild(document.createTextNode(table_items[item]["code"]));
          code_td.classList.add("align-middle");

          let name_td = document.createElement("td");
          name_td.appendChild(document.createTextNode(table_items[item]["name"]));
          name_td.classList.add("align-middle");

          let price_td = document.createElement("td");
          price_td.appendChild(document.createTextNode(table_items[item]["price"]));
          price_td.classList.add("align-middle");

          let units_td = document.createElement("td");
          units_td.appendChild(document.createTextNode(table_items[item]["unit"]));
          units_td.classList.add("align-middle");

          let total_td = document.createElement("td");
          total_td.appendChild(document.createTextNode("0.00"));
          total_td.classList.add("align-middle");

          let quantity = document.createElement("input");
          quantity.setAttribute("type", "number");
          quantity.setAttribute("required", "");
          quantity.classList.add("form-control", "form-control-sm", "align-middle");
          quantity.setAttribute("data-ref", table_items[item]["name"]);
          quantity.setAttribute("min", 1);
          quantity.setAttribute("max", table_items[item]['max']);

          // make sure the quantity is always greater than 0
          quantity.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
          quantity.setAttribute("onkeyup", "addQuantity(this.dataset.ref, this.value, this.max);");
          quantity.setAttribute("onclick", "this.select();");
          table_items[item]['quantity'] = ('quantity' in table_items[item] && table_items[item]['quantity'] > 0) ?
            table_items[item]['quantity'] : 1;
          quantity.value = table_items[item]['quantity'];
          let quantityWrapper = document.createElement("td");
          quantityWrapper.classList.add("m-2");
          quantityWrapper.appendChild(quantity);

          let actionWrapper = document.createElement("td");
          actionWrapper.classList.add("m-2");
          let action = document.createElement("button");
          action.setAttribute("id", table_items[item]["name"]);
          action.setAttribute("onclick", "removeItem(this.id);");
          let icon = document.createElement("span");
          icon.classList.add("fas", "fa-minus", "mt-1");
          action.appendChild(icon);
          action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
          actionWrapper.appendChild(action);

          tr.append(code_td, name_td, price_td, units_td, quantityWrapper, total_td, actionWrapper);
          table_body.appendChild(tr);

        }
        return;
      }

      function addQuantity(item, value, max) {
        value = Number(value);
        max = Number(max);
        value = value <= 0 ? 1 : value;
        value = value > max ? max : value;
        console.log(item, table_items);
        for (key in table_items) {
          if (table_items[key]['name'] === item) {
            table_items[key]['quantity'] = value;
          }
        }

        console.log(value);
      }

      function validateQuantity(elmt, value, max) {
        value = Number(value);
        max = Number(max);
        elmt.value = elmt.value <= 0 ? 1 : elmt.value;
        elmt.value = elmt.value > max ? max : elmt.value;
      }


      const items_quote = document.querySelector('#items_quote');
      const quotable_items = document.querySelector('#quotable_items');

      let updateQuotableItems = () => {
        console.log(all_items)
        items_quote.innerHTML = "";
        quotable_items.value = "";
        for (const key in all_items) {
          let value = all_items[key];
          console.log(value);
          let opt = document.createElement("option");
          opt.value = value["name"];
          opt.appendChild(document.createTextNode(value["name"]));
          items_quote.appendChild(opt);
        }
      }



      document.addEventListener('DOMContentLoaded', function() {
        const today = addDays(new Date(), 1);
        console.log(today);

        const dateMax = addDays(today, 7);
        let month = d_toString(dateMax.getMonth() + 1);
        let day = d_toString(dateMax.getDate());
        valid_until.setAttribute("min", String(dateMax.getFullYear()) + '-' + month + '-' + day);
        valid_until.setAttribute("value", String(dateMax.getFullYear()) + '-' + month + '-' + day);
        populateDatalist('../includes/load_customer.php', "customerlist", "name", "terms");
        populateDatalist('../includes/load_items_quote.php', "items_quote", "name");
        populateDatalist('../includes/load_tax.php', "tax_pc", "tax");

        fetch('../includes/load_items_quote.php')
          .then(response => response.json())
          .then(result => {
            result.forEach((item) => {
              all_items[item.name] = item;
              all_quotable_items[item.name] = item;
            })
            console.log("All items", all_items);
          })
          .catch(error => {
            console.error('Error:', error);
          });


      });
    </script>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- Footer End -->
    <!-- =========================================================== -->
</body>

</html>
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
                <input type="date" id="valid_until" class="form-control" required>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col">
                <label for="browser" class="form-label">Select Customer</label>
                <input list="customerlist" id="customer" class="form-select" required>
                <datalist id="customerlist" class="bg-light"></datalist>
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
                    <th scope="col">Tax %</th>
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
                <input class="form-control form-control-sm text-right" type="text" readonly id="total_before_tax" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Tax 16 %
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="text" readonly id="tax_total" />
              </div>
            </div>
            <div class="row m-3">
              <div class="col text-right fw-bold">
                Quotation
              </div>
              <div class="col col-auto">
                <input class="form-control form-control-sm text-right" type="text" readonly id="po_total" />
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
      const items_quote = document.querySelector('#items_quote');
      const quotable_items = document.querySelector('#quotable_items');
      const customer = document.querySelector("#customer");
      const valid_until_elem = document.querySelector("#valid_until");
      const date_e = document.querySelector("#date");
      const time_t = document.querySelector("#time");


      let all_items = {};
      let all_quotable_items = {};
      let table_items = [];
      let all_customers;

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
            table_items.splice(key, 1);
          }
        }
        const item_to_add = all_quotable_items[item];
        all_items[item] = item_to_add;
        updateTable();
        updateQuotableItems();
      }

      function submitForm() {
        if (table_items.length <= 0) {
          quotable_items.focus();
          return;
        } else if (!valid_until_elem.validity.valid) {
          valid_until_elem.focus();
          return;
        } else if (!customer.validity.valid) {
          customer.focus();
          return;
        }
        const formData = new FormData();
        formData.append("date", date_e.value);
        formData.append("time", time_t.value);
        formData.append("customer", customer.value);
        formData.append("sub_total", po_total_a.getNumericString());
        formData.append("due_date", valid_until_elem.value);
        formData.append("tax", tax_total_a.getNumericString());

        let terms;
        all_customers.forEach(one => {
          if (one["name"] == customer.value) {
            terms = one["terms"];
          }
        })

        formData.append("terms", terms);
        formData.append("user", user_name);
        formData.append("amount", po_total_a.getNumericString());

        let sendable_table = [];
        table_items.forEach(item => {
          sendable_table.push({
            p_code: item.code,
            p_name: item.name,
            p_tax_pc: item.tax,
            p_units: item.unit,
            p_price: item.bs_price,
            p_amount: item.total,
            p_tax: item.tax_amt,
            p_conversion: item.conversion,
            p_atomic_unit: item.atomic_unit,
            p_atomic_price: item.price,
            p_selected_unit: item.current_unit,
            p_quantity: item.current_unit === "unit" ?
              item.quantity : item.quantity / item.conversion,
            p_entered_price: item.current_unit === "unit" ?
              item.bs_price : item.price
          })
        })

        console.log(sendable_table, " : ", table_items);
        formData.append("table_items", JSON.stringify(sendable_table));

        fetch('../includes/add_quotation.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(result => {
            const alertVar =
              `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Quotation created successfully
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
            var divAlert = document.querySelector("#alert-div");
            divAlert.innerHTML = alertVar;
            divAlert.scrollIntoView();

            // return;
            window.setTimeout(() => {
              divAlert.innerHTML = "";
              location.reload();
            }, 2500);

          })
          .catch(error => {
            console.error('Error:', error);
          });
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

          let r_id = "_s_s_s_" + uuidv4();

          let price_td = document.createElement("td");
          price_td.id = "prc" + r_id;
          price_td.appendChild(document.createTextNode(table_items[item]["price"]));
          price_td.classList.add("align-middle");

          let units_td = document.createElement("td");
          units_td.classList.add("align-middle", "col-md-2");

          let unit_select = document.createElement("select");
          unit_select.id = "sel" + r_id;
          unit_select.addEventListener("change", event => {
            unitChanged(event.target.id, event.target.value);
          });
          unit_select.classList.add("form-select", "form-select-sm");
          let opt_atomic = document.createElement("option");
          opt_atomic.appendChild(document.createTextNode(table_items[item]["atomic_unit"]));
          opt_atomic.value = table_items[item]["atomic_unit"];
          table_items[item]['current_unit'] = "atomic_unit";
          let opt_bulk = document.createElement("option");
          opt_bulk.appendChild(document.createTextNode(table_items[item]["unit"]));
          opt_bulk.value = table_items[item]["unit"];

          unit_select.append(opt_atomic, opt_bulk);
          units_td.appendChild(unit_select);

          let quantity = document.createElement("input");
          quantity.id = "qtt" + r_id;
          quantity.setAttribute("type", "number");
          quantity.setAttribute("required", "");
          quantity.classList.add("form-control", "form-control-sm", "align-middle");
          quantity.setAttribute("data-ref", table_items[item]["name"]);
          quantity.setAttribute("min", 1);
          quantity.setAttribute("max", table_items[item]['max']);

          // make sure the quantity is always greater than 0
          quantity.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
          quantity.setAttribute("onkeyup", "addQuantity(this.dataset.ref, this.value, this.max, this);");
          quantity.setAttribute("onclick", "this.select();");
          table_items[item]['quantity'] = ('quantity' in table_items[item] && table_items[item]['quantity'] > 0) ?
            table_items[item]['quantity'] : 1;
          quantity.value = table_items[item]['quantity'];
          let quantityWrapper = document.createElement("td");
          quantityWrapper.classList.add("m-2", "col-md-2");
          quantityWrapper.appendChild(quantity);

          let tax_td = document.createElement("td");
          table_items[item]["tax_amt"] =
            ((Number(table_items[item]["tax"]) / 100) *
              Number(table_items[item]["quantity"]) *
              Number(table_items[item]["price"])).toFixed(2);
          tax_td.appendChild(document.createTextNode(table_items[item]["tax_amt"]));
          tax_td.setAttribute("id", "t-" + table_items[item]["code"]);
          tax_td.classList.add("align-middle");

          let total_td = document.createElement("td");
          total_td.setAttribute("id", "td-" + table_items[item]["code"]);
          table_items[item]["total"] =
            (((Number(table_items[item]["tax"]) / 100) + 1) *
              Number(table_items[item]["quantity"]) *
              Number(table_items[item]["price"])).toFixed(2);
          total_td.appendChild(document.createTextNode(table_items[item]["total"]));
          total_td.classList.add("align-middle");

          let actionWrapper = document.createElement("td");
          actionWrapper.classList.add("m-2");
          let action = document.createElement("button");
          action.setAttribute("onclick", "removeItem('" + table_items[item]["name"] + "');");
          let icon = document.createElement("span");
          icon.classList.add("fas", "fa-minus", "mt-1");
          action.appendChild(icon);
          action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
          actionWrapper.appendChild(action);

          tr.append(code_td, name_td, price_td, units_td, quantityWrapper, tax_td, total_td, actionWrapper);
          table_body.appendChild(tr);

        }
        cumulative_total();
        return;
      }

      function addQuantity(item, value, max, elem) {
        value = Number(value);
        max = Number(max);
        value = value <= 0 ? 1 : value;
        value = value > max ? max : value;
        const unit = document.getElementById("sel_s_s_s_" + elem.id.split("_s_s_s_")[1]).value;
        const price_widget = document.getElementById("prc_s_s_s_" + elem.id.split("_s_s_s_")[1]);
        console.log("Unit: ", unit, table_items);
        for (key in table_items) {
          if (table_items[key]['name'] === item) {

            const price_key = table_items[key].atomic_unit == unit ? "price" : "bs_price";
            table_items[key]['current_unit'] = table_items[key].atomic_unit == unit ?
              "atomic_unit" : "unit";
            price_widget.innerHTML = "";
            price_widget.appendChild(document.createTextNode(table_items[key][price_key]));

            table_items[key]['quantity'] = value;

            table_items[key]["tax_amt"] =
              ((Number(table_items[key]["tax"]) / 100) *
                Number(table_items[key]["quantity"]) *
                Number(table_items[key][price_key])).toFixed(2);

            // Update tax calculations
            table_items[key]["total"] =
              (((Number(table_items[key]["tax"]) / 100) + 1) *
                Number(table_items[key]["quantity"]) *
                Number(table_items[key][price_key])).toFixed(2);
            const tax_td = document.querySelector("#t-" + table_items[key]["code"]);
            const total_td = document.querySelector("#td-" + table_items[key]["code"]);
            total_td.innerHTML = "";
            tax_td.innerHTML = "";
            tax_td.appendChild(document.createTextNode(table_items[key]["tax_amt"]));
            total_td.appendChild(document.createTextNode(table_items[key]["total"]));
          }
        }
        cumulative_total();
      }

      function validateQuantity(elmt, value, max) {
        value = Number(value);
        max = Number(max);
        elmt.value = elmt.value <= 0 ? 1 : elmt.value;
        elmt.value = elmt.value > max ? max : elmt.value;
      }


      const total_before_tax = document.querySelector("#total_before_tax");
      const tax_total = document.querySelector("#tax_total");
      const po_total = document.querySelector("#po_total");

      const total_before_tax_a = new AutoNumeric(total_before_tax, {
        currencySymbol: '',
        minimumValue: 0
      });
      const tax_total_a = new AutoNumeric(tax_total, {
        currencySymbol: '',
        minimumValue: 0
      });
      const po_total_a = new AutoNumeric(po_total, {
        currencySymbol: '',
        minimumValue: 0
      });

      let cumulative_total = () => {
        let before_tax = 0;
        let total_tax = 0;
        let quotation_total = 0;
        table_items.forEach(item => {
          console.log("Yaaah", item);
          const price_key = "atomic_unit" == item.current_unit ? "price" : "bs_price";
          before_tax += Number(item[price_key]) * item["quantity"];
          total_tax += Number(item.tax_amt);
          quotation_total += Number(item.total);
        });
        total_before_tax_a.set(before_tax);
        tax_total_a.set(total_tax);
        po_total_a.set(quotation_total);
      }


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

        fetch('../includes/load_customer.php')
          .then(response => response.json())
          .then(data => {
            all_customers = data;
          })
          .catch((error) => {
            console.error('Error:', error);
          });

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

      document.addEventListener('DOMContentLoaded', function() {
        const date = new Date();
        let month = d_toString(date.getMonth() + 1);
        let day = d_toString(date.getDate());
        let hours = d_toString(date.getHours());
        let minutes = d_toString(date.getMinutes());


        po_time.value = hours + ":" + minutes;
      });

      function unitChanged(id, val) {
        const qtt = document.getElementById("qtt_s_s_s_" + id.split("_s_s_s_")[1]);
        addQuantity(qtt.dataset.ref, qtt.value, qtt.max, qtt);
      }
    </script>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- Footer End -->
    <!-- =========================================================== -->
</body>

</html>

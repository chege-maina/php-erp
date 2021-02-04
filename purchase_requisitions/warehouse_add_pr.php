<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
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
        <h5 class="p-2">Add Purchase Requisition</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="requisition_number" class="form-label">Requisition Number*</label>
                <input type="number" name="requisition_number" id="requisition_number" class="form-control">
              </div>
              <div class="col">
                <label for="requisition_date" class="form-label">Date</label>
                <!-- autofill current date  -->
                <input type="date" name="requisition_date" id="requisition_date" class="form-control">
              </div>
              <div class="col">
                <label for="requisition_time" class="form-label">Time</label>
                <!-- autofill current time  -->
                <input type="time" name="requisition_time" id="requisition_time" class="form-control">
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <label for="browser" class="form-label">Items to Requisition</label>
                <div class="input-group">
                  <input list="requisitionable_items" name="requisitionable_item" id="requisitionable_item" class="form-select">

                  <datalist id="requisitionable_items" class="bg-light">
                    <option value="Tank">Remaining 2 pieces</option>
                    <option value="Steel">
                    <option value="Box profile tile">
                    <option value="12 Gauge Steel">
                    <option value="Marble">
                  </datalist>
                  <input type="button" value="+" class="btn btn-primary" onclick="addItem();">
                </div>
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Product Code</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Units</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">
                    <tr>
                      <th>033</th>
                      <td>Roto</td>
                      <td>Pieces</td>
                      <td>3</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
          const requisitionable_items = {
            Tank: {
              name: "Tank",
              code: 33,
              units: "Kg",
            },
            Steel: {
              name: "Steel",
              code: 52,
              units: "Pcs",
            }
          }
          const requisitionable_item = document.querySelector("#requisitionable_item");
          const requisition_date = document.querySelector("#requisition_date");
          const requisition_number = document.querySelector("#requisition_number");
          const requisition_time = document.querySelector("#requisition_time");
          const table_body = document.querySelector("#table_body");

          function addItem() {
            const item_to_add = requisitionable_items[requisitionable_item.value]
            if (!item_to_add) {
              return;
            }
            console.log(item_to_add);
            let tr = document.createElement("tr");

            let code_td = document.createElement("td");
            code_td.appendChild(document.createTextNode(item_to_add["code"]));
            code_td.classList.add("align-middle");

            let name_td = document.createElement("td");
            name_td.appendChild(document.createTextNode(item_to_add["name"]));
            name_td.classList.add("align-middle");

            let units_td = document.createElement("td");
            units_td.appendChild(document.createTextNode(item_to_add["units"]));
            units_td.classList.add("align-middle");

            let quantity = document.createElement("input");
            quantity.setAttribute("type", "number");
            quantity.setAttribute("required", "");
            quantity.classList.add("form-control", "form-control-sm");
            let quantityWrapper = document.createElement("td");
            quantityWrapper.classList.add("m-2");
            quantityWrapper.appendChild(quantity);
            tr.append(code_td, name_td, units_td, quantityWrapper);
            table_body.appendChild(tr);
          }
        </script>


        <!-- =========================================================== -->
        <!-- Footer Begin -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
</body>

</html>
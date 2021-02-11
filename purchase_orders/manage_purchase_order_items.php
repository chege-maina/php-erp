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
        <h5 class="p-2">Manage Purchase Order Items</h5>
        <div class="card">

          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="supplier_name" class="form-label">Supplier Name*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="branch" class="form-label">Branch*</label>
                <input type="text" name="branch" id="po_branch" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="date" class="form-label">Purchase Date</label>
                <!-- autofill current date  -->
                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="created_by" class="form-label">Created By</label>
                <input type="text" id="created_by" class="form-control" readonly>
              </div>

            </div>
          </div>
        </div>


        <div class="card mt-1">
          <div class="card-header bg-light p-2 pt-3 pl-3">
            <h6>Products</h6>
          </div>
          <div class="card-body fs--1 p-2">
            <div class="table-responsive">
              <table class="table table-sm table-striped mt-0">
                <thead>
                  <tr>
                    <th scope="col">Product Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Units</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Unit Cost</th>
                    <th scope="col">Total</th>
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
                Purchase Order Total
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

        <!-- Additional cards can be added here -->


      </div>
    </div>
    <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
    <!-- body ends here -->
    <!-- =========================================================== -->
    <script>
      const supplier_name = document.querySelector("#supplier_name");
      const po_branch = document.querySelector("#po_branch");
      const po_date = document.querySelector("#date");
      const created_by = document.querySelector("#created_by");

      const total_before_tax = document.querySelector("#total_before_tax");
      const tax_pc = document.querySelector("#tax_pc");
      const po_total = document.querySelector("#po_total");
      const table_body = document.querySelector("#table_body");

      // Clear datalist

      document.addEventListener('DOMContentLoaded', function() {
        // Load Data
        // if (sessionStorage.length <= 0) {
        // window.history.back();
        // }
        const po_number = sessionStorage.getItem('po_number');
        const formData = new FormData();
        formData.append("po_number", po_number);

        fetch('../includes/po_manage.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(result => {
            console.log('Success:', result);
            result.forEach(value => {
              console.log(value);
              supplier_name.value = value["supplier_name"];
              po_branch.value = value["branch"];
              po_date.value = value["date"];
              total_before_tax.value = value['before_tax'];
              tax_pc.value = value['tax_amt'];
              po_total.value = value['po_total'];
              created_by.value = value["user"];
            })
          })
          .catch(error => {
            console.error('Error:', error);
          });

        // const branch = sessionStorage.getItem('branch');
        // items = JSON.parse(sessionStorage.getItem('items'));
        // sessionStorage.clear();
        // console.log(supplier);
        // console.log(branch);
        // console.log(items);
        // // Populate the fields
        // supplier_name.value = supplier;
        // po_branch.value = branch;
        // let i = 0;
        // items.forEach(value => {
        // console.log(value);


        // const this_row = document.createElement("tr");

        // const p_code = document.createElement("td");
        // p_code.appendChild(document.createTextNode(value["p_code"]));
        // p_code.classList.add("align-middle");

        // const p_name = document.createElement("td");
        // p_name.appendChild(document.createTextNode(value["p_name"]));
        // p_name.classList.add("align-middle");

        // const p_units = document.createElement("td");
        // p_units.appendChild(document.createTextNode(value["p_units"]));
        // p_units.classList.add("align-middle");

        // const p_quantity = document.createElement("td");
        // p_quantity.appendChild(document.createTextNode(value["p_quantity"]));
        // p_quantity.classList.add("align-middle");

        // const p_cost = document.createElement("td");
        // p_cost.appendChild(document.createTextNode(value["p_cost"]));
        // p_cost.classList.add("align-middle");

        // const p_total = document.createElement("td");
        // items[i]['p_total'] =
        // Number(value["p_cost"]) * Number(value["p_quantity"]);
        // cumulativeTotal += items[i]['p_total'];
        // p_total.appendChild(document.createTextNode(items[i]['p_total']));
        // i++;
        // p_total.classList.add("align-middle");
        // this_row.append(p_code, p_name, p_units, p_quantity, p_cost, p_total);
        // table_body.appendChild(this_row);
        // });

        // withTax = cumulativeTotal * 0.16;
        // totalWithTax = cumulativeTotal + withTax;

        // tax_pc.value = withTax;
        // po_total.value = totalWithTax;

      });
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

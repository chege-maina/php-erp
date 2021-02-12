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
        <h5 class="p-2">Create Receipt Note</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row flex">
              <div class="col">
                <label for="supplier_name" class="form-label">Supplier Name*</label>
                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
              </div>
              <div class="col">
                <label for="po_number" class="form-label">LPO Number*</label>
                <input type="text" name="po_number" id="po_number" class="form-control" readonly>
              </div>
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

            </div>
            <div class="row pb-2 ">
              <div class="col-sm-3 mt-2 ">
                <label for="invoice" class="form-label">Enter Invoice No./Delivery Note No.*</label>
                <input type="text" name="invoice" id="invoice" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-4">
            <div class="row my-1">
              <div class="col">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Product Code</th>
                      <th scope="col">Product Name</th>
                      <th scope="col">Units</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Quantity Received</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">
                  </tbody>
                </table>
              </div>
            </div>

            <div class="row m-3">
              <div class="col"></div>
              <div class="col col-auto">
                <input class="form-control form-control-sm" type="text" placeholder="Quantity Received" value="" />
              </div>
            </div>

            <div class="row my-3">
              <div class="col">
                <div class="col">
                  <button class="btn btn-falcon-primary btn-sm m-2" role="button"> Submit </button>
                </div>
              </div>
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
      const p_number = document.querySelector("#po_number");
      const po_date = document.querySelector("#date");
      const po_time = document.querySelector("#time");
      const po_invoice = document.querySelector("#invoice");

      function d_toString(value) {
        return value < 10 ? '0' + value : String(value);
      }
      document.addEventListener('DOMContentLoaded', function() {
        const date = new Date();
        let month = d_toString(date.getMonth() + 1);
        let day = d_toString(date.getDate());
        let hours = d_toString(date.getHours());
        let minutes = d_toString(date.getMinutes());


        time.value = hours + ":" + minutes;
      });
      document.addEventListener('DOMContentLoaded', function() {
        const po_vals = sessionStorage.getItem('val');
        let po_number = po_vals.split("^")[0];
        p_number.value = po_number;
        supplier_name.value = po_vals.split('^')[1];

        const formData = new FormData();
        formData.append("po_number", po_number);


        fetch('../includes/receive_goods_manage_items.php', {
            method: 'POST',
            body: formData
          })
          .then(response => response.text())
          .then(result => {
            console.log('Success:', result);
          })
          .catch(error => {
            console.error('Error:', error);
          });

      });
      // Clear datalist
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
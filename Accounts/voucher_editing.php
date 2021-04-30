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
        <h4 class="mb-3">Voucher Details</h4>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="row">
              <div class="col">
                <label for="v_no" class="form-label">No*</label>
                <input class="form-control" type="text" id="v_no" required readonly>
              </div>
              <div class="col">
                <label for="v_type" class="form-label">Type*</label>
                <input class="form-control" type="text" id="v_type" required readonly>
              </div>
              <div class="col">
                <label for="v_date" class="form-label">Date*</label>
                <input class="form-control" type="date" id="v_date" required readonly>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <label for="remarks" class="form-label">Remarks*</label>
                <textarea id="remarks" class="form-control form-control-sm" cols="10" rows="3" readonly></textarea>
              </div>
            </div>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>

        <div class="card mt-1">
          <div class="card-body">
            <table class="table table-sm table-striped table-hover">
              <thead>
                <tr>
                  <th>Group Code</th>
                  <th>Ledger</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody id="table_body">
              </tbody>
            </table>
          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body">
            <div class="row mt">
              <div class="col">
                <label for="total_credit" class="form-label">Total Credit*</label>
                <input class="form-control" type="text" id="total_credit" required readonly>
              </div>
              <div class="col">
                <label for="total_debit" class="form-label">Total Debit*</label>
                <input class="form-control" type="text" id="total_debit" required readonly>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-3 px-4">
            <button type="button" class="btn btn-falcon-success btn-sm mr-2" id="approve_button" onclick="submitForm('approve')">
              <span class="fas fa-check mr-1" data-fa-transform="shrink-3"></span>
              Approve
            </button>
            <button type="button" class="btn btn-falcon-danger btn-sm" id="reject_button" onclick="submitForm('reject')">
              <span class="fas fa-times mr-1" data-fa-transform="shrink-3"></span>
              Reject
            </button>
          </div>
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->



        <!-- =========================================================== -->
        <!-- Footer Begin -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
        <script>
          let v_id;
          const v_no = document.querySelector("#v_no");
          const v_type = document.querySelector("#v_type");
          const v_date = document.querySelector("#v_date");
          const remarks = document.querySelector("#remarks");
          const total_credit = document.querySelector("#total_credit");
          const total_debit = document.querySelector("#total_debit");

          window.addEventListener('DOMContentLoaded', (event) => {
            v_id = window.sessionStorage.getItem("Voucher_No");
            if (v_id == null) {
              location.href = "voucher_listing.php";
            }

            const formData = new FormData();
            formData.append("voucher_no", v_id);
            fetch('../includes/load_voucher_items.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', result);
                if (result.length <= 0) {
                  return;
                }
                result = result[0];
                v_no.value = result.voucher_no;
                v_type.value = result.voucher_type;
                v_date.value = result.date;
                remarks.value = result.remarks;
                total_credit.value = result.total_credit;
                total_debit.value = result.total_debit;
                updateTable(result.table_items);
              })
              .catch(error => {
                console.error('Error:', error);
              });
          });

          const table_body = document.querySelector("#table_body");


          function updateTable(data) {
            console.log(data);
            data.forEach(row => {
              const tr = document.createElement("tr");
              for (key in row) {
                const td = document.createElement("td");
                td.appendChild(document.createTextNode(row[key]));
                tr.appendChild(td);
              }
              table_body.appendChild(tr);
            });
          }
        </script>
</body>

</html>

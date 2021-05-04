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
        <h5 class="mb-2">Chart of Accounts</h5>
        <form action="#" onsubmit="return filterData()">
          <div class="card mb-1">
            <div class="card-body p-2 px-4">
              <div class="row">
                <div class="col">
                  <label class="form-label" for="start_date">From</label>
                  <input id="start_date" class="form-control" type="date" onchange="document.querySelector('#end_date').min = this.value" required>
                </div>
                <div class="col">
                  <label class="form-label" for="end_date">To</label>
                  <input id="end_date" class="form-control" type="date" required>
                </div>
                <div class=" col-auto d-flex align-items-end">
                  <button type="submit" class="btn btn-falcon-primary">Filter</button>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <?php include 'components/chart_tree_data_loader.php' ?>
            <?php include 'components/vc_tree.php' ?>

            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
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
          const start_date = document.querySelector("#start_date");
          const end_date = document.querySelector("#end_date");

          function filterData() {
            const formData = new FormData();
            formData.append("date1", start_date.value);
            formData.append("date2", end_date.value);
            fetch('../includes/load_ledgers_COA.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(result => {
                console.log('Success:', JSON.stringify(result, null, "  "));
                // console.log('Success:', JSON.stringify(global_raw_data, null, "  "));
                // 1. Create empty array
                let tmp_array = [];
                // 2. We have the ledgers in raw form, loop through them.
                result.forEach(row => {
                  let ledger_parent = {};
                  // 3. Get the ledger's parent
                  global_raw_data.forEach(data => {
                    // The child can be a parent or a child
                    if (data.parent_number == row.group_id) {
                      ledger_parent = {
                        parent_number: data.parent_number,
                        parent_title: data.parent_title,
                        parent_type: data.parent_type,
                        parent_carrying_forward: data.parent_carrying_forward
                      }
                    } else if (data.child_number == row.group_id) {
                      ledger_parent = {
                        parent_number: data.child_number,
                        parent_title: data.child_title,
                        parent_type: data.child_type,
                        parent_carrying_forward: data.child_carrying_forward
                      }
                    }
                  });

                  // 4. Add the ledger and its children to memory
                  tmp_array.push({
                    parent_number: ledger_parent.parent_number,
                    parent_title: ledger_parent.parent_title,
                    parent_type: ledger_parent.parent_type,
                    parent_carrying_forward: ledger_parent.parent_carrying_forward,
                    child_number: null,
                    child_title: row.ledger,
                    child_type: null,
                    child_carrying_forward: null,
                    child_debit_val: row.debit,
                    child_credit_val: row.credit,
                    child_opening_bal: row.opening_bal,
                    child_closing_bal: row.closing_bal,
                  });
                });

                // 5. At this point tmp_array is ready to be added to the session raw_data
                console.log("The data is", tmp_array);
                window.sessionStorage.setItem("raw_data",
                  JSON.stringify([...global_raw_data, ...tmp_array]));
                const ev = new StorageEvent("storage", {
                  key: "raw_data"
                });
                window.dispatchEvent(ev);
              })
              .catch(error => {
                console.error('Error:', error);
              });
            return false;
          }
        </script>
</body>

</html>

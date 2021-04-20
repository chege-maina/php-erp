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

        <?php
        include '../base_page/data_list_select.php';
        ?>
        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2">Master List</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row my-3">
              <div class="col-sm-5 my-2">
                <label class="form-label" for="b_month">Select Year</label>
                <div class="input-group">
                  <select class="form-select" name="b_year" id="b_year">
                    <option value disabled selected>
                      -- Select Year --
                    </option>
                  </select>
                  <button type="button" class="btn btn-primary input-group-btn" onclick="selectRows();">
                    Search
                  </button>
                  <div class="invalid-tooltip">This field cannot be left blank.</div>
                </div>
              </div>
            </div>
            <hr>
            <div class="card-body fs--1 p-2">
              <div class=" table-responsive">
                <table class="table table-sm table-striped mt-0">
                  <thead>
                    <tr>
                      <th scope="col">Month</th>
                      <th scope="col">No of Payslips</th>
                      <th scope="col"> Basic Pay </th>
                      <th scope="col"> Net Pay </th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody id="table_body">
                  </tbody>
                </table>
              </div>
            </div>

          </div>
        </div> <!-- end  of the card -->
      </div>
      <?php
      include '../includes/base_page/footer.php';
      ?>
    </div>
  </main>
</body>

</html>

<script>
  const b_year = document.querySelector("#b_year");
  window.addEventListener('DOMContentLoaded', (event) => {

    populateSelectElement("#b_year", '../payroll/load_year.php', "year");

  });
</script>

<script>
  const table_body = document.querySelector("#table_body");



  let table_items;

  const selectRows = () => {
    const formData = new FormData();

    console.log("======================================");
    console.log("selected these");
    console.log("''''''''''''''''''''''''''''''''''''''");
    formData.append("year", b_year.value);
    console.log("======================================");


    fetch('#.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        console.log('Success:', data);
        [...table_items] = data;
        updateTable(table_items);
      })
      .catch(error => {
        console.error('Error:', error);
      });

  }
  let updateTable = (data) => {
    table_body.innerHTML = "";
    console.log("Ladadida", "Commodore ", data);
    data.forEach(value => {

      const this_row = document.createElement("tr");
      // Id will be like 1Tank
      // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

      // month
      let month = document.createElement("td");
      month.appendChild(document.createTextNode(value["month"]));
      month.classList.add("align-middle");

      // number of payslips 
      let payslips_no = document.createElement("td");
      payslips_no.appendChild(document.createTextNode(value["payslips_no"]));
      payslips_no.classList.add("align-middle");

      // Basic Pay
      let basicpay = document.createElement("td");
      basicpay.appendChild(document.createTextNode(value["basicpay"]));
      basicpay.classList.add("align-middle");

      //Net Pay
      let netpay = document.createElement("td");
      netpay.appendChild(document.createTextNode(value["netpay"]));
      netpay.classList.add("align-middle");

      // Status
      let status = document.createElement("td");
      status.appendChild(document.createTextNode(value["status"]));
      status.classList.add("align-middle");



      // CONTINUE FROM HERE RUTH



      this_row.append(
        month,
        payslips_no,
        basicpay,
        netpay,
        status,
      );
      table_body.appendChild(this_row);

    });
  }
</script>
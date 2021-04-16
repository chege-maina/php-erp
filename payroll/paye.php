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
        <h5 class="p-2">P.A.Y.E Rates</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">

            <div class="row ">

              <div class="col col-lg-2">
                <label for="#" class="form-label">Insert Year</label>
                <input type="number" name="adv_year" id="adv_year" class="form-control" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col col-md-2">
                <label for="#" class="form-label">Personal Relief</label>
                <input type="number" name="relief" id="relief" class="form-control" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
              <div class="col-auto ml-auto p-2 my-4">
                <button type="button" class="form-control btn btn-sm btn-primary" onclick="addItem();">
                  Add Row
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <table class="table table-striped" id="data_table">
                  <thead>
                    <tr>
                      <th scope="col">From</th>
                      <th scope="col">To</th>
                      <th scope="col">Rate(%)</th>
                      <th scope="col" class="col-md-2">Action</th>
                    </tr>
                  </thead>
                  <tbody id="c_table_body">
                  </tbody>
                </table>
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

      <?php
      include '../includes/base_page/footer.php';
      ?>



      <script>
        const items_in_table = {};
        const c_table_body = document.querySelector("#c_table_body");

        const adv_year = document.querySelector("#adv_year");
        const relief = document.querySelector("#relief");

        function updateTable() {
          c_table_body.innerHTML = "";
          console.log(items_in_table);
          for (let item in items_in_table) {

            let tr = document.createElement("tr");

            //  From

            let from = document.createElement("input");
            from.setAttribute("type", "number");
            from.setAttribute("required", "");
            from.classList.add("form-control", "form-control-sm", "align-middle");
            // from.setAttribute("data-ref", items_in_table[item]["name"]);
            from.setAttribute("min", 0);
            // from.setAttribute("max", items_in_table[item]['max']);

            // make sure the from is always greater than 0
            // from.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
            // from.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
            from.setAttribute("onclick", "this.select();");
            items_in_table[item]['from'] = ('from' in items_in_table[item] && items_in_table[item]['from'] >= 0) ?
              items_in_table[item]['from'] : 0;
            from.value = items_in_table[item]['from'];

            from.addEventListener("input", (event) => {
              items_in_table[item].from = Number(event.target.value);
            })
            let fromWrapper = document.createElement("td");
            fromWrapper.classList.add("m-2", "col-2");
            fromWrapper.appendChild(from);

            // To

            let to = document.createElement("input");
            to.setAttribute("type", "number");
            to.setAttribute("required", "");
            to.classList.add("form-control", "form-control-sm", "align-middle");
            // to.setAttribute("data-ref", items_in_table[item]["name"]);
            to.setAttribute("min", 0);
            // to.setAttribute("max", items_in_table[item]['max']);

            // make sure the to is always greater than 0
            // to.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
            // to.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
            to.setAttribute("onclick", "this.select();");
            items_in_table[item]['to'] = ('to' in items_in_table[item] && items_in_table[item]['to'] >= 0) ?
              items_in_table[item]['to'] : 0;
            to.value = items_in_table[item]['to'];

            to.addEventListener("input", (event) => {
              items_in_table[item].to = Number(event.target.value);
            })
            let toWrapper = document.createElement("td");
            toWrapper.classList.add("m-2", "col-2");
            toWrapper.appendChild(to);


            // Rate

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

            let actionWrapper = document.createElement("td");
            actionWrapper.classList.add("m-2");
            let action = document.createElement("button");
            action.setAttribute("id", item);
            action.setAttribute("onclick", "removeItem(this.id);");

            action.appendChild(document.createTextNode("-"));
            action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
            actionWrapper.appendChild(action);

            tr.append(
              fromWrapper,
              toWrapper,
              rateWrapper,
              actionWrapper
            );
            c_table_body.appendChild(tr);
          }
          return;
        }

        function addItem() {
          const tmp = {
            from: 0,
            to: 0,
            rate: 0,
          }
          items_in_table[uuidv4()] = tmp;

          updateTable();
        }

        function removeItem(item) {
          delete items_in_table[String(item)];

          updateTable();
        }

        function validateQuantity(elmt, value, max) {
          value = Number(value);
          max = Number(max);
          elmt.value = elmt.value <= 0 ? 1 : elmt.value;
          elmt.value = elmt.value > max ? max : elmt.value;
        }
      </script>


      <script>
        function getItems() {
          const tmp_obj = {};
          const payes = [];
          c_table_body.childNodes.forEach(row => {

            const p_from = row.childNodes[0].childNodes[0].value;
            const p_to = row.childNodes[1].childNodes[0].value;
            const p_rate = row.childNodes[2].childNodes[0].value;


            payes.push({
              from: p_from,
              to: p_to,
              rate: p_rate,

            });
          });

          console.log("submitting", payes);

          tmp_obj["table_items"] = JSON.stringify(payes);
          console.log("==================================");
          console.log(tmp_obj);
          console.log("==================================");

          return tmp_obj
        }

        function submitForm() {

          if (!adv_year.value) {
            return;
          }

          if (!relief.value) {
            return;
          }

          let tmp_obj = getItems();

          const formData = new FormData();
          formData.append("year", adv_year.value);
          formData.append("relief", relief.value);
          for (let key in tmp_obj) {
            formData.append(key, tmp_obj[key]);
          }

          // fetch goes here

          fetch('add_paye_schedule.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(result => {
              console.log('Success:', result);

              // setTimeout(function() {
              //   location.reload();
              // }, 2500);

            })
            .catch(error => {
              console.error('Error:', error);
            });

          return false;
        }
      </script>

    </div>
  </main>

</body>

</html>
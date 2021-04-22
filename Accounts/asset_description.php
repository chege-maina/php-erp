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
        <h5 class="p-2">Asset Description</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">
            <div class="row my-3">
              <div class="col">
                <label for="" class="form-label">Name</label>
                <input class="form-control" name="asset_name" type="text" id="asset_name" required />
              </div>
              <div class="col">
                <label for="reg_no" class="form-label">RegNo/Serial No</label>
                <input class="form-control" name="reg_no" type="number" id="reg_no" required />
              </div>
              <div class="col">
                <label for="tag_no" class="form-label">Tag No</label>
                <input class="form-control" name="tag_no" type="number" id="tag_no" required />
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <label class="form-label" for="branch_id">Select Branch*</label>
                <select class="form-select" name="branch_id" id="branch_id" required>
                  <option value disabled selected>
                    -- Select Branch --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="asset_grp">Asset Group*</label>
                <select class="form-select" name="asset_grp" id="asset_grp" required>
                  <option value disabled selected>
                    -- Select Asset Group --
                  </option>
                  <option value="all">All</option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="unit">Unit*</label>
                <select class="form-select" name="unit" id="unit" required>
                  <option value disabled selected>
                    -- Select Unit --
                  </option>
                  <option value="Units">Units</option>
                  <option value="Pieces">Pieces</option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <label for="comment" class="form-label"> Description</label>
                <textarea class="form-control" id="comment" aria-label="With textarea" required></textarea>
              </div>
              <div class="col">
                <label for="weight" class="form-label">weight </label>
                <div class="input-group">
                  <input class="form-control" id="weight" name="weight" type="number"></input>
                  <span class="input-group-text">
                    MT
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mt-1">
          <div class="card-body fs--1 p-4 position-relative">
            <div class="row my-3">
              <div class="col">
                <label for="asset_date" class="form-label"> Date of Purchase*</label>
                <input class="form-control" name="asset_date" id="asset_date" type="date" required></input>
              </div>
              <div class="col">
                <label for="dep_rate" class="form-label">Depreciation Rate* </label>
                <div class="input-group">
                  <input class="form-control" id="dep_rate" name="dep_rate" type="number"></input>
                  <span class="input-group-text">
                    %
                  </span>
                </div>
              </div>
              <div class="col">
                <label for="cost" class="form-label">Cost* </label>
                <div class="input-group">
                  <input class="form-control" id="cost" name="cost" type="number"></input>
                  <span class="input-group-text">
                    KES
                  </span>
                </div>
              </div>
            </div>
            <div class="row my-3">
              <div class="col">
                <label class="form-label" for="dep_method">Depreciation Method*</label>
                <select class="form-select" name="dep_method" id="dep_method" required>
                  <option value disabled selected>
                    -- Select Method --
                  </option>
                  <option value="Fixed">Fixed</option>
                  <option value="Reducing">Reducing</option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
                <hr>
                <div class="row">
                  <div class="col">
                    <label class="form-label" for="financed">Financed By*</label>
                    <input class="form-control" name="financed" type="text" id="financed" required />
                    <div class="invalid-tooltip">This field cannot be left blank.</div>
                  </div>
                  <div class="col">
                    <label for="loan_ref" class="form-label">Loan Ref No*</label>
                    <input class="form-control" name="loan_ref" type="number" id="loan_ref" required />
                  </div>
                </div>
              </div>
              <div class="col">
                <label class="form-label" for="wear">Wear and Tear*</label>
                <select class="form-select" name="wear" id="wear" required>
                  <option value disabled selected>
                    -- Select Unit --
                  </option>
                  <option value="Class 1">Class 1</option>
                  <option value="Class 2">Class 2</option>
                  <option value="Class 3">Class 3</option>
                  <option value="Other">Other</option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
              <div class="col my-1">
                <label class="form-check-label" for="asset_status">
                  Asset Status
                </label>
                <div class="input-group">
                  <div class="col ">
                    <div class="form-check">
                      <input class="form-check-input" id="asset_status1" value="active" type="radio" name="flexRadioDefault" />
                      <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                  </div>
                  <div class="col mx-2">
                    <div class="form-check">
                      <input class="form-check-input" id="asset_status2" value="disposed" type="radio" name="flexRadioDefault" />
                      <label class="form-check-label" for="flexRadioDefault1">Disposed </label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-check">
                      <input class="form-check-input" id="asset_status3" value="inactive" type="radio" name="flexRadioDefault" />
                      <label class="form-check-label" for="flexRadioDefault1">Inactive</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="d-flex flex-row-reverse my-4">
                    <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitForm();">
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
      include '../includes/base_page/footer.php';
      ?>
    </div>
  </main>
</body>

</html>

<script>
  const branch_id = document.querySelector("#branch_id");
  const asset_name = document.querySelector("#asset_name");
  const reg_no = document.querySelector("#reg_no");
  const tag_no = document.querySelector("#tag_no");
  const asset_grp = document.querySelector("#asset_grp");
  const unit = document.querySelector("#unit");
  const comment = document.querySelector("#comment");
  const weight = document.querySelector("#weight");
  const asset_date = document.querySelector("#asset_date");
  const dep_rate = document.querySelector("#dep_rate");
  const cost = document.querySelector("#cost");
  const dep_method = document.querySelector("#dep_method");
  const financed = document.querySelector("#financed");
  const loan_ref = document.querySelector("#loan_ref");
  const wear = document.querySelector("#wear");
  const asset_status1 = document.querySelector("#asset_status1");
  const asset_status2 = document.querySelector("#asset_status2");
  const asset_status3 = document.querySelector("#asset_status3");

  window.addEventListener('DOMContentLoaded', (event) => {

    populateSelectElement("#branch_id", '../includes/load_branch_items.php', "branch");

  });

  function submitForm() {

    if (!wear.value) {
      return;
    }

    if (!loan_ref.value) {
      return;
    }

    if (!financed.value) {
      return;
    }

    if (!dep_method.value) {
      return;
    }

    if (!cost.value) {
      return;
    }

    if (!dep_rate.value) {
      return;
    }

    if (!asset_date.value) {
      return;
    }

    if (!weight.value) {
      return;
    }

    if (!comment.value) {
      return;
    }

    if (!unit.value) {
      return;
    }

    if (!asset_grp.value) {
      return;
    }

    if (!branch_id.value) {
      return;
    }

    if (!tag_no.value) {
      return;
    }

    if (!reg_no.value) {
      return;
    }

    if (!asset_name.value) {
      return;
    }

    const formData = new FormData();
    formData.append("name", asset_name.value);
    formData.append("number", reg_no.value);
    formData.append("tag_no", tag_no.value);
    formData.append("branch", branch_id.value);
    formData.append("asset_group", asset_grp.value);
    formData.append("unit", unit.value);
    formData.append("descpt", comment.value);
    formData.append("weight", weight.value);
    formData.append("date", asset_date.value);
    formData.append("dep_rate", dep_rate.value);
    formData.append("cost", cost.value);
    formData.append("dep_method", dep_method.value);
    formData.append("financier", financed.value);
    formData.append("loan_ref", loan_ref.value);
    formData.append("wear_tear", wear.value);
    if (asset_status1.checked) {
      formData.append("asset_status", asset_status1.value);
    } else if (asset_status2.checked) {
      formData.append("asset_status", asset_status2.value);
    } else if (asset_status3.checked) {
      formData.append("asset_status", asset_status3.value);
    }
    // fetch goes here

    fetch('../includes/add_asset.php', {
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

  }
</script>
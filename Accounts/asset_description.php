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

<style>
  .vertical {
    border-left: 1px solid black;
    height: 200px;
  }
</style>


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
        <h5 class="p-2">Asset Description</h5>
        <div class="card">


          <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
          </div>
          <!--/.bg-holder-->

          <div class="card-body fs--1 p-4 position-relative">
            <div class="row">
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
            <div class="row">
              <div class="col">
                <label class="form-label" for="branch">Select Branch*</label>
                <select class="form-select" name="branch" id="branch" required>
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
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
              <div class="col">
                <label class="form-label" for="unit">Unit*</label>
                <select class="form-select" name="unit" id="unit" required>
                  <option value disabled selected>
                    -- Select Unit --
                  </option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="row">
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
            <div class="row">
              <div class="col">
                <label for="asset_date" class="form-label"> Date*</label>
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
            <div class="row">
              <div class="col">
                <label class="form-label" for="dep_method">Depreciation Method*</label>
                <select class="form-select" name="dep_method" id="dep_method" required>
                  <option value disabled selected>
                    -- Select Method --
                  </option>
                  <option value="Straight-Line">Straight-Line</option>
                  <option value="Reducing">Reducing</option>
                </select>
                <div class="invalid-tooltip">This field cannot be left blank.</div>
                <hr>
                <div class="row">
                  <div class="col">
                    <label class="form-label" for="financed">Financed By*</label>
                    <select class="form-select" name="financed" id="financed" required>
                      <option value disabled selected>
                        -- Select Method --
                      </option>
                      <div class="invalid-tooltip">This field cannot be left blank.</div>
                    </select>
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
                      <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault" />
                      <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                  </div>
                  <div class="col mx-2">
                    <div class="form-check">
                      <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault" />
                      <label class="form-check-label" for="flexRadioDefault1">Disposed </label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-check">
                      <input class="form-check-input" id="flexRadioDefault1" type="radio" name="flexRadioDefault" />
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
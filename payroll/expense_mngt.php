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
      <h5 class="p-2">Expense Management</h5>
      <div class="card">
        <div class="card-body fs--1 p-4">
          <!-- Content is to start here -->
          <div class="row pb-2 ">
            <div class="col">
              <label for="exp_date" class="form-label">Date </label>
              <input type="date" name="exp_date" id="exp_date" class="form-control" required>
            </div>
            <div class="col">
              <label for="#" class="form-label">Select Employee </label>
              <div class="input-group">
                <input list="employee" name="employee" id="employee_name" class="form-select" required>
                <datalist id="employee"></datalist>
                <button type="button" class="btn btn-primary">Select</button>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col">
              <label for="designation" class="form-label">Designation </label>
              <input type="text" name="designation" id="designation" class="form-control" required readonly>
            </div>
            <div class="col">
              <label for="department" class="form-label">Department</label>
              <input type="text" name="department" id="department" class="form-control" required readonly>
            </div>
            <div class="col">
              <label for="emp_no" class="form-label">Emp No#</label>
              <input type="text" name="emp_no" id="emp_no" class="form-control" required readonly>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <label for="#" class="form-label">Loan Type</label>
              <div class="input-group">
                <input list="loan" name="loan" id="loan_type" class="form-select" required>
                <datalist id="loan"></datalist>
              </div>
            </div>
            <div class="col">
              <label for="#" class="form-label">Description</label>
              <div class="input-group">
                <input list="description" name="description" id="desc" class="form-select" required>
                <datalist id="description"></datalist>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <label for="#" class="form-label">Initial Amount</label>
              <div class="input-group">
                <span class="input-group-text is-static">KES</span>
                <input type="number" class="form-control" name="init_amt" id="init_amt" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="col">
              <label for="#" class="form-label">Balance</label>
              <div class="input-group">
                <span class="input-group-text is-static">KES</span>
                <input type="number" class="form-control" name="balance" id="balance" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="col">
              <label for="#" class="form-label">Installment Amount</label>
              <div class="input-group">
                <span class="input-group-text is-static">KES</span>
                <input type="number" class="form-control" name="installment" id="installment" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>
            <div class="col">
              <label for="#" class="form-label">Interest</label>
              <div class="input-group">
                <span class="input-group-text is-static">%</span>
                <input type="number" class="form-control" name="interest" id="interest" required>
                <div class="invalid-feedback">This field cannot be left blank.</div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col">
              <label for="issue_date" class="form-label">Issued Date </label>
              <input type="date" name="issue_date" id="issue_date" class="form-control" required>
            </div>
            <div class="col">
              <label for="begin_date" class="form-label">Start Date </label>
              <input type="date" name="begin_date" id="begin_date" class="form-control" required>
            </div>
            <div class="col">
              <label for="#" class="form-label">Interest Type</label>
              <div class="input-group">
                <input list="interest" name="interest" id="interest_type" class="form-select" required>
                <datalist id="interest"></datalist>
              </div>
            </div>
            <div class="col">
              <label for="#" class="form-label">Fringe Benefit Tax</label>
              <div class="input-group">
                <input list="fringe" name="fringe" id="fringe_tax" class="form-select" required>
                <datalist id="fringe"></datalist>
              </div>
            </div>
          </div>
          <button class="btn btn-falcon-primary btn-sm my-2" id="submit">
            Submit
          </button>
        </div>
      </div>

      <?php
      include '../includes/base_page/footer.php';
      ?>
    </div>
    </body>

</html>
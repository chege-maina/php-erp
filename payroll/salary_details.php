<div>
  <div class="row">
    <div class="col">
      <label for="employment" class="form-label">Employment Type</label>
      <select name="employment" id="employment_type" class="form-select">
        <option value="Regular">Regular(open-ended)</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col">
      <label for="currency" class="form-label">Payment Currency</label>
      <select name="currency" id="payment_currency" class="form-select">
        <option value="KES">KES</option>
      </select>
    </div>
    <div class="col">
      <label for="shift" class="form-label">Work Shift</label>
      <select name="shift" id="work_shift" class="form-select">
        <option value disabled selected>-- SELECT WORK SHIFT --</option>
      </select>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <label class="form-label" for="salary">Monthly Salary(KES)</label>
      <input type="number" class="form-control" name="salary" id="monthly_salary" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label for="monthly" class="form-label">Monthly</label>
      <div class="input-group">
        <span class="input-group-text is-static">Monthly</span>
        <select name="monthly" id="salary_type" class="form-select">
          <option value="Basic Pay">Basic Pay</option>
          <option value="Consolidated">Consolidated</option>
          <option value="Net Pay">Net Pay</option>
        </select>
      </div>
    </div>
    <div class="col">
      <label for="off_days" class="form-label">Off Days</label>
      <select name="off_days" id="off_days" class="form-select">
        <option value="SUNDAY">SUNDAY</option>
        <option value="MONDAY">MONDAY</option>
        <option value="TUESDAY">TUESDAY</option>
        <option value="WEDNESDAY">WEDNESDAY</option>
        <option value="THURSDAY">THURSDAY</option>
        <option value="FRIDAY">FRIDAY</option>
        <option value="SATURDAY">SATURDAY</option>
      </select>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <label for="income_tax" class="form-label">Income Tax</label>
      <select name="income_tax" id="income_tax" class="form-select">
        <option value="none">NONE</option>
        <option value="primary">P.A.Y.E</option>
      </select>
    </div>
    <div class="col d-flex align-items-end">
      <div class="pr-4">
        <input type="checkbox" name="vehicle3" class="form-check-input" id="deduct_nhif" checked>
        <label for="vehicle2" class="form-check-label"> Deduct NHIF</label>
      </div>
      <div class="pr-2">
        <input type="checkbox" name="vehicle3" class="form-check-input" id="deduct_nssf" checked>
        <label for="vehicle3" class="form-check-label"> Deduct NSSF</label>
      </div>
    </div>
  </div>
  <?php
  include './payment_details.php';
  ?>
</div>
<script>
  const employment_type = document.querySelector("#employment_type");
  const payment_currency = document.querySelector("#payment_currency");
  const work_shift = document.querySelector("#work_shift");
  const monthly_salary = document.querySelector("#monthly_salary");
  const salary_type = document.querySelector("#salary_type");

  const off_days = document.querySelector("#off_days");
  const income_tax = document.querySelector("#income_tax");
  const deduct_nhif = document.querySelector("#deduct_nhif");
  const deduct_nssf = document.querySelector("#deduct_nssf");

  function checkSalaryDetails() {
    return checkPaymentOption();
  }

  function getSalaryDetails() {
    let tmp = {
      employment_type: employment_type.value,
      payment_currency: payment_currency.value,
      work_shift: work_shift.value,
      monthly_salary: monthly_salary.value,
      salary_type: salary_type.value,
      off_days: off_days.value,
      income_tax: income_tax.value,
      deduct_nssf: deduct_nssf.checked,
      deduct_nhif: deduct_nhif.checked,
    };

    const paymentOptions = getPaymentOption();
    for (let key in paymentOptions) {
      tmp[key] = paymentOptions[key];
    }
    return tmp;
  }

  window.addEventListener('DOMContentLoaded', (event) => {

    populateSelectElement("#work_shift", '../payroll/load_shift.php', "name");
  });
</script>
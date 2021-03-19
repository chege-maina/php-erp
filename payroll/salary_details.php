<div>
  <div class="row">
    <div class="col">
      <label for="employment" class="form-label">Employment Type</label>
      <select name="employment" id="employment" class="form-select">
        <option value="Regular">Regular(open-ended)</option>
      </select>
    </div>
    <div class="col">
      <label for="currency" class="form-label">Payment Currency</label>
      <select name="currency" id="currency" class="form-select">
        <option value="KES">KES</option>
        <option value="JPY">JPY</option>
      </select>
    </div>
    <div class="col">
      <label for="shift" class="form-label">Work Shift</label>
      <select name="shift" id="shift" class="form-select">
        <option value="Regular">Regular shift</option>
        <option value="Night">Night shift</option>
        <option value="Afternoon">Afternoon shift</option>
      </select>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <label class="form-label" for="salary">Monthly Salary(KES)</label>
      <input type="number" class="form-control" name="salary" id="salary" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label for="monthly" class="form-label">Monthly</label>
      <div class="input-group">
        <span class="input-group-text is-static">Monthly</span>
        <select name="monthly" id="monthly" class="form-select">
          <option value="basic">Basic Pay</option>
          <option value="consolidated">Consolidated</option>
          <option value="net">Net Pay</option>
        </select>
      </div>
    </div>
    <div class="col">
      <label for="off_days" class="form-label">Off Days</label>
      <select name="off_days" id="off_days" class="form-select">
        <option value="SUNDAY">SUNDAY</option>
        <option value="MONDAY">MONDAY</option>
      </select>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <label for="income_tax" class="form-label">Income Tax</label>
      <select name="income_tax" id="income_tax" class="form-select">
        <option value="none">NONE</option>
        <option value="primary">P.A.Y.E Primary Employee</option>
        <option value="secondary">P.A.Y.E Secondary Employee</option>
      </select>
    </div>
    <div class="col d-flex align-items-end">
      <div class="pr-4">
        <input type="checkbox" name="vehicle3" class="form-check-input" value="Boat" checked>
        <label for="vehicle2" class="form-check-label"> Deduct NHIF</label>
      </div>
      <div class="pr-2">
        <input type="checkbox" name="vehicle3" class="form-check-input" value="Boat" checked>
        <label for="vehicle3" class="form-check-label"> Deduct NSSF</label>
      </div>
    </div>
  </div>
</div>
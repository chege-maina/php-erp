<div class="card">
  <div class="card-body fs--1 p-4">

    <div class="row m-3">
      <div class="col">
        <label class="form-label" for="job_number">Job Number</label>
        <input type="number" class="form-control" name="job_number" id="job_number" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
      <div class="col">
        <label class="form-label" for="employ_date">Date of Employment</label>
        <input type="date" class="form-control" name="employ_date" id="employ_date" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
    </div>
    <hr>
    <h6 class="p-2" id="title-header">Current Contract
    </h6>
    <div class="row m-3">
      <div class="col">
        <label class="form-label" for="start_date">Contract Start Date</label>
        <input type="date" class="form-control" name="start_date" id="start_date" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
      <div class="col">
        <label class="form-label" for="end_date">Contract End Date</label>
        <input type="date" class="form-control" name="end_date" id="end_date" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
      <div class="col">
        <label class="form-label" for="duration">Contract Duration</label>
        <input type="text" class="form-control" name="duration" id="duration" required readonly>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
    </div>
    <hr>
    <div class="row m-3">
      <div class="col col-md-4 my-1">
        <label class="form-label" for="job_title">Job Title</label>
        <input type="text" class="form-control" name="job_title" id="job_title" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
    </div>
    <div class="row m-3">
      <div class="col">
        <label for="department" class="form-label">Department</label>
        <select name="department" id="department" class="form-select">
          <option value="all">All</option>
        </select>
      </div>
      <div class="col">
        <label for="head_of" class="form-label">Head Of</label>
        <select name="head_of" id="head_of" class="form-select">
          <option value="all">All</option>
        </select>
      </div>
    </div>
    <div class="row m-3">
      <div class="col">
        <label for="report_to" class="form-label">Report To</label>
        <select name="report_to" id="report_to" class="form-select">
          <option value="all">-- SELECT MANAGER --</option>
        </select>
      </div>
      <div class="col">
        <label for="region" class="form-label">Region</label>
        <select name="region" id="region" class="form-select">
          <option value="Nairobi">Nairobi</option>
        </select>
      </div>
    </div>
    <div class="row m-3">
      <div class="col">
        <button class="btn btn-falcon-primary btn-sm m-2" id="submit">
          Submit
        </button>
      </div>
    </div>
  </div>
</div>
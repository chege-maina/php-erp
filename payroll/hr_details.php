<div>
  <div class="row">
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
  <div>
    <hr>
    <h6 class="p-2" id="title-header">
      Current Contract
    </h6>
    <div class="row mt-3">
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
        <input type="text" class="form-control" name="duration" id="duration" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
    </div>
    <hr>
    <div class="row mt-3">
      <div class="col col-md-4 my-1">
        <label class="form-label" for="job_title">Job Title</label>
        <input type="text" class="form-control" name="job_title" id="job_title" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
    </div>
    <div class="row mt-3">
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
    <div class="row mt-3">
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
  </div>
</div>

<script>
  const job_number = document.querySelector("#job_number");
  const employ_date = document.querySelector("#employ_date");
  const start_date = document.querySelector("#start_date");
  const end_date = document.querySelector("#end_date");
  const duration = document.querySelector("#duration");
  const job_title = document.querySelector("#job_title");
  const department = document.querySelector("#department");
  const head_of = document.querySelector("#head_of");
  const report_to = document.querySelector("#report_to");
  const region = document.querySelector("#region");

  function getHrDetails() {
    let tmp = {
      job_number: job_number.value,
      employ_date: employ_date.value,
      start_date: start_date.value,
      end_date: end_date.value,
      duration: duration.value,
      job_title: job_title.value,
      department: department.value,
      head_of: head_of.value,
      report_to: report_to.value,
      region: region.value,
    }
    return tmp;
  }
</script>

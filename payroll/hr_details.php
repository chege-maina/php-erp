<?php
include '../base_page/data_list_select.php';
?>

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
      <div class="col">
        <label class="form-label" for="job_title">Job Title</label>
        <input type="text" class="form-control" name="job_title" id="job_title" required>
        <div class="invalid-feedback">This field cannot be left blank.</div>
      </div>
      <div class="col">
        <label for="branch" class="form-label">Branch</label>
        <select name="branch" id="branch" class="form-select">
          <option value="" disabled selected>Select Branch</option>
          <option value="mm1">MM1</option>
          <option value="mm2">MM2</option>
        </select>
      </div>
    </div>
    <div class="row mt-3">

      <!--ancm,mx,c nxz -->

      <div class="col">
        <!-- Make Combo -->
        <label for="department" class="form-label">Department</label>
        <div class="input-group">
          <input list="departments" name="department" id="department" class="form-select" required>
          <datalist id="departments"></datalist>
          <div class="invalid-tooltip">This field cannot be left blank.</div>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addCategory">
            +
          </button>

        </div>
      </div>

      <!--dkznlsknl--->

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
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">

    <div class="modal-content border-0">
      <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
          <h4 class="mb-1" id="addUnitLabel">Add Department</h4>
        </div>
        <div class="p-4">
          <!-- Category Form -->
          <form id="add_ct_frm" name="add_ct_frm">
            <div class="p2">
              <label for="modal_category_name" class="form-label">Department Name*</label>
              <input type="text" name="modal_category_name" id="modal_category_name" class="form-control" required>
              <div class="invalid-feedback">This field cannot be left blank.</div>
            </div>
            <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_ct_submit" name="add_ct_submit" data-dismiss="modal">
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
<script>
  $(document).ready(function() {
    $('#add_ct_submit').click(function(e) {
      e.preventDefault();
      var cat_name = $('#modal_category_name').val();
      var data1 = {
        modal_category_name: cat_name
      }

      if (cat_name == '') {
        alert("Please complete form!")
      } else {
        var conf = confirm("Do You Want to Add a New Department?")
        if (conf) {
          $.ajax({
            url: "../payroll/add_department.php",
            method: "POST",
            data: data1,
            success: function(data) {
              $('#add_ct_frm')[0].reset();
              //$('form').trigger("reset");
              if (data == 'New Department Added Successfully') {
                updateComboBoxes();
              }
              alert(data)
            }
          })

        }
      }
    })
  })
  const departments = document.querySelector("#departments");
  const job_number = document.querySelector("#job_number");
  const branch = document.querySelector("#branch");
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
      branch: branch.value,
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

  window.addEventListener('DOMContentLoaded', (event) => {

    initSelectElement("#departments", "-- Select Department --");
    populateSelectElement("#departments", '../payroll/load_department.php', "name");

  });
</script>
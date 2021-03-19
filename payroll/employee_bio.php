<div>
  <div class="row">
    <div class="col">
      <label class="form-label" for="product_name">First Name*</label>
      <input type="text" class="form-control" name="first_name" id="first_name" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label class="form-label" for="product_name">Middle Name*</label>
      <input type="text" class="form-control" name="middle_name" id="middle_name" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label class="form-label" for="product_name">Last Name*</label>
      <input type="text" class="form-control" name="last_name" id="last_name" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
  </div>

  <div class="row mt-2">
    <div class="col">
      <label for="gender" class="form-label">Gender</label>
      <select name="gender" id="gender" class="form-select">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
    </div>
    <div class="col">
      <label class="form-label" for="last_name">Date of Birth*</label>
      <input type="date" class="form-control" name="date" id="dob" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col ">
      <label for="residence" class="form-label">Residential Status</label>
      <select name="residence" id="residential_status" class="form-select">
        <option value="Resident">Resident</option>
        <option value="Resident">Resident</option>
      </select>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col">
      <label class="form-label" for="photo">Passport Photo</label>
      <input class="form-control" id="photo" name="photo" type="file" accept="image/*" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label class="form-label" for="national_id">National ID NO.*</label>
      <input type="number" class="form-control" name="national_id" id="national_id" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label class="form-label" for="pin_no">PIN NO.*</label>
      <input type="number" class="form-control" name="pin_no" id="pin_no" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col">
      <label class="form-label" for="nssf_no">NSSF NO.*</label>
      <input type="number" class="form-control" name="nssf_no" id="nssf_no" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
    <div class="col">
      <label class="form-label" for="nhif_no">NHIF NO.*</label>
      <input type="number" class="form-control" name="nhif_no" id="nhif_no" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
  </div>
</div>

<script>
  const emp_first_name = document.querySelector("#first_name");
  const emp_middle_name = document.querySelector("#middle_name");
  const emp_last_name = document.querySelector("#last_name");
  const emp_gender = document.querySelector("#gender");
  const emp_dob = document.querySelector("#dob");
  const emp_residential_status = document.querySelector("#residential_status");
  const emp_photo = document.querySelector("#photo");
  const emp_national_id = document.querySelector("#national_id");
  const emp_pin_no = document.querySelector("#pin_no");
  const emp_nssf_no = document.querySelector("#nssf_no");
  const emp_nhif_no = document.querySelector("#nhif_no");

  function getEmployeeBio() {
    let tmp = {
      first_name: emp_first_name.value,
      middle_name: emp_middle_name.value,
      last_name: emp_last_name.value,
      gender: emp_gender.value,
      date_of_birth: emp_dob.value,
      residential_status: emp_residential_status.value,
      national_id_no: emp_national_id.value,
      pin_no: emp_pin_no.value,
      nssf_no: emp_nssf_no.value,
      nhif_no: emp_nhif_no.value,
      passport: photo.files[0],
    };

    return tmp;
  }
</script>

<div class="row">
  <div class="col">
    <label class="form-label" for="off_mail">Official Email*</label>
    <input type="text" class="form-control" name="off_mail" id="off_mail" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
  <div class="col">
    <label class="form-label" for="pers_mail">Personal Email*</label>
    <input type="text" class="form-control" name="pers_mail" id="pers_mail" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
  <div class="col">
    <label for="country" class="form-label">Country</label>
    <select name="country" id="country" class="form-select">
      <?php
      include './countries.php';
      ?>
    </select>
  </div>
</div>
<div class="row mt-2">
  <div class="col">
    <label class="form-label" for="mobile_no">Mobile Phone NO.*</label>
    <input type="number" class="form-control" name="mobile_no" id="mobile_no" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
  <div class="col">
    <label class="form-label" for="official_no">Official Phone NO.*</label>
    <input type="number" class="form-control" name="official_no" id="official_no" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
  <div class="col mt-4">
    <div class="input-group">
      <span class="input-group-text is-static">EXT NO.</span>
      <input type="number" class="form-control" name="ext_no" id="ext_no" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col">
    <label class="form-label" for="mobile_no">City/Town*</label>
    <input type="text" class="form-control" name="town" id="city_town" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
  <div class="col">
    <label class="form-label" for="county">County/Province/State*</label>
    <input type="text" class="form-control" name="county" id="county" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
  <div class="col">
    <label class="form-label" for="p_code">Zip/Postal Code*</label>
    <input type="text" class="form-control" name="p_code" id="p_code" required>
    <div class="invalid-feedback">This field cannot be left blank.</div>
  </div>
</div>
<div class="card-header">Next of Kin</div>
<div class="row">
  <div class="col col-auto">
    <button type="button" class="btn btn-sm btn-primary" onclick="addItem();">
      Add Row
    </button>
  </div>
</div>
<div class="row">
  <div class="col">
    <table class="table table-striped" id="data_table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Relation</th>
          <th scope="col">Phone</th>
          <th scope="col">Email</th>
          <th scope="col" class="col-md-2">Action</th>
        </tr>
      </thead>
      <tbody id="c_table_body">
      </tbody>
    </table>
  </div>
</div>

<script>
  const items_in_table = {};
  const c_table_body = document.querySelector("#c_table_body");


  function updateTable() {
    c_table_body.innerHTML = "";
    console.log(items_in_table);
    for (let item in items_in_table) {

      let tr = document.createElement("tr");

      let kin_name = document.createElement("input");
      kin_name.setAttribute("type", "text");
      kin_name.setAttribute("required", "");
      kin_name.setAttribute("value", items_in_table[item].name);
      kin_name.classList.add("form-control", "form-control-sm", "align-middle");
      kin_name.addEventListener("change", event => {
        items_in_table[item].name = String(event.target.value);
      });
      let kin_name_wrapper = document.createElement("td");
      kin_name_wrapper.appendChild(kin_name);

      let kin_relation = document.createElement("input");
      kin_relation.setAttribute("type", "text");
      kin_relation.setAttribute("required", "");
      kin_relation.setAttribute("value", items_in_table[item].relation);
      kin_relation.classList.add("form-control", "form-control-sm", "align-middle");
      kin_relation.addEventListener("change", event => {
        items_in_table[item].relation = String(event.target.value);
      });
      let kin_relation_wrapper = document.createElement("td");
      kin_relation_wrapper.appendChild(kin_relation);

      let kin_phone = document.createElement("input");
      kin_phone.setAttribute("type", "tel");
      kin_phone.setAttribute("required", "");
      kin_phone.setAttribute("value", items_in_table[item].phone);
      kin_phone.classList.add("form-control", "form-control-sm", "align-middle");
      kin_phone.addEventListener("change", event => {
        items_in_table[item].phone = String(event.target.value);
      });
      let kin_phone_wrapper = document.createElement("td");
      kin_phone_wrapper.appendChild(kin_phone);

      let kin_email = document.createElement("input");
      kin_email.setAttribute("type", "email");
      kin_email.setAttribute("required", "");
      kin_email.setAttribute("value", items_in_table[item].email);
      kin_email.classList.add("form-control", "form-control-sm", "align-middle");
      kin_email.addEventListener("change", event => {
        items_in_table[item].email = String(event.target.value);
      });
      let kin_email_wrapper = document.createElement("td");
      kin_email_wrapper.appendChild(kin_email);

      let actionWrapper = document.createElement("td");
      actionWrapper.classList.add("m-2");
      let action = document.createElement("button");
      action.setAttribute("id", item);
      action.setAttribute("onclick", "removeItem(this.id);");
      let icon = document.createElement("span");
      icon.classList.add("fas", "fa-minus", "mt-1");
      action.appendChild(icon);
      action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
      actionWrapper.appendChild(action);

      tr.append(
        kin_name_wrapper,
        kin_relation_wrapper,
        kin_phone_wrapper,
        kin_email_wrapper,
        actionWrapper
      );
      c_table_body.appendChild(tr);
    }
    return;
  }

  function addItem() {
    const tmp = {
      name: "",
      email: "",
      phone: "",
      relation: "",
    }
    items_in_table[uuidv4()] = tmp;

    updateTable();
  }

  function removeItem(item) {
    delete items_in_table[String(item)];

    updateTable();
  }

  function getNextOfKin() {
    let tmp_obj = [];
    if (c_table_body.innerHTML.trim() == "") {
      return tmp_obj;
    }
    c_table_body.childNodes.forEach(row => {
      const k_name = row.childNodes[0].childNodes[0].value.trim();

      const k_relation = row.childNodes[1].childNodes[0].value.trim();

      const k_phone = row.childNodes[2].childNodes[0].value.trim();

      const k_email = row.childNodes[2].childNodes[0].value.trim();


      if (!(k_name == "" && k_relation == "" && k_phone == "" && k_email == "")) {
        tmp_obj.push({
          name: k_name,
          relation: k_relation,
          phone: k_phone,
          email: k_email,
        });
      }
    });
    return tmp_obj;
  };

  const off_mail = document.querySelector("#off_mail");
  const pers_mail = document.querySelector("#pers_mail");
  const country = document.querySelector("#country");
  const mobile_no = document.querySelector("#mobile_no");
  const official_no = document.querySelector("#official_no");
  const ext_no = document.querySelector("#ext_no");
  const city_town = document.querySelector("#city_town");
  const county = document.querySelector("#county");
  const p_code = document.querySelector("#p_code");


  function getContactDetails() {
    let tmp = {
      official_email: off_mail.value,
      personal_email: pers_mail.value,
      country: country.value,
      mobile_no: mobile_no.value,
      official_no: official_no.value,
      ext_no: ext_no.value,
      city_town: city_town.value,
      county: county.value,
      p_code: p_code.value,
      table_items: JSON.stringify(getNextOfKin()),
    }

    return tmp;
  }
</script>

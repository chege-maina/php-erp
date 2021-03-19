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
      <input type="number" class="form-control" name="official_no" id="official_no" required>
      <div class="invalid-feedback">This field cannot be left blank.</div>
    </div>
  </div>
</div>
<div class="row mt-2">
  <div class="col">
    <label class="form-label" for="mobile_no">City/Town*</label>
    <input type="text" class="form-control" name="town" id="town" required>
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

  function getTableData() {
    let tmp_obj = [];
    let errors = false;
    c_table_body.childNodes.forEach(row => {
      console.log(row);
      // const t_branch = row.childNodes[0].innerHTML;

      // let t_min_val = row.childNodes[1].childNodes[0];
      // if (!t_min_val.validity.valid) {
      // t_min_val.focus();
      // errors = true;
      // return;
      // }
      // t_min_val = t_min_val.value;

      // let t_max_val = row.childNodes[2].childNodes[0];
      // if (!t_max_val.validity.valid) {
      // t_max_val.focus();
      // errors = true;
      // return;
      // }
      // t_max_val = t_max_val.value;

      // let t_reorder_level = row.childNodes[3].childNodes[0];
      // if (!t_reorder_level.validity.valid) {
      // t_reorder_level.focus();
      // errors = true;
      // return;
      // }
      // t_reorder_level = t_reorder_level.value;

      // let t_opening_bal = row.childNodes[4].childNodes[0];
      // if (!t_opening_bal.validity.valid) {
      // t_opening_bal.focus();
      // errors = true;
      // return;
      // }
      // t_opening_bal = t_opening_bal.value;

      // tmp_obj.push({
      // branch: t_branch,
      // min_level: t_min_val,
      // max_level: t_max_val,
      // reorder: t_reorder_level,
      // opening_bal: t_opening_bal,
      // });
    });
    // let to_return = errors ? false : tmp_obj;
    // return to_return;
  };
</script>

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

  function updateTable() {
    table_body.innerHTML = "";
    for (let item in items_in_table) {

      let tr = document.createElement("tr");
      // Id will be like 1Tank
      // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

      let branch_name = document.createElement("td");
      branch_name.appendChild(document.createTextNode(items_in_table[item].branch));
      branch_name.classList.add("align-middle");

      let min_level = document.createElement("input");
      const min_level_id = uuidv4();
      min_level.setAttribute("type", "number");
      min_level.setAttribute("id", min_level_id);
      min_level.setAttribute("required", "");
      min_level.classList.add("form-control", "form-control-sm", "align-middle");
      // min_level.setAttribute("data-ref", items_in_table[item]["name"]);
      min_level.setAttribute("min", 1);

      // make sure the min_level is always greater than 0
      // min_level.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // min_level.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      // min_level.setAttribute("onclick", "this.select();");
      min_level.addEventListener("input", (event) => {
        items_in_table[item].min_level = Number(event.target.value);
      })
      items_in_table[item]['min_level'] = ('min_level' in items_in_table[item] && items_in_table[item]['min_level'] > 0) ?
        items_in_table[item]['min_level'] : 1;
      min_level.value = items_in_table[item]['min_level'];
      let min_levelWrapper = document.createElement("td");
      min_levelWrapper.classList.add("m-2", "col-2");
      min_levelWrapper.appendChild(min_level);



      const max_level_id = uuidv4();
      const reorder_level_id = uuidv4();

      let max_level = document.createElement("input");
      max_level.setAttribute("type", "number");
      max_level.setAttribute("id", max_level_id);
      max_level.setAttribute("required", "");
      max_level.classList.add("form-control", "form-control-sm", "align-middle");
      max_level.setAttribute("data-min", min_level_id);
      max_level.setAttribute("min", 1);

      // make sure the max_level is always greater than 0
      max_level.setAttribute("onfocusout",
        "document.querySelector('#" + reorder_level_id + "').setAttribute('max', this.value)");
      // max_level.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      max_level.setAttribute("onclick", "this.select();");
      items_in_table[item]['max_level'] = ('max_level' in items_in_table[item] && items_in_table[item]['max_level'] > 0) ?
        items_in_table[item]['max_level'] : 1;
      max_level.value = items_in_table[item]['max_level'];

      max_level.addEventListener("input", (event) => {
        items_in_table[item].max_level = Number(event.target.value);
      })
      let max_levelWrapper = document.createElement("td");
      max_levelWrapper.classList.add("m-2", "col-2");
      max_levelWrapper.appendChild(max_level);



      let reorder_level = document.createElement("input");
      reorder_level.setAttribute("id", reorder_level_id);
      reorder_level.setAttribute("type", "number");
      reorder_level.setAttribute("required", "");
      reorder_level.classList.add("form-control", "form-control-sm", "align-middle");
      // reorder_level.setAttribute("data-ref", items_in_table[item]["name"]);
      reorder_level.setAttribute("min", 1);
      // reorder_level.setAttribute("max", items_in_table[item]['max']);

      // make sure the reorder_level is always greater than 0
      reorder_level.setAttribute("onfocusout",
        "document.querySelector('#" + max_level_id + "').setAttribute('min', this.value)");
      reorder_level.setAttribute("onchange",
        "document.querySelector('#" + min_level_id + "').setAttribute('max', this.value)");
      // reorder_level.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // reorder_level.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      reorder_level.setAttribute("onclick", "this.select();");
      items_in_table[item]['reorder_level'] = ('reorder_level' in items_in_table[item] && items_in_table[item]['reorder_level'] > 0) ?
        items_in_table[item]['reorder_level'] : 1;
      reorder_level.value = items_in_table[item]['reorder_level'];

      reorder_level.addEventListener("input", (event) => {
        items_in_table[item].reorder_level = Number(event.target.value);
      })
      let reorder_levelWrapper = document.createElement("td");
      reorder_levelWrapper.classList.add("m-2", "col-2");
      reorder_levelWrapper.appendChild(reorder_level);




      let opening_balance = document.createElement("input");
      opening_balance.setAttribute("type", "number");
      opening_balance.setAttribute("required", "");
      opening_balance.classList.add("form-control", "form-control-sm", "align-middle");
      // opening_balance.setAttribute("data-ref", items_in_table[item]["name"]);
      opening_balance.setAttribute("min", 0);
      // opening_balance.setAttribute("max", items_in_table[item]['max']);

      // make sure the opening_balance is always greater than 0
      // opening_balance.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
      // opening_balance.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
      opening_balance.setAttribute("onclick", "this.select();");
      items_in_table[item]['opening_balance'] = ('opening_balance' in items_in_table[item] && items_in_table[item]['opening_balance'] >= 0) ?
        items_in_table[item]['opening_balance'] : 0;
      opening_balance.value = items_in_table[item]['opening_balance'];

      opening_balance.addEventListener("input", (event) => {
        items_in_table[item].opening_balance = Number(event.target.value);
      })
      let opening_balanceWrapper = document.createElement("td");
      opening_balanceWrapper.classList.add("m-2", "col-2");
      opening_balanceWrapper.appendChild(opening_balance);


      let actionWrapper = document.createElement("td");
      actionWrapper.classList.add("m-2");
      let action = document.createElement("button");
      action.setAttribute("id", items_in_table[item]["branch"]);
      action.setAttribute("onclick", "removeItem(this.id);");
      let icon = document.createElement("span");
      icon.classList.add("fas", "fa-minus", "mt-1");
      action.appendChild(icon);
      action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
      actionWrapper.appendChild(action);

      tr.append(branch_name,
        min_levelWrapper,
        max_levelWrapper,
        reorder_levelWrapper,
        opening_balanceWrapper,
        actionWrapper
      );
      table_body.appendChild(tr);


      // tr.append(branch_name, balance_td, units_td, quantityWrapper, actionWrapper);
      // table_body.appendChild(tr);

    }
    return;
  }
</script>

<div class="modal fade" id="catCRUDModal" width="60vw" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">

    <div class="modal-content border-0">
      <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
          <h4 class="mb-1" id="modalHeader">Chart of Accounts</h4>
        </div>
        <div class="p-4">
          <!-- Form -->
          <form id="add_ct_frm" name="add_ct_frm">
            <div class="p2">
              <label for="parent_name" class="form-label">Parent Name*</label>
              <input type="text" name="parent_name" id="parent_name" class="form-control" required readonly>
            </div>

            <div class="p2">
              <label for="head_name" class="form-label">Head Name*</label>
              <input type="text" name="head_name" id="head_name" class="form-control" required>
            </div>

            <div class="row mt-1">
              <div class="col">
                <label for="head_code" class="form-label">Head Code*</label>
                <input type="text" name="head_code" id="head_code" class="form-control" required>
              </div>
              <div class="col">
                <label for="head_level" class="form-label">Head Level*</label>
                <input type="text" name="head_level" id="head_level" class="form-control" required readonly>
              </div>
            </div>

            <div class="row mt-1">
              <div class="col">
                <label for="account_type" class="form-label">Account Type*</label>
                <select name="account_type" id="account_type" class="form-select" required>
                  <option value="debit">debit</option>
                  <option value="credit">credit</option>
                </select>
              </div>
              <div class="col">
                <label for="carrying_forward" class="form-label">Carrying Forward*</label>
                <select name="carrying_forward" id="carrying_forward" class="form-select" required>
                  <option value="yes">yes</option>
                  <option value="no">no</option>
                </select>
              </div>
            </div>

            <div class="row mt-1">
              <div class="col-auto">
                <input type="button" value="Save" class="btn btn-falcon-primary mt-3" id="save_account" name="save_account" onclick="saveDetails()">
                <input type="button" value="Add Child" class="btn btn-falcon-primary mt-3 ml-1" id="add_child_submit" name="add_ct_submit" onclick="addNewChild()">
              </div>
              <div class="col-auto">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  const parent_name = document.querySelector("#parent_name");
  const head_name = document.querySelector("#head_name");
  const head_code = document.querySelector("#head_code");
  const head_level = document.querySelector("#head_level");
  const account_type = document.querySelector("#account_type");
  const carrying_forward = document.querySelector("#carrying_forward");
  const add_child_submit = document.querySelector("#add_child_submit");
  const save_account = document.querySelector("#save_account");


  let parent_children_map;
  let item_object;
  let command;
  let parent_object = {};
  let adding_child = false;

  function addNewChild() {
    if (!adding_child) {
      save_account.disabled = true;
      parent_name.value = item_object.name;
      head_name.value = "";
      head_code.value = "";
      account_type.value = "debit";
      head_level.value = Number(head_level.value) + 1;
      console.log("About to save");
      add_child_submit.value = "Save Child";
      adding_child = true;
    } else {
      // We are adding children, commit
      if (!head_name.validity.valid) {
        head_name.focus();
        return;
      } else if (!head_code.validity.valid) {
        head_code.focus();
        return;
      }


      console.log("===================================");
      console.log("parent_code", item_object.code);
      console.log("head_code", head_code.value);
      console.log("head_name", head_name.value);
      console.log("account_type", account_type.value);
      console.log("carrying_forward", carrying_forward.value == "no" ? 0 : 1);
      console.log("===================================");

      const formData = new FormData();
      formData.append("parent_code", item_object.code);
      formData.append("head_code", head_code.value);
      formData.append("head_name", head_name.value);
      formData.append("account_type", account_type.value);
      formData.append("carrying_forward", carrying_forward.value == "no" ? 0 : 1);

      fetch('./php_scripts/add_node.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.text())
        .then(result => {
          console.log("Saved yay", result);
          return;
          if (result.message == 'success') {
            // location.reload();
          }
        })
        .catch(error => {
          console.error('Error:', error);
        });

    }
  }

  function getChildParent(child_code) {
    const raw_data = JSON.parse(window.sessionStorage.getItem("raw_data"));
    let found = false;

    raw_data.forEach(row => {
      if (row.child_number == child_code) {
        found = true;
        parent_object = {
          code: row.parent_number,
          title: row.parent_title,
        };
      }
    });

    parent_object = found ? parent_object : {
      code: 0,
      title: ""
    };

    return parent_object.title;
  }

  function isChildCarryingForward(child_code) {
    const raw_data = JSON.parse(window.sessionStorage.getItem("raw_data"));
    let child_object = {};

    raw_data.forEach(row => {
      if (row.child_number == child_code) {
        child_object = {
          code: row.child_number,
          title: row.child_title,
          carrying_forward: Boolean(Number(row.child_carrying_forward))
        };
      }
    });

    return child_object.carrying_forward;
  }

  function showModal() {
    // If previously disabled, enable it.
    save_account.removeAttribute("disabled");

    if (command === "edit") {
      if (Number(item_object.level) == 3) {
        add_child_submit.disabled = true;
      } else {
        add_child_submit.removeAttribute("disabled");
      }

      head_name.value = item_object.name;
      head_code.value = "code" in item_object ? item_object.code : "";
      parent_name.value = getChildParent(item_object.code);
      parent_name.value = getChildParent(item_object.code);
      carrying_forward.value = isChildCarryingForward(item_object.code) ? 'yes' : 'no';
      account_type.value = item_object.type;
      head_level.value = Number(item_object.level);
    } else if (command === "add_root") {
      add_child_submit.disabled = true;
      save_account.disabled = true;
      head_level.value = 1;
    }

    $('#catCRUDModal').modal('show');
  }

  function saveDetails() {
    if (!head_name.validity.valid) {
      head_name.focus();
      return;
    } else if (!head_code.validity.valid) {
      head_code.focus();
      return;
    }


    console.log("===================================");
    console.log("prev_code", item_object.code);
    console.log("head_code", head_code.value);
    console.log("head_name", head_name.value);
    console.log("account_type", account_type.value);
    console.log("carrying_forward", carrying_forward.value == "no" ? 0 : 1);
    console.log("===================================");

    const formData = new FormData();
    formData.append("prev_code", item_object.code);
    formData.append("head_code", head_code.value);
    formData.append("head_name", head_name.value);
    formData.append("account_type", account_type.value);
    formData.append("carrying_forward", carrying_forward.value == "no" ? 0 : 1);

    fetch('./php_scripts/update_node.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log('Success:', result);
        if (result.message == 'success') {
          location.reload();
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
    $('#catCRUDModal').modal('hide');
  }

  window.addEventListener('show_category_crud', event => {
    const id = event.detail.id;
    command = event.detail.command;

    if (command != "add_root") {
      const index = JSON.parse(event.detail.index);
      parent_children_map = JSON.parse(sessionStorage.getItem("items"));

      const [...item_path_array] = index[id];

      let level_2_item;
      let level_3_item;
      let level_4_item;
      let level_5_item;
      switch (item_path_array.length) {
        case 1:
          let tmp_obj = {};
          tmp_obj = parent_children_map[item_path_array[0]];
          ({
            ...item_object
          } = tmp_obj);
          item_object.name = item_path_array[0];
          item_object.level = 1;
          break;

        case 2:
          // 1. Get the level 2 item;
          parent_children_map[item_path_array[0]].children_to_add.forEach(item => {
            if (item.name == item_path_array[1]) {
              level_2_item = item;
            }
          });

          ({
              ...item_object
            } =
            level_2_item
          );
          item_object.level = 2;
          break;

        case 3:
          // 1. Get the level 2 item;
          parent_children_map[item_path_array[0]].children_to_add.forEach(item => {
            if (item.name == item_path_array[1]) {
              level_2_item = item;
            }
          });
          // 2. At level three, the level_2_item is in root, get it's children
          parent_children_map[level_2_item.name].children_to_add.forEach(item => {
            if (item.name == item_path_array[2]) {
              level_3_item = item;
            }
          });

          ({
              ...item_object
            } =
            level_3_item
          );
          item_object.level = 3;
          break;

        case 4:
          // 1. Get the level 2 item;
          parent_children_map[item_path_array[0]].children_to_add.forEach(item => {
            if (item.name == item_path_array[1]) {
              level_2_item = item;
            }
          });
          // 2. At level three, the level_2_item is in root, get it's children
          parent_children_map[level_2_item.name].children_to_add.forEach(item => {
            if (item.name == item_path_array[2]) {
              level_3_item = item;
            }
          });

          // 3. At level four, the level_3_item is in root, get it's children
          parent_children_map[level_3_item.name].children_to_add.forEach(item => {
            if (item.name == item_path_array[3]) {
              level_4_item = item;
            }
          });

          ({
              ...item_object
            } =
            level_4_item
          );
          item_object.level = 4;

          break;
        case 5:
          // 1. Get the level 2 item;
          parent_children_map[item_path_array[0]].children_to_add.forEach(item => {
            if (item.name == item_path_array[1]) {
              level_2_item = item;
            }
          });
          // 2. At level three, the level_2_item is in root, get it's children
          parent_children_map[level_2_item.name].children_to_add.forEach(item => {
            if (item.name == item_path_array[2]) {
              level_3_item = item;
            }
          });

          // 3. At level four, the level_3_item is in root, get it's children
          parent_children_map[level_3_item.name].children_to_add.forEach(item => {
            if (item.name == item_path_array[3]) {
              level_4_item = item;
            }
          });

          // 3. At level four, the level_4_item is in root, get it's children
          parent_children_map[level_4_item.name].children_to_add.forEach(item => {
            if (item.name == item_path_array[4]) {
              level_5_item = item;
            }
          });

          ({
              ...item_object
            } =
            level_5_item
          );
          item_object.level = 5;
      }

      item_object.path = item_path_array;
    }

    showModal();
  });
</script>

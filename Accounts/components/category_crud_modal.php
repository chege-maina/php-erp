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
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
            </div>

            <div class="row mt-1">
              <div class="col-auto">
                <input type="button" value="Save" class="btn btn-falcon-primary mt-3" id="add_ct_submit" name="add_ct_submit" onclick="saveDetails()">
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

  let parent_children_map;
  let item_object;
  let command;
  let parent_object = {};

  function addNewChild() {
    console.log("About to save");
  }

  function getChildParent(child_code) {
    const raw_data = JSON.parse(window.sessionStorage.getItem("raw_data"));
    let found = false;

    raw_data.forEach(row => {
      if (row.child_number = child_code) {
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

    console.log(child_code, raw_data);
    return parent_object.title;
  }

  function showModal() {
    console.log("Showing", item_object);
    if (command === "edit") {
      head_name.value = item_object.name;
      head_code.value = "code" in item_object ? item_object.code : "";
      parent_name.value = getChildParent(item_object.code);
      account_type.value = item_object.type;
      head_level.value = Number(item_object.level) + 1;
      $('#catCRUDModal').modal('show');
    }
  }

  function saveDetails() {
    const path = item_object.path
    switch (path.length) {
      case 1:
        console.log(parent_children_map[path[0]]);
        const {
          ...tmp_obj
        } = parent_children_map[path[0]];

        // Now that we have the detail object of this item, check if the key has changed
        if (head_name.value !== path[0]) {
          console.log("Node name has changed");
          delete parent_children_map[path[0]];
          parent_children_map[head_name.value] = tmp_obj;
          sessionStorage.setItem("items", JSON.stringify(parent_children_map));

          const ev = new StorageEvent("storage", {
            key: "items",
          });
          window.dispatchEvent(ev);
        }
        break;
    }
    $('#catCRUDModal').modal('hide');
  }

  window.addEventListener('show_category_crud', event => {
    const id = event.detail.id;
    const index = JSON.parse(event.detail.index);
    parent_children_map = JSON.parse(sessionStorage.getItem("items"));
    command = event.detail.command;

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
    showModal();
  });
</script>

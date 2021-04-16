<script>
  window.addEventListener('show_category_crud', event => {
    const id = event.detail.id;
    const index = JSON.parse(event.detail.index);
    const parent_children_map = JSON.parse(sessionStorage.getItem("items"));

    const [...item_path_array] = index[id];

    console.log(item_path_array);

    let level_2_item;
    let level_3_item;
    let level_4_item;
    let level_5_item;
    switch (item_path_array.length) {
      case 1:
        console.log(id, parent_children_map[item_path_array[0]]);
        break;

      case 2:
        // 1. Get the level 2 item;
        parent_children_map[item_path_array[0]].children_to_add.forEach(item => {
          if (item.name == item_path_array[1]) {
            level_2_item = item;
          }
        });
        console.log(id, level_2_item);
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
        console.log(id, level_3_item);
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

        console.log(id, level_4_item);

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


        console.log(id, level_5_item);
    }

    // $('#catCRUDModal').modal('show');
  });
</script>

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
              <label for="head_code" class="form-label">Head Name*</label>
              <input type="text" name="head_code" id="head_code" class="form-control" required>
            </div>

            <div class="row mt-1">
              <div class="col">
                <label for="head_code" class="form-label">Head Code*</label>
                <input type="text" name="head_code" id="head_code" class="form-control" required>
              </div>
              <div class="col">
                <label for="head_level" class="form-label">Head Level*</label>
                <input type="text" name="head_level" id="head_level" class="form-control" required>
              </div>
            </div>

            <div class="row mt-1">
              <div class="col">
                <label for="account_type" class="form-label">Account Type*</label>
                <select name="account_type" id="account_type" class="form-select" required>
                  <option value="Debit">Debit</option>
                  <option value="Credit">Credit</option>
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

            <input type="button" value="Add" class="btn btn-falcon-primary mt-3" id="add_ct_submit" name="add_ct_submit" data-dismiss="modal">
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

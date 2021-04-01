<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">

        <div class="input-group">
          <select class="form-select form-select-sm" name="branch" id="branch_select">
            <option value disabled selected>
              ----
            </option>
          </select>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-falcon-default btn-sm input-group-btn" onclick="filterWithBranch()">
            <span class="fas fa-check" data-fa-transform="shrink-3"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const branch_select = document.querySelector("#branch_select");
  window.addEventListener('AllItemsLoaded', (event) => {

    branch_select.innerHTML = "";
    branch_list.forEach((value) => {
      let opt = document.createElement("option");
      opt.appendChild(document.createTextNode(value));
      opt.value = value;
      branch_select.appendChild(opt);
    });


  });

  function filterWithBranch() {
    const to_branch = branch_select.value;
    json_items = getItemsArray(to_branch);

    const ev = new CustomEvent('ItemsUpdated', {
      detail: JSON.stringify(json_items)
    });
    window.dispatchEvent(ev);


    document.querySelector("#product_category").value = "";
    document.querySelector("#sub_category").value = "";
  }
</script>

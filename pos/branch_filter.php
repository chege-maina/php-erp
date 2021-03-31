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
          <button type="button" class="btn btn-falcon-default btn-sm input-group-btn" onclick="addItem()">
            <span class="fas fa-check" data-fa-transform="shrink-3"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('DOMContentLoaded', (event) => {
    const branch_select = document.querySelector("#branch_select");


    fetch('../includes/load_branch_items.php')
      .then(response => response.json())
      .then(data => {
        data.forEach((value) => {
          let opt = document.createElement("option");
          opt.appendChild(document.createTextNode(value['branch']));
          opt.value = value['branch'];
          branch_select.appendChild(opt);
        });
      });

  });
</script>

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col pr-1">
        <input list="category_list" class="form-select form-select-sm" id="product_category" placeholder="Categories" onchange="updateSubCategories();" required />
        <datalist id="category_list">
        </datalist>
      </div>
      <div class="col p-0">
        <input list="subcategories_list" class="form-select form-select-sm" id="sub_category" placeholder="Sub Categories" required />
        <datalist id="subcategories_list">
        </datalist>
      </div>
      <div class="col col-auto pl-1">
        <button class="btn btn-falcon-default btn-sm" onclick="filterWithCategories();">
          <span class="fas fa-check" data-fa-transform="shrink-3"></span>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  const category_list = document.querySelector("#category_list");
  const product_category = document.querySelector("#product_category");
  const sub_category = document.querySelector("#sub_category");


  const subcategories_list = document.querySelector("#subcategories_list");


  function filterWithCategories() {
    if (!product_category.validity.valid) {
      product_category.focus();
      return;
    }
    if (!sub_category.validity.valid) {
      sub_category.focus();
      return;
    }
    console.log("Filtering with: ", product_category.value, sub_category.value);
    getFilteredByCats(product_category.value, sub_category.value);
  }

  // Add the no-selectable item first
  let opt = document.createElement("option");
  fetch('../includes/load_category.php')
    .then(response => response.json())
    .then(data => {
      data.forEach((value) => {
        let opt = document.createElement("option");
        opt.value = value['category'];
        category_list.appendChild(opt);
      });
    });

  // Populate subcategories array
  fetch('../includes/load_subcategory.php')
    .then(response => response.json())
    .then(data => {
      subcategories_dict = [];
      data.forEach(row => {
        subcategories_dict[row.category] = row.subcategories;
      });
      updateSubCategories();
    });

  let subcategories_dict = {};

  function updateSubCategories() {
    if (!product_category.value) {
      return;
    }

    // Clear it
    sub_category.value = "";
    subcategories_list.innerHTML = "";
    // Add the no-selectable item first
    let opt = document.createElement("option");

    let sub_cats = subcategories_dict[product_category.value];

    sub_cats.forEach((sub_cat) => {
      let opt = document.createElement("option");
      opt.value = sub_cat['subcategory'];
      subcategories_list.appendChild(opt);
    });
  }
</script>

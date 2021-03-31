<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col pr-1">
        <input list="category_list" class="form-select form-select-sm" name="product_category" id="product_category" placeholder="Categories" onchange="updateSubCategories();" />
        <datalist id="category_list">
        </datalist>
      </div>
      <div class="col p-0">
        <input list="subcategories_list" class="form-select form-select-sm" id="ice-cream-choice" name="ice-cream-choice" placeholder="Sub Categories" />
        <datalist id="subcategories_list">
        </datalist>
      </div>
      <div class="col col-auto pl-1">
        <button class="btn btn-falcon-default btn-sm">
          <span class="fas fa-check" data-fa-transform="shrink-3"></span>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  const category_list = document.querySelector("#category_list");
  const product_category = document.querySelector("#product_category");

  const subcategories_list = document.querySelector("#subcategories_list");

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
    console.log("Subs", subcategories_dict);
    if (!product_category.value) {
      return;
    }

    // Clear it
    subcategories_list.innerHTML = "";
    // Add the no-selectable item first
    let opt = document.createElement("option");

    let sub_cats = subcategories_dict[product_category.value];
    console.log("Subbed", sub_cats);

    sub_cats.forEach((sub_cat) => {
      let opt = document.createElement("option");
      opt.value = sub_cat['subcategory'];
      subcategories_list.appendChild(opt);
    });
  }
</script>

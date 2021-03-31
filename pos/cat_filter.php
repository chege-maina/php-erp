<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <input list="category_list" class="form-select form-select-sm" name="product_category" placeholder="Categories" />
        <datalist id="category_list">
        </datalist>
      </div>
      <div class="col">
        <input list="bice-cream-flavors" class="form-select form-select-sm" id="ice-cream-choice" name="ice-cream-choice" placeholder="Sub Categories" />
        <datalist id="subcategories_list">
          <option value="Chocolate">
          <option value="Coconut">
          <option value="Mint">
          <option value="Strawberry">
          <option value="Vanilla">
        </datalist>
      </div>
      <div class="col col-auto">
        <button class="btn btn-falcon-default btn-sm">
          Apply
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  const category_list = document.querySelector("#category_list");

  // Add the no-selectable item first
  let opt = document.createElement("option");
  fetch('../includes/load_category.php')
    .then(response => response.json())
    .then(data => {
      console.log("Loaded data", data);
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
    if (!category_list.value) {
      return;
    }

    // Clear it
    sub_group.innerHTML = "";
    // Add the no-selectable item first
    let opt = document.createElement("option");
    opt.appendChild(document.createTextNode("-- Select Group --"));
    opt.setAttribute("value", "");
    opt.setAttribute("disabled", "");
    opt.setAttribute("selected", "");
    sub_group.appendChild(opt);


    let sub_cats = subcategories_dict[category_list.value];
    console.log(sub_cats);
    console.log(sub_cats)
    sub_cats.forEach((sub_cat) => {
      let opt = document.createElement("option");
      opt.appendChild(document.createTextNode(sub_cat['subcategory'].toLowerCase()));
      opt.value = sub_cat['subcategory'];
      sub_group.appendChild(opt);
    });
  }
</script>

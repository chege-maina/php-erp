<script>
  // TODO: Requirements
  // Close and start session
  // Validation of the above

  let branch_list = [];
  let current_item_list = [];

  function getBaseUrl() {
    // HACK: This is to accomadate xampp devs
    const path = window.location.pathname.split('/');
    let xampp_offset = "";
    if (path.length > 3) {
      xampp_offset = "/" + path[1];
    }
    const url = window.location.href.split(window.location.host)[0] + window.location.host + xampp_offset;
    return url;
  }

  let branch_items = {};
  window.addEventListener('DOMContentLoaded', (event) => {

    fetch('./pos_items_sales.php')
      .then(response => response.json())
      .then(data => {
        data.forEach(value => {
          branch_list.push(value.branch);
          branch_items[value.branch] = value.branch_stuff;
        });
        // console.log("Look at the data", data);

        // TODO: Get branch from session
        const first_branch = data[0].branch;
        // console.log("yaaah: ", getItemsArray(first_branch));
        json_items = getItemsArray(first_branch);


        const ev = new CustomEvent('AllItemsLoaded', {
          detail: JSON.stringify(json_items)
        });
        window.dispatchEvent(ev);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  });

  function getItemsArray(branch_name) {
    let tmp = [];
    let i = 1;
    branch_items[branch_name].forEach(product => {
      tmp.push({
        key: i,
        name: product.name,
        code: product.code,
        stock: product.balance,
        quantity: 1,
        balance: product.balance,
        price: Number(product.price),
        discount: 0,
        tax: 0,
        tax_pc: product.tax,
        subtotal: 0,
        image_url: getBaseUrl() + product.path,
        bulk_unit: product.unit,
        atomic_unit: product.atomic_unit,
        bulk_price: Number(product.bs_price),
        category: product.category,
        sub_category: product.sub_category,
      })
    });
    [...current_item_list] = tmp;
    return tmp;
  }
</script>

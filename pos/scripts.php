<script>
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
          branch_items[value.branch] = value.branch_stuff;
        });
        console.log("Fetched: ", branch_items);
        console.log("yaaah: ", getItemsArray("MM1"));
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
        price: product.price,
        discount: 0,
        tax: 0,
        tax_pc: product.tax,
        subtotal: 0,
        image_url: getBaseUrl() + product.path,
        bulk_unit: product.unit,
        atomic_unit: product.atomic_unit,
        bulk_price: product.bs_price,
      })
    });
    return tmp;
  }
</script>

<style>
  /* The Modal (background) */
  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.6);
    /* Black w/ opacity */
  }

  /* Modal Content/Box */
  .modal-content {
    margin: 10% auto;
    /* 15% from the top and centered */
    border: 1px solid #888;
    width: 80%;
    /* Could be more or less, depending on screen size */
  }

  /* The Close Button */
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
</style>
<nav class="navbar fixed-bottom navbar-light py-2 mr-0">
  <div class="row container-fluid d-flex justify-content-end mr-0 p-0">
    <div class="col col-auto p-0 mr-0">
      <div class="card p-2 mr-0">
        <div class="row">
          <div class="col">
            <label class="form-label" for="product_name">Net Total*</label>
            <input type="text" id="fab_net_total" class="form-control form-control-sm form-inline" readonly>
          </div>
          <div class="col col-auto d-flex align-items-end">
            <!-- Trigger/Open The Modal -->
            <button id="myBtn" class="btn btn-falcon-primary">Checkout</button>

            <!-- The Modal -->
            <div id="myModal" class="modal">

              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <script src="https://unpkg.com/vue"></script>
                <script src="../components/vue-components/fpos-checkout/dist/fpos-checkout.js"></script>


                <div id="checkout_div">
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
  const checkout_div = document.querySelector("#checkout_div");

  let page_main;
  let page_checkout;
  window.addEventListener('DOMContentLoaded', (event) => {
    page_main = document.querySelector("#page_main");
    page_checkout = document.querySelector("#page_checkout");
  });



  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function() {
    // page_main.classList.add("hide_page");
    // page_checkout.classList.remove("hide_page");

    // ==========================================
    // Create and show the modal
    // ==========================================
    const sendable_data = JSON.parse(window.sessionStorage.getItem("sendable_table"));
    console.log(sendable_data);
    const checkout_modal = document.createElement("fpos-checkout");

    checkout_modal.setAttribute("title", "POS Checkout Modal");
    checkout_modal.setAttribute("subtotal", sendable_data.grand_total);
    checkout_div.innerHTML = "";
    checkout_div.appendChild(checkout_modal);


    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  // window.onclick = function(event) {
  // if (event.target == modal) {
  // modal.style.display = "none";
  // }
  // }

  window.addEventListener('checkout_now', (event) => {
    console.log("ready");
    const sendableTable = JSON.parse(sessionStorage.getItem("sendable_table"));
    const rawTableItems = sendableTable["table_items"];
    const groupedByBranch = {};
    rawTableItems.forEach(item => {
      console.log(item);
      // Initialize it if necessary
      groupedByBranch[item.branch] =
        item.branch in groupedByBranch ?
        groupedByBranch[item.branch] : [];

      // Add this item
      groupedByBranch[item.branch].push({
        p_code: item.code,
        p_name: item.name,
        p_branch: item.branch,
        p_tax_pc: item.tax_pc,
        // This is the bulk unit
        p_units: item.bulk_units,
        p_price: item.bulk_price,
        p_amount: item.subtotal,
        p_tax: item.tax,
        // TODO: Add this in item cards
        p_conversion: item.conversion,
        p_atomic_unit: item.units,
        p_atomic_price: item.price,
        p_selected_unit: item.current_unit,
        p_quantity: item.current_unit === item.units ?
          item.quantity / item.conversion : item.quantity,
        p_entered_price: item.current_price,
      });
    });

    // HACK: Told to ungroup
    const ungroupedTable = [];

    for (key in groupedByBranch) {
      groupedByBranch[key].forEach(item => {
        ungroupedTable.push(item);
      });
    }

    const user_name = "<?= $_SESSION['name'] ?>";
    const user_branch = "<?= $_SESSION['branch'] ?>";

    // sendableTable["table_items"] = groupedByBranch;
    sendableTable["table_items"] = ungroupedTable;
    sendableTable["user_name"] = user_name;
    sendableTable["user_branch"] = user_branch;

    console.log("============================================");

    const formData = new FormData();

    for (key in sendableTable) {
      console.log(key, " : ",
        sendableTable[key]);
      formData.append(key, sendableTable[key]);
    }

    fetch('./add_pos_sale.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(result => {
        console.log('Success:', result);
      })
      .catch(error => {
        console.error('Error:', error);
      });
  });
</script>

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
            <input type="text" class="form-control form-control-sm form-inline">
          </div>
          <div class="col">
            <label class="form-label" for="product_name">Paid Amount*</label>
            <input type="text" class="form-control form-control-sm form-inline">
          </div>
          <div class="col">
            <label class="form-label" for="product_name">Change Due*</label>
            <input type="text" class="form-control form-control-sm form-inline">
          </div>
          <div class="col col-auto d-flex align-items-end">
            <!-- Trigger/Open The Modal -->
            <button id="myBtn" class="btn btn-falcon-primary">Open Modal</button>

            <!-- The Modal -->
            <div id="myModal" class="modal">

              <!-- Modal content -->
              <div class="modal-content">
                <span class="close">&times;</span>
                <script src="https://unpkg.com/vue"></script>
                <script src="../components/vue-components/fpos-checkout/dist/fpos-checkout.js"></script>


                <fpos-checkout></fpos-checkout>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks on the button, open the modal
  btn.onclick = function() {
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
</script>

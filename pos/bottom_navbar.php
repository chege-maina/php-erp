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
            <button type="button" id="sub_group_btn" class="btn btn-falcon-primary" data-toggle="modal" data-target="#checkoutPage">
              Checkout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="checkoutPage" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">

    <div class="modal-content border-0">
      <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
          <h4 class="mb-1" id="addUnitLabel">Checkout</h4>
        </div>
        <div class="p-4">
          Checkout from here
        </div>
      </div>
    </div>

  </div>
</div>

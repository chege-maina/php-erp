<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <div class="input-group">
          <input type="text" name="bar_code" id="bar_code" class="form-control form-control-sm" placeholder="Barcode">
          <button class="btn btn-falcon-default btn-sm">
            <span class="fas fa-barcode"></span>
          </button>
        </div>
      </div>
      <div class="col">
        <div class="input-group">
          <input list="customer-list" class="form-select form-select-sm" id="ice-cream-choice" name="ice-cream-choice" placeholder="Customers" />
          <datalist id="customer-list">
            <option value="Chocolate">
            <option value="Coconut">
            <option value="Mint">
            <option value="Strawberry">
            <option value="Vanilla">
          </datalist>
          <button class="btn btn-falcon-default btn-sm">
            +
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

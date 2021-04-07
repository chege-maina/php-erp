<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="d-flex justify-content-end">
        <div class="col col-md-6">
          <table class="table table-sm table-striped table-hover">
            <tbody>
              <tr>
                <td class="text-right align-middle">

                  <label class="form-label">Total Before Tax</label>
                </td>
                <td class="col">
                  <input type="text" class="form-control form-control-sm col-md-1" name="total_before_tax" id="total_before_tax">
                </td>
              </tr>
              <tr>
                <td class="text-right align-middle">
                  <label class="form-label">Tax 16%</label>
                </td>
                <td class="col">
                  <input type="text" class="form-control form-control-sm col-md-1" name="tax_total" id="tax_total">
                </td>
              </tr>
              <tr>
                <td class="text-right align-middle">
                  <label class="form-label">Grand Total</label>
                </td>
                <td class="col">
                  <input type="text" class="form-control form-control-sm col-md-1" name="grand_total" id="grand_total">
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('calculate_subtotals', function(e) {
    console.log("Ready to rumble");
  }, false);
</script>

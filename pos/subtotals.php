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
  let i = 0;

  window.addEventListener('calculate_subtotals', function(e) {
    const table_data = JSON.parse(window.sessionStorage.getItem("table_data"));
    const table_array = [];
    let cumulative_tax_total = 0;
    let cumulative_total_pretax = 0;
    let cumulative_grand_total = 0;

    for (let key in table_data) {
      const row = table_data[key];
      table_array.push(row);
      cumulative_tax_total += Number(row.tax);
      cumulative_total_pretax += Number(row.subtotal) - Number(row.tax);
      cumulative_grand_total += Number(row.subtotal);
    }
    console.log(`Tax: ${cumulative_tax_total} -- Pretax: ${cumulative_total_pretax} -- Grand ${cumulative_grand_total}`)
  }, false);
</script>

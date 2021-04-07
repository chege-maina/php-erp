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
                  <input type="text" class="form-control form-control-sm col-md-1" name="total_before_tax" id="total_before_tax" readonly>
                </td>
              </tr>
              <tr>
                <td class="text-right align-middle">
                  <label class="form-label">Tax 16%</label>
                </td>
                <td class="col">
                  <input type="text" class="form-control form-control-sm col-md-1" name="tax_total" id="tax_total" readonly>
                </td>
              </tr>
              <tr>
                <td class="text-right align-middle">
                  <label class="form-label">Grand Total</label>
                </td>
                <td class="col">
                  <input type="text" class="form-control form-control-sm col-md-1" name="grand_total" id="grand_total" readonly>
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
  const total_before_tax = document.querySelector("#total_before_tax");
  const tax_total = document.querySelector("#tax_total");
  const grand_total = document.querySelector("#grand_total");
  const fab_net_total = document.querySelector("#fab_net_total");


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

    cumulative_tax_total = cumulative_tax_total.toFixed(2);
    cumulative_grand_total = cumulative_grand_total.toFixed(2);
    cumulative_total_pretax = cumulative_total_pretax.toFixed(2);
    const tmp_obj = {
      tax_total: cumulative_tax_total,
      pretax_total: cumulative_total_pretax,
      grand_total: cumulative_grand_total,
      table_items: table_array,
    }

    sessionStorage.setItem("sendable_table", JSON.stringify(tmp_obj));

    total_before_tax.value = numberWithCommas(cumulative_total_pretax);
    tax_total.value = numberWithCommas(cumulative_tax_total);
    grand_total.value = numberWithCommas(cumulative_grand_total);
    fab_net_total.value = numberWithCommas(cumulative_grand_total);
  }, false);


  function numberWithCommas(x) {
    if (isNaN(x)) {
      return x;
    }
    var parts = x.toString().split(".");
    if (parts.length < 2) {
      parts[1] = "00";
    }
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  };
</script>

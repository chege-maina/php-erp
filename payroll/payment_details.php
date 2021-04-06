<hr>
<div class="row mt-3">
  <div class="col col-md-3">
    <label for="s_payment_option" class="form-label">Income Tax</label>
    <select name="s_payment_option" class="form-select" id="s_payment_option" onchange="paymentOptionChanged()">
      <option value="Salary Transfer">Salary Transfer</option>
      <option value="Bank Transfer">Bank Transfer</option>
      <option value="Mobile Money">Mobile Money</option>
      <option value="Cash">Cash</option>
      <option value="Cheque">Cheque</option>
    </select>
  </div>
</div>
<div id="so_bank_transfer" class="bg-light p-2 mt-2 border rounded-3 hide-this">
  <div class="row">
    <div class="col">
      <label for="s_account_name" class="form-label">Account Name</label>
      <input type="text" name="s_account_name" id="s_account_name" class="form-control">
    </div>
    <div class="col">
      <label for="s_account_no" class="form-label">Account No.</label>
      <input type="text" name="s_account_no" id="s_account_no" class="form-control">
    </div>
    <div class="col">
      <label for="s_bank_name" class="form-label">Bank Name</label>
      <input type="text" name="s_bank_name" id="s_bank_name" class="form-control">
    </div>
  </div>
  <div class="row mt-3">
    <div class="col">
      <label for="s_bank_branch" class="form-label">Bank Branch</label>
      <input type="text" name="s_bank_branch" id="s_bank_branch" class="form-control">
    </div>
    <div class="col">
      <label for="s_sort_code" class="form-label">Sort Code <small>(bank + branch code)</small></label>
      <input type="text" name="s_sort_code" id="s_sort_code" class="form-control">
    </div>
  </div>
</div>

<div id="so_mobile_money" class="bg-light p-2 mt-2 border rounded-3 hide-this">
  <div class="row">
    <div class="col">
      <label for="s_mobile_no" class="form-label">Mobile Number</label>
      <input type="text" name="s_mobile_no" id="s_mobile_no" class="form-control">
    </div>
  </div>
</div>

<script>
  const s_payment_option = document.querySelector("#s_payment_option");

  const so_bank_transfer = document.querySelector("#so_bank_transfer");
  const so_mobile_money = document.querySelector("#so_mobile_money");

  const s_account_no = document.querySelector("#s_account_no");
  const s_account_name = document.querySelector("#s_account_name");
  const s_bank_name = document.querySelector("#s_bank_name");
  const s_bank_branch = document.querySelector("#s_bank_branch");
  const s_sort_code = document.querySelector("#s_sort_code");

  const s_mobile_no = document.querySelector("#s_mobile_no");

  const so_bank_transfer_fields = [s_account_no, s_account_name, s_bank_name, s_bank_branch, s_sort_code];

  function checkPaymentOption() {
    if (s_payment_option.value == "Bank Transfer") {
      so_bank_transfer_fields.forEach(field => {
        if (field.value.trim() == "") {
          return {
            success: false,
            message: "Some bank transfer details have not been filled"
          };
        }
      });
    } else if (s_payment_option.value == "Mobile Money") {
      if (s_mobile_no.value.trim() == "") {
        return {
          success: false,
          message: "Payment mobile number not filled"
        };
      }
    }

    return {
      success: true
    };

  }

  function getPaymentOption() {
    return {
      s_payment_option: s_payment_option.value,
      s_account_no: s_account_no.value,
      s_account_name: s_account_name.value,
      s_bank_name: s_bank_name.value,
      s_bank_branch: s_bank_branch.value,
      s_sort_code: s_sort_code.value,
      s_mobile_no: s_mobile_no.value
    }
  }

  function paymentOptionChanged() {
    switch (s_payment_option.value) {
      case "Bank Transfer":
        so_mobile_money.classList.add('hide-this');
        so_bank_transfer.classList.remove('hide-this');
        break;
      case "Salary Transfer":
        so_mobile_money.classList.add('hide-this');
        so_bank_transfer.classList.add('hide-this');
        break;
      case "Mobile Money":
        so_mobile_money.classList.remove('hide-this');
        so_bank_transfer.classList.add('hide-this');
        break;
      case "Cash":
        so_mobile_money.classList.add('hide-this');
        so_bank_transfer.classList.add('hide-this');
        break;
      case "Cheque":
        so_mobile_money.classList.add('hide-this');
        so_bank_transfer.classList.add('hide-this');
        break;
    }
  }
</script>
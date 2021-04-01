<hr>
<div class="card-header">Benefits</div>
<div class="row justify-content-between">
  <div class="col-md-3">
    <button type="button" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addCategory">
      Add Benefit
    </button>
  </div>
  <div class="col-md-5">
    <div class="input-group">
      <select class="form-select" name="sbenefit" id="benefit_select">
        <option value disabled selected>
          -- Select Benefit --
        </option>
      </select>
      <div class="invalid-tooltip">This field cannot be left blank.</div>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary input-group-btn" onclick="addItem()">
        +
      </button>
    </div>
  </div>
</div>
<div class="row">
  <div class="col">
    <table class="table table-striped" id="data_table">
      <thead>
        <tr>
          <th scope="col">Benefit</th>
          <th scope="col">Quantity</th>
          <th scope="col">Rate</th>
          <th scope="col">Total</th>
          <th scope="col" class="col-md-2">Action</th>
        </tr>
      </thead>
      <tbody id="c_table_body">
      </tbody>
    </table>
  </div>
</div>
</div>
<!-- benefitmodal-->

<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">

    <div class="modal-content border-0">
      <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
          <h4 class="mb-1" id="addUnitLabel">Add Benefit</h4>
        </div>
        <div class="p-4">
          <!-- Category Form -->
          <form id="add_ct_frm" name="add_ct_frm">
            <div class="p2">
              <label for="modal_category_name" class="form-label">Benefit Name*</label>
              <input type="text" name="modal_category_name" id="modal_category_name" class="form-control" required>
              <div class="invalid-feedback">This field cannot be left blank.</div>
            </div>
            <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_ct_submit" name="add_ct_submit" data-dismiss="modal">
          </form>
        </div>
      </div>
    </div>

  </div>
  <!--end of benefit modal -->

  <script>
    //adding a new  benefit 

    $(document).ready(function() {
      $('#add_ct_submit').click(function(e) {
        e.preventDefault();
        var cat_name = $('#modal_category_name').val();
        var data1 = {
          modal_category_name: cat_name
        }

        if (cat_name == '') {
          alert("Please complete form!")
        } else {
          var conf = confirm("Do You Want to Add a New Type of Benefit?")
          if (conf) {
            $.ajax({
              url: "../payroll/add_benefit.php",
              method: "POST",
              data: data1,
              success: function(data) {
                $('#add_ct_frm')[0].reset();
                //$('form').trigger("reset");
                if (data == 'New Type of Benefit Added Successfully') {
                  updateComboBoxes();
                }
                alert(data)
              }
            })

          }
        }
      })
    })
  </script>
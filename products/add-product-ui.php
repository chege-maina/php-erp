<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
include_once '../includes/dbconnect.php';
include '../includes/base_page/head.php';
?>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container" data-layout="container">
      <!--nav starts here -->
      <?php
      include '../includes/base_page/nav.php';
      ?>

      <div class="content">
        <?php
        include '../navbar-shared.php';
        ?>

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="alert-div"></div>
        <h5 class="p-2" id="title-header">Add New Product
          <div id="spinner" class="spinner-border" role="status"></div>
        </h5>
        <!-- Content is to start here -->
        <form name="add_product" id="add_product" onsubmit="return submitForm();">
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label class="form-label" for="product_code">Product Code*</label>
                  <input type="text" class="form-control" name="product_code" id="product_code" readonly>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="product_name">Product Name*</label>
                  <input type="text" class="form-control" name="product_name" id="product_name" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <!-- Make Combo -->
                  <label class="form-label" for="product_category">Category*</label>
                  <div class="input-group">
                    <select class="form-select" name="product_category" id="product_category" required>
                      <option value disabled selected>
                        -- Select Category --
                      </option>
                    </select>
                    <div class="invalid-tooltip">This field cannot be left blank.</div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addCategory">
                      +
                    </button>

                  </div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col">
                  <div class="row">
                    <div class="col">
                      <!-- Units -->

                      <label class="form-label" for="product_unit">Unit*</label>
                      <div class="input-group">
                        <select class="form-select" name="product_unit" id="product_unit" required>
                          <option value disabled selected>
                            -- Select Unit --
                          </option>
                        </select>

                        <div class="invalid-feedback">This field cannot be left blank.</div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addUnit">
                          +
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <label class="form-label" for="product_image">Product Image*</label>
                  <input class="form-control" id="product_image" name="product_image" type="file" accept="image/*" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Product Levels -->
          <h5 class="p-2 mt-4">Product Levels</h5>
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label class="form-label" for="min_level">Minimum Level*</label>
                  <input type="number" class="form-control hide-this" name="min_level" id="min_level">
                  <input type="text" class="form-control" id="min_level_helper" required>
                  <script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                      commify('#min_level', '#min_level_helper');
                    });
                  </script>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="max_level">Maximum Level*</label>
                  <input type="number" class="form-control hide-this" name="max_level" id="max_level">
                  <input type="text" class="form-control" id="max_level_helper" required>
                  <script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                      commify('#max_level', '#max_level_helper');
                    });
                  </script>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="reorder">Reorder Level*</label>
                  <input type="number" class="form-control hide-this" name="reorder" id="reorder">
                  <input type="text" class="form-control" id="reorder_helper" required>
                  <script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                      commify('#reorder', '#reorder_helper');
                    });
                  </script>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
            </div>
          </div>


          <!-- Tax -->
          <h5 class="p-2 mt-4">Tax</h5>
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col">
                  <label for="tax_type">Tax Type*</label><br />
                  <select class="form-select" name="tax_type" id="tax_type" required onchange="calculatePrices();">
                    <option value="exclusive">exclusive</option>
                    <option value="inclusive">inclusive</option>
                  </select>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label for="applicable_tax">Applicable Tax*</label><br />
                  <select class="form-select" name="applicable_tax" id="applicable_tax" required onchange="calculatePrices();">
                  </select>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="amount_before_tax">Amount Before Tax*</label>
                  <input type="number" class="form-control hide-this" name="amount_before_tax" id="amount_before_tax">
                  <input type="text" class="form-control" id="amount_before_tax_helper" required onchange="calculatePrices();">
                  <script>
                    window.addEventListener('DOMContentLoaded', (event) => {
                      commify('#amount_before_tax', '#amount_before_tax_helper');
                    });
                  </script>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
              <!-- Tax table -->
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">Default Purchase Price</th>
                    <th scope="col">Profit Margin(%)</th>
                    <th scope="col">Default Selling Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="row">
                        <div class="col">
                          <label class="form-label" for="dpp_exc_tax">Exc. Tax*</label>
                          <input type="number" class="form-control" name="dpp_exc_tax" id="dpp_exc_tax" required readonly>
                          <div class="invalid-feedback">This field cannot be left blank.</div>
                        </div>
                        <div class="col">
                          <label class="form-label" for="dpp_inc_tax">Inc. Tax*</label>
                          <input type="number" class="form-control" name="dpp_inc_tax" id="dpp_inc_tax" required readonly>
                          <div class="invalid-feedback">This field cannot be left blank.</div>
                        </div>
                    </td>
                    <td>
                      <label class="form-label" for="profit_margin">*</label>
                      <div class="input-group mb-3 col col-md-2">
                        <input type="number" class="form-control" name="profit_margin" aria-describedby="margin-percentage-label" value="25" id="profit_margin" required onkeyup=="calculatePrices();">
                        <span class="input-group-text" id="margin-percentage-label">%</span>
                      </div>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </td>
                    <td>
                      <label class="form-label" for="dsp_price">Exc. Tax*</label>
                      <input type="number" class="form-control" name="dsp_price" id="dsp_price" required readonly>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <input type="submit" class="btn btn-falcon-primary m-2" name="submit" id="submit" value="Submit">
        </form>
        <!-- Content ends here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->

        <!-- =========================================================== -->
        <!-- modals -->
        <!-- =========================================================== -->
        <!-- Category Modal -->
        <div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog" role="document">

            <div class="modal-content border-0">
              <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
                  <h4 class="mb-1" id="addUnitLabel">Add Category</h4>
                </div>
                <div class="p-4">
                  <!-- Category Form -->
                  <form id="add_ct_frm" name="add_ct_frm">
                    <div class="p2">
                      <label for="modal_category_name" class="form-label">Category Name*</label>
                      <input type="text" name="modal_category_name" id="modal_category_name" class="form-control" required>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </div>
                    <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_ct_submit" name="add_ct_submit">
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Units Modal -->
        <div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="addUnitLabel" aria-hidden="true" data-backdrop="static">
          <div class="modal-dialog" role="document">

            <div class="modal-content border-0">
              <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
                <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
                  <h4 class="mb-1" id="addUnitLabel">Add Unit</h4>
                </div>
                <div class="p-4">
                  <!-- Units form  -->
                  <form id="add_ut_frm" name="add_ut_frm">
                    <div class="row">
                      <div class="col">
                        <label for="modal_unit_name" class="form-label">Unit*</label>
                        <input type="text" name="modal_unit_name" id="modal_unit_name" class="form-control" required>
                        <div class="invalid-feedback">This field cannot be left blank.</div>
                      </div>
                    </div>

                    <div class="row mt-2">
                      <div class="col">
                        <label for="modal_unit_description" class="form-label">Unit Description*</label>
                        <input type="text" name="modal_unit_description" id="modal_unit_description" class="form-control" required>
                        <div class="invalid-feedback">This field cannot be left blank.</div>
                      </div>
                    </div>
                    <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_ut_submit" name="add_ut_submit">
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!--product - supplier -->

        <script>
          $(document).ready(function() {
            $('#add_ut_submit').click(function(e) {
              e.preventDefault();
              var unt_name = $('#modal_unit_name').val();
              var unt_desc = $('#modal_unit_description').val();
              var data1 = {
                modal_unit_name: unt_name,
                modal_unit_description: unt_desc
              }

              if (unt_name == '' || unt_desc == '') {
                alert("Please complete form!")
              } else {
                var conf = confirm("Do You Want to Add a New Unit?")
                if (conf) {
                  $.ajax({
                    url: "../includes/add_unit.php",
                    method: "POST",
                    data: data1,
                    success: function(data) {
                      $('#add_ut_frm')[0].reset();
                      //$('form').trigger("reset");
                      if (data == 'New Unit Added Successfully') {
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
        <script>
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
                var conf = confirm("Do You Want to Add a New Category?")
                if (conf) {
                  $.ajax({
                    url: "../includes/add_category.php",
                    method: "POST",
                    data: data1,
                    success: function(data) {
                      $('#add_ct_frm')[0].reset();
                      //$('form').trigger("reset");
                      if (data == 'New Category Added Successfully') {
                        updateComboBoxes();
                      }
                      alert(data)
                    }
                  })

                }
              }
            })
          })

          function submitForm() {
            console.log("Submitting");
            const product_code = document.querySelector("#product_code").value;
            const product_name = document.querySelector("#product_name").value;
            const product_category = document.querySelector("#product_category").value;
            const product_unit = document.querySelector("#product_unit").value;
            // const product_supplier = document.querySelector("#product_supplier").value;
            const product_image = document.querySelector("#product_image").files[0];

            const min_level = document.querySelector("#min_level").value;
            const max_level = document.querySelector("#max_level").value;
            const reorder = document.querySelector("#reorder").value;

            const tax_type = document.querySelector("#tax_type").value;
            const applicable_tax = document.querySelector("#applicable_tax").value;
            const amount_before_tax = document.querySelector("#amount_before_tax").value;

            const dpp_exc_tax = document.querySelector("#dpp_exc_tax").value;
            const dpp_inc_tax = document.querySelector("#dpp_inc_tax").value;
            const profit_margin = document.querySelector("#profit_margin").value;
            const dsp_price = document.querySelector("#dsp_price").value;

            const formData = new FormData();
            formData.append("user_name", user_name);

            formData.append("product_code", product_code);
            formData.append("product_name", product_name);
            formData.append("product_category", product_category);
            formData.append("product_unit", product_unit);
            //  formData.append("product_supplier", product_supplier);
            formData.append("product_image", product_image);

            formData.append("min_level", min_level);
            formData.append("max_level", max_level);
            formData.append("reorder", reorder);

            formData.append("tax_type", tax_type);
            formData.append("applicable_tax", applicable_tax);
            formData.append("amount_before_tax", amount_before_tax);

            formData.append("dpp_exc_tax", dpp_exc_tax);
            formData.append("dpp_inc_tax", dpp_inc_tax);
            formData.append("profit_margin", profit_margin);
            formData.append("dsp_price", dsp_price);

            fetch('add_product.php', {
                method: 'POST',
                body: formData
              })
              .then(response => response.json())
              .then(data => {
                console.log(data);
                if (data["message"] == "success") {
                  const alertVar =
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> Product added to the database.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                  var divAlert = document.querySelector("#alert-div");
                  divAlert.innerHTML = alertVar;
                  divAlert.scrollIntoView();
                  setTimeout(function() {
                    location.href = "../supplier/create.php"
                  }, 2500);
                } else {
                  const alertVar =
                    `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error!</strong> ${data["desc"]}.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                  var divAlert = document.querySelector("#alert-div");
                  divAlert.innerHTML = alertVar;
                  divAlert.scrollIntoView();
                }
              })
              .catch(error => {
                console.error(error);
              });

            return false;
          }
        </script>

        <script>
          // listen for the DOMContentLoaded event, then bind our function
          document.addEventListener('DOMContentLoaded', function() {
            updateComboBoxes();
          });


          function updateComboBoxes() {
            const product_code = document.querySelector("#product_code")
            fetch('get-item-code.php')
              .then(response => response.json())
              .then(data => {
                // console.log(data);
                product_code.value = data;
              });

            const product_unit = document.querySelector("#product_unit");
            const product_category = document.querySelector("#product_category");
            const applicable_tax = document.querySelector("#applicable_tax");
            // const product_supplier = document.querySelector("#product_supplier");


            // Clear it
            product_category.innerHTML = "";
            // Add the no-selectable item first
            let opt = document.createElement("option");
            opt.appendChild(document.createTextNode("-- Select Category --"));
            opt.setAttribute("value", "");
            opt.setAttribute("disabled", "");
            opt.setAttribute("selected", "");
            product_category.appendChild(opt);
            // Populate categories combobox
            fetch('../includes/load_category.php')
              .then(response => response.json())
              .then(data => {
                data.forEach((value) => {
                  let opt = document.createElement("option");
                  opt.appendChild(document.createTextNode(value['category'].toLowerCase()));
                  opt.value = value['category'].toLowerCase();
                  product_category.appendChild(opt);
                });
              });

            // Clear it
            product_unit.innerHTML = "";
            // Add the no-selectable item first
            opt = document.createElement("option");
            opt.appendChild(document.createTextNode("-- Select Unit --"));
            opt.setAttribute("value", "");
            opt.setAttribute("disabled", "");
            opt.setAttribute("selected", "");
            product_unit.appendChild(opt);
            // Populate units combobox
            fetch('../includes/load_unit.php')
              .then(response => response.json())
              .then(data => {
                data.forEach((value) => {
                  let opt = document.createElement("option");
                  opt.appendChild(document.createTextNode(value['unit'] + " (" + value['desc'].toLowerCase() + ")"));
                  opt.value = value['unit'].toLowerCase();
                  product_unit.appendChild(opt);
                });
              });

            // Clear it
            applicable_tax.innerHTML = "";
            // Populate taxes combobox
            fetch('../includes/load_tax.php')
              .then(response => response.json())
              .then(data => {
                data.forEach((value) => {
                  let opt = document.createElement("option");
                  opt.appendChild(document.createTextNode(value['tax'] + "%"));
                  opt.value = value['tax'];
                  applicable_tax.appendChild(opt);
                  removeSpinner();
                });
              });

            // Clear it
            // product_supplier.innerHTML = "";
            // // Add the no-selectable item first
            // opt = document.createElement("option");
            // opt.appendChild(document.createTextNode("-- Select Supplier --"));
            // opt.setAttribute("value", "");
            // opt.setAttribute("disabled", "");
            // opt.setAttribute("selected", "");
            // product_supplier.appendChild(opt);
            // // Populate suppliers combobox
            // fetch('../includes/load_supplier.php')
            //   .then(response => response.json())
            //   .then(data => {
            //     console.log(data);
            //     data.forEach((value) => {
            //       console.log(value);
            //       let opt = document.createElement("option");
            //       // Convert the supplier name to lowercase first so that it can be capitalized
            //       opt.appendChild(document.createTextNode(value['supplier'].toLowerCase()));
            //       opt.style.textTransform = "capitalize";
            //       opt.value = value['supplier'];
            //       product_supplier.appendChild(opt);
            //       // Update spinner we are done

            //     });
            //   });
          }

          function calculatePrices() {
            const tax_type = document.querySelector("#tax_type");
            const applicable_tax = document.querySelector("#applicable_tax");
            const amount_before_tax = document.querySelector("#amount_before_tax");

            const dpp_exc_tax = document.querySelector("#dpp_exc_tax");
            const dpp_inc_tax = document.querySelector("#dpp_inc_tax");
            const profit_margin = document.querySelector("#profit_margin");
            const dsp_price = document.querySelector("#dsp_price");


            dpp_exc_tax.value = amount_before_tax.value

            if (tax_type.value == "inclusive" && applicable_tax.value > 0) {
              // dpp_inc_tax.value = (applicable_tax.value / 100 * amount_before_tax.value) + Number(amount_before_tax.value);
              dpp_inc_tax.value = amount_before_tax.value
              dpp_inc_tax.value = Number(dpp_inc_tax.value).toFixed(2)
              dpp_exc_tax.value = Number(amount_before_tax.value) / ((Number(applicable_tax.value) + 100) / 100)
              dpp_exc_tax.value = Number(dpp_exc_tax.value).toFixed(2)
            } else if (tax_type.value == "exclusive" && applicable_tax.value > 0) {
              dpp_inc_tax.value = (applicable_tax.value / 100 * amount_before_tax.value) + Number(amount_before_tax.value);
              dpp_inc_tax.value = Number(dpp_inc_tax.value).toFixed(2)
            } else {
              dpp_inc_tax.value = amount_before_tax.value;
            }

            dsp_price.value = (profit_margin.value / 100 * amount_before_tax.value) + Number(amount_before_tax.value)
            //console.log(tax_type.value, applicable_tax.value, amount_before_tax.value);
          }

          function removeSpinner() {
            const spinner = document.querySelector("#spinner");
            spinner.setAttribute("class", "invisible");
          }
        </script>



        <!-- =========================================================== -->
        <!-- Footer Begin -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
</body>

</html>

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
                  <label class="form-label" for="product_name">Product Name*</label>
                  <input type="text" class="form-control" name="product_name" id="product_name" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <!-- Make Combo -->
                  <label class="form-label" for="product_category">Group*</label>
                  <div class="input-group">
                    <select class="form-select" name="product_category" id="product_category" required onchange="groupChanged(this.value)">
                      <option value disabled selected>
                        -- Select Group --
                      </option>
                    </select>
                    <div class="invalid-tooltip">This field cannot be left blank.</div>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addCategory">
                      +
                    </button>

                  </div>
                </div>
                <div class="col">
                  <!-- Make Combo -->
                  <label class="form-label" for="product_category">Subgroup*</label>
                  <div class="input-group">
                    <select class="form-select" name="sub_group" id="sub_group" required disabled>
                      <option value disabled selected>
                        -- Select Subgroup --
                      </option>
                    </select>
                    <div class="invalid-tooltip">This field cannot be left blank.</div>

                    <!-- Button trigger modal -->
                    <button type="button" id="sub_group_btn" class="btn btn-primary input-group-btn" data-toggle="modal" data-target="#addSubCategory" disabled>
                      +
                    </button>

                  </div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col">
                  <label class="form-label" for="weight">Weight(KGS)*</label>
                  <input type="number" class="form-control" name="weight" id="weight" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
                <div class="col">
                  <label class="form-label" for="product_image">Product Image*</label>
                  <input class="form-control" id="product_image" name="product_image" type="file" accept="image/*" required>
                  <div class="invalid-feedback">This field cannot be left blank.</div>
                </div>
              </div>
              <div class="row pt-3">
                <div class="col">
                  <div class="row">
                    <div class="col">
                      <!-- Bulk Units -->

                      <label class="form-label" for="purchasing_unit">Purchasing Unit*</label>
                      <div class="input-group">
                        <select class="form-select" name="purchasing_unit" id="purchasing_unit" required>
                          <option value disabled selected>
                            -- Select Unit --
                          </option>
                        </select>

                        <div class="invalid-feedback">This field cannot be left blank.</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="row">
                    <div class="col">
                      <!-- Units -->

                      <label class="form-label" for="selling_unit">Conversion Value*</label>

                      <input type="number" name="conversion_value" id="conversion_value" class="form-control">
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </div>
                  </div>
                </div>

                <div class="col">
                  <div class="row">
                    <div class="col">
                      <!-- Units -->

                      <label class="form-label" for="selling_unit">Selling Unit*</label>
                      <select class="form-select" name="selling_unit" id="selling_unit" required>
                        <option value disabled selected>
                          -- Select Unit --
                        </option>
                      </select>

                      <div class="invalid-feedback">This field cannot be left blank.</div>

                      <!-- Button trigger modal -->
                    </div>
                    <div class="col col-auto">
                      <div class="d-flex align-items-end pb-3" style="height: 5rem;">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUnit">
                          Add Unit
                        </button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Tax -->

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

              <div class="row mt-3">
                <div class="col">
                  <label class="form-label" for="dsp_price">Default Selling Price*</label>
                  <div class="input-group">
                    <span class="input-group-text is-static">Exc. Tax</span>
                    <input type="number" class="form-control" name="dsp_price" id="dsp_price" required onkeyup="calculatePrices();" onfocusout="this.value = this.value > 0 ? this.value : 1">
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                </div>
                <div class="col">
                  <label class="form-label" for="bulk_dsp_price">Default Selling Price(Bulk Items)*</label>
                  <div class="input-group">
                    <span class="input-group-text is-static">Exc. Tax</span>
                    <input type="number" class="form-control" name="bulk_dsp_price" id="bulk_dsp_price" required onkeyup="calculatePrices();" onfocusout="this.value = this.value > 0 ? this.value : 1">
                    <div class="invalid-feedback">This field cannot be left blank.</div>
                  </div>
                </div>
              </div>
              <!-- Tax table -->
              <table class="table mt-3">
                <thead>
                  <tr>
                    <th scope="col">Default Purchase Price</th>
                    <th scope="col">Profit Margin(%)</th>
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
                        <input type="number" class="form-control" name="profit_margin" aria-describedby="margin-percentage-label" value="25" id="profit_margin" required onkeyup=="calculatePrices();" readonly>
                        <span class="input-group-text" id="margin-percentage-label">%</span>
                      </div>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!--end of tax -->

          <!-- Product Levels -->
          <h5 class="p-2 mt-4">Product Levels</h5>
          <div class="card">
            <div class="card-body fs--1 p-4">
              <div class="row">
                <div class="col-sm-4 ">
                  <!-- Make Combo -->
                  <label class="form-label" for="branch">Branch*</label>
                  <div class="input-group">
                    <select class="form-select" name="branch" id="branch_select">
                      <option value disabled selected>
                        -- Select Branch --
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
              <hr>
              <div class="row">
                <div class="col">
                  <table class="table table-striped" id="table_id">
                    <thead>
                      <tr>
                        <th scope="col">Branch</th>
                        <th scope="col">Minimum Level</th>
                        <th scope="col">Maximum Level </th>
                        <th scope="col">Reorder Level</th>
                        <th scope="col">Opening Balance</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody id="table_body">
                    </tbody>
                  </table>
                </div>
              </div>
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
                  <h4 class="mb-1" id="addUnitLabel">Add Group</h4>
                </div>
                <div class="p-4">
                  <!-- Category Form -->
                  <form id="add_ct_frm" name="add_ct_frm">
                    <div class="p2">
                      <label for="modal_category_name" class="form-label">Group Name*</label>
                      <input type="text" name="modal_category_name" id="modal_category_name" class="form-control" required>
                      <div class="invalid-feedback">This field cannot be left blank.</div>
                    </div>
                    <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_ct_submit" name="add_ct_submit" data-dismiss="modal">
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>

        <! --SubCategory Modal -->
          <div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryLabel" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">

              <div class="modal-content border-0">
                <div class="position-absolute top-0 right-0 mt-3 mr-3 z-index-1">
                  <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                  <div class="bg-light rounded-top-lg py-3 pl-4 pr-6">
                    <h4 class="mb-1" id="addUnitLabel">Add Sub Group</h4>
                  </div>
                  <div class="p-4">
                    <!-- Category Form -->
                    <form id="add_ct_frm" name="add_ct_frm">
                      <div class="p2">
                        <label for="modal_category_name" class="form-label">Sub group Name*</label>
                        <input type="text" name="modal_subcategory_name" id="modal_subcategory_name" class="form-control" required>
                        <div class="invalid-feedback">This field cannot be left blank.</div>
                      </div>
                      <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_sct_submit" name="add_sct_submit" data-dismiss="modal" onclick="submitSubCategory()">
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
                      <input type="button" value="Add" class="btn btn-falcon-primary mt-2" id="add_ut_submit" name="add_ut_submit" data-dismiss="modal">
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

            function getTableData() {
              let tmp_obj = [];
              let errors = false;
              table_body.childNodes.forEach(row => {
                const t_branch = row.childNodes[0].innerHTML;

                let t_min_val = row.childNodes[1].childNodes[0];
                if (!t_min_val.validity.valid) {
                  t_min_val.focus();
                  errors = true;
                  return;
                }
                t_min_val = t_min_val.value;

                let t_max_val = row.childNodes[2].childNodes[0];
                if (!t_max_val.validity.valid) {
                  t_max_val.focus();
                  errors = true;
                  return;
                }
                t_max_val = t_max_val.value;

                let t_reorder_level = row.childNodes[3].childNodes[0];
                if (!t_reorder_level.validity.valid) {
                  t_reorder_level.focus();
                  errors = true;
                  return;
                }
                t_reorder_level = t_reorder_level.value;

                let t_opening_bal = row.childNodes[4].childNodes[0];
                if (!t_opening_bal.validity.valid) {
                  t_opening_bal.focus();
                  errors = true;
                  return;
                }
                t_opening_bal = t_opening_bal.value;

                tmp_obj.push({
                  branch: t_branch,
                  min_level: t_min_val,
                  max_level: t_max_val,
                  reorder: t_reorder_level,
                  opening_bal: t_opening_bal,
                });
              });
              let to_return = errors ? false : tmp_obj;
              return to_return;
            };


            function submitSubCategory() {
              const modal_subcategory_name = document.querySelector("#modal_subcategory_name").value;
              const product_category = document.querySelector("#product_category").value;

              if (!modal_subcategory_name) {
                alert("Incomplete form");
                return;
              }

              const formData = new FormData();
              formData.append("sub_category", modal_subcategory_name);
              formData.append("category", product_category);

              console.log("sub_category", modal_subcategory_name);
              console.log("category", product_category);
              fetch('../includes/add_subcategory.php', {
                  method: 'POST',
                  body: formData
                })
                .then(response => response.json())
                .then(result => {
                  alert(result);
                  updateComboBoxes();
                })
                .catch(error => {
                  console.error('Error:', error);
                });
            }

            function submitForm() {
              console.log("Submitting");

              const product_name = document.querySelector("#product_name").value;
              const product_category = document.querySelector("#product_category").value;
              const sub_group = document.querySelector("#sub_group").value;
              const weight = document.querySelector("#weight").value;

              const purchasing_unit = document.querySelector("#purchasing_unit").value;
              const conversion_value = document.querySelector("#conversion_value").value;
              const selling_unit = document.querySelector("#selling_unit").value;

              const product_image = document.querySelector("#product_image").files[0];

              const tax_type = document.querySelector("#tax_type").value;
              const applicable_tax = document.querySelector("#applicable_tax").value;
              const amount_before_tax = document.querySelector("#amount_before_tax").value;

              const dpp_exc_tax = document.querySelector("#dpp_exc_tax").value;
              const dpp_inc_tax = document.querySelector("#dpp_inc_tax").value;
              const profit_margin = document.querySelector("#profit_margin").value;
              const dsp_price = document.querySelector("#dsp_price").value;
              const bulk_dsp_price = document.querySelector("#bulk_dsp_price").value;

              const table_items = getTableData();
              if (table_items == undefined || table_items.length <= 0) {
                document.querySelector("#branch_select").focus();
                return false;
              }

              // ===================================================================
              // -------------------------------------------------------------------
              // ===================================================================
              console.log("user_name", user_name);

              console.log("product_name", product_name);
              console.log("product_category", product_category);

              console.log("product_unit", purchasing_unit);
              console.log("selling_unit", selling_unit);
              console.log("conversion_value", conversion_value);

              console.log("sub_category", sub_group);
              console.log("weight", weight);

              console.log("product_image", product_image);
              console.log("tax_type", tax_type);
              console.log("applicable_tax", applicable_tax);
              console.log("amount_before_tax", amount_before_tax);

              console.log("dpp_exc_tax", dpp_exc_tax);
              console.log("dpp_inc_tax", dpp_inc_tax);
              console.log("profit_margin", profit_margin);
              console.log("dsp_price", dsp_price);
              console.log("bs_price", dsp_price);

              console.log("table_items", table_items);
              // ===================================================================
              // ___________________________________________________________________
              // ===================================================================



              const formData = new FormData();
              formData.append("user_name", user_name);

              formData.append("product_name", product_name);
              formData.append("product_category", product_category);

              formData.append("product_unit", purchasing_unit);
              formData.append("selling_unit", selling_unit);
              formData.append("conversion_value", conversion_value);


              formData.append("sub_category", sub_group);
              formData.append("weight", weight);

              formData.append("tax_type", tax_type);
              formData.append("applicable_tax", applicable_tax);
              formData.append("amount_before_tax", amount_before_tax);

              formData.append("dpp_exc_tax", dpp_exc_tax);
              formData.append("dpp_inc_tax", dpp_inc_tax);
              formData.append("profit_margin", profit_margin);
              formData.append("dsp_price", dsp_price);
              formData.append("bs_price", bulk_dsp_price);

              formData.append("product_image", product_image);

              formData.append("table_items", JSON.stringify(table_items));

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

            let branch_dict = {};
            let items_in_table = {};
            const table_body = document.querySelector("#table_body");
            const sub_group = document.querySelector("#sub_group");
            const sub_group_btn = document.querySelector("#sub_group_btn");
            const product_category = document.querySelector("#product_category");



            function groupChanged(val) {
              if (!val) {
                return;
              }
              sub_group.disabled = false;
              sub_group_btn.disabled = false;
              updateSubCategories();
            }

            let subcategories_dict = {};

            function updateSubCategories() {
              console.log("Subs", subcategories_dict);
              if (!product_category.value) {
                return;
              }

              // Clear it
              sub_group.innerHTML = "";
              // Add the no-selectable item first
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Group --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              sub_group.appendChild(opt);


              let sub_cats = subcategories_dict[product_category.value];
              console.log(sub_cats);
              console.log(sub_cats)
              sub_cats.forEach((sub_cat) => {
                let opt = document.createElement("option");
                opt.appendChild(document.createTextNode(sub_cat['subcategory'].toLowerCase()));
                opt.value = sub_cat['subcategory'];
                sub_group.appendChild(opt);
              });
            }

            function updateComboBoxes() {
              const selling_unit = document.querySelector("#selling_unit");
              const applicable_tax = document.querySelector("#applicable_tax");
              const branch_select = document.querySelector("#branch_select");

              // const product_supplier = document.querySelector("#product_supplier");


              // Clear it
              product_category.innerHTML = "";
              // Add the no-selectable item first
              let opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Group --"));
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
                    opt.value = value['category'];
                    product_category.appendChild(opt);
                  });
                });

              // Populate subcategories array
              fetch('../includes/load_subcategory.php')
                .then(response => response.json())
                .then(data => {
                  subcategories_dict = [];
                  data.forEach(row => {
                    subcategories_dict[row.category] = row.subcategories;
                  });
                  updateSubCategories();
                });



              // Clear it
              selling_unit.innerHTML = "";
              // Add the no-selectable item first
              opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Unit --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              selling_unit.appendChild(opt);

              // Clear it
              purchasing_unit.innerHTML = "";
              // Add the no-selectable item first
              opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Unit --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              purchasing_unit.appendChild(opt);

              // Populate units combobox
              fetch('../includes/load_unit.php')
                .then(response => response.json())
                .then(data => {
                  console.log(data);
                  data.forEach((value) => {
                    let opt = document.createElement("option");
                    opt.appendChild(document.createTextNode(value['unit'] + " (" + value['desc'].toLowerCase() + ")"));
                    opt.value = value['unit'].toLowerCase();
                    selling_unit.appendChild(opt);

                    opt = document.createElement("option");
                    opt.appendChild(document.createTextNode(value['unit'] + " (" + value['desc'].toLowerCase() + ")"));
                    opt.value = value['unit'].toLowerCase();
                    selling_unit.appendChild(opt);
                    purchasing_unit.appendChild(opt);
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
                  });
                });


              fetch('../includes/load_branch_items.php')
                .then(response => response.json())
                .then(data => {
                  data.forEach((value) => {
                    let opt = document.createElement("option");
                    opt.appendChild(document.createTextNode(value['branch']));
                    opt.value = value['branch'];
                    branch_select.appendChild(opt);
                    // Update dicts
                    branch_dict[value.branch] = value.branch;
                    items_in_table = {};

                    updateBranchSelect();
                    updateTable();

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

            function updateBranchSelect() {
              // Clear it
              branch_select.innerHTML = "";
              // Add the no-selectable item first
              opt = document.createElement("option");
              opt.appendChild(document.createTextNode("-- Select Branch --"));
              opt.setAttribute("value", "");
              opt.setAttribute("disabled", "");
              opt.setAttribute("selected", "");
              branch_select.appendChild(opt);
              // Populate combobox
              for (key in branch_dict) {
                let opt = document.createElement("option");
                opt.appendChild(document.createTextNode(key));
                opt.value = key;
                branch_select.appendChild(opt);
              }
            }


            function validateQuantity(elmt, value, max) {
              value = Number(value);
              max = Number(max);
              elmt.value = elmt.value <= 0 ? 1 : elmt.value;
              elmt.value = elmt.value > max ? max : elmt.value;
            }


            function updateTable() {
              table_body.innerHTML = "";
              for (let item in items_in_table) {

                let tr = document.createElement("tr");
                // Id will be like 1Tank
                // tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

                let branch_name = document.createElement("td");
                branch_name.appendChild(document.createTextNode(items_in_table[item].branch));
                branch_name.classList.add("align-middle");

                let min_level = document.createElement("input");
                const min_level_id = uuidv4();
                min_level.setAttribute("type", "number");
                min_level.setAttribute("id", min_level_id);
                min_level.setAttribute("required", "");
                min_level.classList.add("form-control", "form-control-sm", "align-middle");
                // min_level.setAttribute("data-ref", items_in_table[item]["name"]);
                min_level.setAttribute("min", 1);

                // make sure the min_level is always greater than 0
                // min_level.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
                // min_level.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
                // min_level.setAttribute("onclick", "this.select();");
                min_level.addEventListener("input", (event) => {
                  items_in_table[item].min_level = Number(event.target.value);
                })
                items_in_table[item]['min_level'] = ('min_level' in items_in_table[item] && items_in_table[item]['min_level'] > 0) ?
                  items_in_table[item]['min_level'] : 1;
                min_level.value = items_in_table[item]['min_level'];
                let min_levelWrapper = document.createElement("td");
                min_levelWrapper.classList.add("m-2", "col-2");
                min_levelWrapper.appendChild(min_level);



                const max_level_id = uuidv4();
                const reorder_level_id = uuidv4();

                let max_level = document.createElement("input");
                max_level.setAttribute("type", "number");
                max_level.setAttribute("id", max_level_id);
                max_level.setAttribute("required", "");
                max_level.classList.add("form-control", "form-control-sm", "align-middle");
                max_level.setAttribute("data-min", min_level_id);
                max_level.setAttribute("min", 1);

                // make sure the max_level is always greater than 0
                max_level.setAttribute("onfocusout",
                  "document.querySelector('#" + reorder_level_id + "').setAttribute('max', this.value)");
                // max_level.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
                max_level.setAttribute("onclick", "this.select();");
                items_in_table[item]['max_level'] = ('max_level' in items_in_table[item] && items_in_table[item]['max_level'] > 0) ?
                  items_in_table[item]['max_level'] : 1;
                max_level.value = items_in_table[item]['max_level'];

                max_level.addEventListener("input", (event) => {
                  items_in_table[item].max_level = Number(event.target.value);
                })
                let max_levelWrapper = document.createElement("td");
                max_levelWrapper.classList.add("m-2", "col-2");
                max_levelWrapper.appendChild(max_level);



                let reorder_level = document.createElement("input");
                reorder_level.setAttribute("id", reorder_level_id);
                reorder_level.setAttribute("type", "number");
                reorder_level.setAttribute("required", "");
                reorder_level.classList.add("form-control", "form-control-sm", "align-middle");
                // reorder_level.setAttribute("data-ref", items_in_table[item]["name"]);
                reorder_level.setAttribute("min", 1);
                // reorder_level.setAttribute("max", items_in_table[item]['max']);

                // make sure the reorder_level is always greater than 0
                reorder_level.setAttribute("onfocusout",
                  "document.querySelector('#" + max_level_id + "').setAttribute('min', this.value)");
                reorder_level.setAttribute("onchange",
                  "document.querySelector('#" + min_level_id + "').setAttribute('max', this.value)");
                // reorder_level.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
                // reorder_level.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
                reorder_level.setAttribute("onclick", "this.select();");
                items_in_table[item]['reorder_level'] = ('reorder_level' in items_in_table[item] && items_in_table[item]['reorder_level'] > 0) ?
                  items_in_table[item]['reorder_level'] : 1;
                reorder_level.value = items_in_table[item]['reorder_level'];

                reorder_level.addEventListener("input", (event) => {
                  items_in_table[item].reorder_level = Number(event.target.value);
                })
                let reorder_levelWrapper = document.createElement("td");
                reorder_levelWrapper.classList.add("m-2", "col-2");
                reorder_levelWrapper.appendChild(reorder_level);




                let opening_balance = document.createElement("input");
                opening_balance.setAttribute("type", "number");
                opening_balance.setAttribute("required", "");
                opening_balance.classList.add("form-control", "form-control-sm", "align-middle");
                // opening_balance.setAttribute("data-ref", items_in_table[item]["name"]);
                opening_balance.setAttribute("min", 0);
                // opening_balance.setAttribute("max", items_in_table[item]['max']);

                // make sure the opening_balance is always greater than 0
                // opening_balance.setAttribute("onfocusout", "validateQuantity(this, this.value, this.max);");
                // opening_balance.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value, this.max);");
                opening_balance.setAttribute("onclick", "this.select();");
                items_in_table[item]['opening_balance'] = ('opening_balance' in items_in_table[item] && items_in_table[item]['opening_balance'] >= 0) ?
                  items_in_table[item]['opening_balance'] : 0;
                opening_balance.value = items_in_table[item]['opening_balance'];

                opening_balance.addEventListener("input", (event) => {
                  items_in_table[item].opening_balance = Number(event.target.value);
                })
                let opening_balanceWrapper = document.createElement("td");
                opening_balanceWrapper.classList.add("m-2", "col-2");
                opening_balanceWrapper.appendChild(opening_balance);


                let actionWrapper = document.createElement("td");
                actionWrapper.classList.add("m-2");
                let action = document.createElement("button");
                action.setAttribute("id", items_in_table[item]["branch"]);
                action.setAttribute("onclick", "removeItem(this.id);");
                let icon = document.createElement("span");
                icon.classList.add("fas", "fa-minus", "mt-1");
                action.appendChild(icon);
                action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
                actionWrapper.appendChild(action);

                tr.append(branch_name,
                  min_levelWrapper,
                  max_levelWrapper,
                  reorder_levelWrapper,
                  opening_balanceWrapper,
                  actionWrapper
                );
                table_body.appendChild(tr);


                // tr.append(branch_name, balance_td, units_td, quantityWrapper, actionWrapper);
                // table_body.appendChild(tr);

              }
              return;
            }



            function addItem() {
              if (!branch_select.value) {
                return;
              }

              const branch_pricing = {
                branch: branch_dict[branch_select.value],
                max_level: 0,
                reorder_level: 0,
                opening_balance: 0,
              }
              console.log(branch_pricing);
              items_in_table[branch_select.value] = branch_pricing;

              delete branch_dict[branch_select.value];

              updateTable();
              updateBranchSelect();
            }

            function removeItem(item) {
              delete items_in_table[String(item)];
              branch_dict[item] = item;

              updateTable();
              updateBranchSelect();
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

              // dsp_price.value = (profit_margin.value / 100 * amount_before_tax.value) + Number(amount_before_tax.value)
              profit_margin.value = ((dsp_price.value - Number(amount_before_tax.value)) / amount_before_tax.value) * 100;

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

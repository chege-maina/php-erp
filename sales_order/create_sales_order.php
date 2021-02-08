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
        <div class="card mb-3">
          <div class="card-body">
            <div class="row flex-between-center">
              <div class="col-md">
                <h5 class="mb-2 mb-md-0">New Sales</h5>
              </div>
              <div class="col-auto">
                <button class="btn btn-falcon-default btn-sm mr-2" role="button">Manage Sales</button>
                <button class="btn btn-falcon-primary btn-sm" role="button"> POS Sale </button>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-0">
          <div class="col-lg-12 pr-lg-2">
            <div class="card mb-3">
              <div class="card-body bg-light">
                <form action="" method="GET">
                  <div class="row gx-2">

                    <div class="col-sm-3 mb-3">
                      <label class="form-label" for="event-name">Customer Name</label>
                      <input class="form-control" id="event-name" name="customer_name" value="Walking Customer " type="text" placeholder="Walkin Customer" value="" />
                    </div>
                    <div class="row pb-2">
                      <table class="table mt-2">
                        <thead>
                          <tr>

                            <th>Product Category</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>


                          </tr>
                        </thead>
                        <tbody id="table_body">
                          <tr>
                            <td>
                              <select name="product_category" id="product_category" class="form-select" type="text">

                                <option value="options">option</option>
                                <option value="options">option</option>
                              </select>
                            </td>

                            <td>
                              <input type="text" name="product_name" id="product_name" class="form-control">
                            </td>
                            <td>
                              <input name="product_unit" class="form-control form-control-sm m-3" type="text" placeholder="Price" value="" />
                            </td>
                            <td>
                              <input name="qty" class="form-control form-control-sm m-3" type="text" placeholder="Price" value="" />
                            </td>
                            <td>
                              <input name="total" class="form-control form-control-sm m-3" type="text" placeholder="Price" value="" />
                            </td>

                            <td id="1">
                              <div id="add" class="btn btn-link btn-sm"><span class="fas fa-plus" data-fa-transform="shrink-2"></span></div>

                              <div class="btn  btn-sm btn_remove"><span class="fas fa-times-circle text-danger m-3"></span></div>
                            </td>
                          </tr>
                        </tbody>
                    </div>

                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Tax</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Tax" value="" required />
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Transport Cost</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Transport Cost" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Cash Payment</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Cash Payment" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Mobile Money Payment</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Mobile Payment" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Credit Card Payment:</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Credit Card Payment" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Credit Card Payment:</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Credit Card Payment" value="" />
                      </td>
                    </tr>
                    <tr>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <td>
                      </td>
                      <th>Uncleared Cheques Payment:</th>
                      <td>
                        <input class="form-control form-control-sm m-3" type="text" placeholder="Uncleared Cheques Payment" value="" />
                      </td>
                    </tr>
                    </table>

                  </div>
                  <div class="col-12">
                    <div class="border-dashed-bottom my-3"></div>
                  </div>
                  <div class="row gx-2">
                    <div class="col-sm-3 mb-3">
                      <label class="form-label" for="event-name">Delivery Method</label>
                      <select placeholder="Walkin Customer" name="status" id="status" class="form-select">
                        <option value="Self Collect">Self Collect</option>
                        <option value="Devlivered">Delivered</option>
                      </select>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label class="form-label" for="event-name">Vehicle No.</label>
                      <input class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="">
                      </input>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label class="form-label" for="event-name">Drivers Name</label>
                      <input class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="">
                      </input>
                    </div>
                    <div class="col-sm-3 mb-3">
                      <label class="form-label" for="event-name">Drivers Phone</label>
                      <input class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="">
                      </input>
                    </div>
                  </div>
                  <div class="col">
                    <button class="btn btn-falcon-primary btn-sm" role="button"> Submit Sale </button>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
          const table_body = document.querySelector("#table_body");
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

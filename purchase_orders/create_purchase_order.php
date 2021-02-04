<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
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
                        <label class="form-label" for="event-name" >Customer Name</label>
                        <input class="form-control" id="event-name" name="customer_name" value="Walking Customer "type="text" placeholder="Walkin Customer" value="" />
                      </div>
    

                      <div class="col-12">
                        <div class="border-dashed-bottom my-3"></div>
                      </div>

                  <table  >
                    <thead>
                      <tr  class=" fs--1">
          
                        <th>Product Category</th>
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>
                            <div id="add" class="btn btn-link btn-sm"><span class="fas fa-plus" data-fa-transform="shrink-2"></span></div>
                        </th>

                      </tr>
                    </thead>
                    <tbody id="dynamic_field">
                      <tr  id="row1">
                        <td class="">
                        <select name="branch1" class="form-control  form-select-sm " id="" type="text"  >
                          
                          <option selected="selected">options</option>
                          <option selected="selected">options</option>
                        </select>
                        </td>

                        <td>
                        <select name="pcategory1" class="form-control form-select-sm " id="" type="text"  >
                          <option selected="selected">options</option>
                        </select>
                        </td>
                        <td>
                          <input name="pname1" class="form-control form-control-sm" type="text" placeholder="Price" value="" />
                        </td>
                        <td>
                          <input name="punit1" class="form-control form-control-sm" type="text" placeholder="Price" value="" />
                        </td>
                        <td>
                          <input name="pquantity1" class="form-control form-control-sm" type="text" placeholder="Price" value="" />
                        </td>
                        <td>
                          <input name="total1" class="form-control form-control-sm" type="text" placeholder="Price" value="" />
                        </td>
                        <td  class=" btn_remove " id="1">
                          <div class="btn  btn-sm btn_remove"><span class="fas fa-times-circle text-danger"></span></div>
                        </td>


                        </tr> </tbody>
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                          <input class="form-control form-control-sm" type="text" placeholder="Product Name" value="" />
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
                        <select class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="" >
                            <option selected="selected">Self Collect</option>
                            <option selected="selected">Delivered</option>
                        </select>
                      </div>


                      <div class="col-sm-3 mb-3">
                        <label class="form-label" for="event-name">Vehicle No.</label>
                        <input class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="" >
                        </input>
                      </div>
                      <div class="col-sm-3 mb-3">
                        <label class="form-label" for="event-name">Drivers Name</label>
                        <input class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="" >
                        </input>
                      </div>
                      <div class="col-sm-3 mb-3">
                        <label class="form-label" for="event-name">Drivers Phone</label>
                        <input class="form-control" id="event-name" type="text" placeholder="Walkin Customer" value="" >
                        </input>
                      </div>

                                            
                        
                          
                        
                  </div>

                    <div class="col-12">
                        <label class="form-label" for="event-description">Sale Details</label>
                        <textarea class="form-control" id="event-description" rows="2"></textarea>
                      </div>
                                            <div class="col-12">
                        <div class="border-dashed-bottom my-3"></div>
                      </div>



                  <button class="btn btn-falcon-primary btn-sm" role="button"> Submit Sale </button>
                 <!-- <input type="submit" name="print" id="print" value="Print" onclick="myFunction()"/> -->
                </div>
                   
                  </form>

                </div>
            </div>
          </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
          const requisition_date = document.querySelector("#requisition_date");
          const requisition_number = document.querySelector("#requisition_number");
          const requisition_time = document.querySelector("#requisition_time");
          const reorderble_items = document.querySelector("#reorderble_items");
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
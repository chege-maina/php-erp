 <?php
    $connect = mysqli_connect("localhost", "root", "", "msl_db");
    $query = "SELECT * FROM tbl_supplier ORDER BY id DESC";
    $result = mysqli_query($connect, $query);
    ?>
 <!DOCTYPE html>
 <html lang="en-US" dir="ltr">
 <?php
    session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: ../index.php');
        exit();
    }

    include '../includes/base_page/head.php';
    ?>


 <body>
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
                 <h5 class="p-2">Manage Supplier</h5>
                 <div class="card">
                     <div class="card-body fs--1 p-4">
                         <div class="table-responsive">
                             <div align="right">
                                 <button type="button" name="add" id="add" data-toggle="modal" class="btn btn-falcon-info btn-sm" role="button" data-target="#add_data_Modal">Add</button>
                             </div>
                             <br />
                             <div id="employee_table">
                                 <table class="table table-bordered">
                                     <tr>
                                         <th width="70%">Supplier Name</th>
                                         <th width="15%">Edit</th>
                                         <th width="15%">View</th>
                                     </tr>
                                     <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                        ?>
                                         <tr>
                                             <td><?php echo $row["name"]; ?></td>
                                             <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /></td>
                                             <td><input type="button" name="view" value="view" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>
                                         </tr>
                                     <?php
                                        }
                                        ?>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
 </body>

 </html>
 <div id="dataModal" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Supplier Details</h4>
             </div>
             <div class="modal-body" id="employee_detail">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <div id="add_data_Modal" class="modal fade">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>

             </div>
             <div class="modal-body">
                 <form method="post" id="insert_form">
                     <label>Enter Supplier Name</label>
                     <input type="text" name="name" id="name" class="form-control" />
                     <br />
                     <label>Enter Supplier ID</label>
                     <textarea name="supplier_id" id="supplier_id" class="form-control"></textarea>
                     <br />
                     <label>Email</label>
                     <input type="text" name="email" id="email" class="form-control" />
                     <br />
                     <label>Enter Telephone Number</label>
                     <input type="text" name="tel_no" id="tel_no" class="form-control" />
                     <br />
                     <label>Enter Address</label>
                     <input type="text" name="address" id="address" class="form-control" />
                     <br />
                     <!--<input type="hidden" name="supplier_id" id="supplier_id" /> -->
                     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <script>
     $(document).ready(function() {
         $('#add').click(function() {
             $('#insert').val("Insert");
             $('#insert_form')[0].reset();
         });
         $(document).on('click', '.edit_data', function() {
             var supplier_id = $(this).attr("id");
             $.ajax({
                 url: "fetch.php",
                 method: "POST",
                 data: {
                     supplier_id: supplier_id
                 },
                 dataType: "json",
                 success: function(data) {
                     $('#name').val(data.name);
                     $('#supplier_id').val(data.supplier_id);
                     $('#email').val(data.email);
                     $('#tel_no').val(data.tel_no);
                     $('#address').val(data.address);
                     //   $('#supplier_id').val(data.id);
                     $('#insert').val("Update");
                     $('#add_data_Modal').modal('show');
                 }
             });
         });
         $('#insert_form').on("submit", function(event) {
             event.preventDefault();
             if ($('#name').val() == "") {
                 alert("Name is required");
             } else if ($('#supplier_id').val() == '') {
                 alert("Supplier ID is required");
             } else if ($('#tel_no').val() == '') {
                 alert("Telephone Number is required");
             } else if ($('#address').val() == '') {
                 alert("Address is required");
             } else {
                 $.ajax({
                     url: "insert.php",
                     method: "POST",
                     data: $('#insert_form').serialize(),
                     beforeSend: function() {
                         $('#insert').val("Inserting");
                     },
                     success: function(data) {
                         $('#insert_form')[0].reset();
                         $('#add_data_Modal').modal('hide');
                         $('#employee_table').html(data);
                     }
                 });
             }
         });
         $(document).on('click', '.view_data', function() {
             var supplier_id = $(this).attr("id");
             if (supplier_id != '') {
                 $.ajax({
                     url: "select.php",
                     method: "POST",
                     data: {
                         supplier_id: supplier_id
                     },
                     success: function(data) {
                         $('#employee_detail').html(data);
                         $('#dataModal').modal('show');
                     }
                 });
             }
         });
     });
 </script>

 <?php
    include '../includes/base_page/footer.php';
    ?>
 <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
 <!-- Footer End -->
 <!-- =========================================================== -->
 </body>

 </html>
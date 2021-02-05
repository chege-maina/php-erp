<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit();
}
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
                <h5 class="p-2">Add Supplier</h5>
                <div class="card ">
                    <div class="card-body  ">
                        <!-- Content is to start here -->
                        <form class="form-horizontal">
                            <div class="row">
                                <div class="col ">
                                    <label for="supplier_name" class="form-label">Supplier Name*</label>
                                    <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
                                </div>


                                <div class="col">
                                    <label for="suppler_id" class="form-label">Supplier ID*</label>
                                    <input type="text" name="supplier_id" id="supplier_id" class="form-control" required>
                                </div>


                                <div class="col">
                                    <label for="email" class="form-label">Email*</label>
                                    <input type="text" name="email" id="email" class="form-control" required>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">

                                    <label for="telephone_number" class="form-label">Telephone Number*</label>
                                    <!-- autofill current date  -->
                                    <input type="text" name="telephone_number" id="telephone_number" class="form-control" required>
                                </div>


                                <div class="col">

                                    <label for="address" class="form-label">Address*</label>
                                    <!-- autofill current time  -->
                                    <input type="address" name="address" id="address" class="form-control" placeholder="0000-00100" required>
                                </div>
                            </div>
                            <div class="col">
                                <button class="btn btn-falcon-primary btn-sm m-3" role="button"> Create New Supplier </button>
                            </div>

                            <!-- Content ends here -->
                        </form>
                    </div>
                    <!-- Additional cards can be added here -->
                </div>
                <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
                <!-- body ends here -->
                <!-- =========================================================== -->
                <script>
                    let all_requisitionable_items = {};
                    let items_in_combobox = {};


                    // const items_in_requisitionable_item

                    const telephone_number = document.querySelector("#telephone_number");
                    const supplier_name = document.querySelector("#supplier_name");
                    const supplier_id = document.querySelector("#supplier_id");
                    const email = document.querySelector("#email");
                    const address = document.querySelector("#address");
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
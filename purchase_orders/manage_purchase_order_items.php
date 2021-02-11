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
                <h5 class="p-2">Manage Purchase Order Items</h5>
                <div class="card">
                    <div class="card-body fs--1 p-4">
                        <!-- Content is to start here -->
                        <div class="row">
                            <div class="col">
                                <label for="supplier_name" class="form-label">Supplier Name*</label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="branch" class="form-label">Branch*</label>
                                <input type="text" name="branch" id="branch" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="date" class="form-label">Purchase Date</label>
                                <!-- autofill current date  -->
                                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="time" class="form-label">Purchase Time</label>
                                <!-- autofill current date  -->
                                <input type="time" id="time" class="form-control" readonly>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card mt-1">
                    <div class="card-body fs--1 p-4">
                        <div class="row my-1">
                            <div class="col">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Units</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Unit Cost</th>
                                            <th scope="col">Total</th>
                                            <br>
                                            <br>
                                        </tr>
                                    </thead>

                                    <tbody id="table_body">
                                    </tbody>
                                    <div class="row m-3">

                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <th>Total Before Tax</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="text" placeholder="Total Before Tax" value="" readonly />
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
                                            <th>Tax 16 %</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="text" placeholder="Tax 16 %" value="" readonly />
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
                                            <th>Purchase Order Total</th>
                                            <td>
                                                <input class="form-control form-control-sm" type="text" placeholder="Purchase Order Total" value="" readonly />
                                            </td>
                                        </tr>
                                    </div>
                                </table>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <div class="col">
                                    <button class="btn btn-falcon-success btn-sm m-2" role="button"> Approve </button>
                                </div>
                            </div>
                        </div>
                        <!-- Content ends here -->
                    </div>

                </div>
                <!-- Additional cards can be added here -->
            </div>
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->
        <script>
            function d_toString(value) {
                return value < 10 ? '0' + value : String(value);
            }
            document.addEventListener('DOMContentLoaded', function() {
                const date = new Date();
                let month = d_toString(date.getMonth() + 1);
                let day = d_toString(date.getDate());
                let hours = d_toString(date.getHours());
                let minutes = d_toString(date.getMinutes());


                time.value = hours + ":" + minutes;
            });

            // Clear datalist
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
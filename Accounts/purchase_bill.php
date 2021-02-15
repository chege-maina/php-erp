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
                <h5 class="p-2">Enter Bill </h5>
                <div class="card">

                    <div class="bg-holder d-none d-lg-block bg-card" style="background-image:url(../assets/img/illustrations/corner-4.png);">
                    </div>
                    <!--/.bg-holder-->

                    <div class="card-body fs--1 pr-2">

                        <div class="d-flex align-items-center mb-2 flex-row" style="height: 5rem;">
                            <h5>Purchase Bill </h5>
                            <span id="po_nbr" class="text-info h2 ml-2"></span>
                        </div>

                        <!-- Content is to start here -->
                        <div class="row">
                            <div class="col">
                                <label for="supplier_name" class="form-label">Supplier Name*</label>
                                <input type="text" name="supplier_name" id="supplier_name" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="branch" class="form-label">Address</label>
                                <input type="text" name="branch" id="po_branch" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="branch" class="form-label">Terms</label>
                                <input type="text" name="branch" id="po_branch" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="created_by" class="form-label">Invoice Number</label>
                                <input type="text" id="created_by" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="date" class="form-label">Date</label>
                                <!-- autofill current date  -->
                                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="created_by" class="form-label">LPO Number</label>
                                <input type="text" id="created_by" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="branch" class="form-label">Amount Due</label>
                                <input type="text" name="branch" id="po_branch" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="date" class="form-label">Bill Due</label>
                                <!-- autofill current date  -->
                                <input type="date" value="<?php echo date("Y-m-d"); ?>" id="date" class="form-control" readonly>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="card mt-1">
                    <div class="card-header bg-light p-2 pt-3 pl-3">
                        <h6>Products</h6>
                    </div>
                    <div class="card-body fs--1 p-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped mt-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Product Code</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Units</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Cost</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                </tbody>
                            </table>
                        </div>

                        <div class="row m-3">
                            <div class="col text-right fw-bold">
                                Total Before Tax</div>
                            <div class="col col-auto">
                                <input class="form-control form-control-sm text-right" type="number" readonly id="total_before_tax" />
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col text-right fw-bold">
                                Tax 16 %
                            </div>
                            <div class="col col-auto">
                                <input class="form-control form-control-sm text-right" type="number" readonly id="tax_pc" />
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col text-right fw-bold">
                                Purchase Order Total
                            </div>
                            <div class="col col-auto">
                                <input class="form-control form-control-sm text-right" type="number" readonly id="po_total" />
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card mt-1">
                    <div class="card-body fs--1 p-1">
                        <div class="d-flex flex-row-reverse">
                            <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                                Approve
                            </button>
                        </div>
                        <!-- Content ends here -->
                    </div>

                </div>

                <!-- Additional cards can be added here -->


            </div>
        </div>

        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
</body>

</html>
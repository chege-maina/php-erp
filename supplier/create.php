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
                <div id="alert-div"></div>
                <h5 class="p-2">Add Supplier</h5>
                <div class="card">
                    <div class="card-body fs--1 p-4">
                        <form method="POST" onsubmit="return doInsert(this);">
                            <div class="row">
                                <div class="col">
                                    <label for="supplier_id" class="form-label">Supplier ID*</label>
                                    <input name="supplier_id" class="form-control m-3" placeholder="Supplier ID" required>
                                    <div class="invalid-feedback">This field cannot be left blank.</div>
                                </div>
                                <div class="col">
                                    <label for="name" class="form-label">Name*</label>
                                    <input name="name" class="form-control m-3" placeholder="Name" required>
                                    <div class="invalid-feedback">This field cannot be left blank.</div>
                                </div>
                                <div class="col">
                                    <label for="email" class="form-label">Email*</label>
                                    <input name="email" class="form-control m-3" placeholder="Email" required>
                                    <div class="invalid-feedback">This field cannot be left blank.</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="tel_no" class="form-label">Telephone Number*</label>
                                    <input name="tel_no" class="form-control m-3" placeholder="Tel No" required>
                                    <div class="invalid-feedback">This field cannot be left blank.</div>
                                </div>
                                <div class="col">
                                    <label for="address" class="form-label">Address*</label>
                                    <input name="address" class="form-control m-3" placeholder="Address" required>
                                    <div class="invalid-feedback">This field cannot be left blank.</div>
                                </div>
                            </div>
                            <section>
                                <div class="row pt-3">
                                    <div class="col">
                                        <div class="row">
                                            <!--  <div class="col">
                                            <label for="payment_terms" class="form-label">Payment Terms*</label>
                                            <select name="payment_terms" id="payment_terms" class="form-select" required>
                                                <option value="net 30">net 30</option>
                                                <option value="net 30">net 30</option>
                                                <option value="net 30">net 30</option>
                                                <option value="due on receipt">due on receipt</option>
                                            </select>
                                            <div class="invalid-feedback">This field cannot be left blank.</div>
                                        </div> -->
                                            <div class="col">
                                                <label for="tax_id" class="form-label">Supplier Tax ID*</label>
                                                <input name="tax_id" class="form-control m-3" placeholder="Tax ID" required>
                                                <div class="invalid-feedback">This field cannot be left blank.</div>
                                            </div>
                                            <div class="col">
                                                <label for="credit_limit" class="form-label">Credit Limit*</label>
                                                <input name="credit_limit" class="form-control m-3" placeholder="Credit Limit" required>
                                                <div class="invalid-feedback">This field cannot be left blank.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-falcon-primary" id="submit" type="submit" value="Insert">

                                        <span class="fas fa-save mr-1 m-1" data-fa-transform="shrink-3"></span>
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <script>
                    function doInsert(form) {
                        var supplier_id = form.supplier_id.value;
                        var name = form.name.value;
                        var email = form.email.value;
                        var tel_no = form.tel_no.value;
                        var address = form.address.value;
                        var tax_id = form.tax_id.value;
                        var credit_limit = form.credit_limit.value;

                        var ajax = new XMLHttpRequest();
                        ajax.open("POST", "Http.php", true);
                        ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                        ajax.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200)
                                alert(this.responseText);
                        };

                        ajax.send("supplier_id=" + supplier_id + "&name=" + name + "&email=" + email + "&tel_no=" + tel_no + "&address=" + address + "&tax_id=" + tax_id + "&credit_limit=" + credit_limit + "&do_insert=1");
                        return false;
                    }
                </script>

                <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
                <?php
                include '../includes/base_page/footer.php';
                ?>
                <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
                <!-- Footer End -->
                <!-- =========================================================== -->
            </div>
        </div>
</body>

</html>
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
                <h5 class="p-2">Generate Remittance Advice</h5>
                <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->

                <div class="card mt-3">
                    <div class="card-body fs--1 p-4">
                        <div class="row">
                            <div class="col-lg-8 mb-3">
                            </div>
                            <div class="col-lg-4 mb-3">

                                <div class="col flex-row-reverse">
                                    <div class="col">
                                        <label for="req_date" class="form-label">Date </label>
                                        <input type="date" name="req_date" id="req_date_from" class="form-control" required onchange="updateDateFilters();">

                                    </div>
                                </div>
                                <!-- Content is to start here -->

                            </div>
                        </div>
                        <!-- Content is to start here -->
                        <div class="row pb-2 ">
                            <div class="col">
                                <label for="bills" class="form-label">Show Bills Due</label>
                                <select name="bills" id="status" class="form-select">
                                    <option value="all">Show All</option>
                                    <option value="bills_due">Show Bills Due</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="req_date" class="form-label">From </label>
                                <input type="date" name="req_date" id="req_date_from" class="form-control" required onchange="updateDateFilters();">
                            </div>
                            <div class="col">
                                <label for="req_date" class="form-label">To </label>
                                <input type="date" name="req_date" id="req_date_to" class="form-control" required onchange="updateDateFilters();">
                            </div>
                            <div class="col-auto d-flex align-items-end">
                                <button class="btn btn-falcon-primary" type="button" onclick="filterRequisitions();">
                                    <span class="fas fa-filter mr-1" data-fa-transform="shrink-3"></span>Filter
                                </button>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="m-2 mb-2">
                        <div class="table-responsive">
                            <table class="table table-sm table-striped" id="table-main">
                                <thead>
                                    <tr>
                                        <th>Due Date</th>
                                        <th>Invoice Number</th>
                                        <th>Supplier</th>
                                        <th>Amount Due</th>
                                        <th>WHT</th>
                                        <th>Amount Payable</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                </tbody>
                            </table>
                        </div>
                        <div class="row m-3">
                            <div class="col text-right fw-bold">
                                Total Amount</div>
                            <div class="col col-auto">
                                <input class="form-control form-control-sm text-right" type="number" readonly id="total_before_tax" />
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col text-right fw-bold">
                                Less 2% VAT With Held
                            </div>
                            <div class="col col-auto">
                                <input class="form-control form-control-sm text-right" type="number" readonly id="tax_pc" />
                            </div>
                        </div>
                        <div class="row m-3">
                            <div class="col text-right fw-bold">
                                Net Payable
                            </div>
                            <div class="col col-auto">
                                <input class="form-control form-control-sm text-right" type="number" readonly id="po_total" />
                            </div>
                        </div>
                    </div>
                    <!-- Content ends here -->
                </div>
                <div class="card mt-1">
                    <div class="card-body fs--1 p-1">
                        <div class="d-flex flex-row-reverse">
                            <button class="btn btn-falcon-primary btn-sm m-2" id="submit" onclick="submitPO();">
                                Create
                            </button>
                        </div>
                        <!-- Content ends here -->
                    </div>

                </div>

                <!-- Additional cards can be added here -->
            </div>
            <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
            <!-- body ends here -->
            <!-- =========================================================== -->

            <script>
                const req_date_from = document.querySelector("#req_date_from");
                const req_date_to = document.querySelector("#req_date_to");
                const r_status = document.querySelector("#status");
                const table_body = document.querySelector("#table_body");


                function d_toString(value) {
                    return value < 10 ? '0' + value : String(value);
                }


                function updateDateFilters() {
                    const fromDate = new Date(req_date_from.value);
                    const toDate = new Date(req_date_to.value);
                    if (fromDate > toDate) {
                        let month = d_toString(fromDate.getMonth() + 1);
                        let day = d_toString(fromDate.getDate() + 1);
                        req_date_to.value = String(fromDate.getFullYear()) + '-' + month + '-' + day;
                    }
                    req_date_to.setAttribute("min", fromDate);

                    console.log("From: ", fromDate.getDate(), " To: ", req_date_to.value);
                }

                window.addEventListener('DOMContentLoaded', (event) => {
                    const date = new Date();
                    let month = d_toString(date.getMonth() + 1);
                    let day = d_toString(date.getDate());
                    let day_to = d_toString(date.getDate() + 1);

                    req_date_from.value = String(date.getFullYear()) + '-' + month + '-' + day;
                    req_date_to.value = String(date.getFullYear()) + '-' + month + '-' + day_to;
                    req_date_to.setAttribute("min", req_date_from.value);

                    const formData = new FormData();
                    fetch('../includes/#.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            console.log(result);
                            updateTable(result);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });


                let updateTable = (data) => {
                    table_body.innerHTML = "";
                    data.forEach(value => {
                        const this_row = document.createElement("tr");

                        const req_no = document.createElement("td");
                        req_no.appendChild(document.createTextNode(value["req_no"]));
                        req_no.classList.add("align-middle");

                        const req_date = document.createElement("td");
                        req_date.appendChild(document.createTextNode(value["date"]));
                        req_date.classList.add("align-middle");

                        const req_branch = document.createElement("td");
                        req_branch.appendChild(document.createTextNode(value["branch"]));
                        req_branch.classList.add("align-middle");

                        const req_user = document.createElement("td");
                        req_user.appendChild(document.createTextNode(value["user"]));
                        req_user.classList.add("align-middle");

                        const req_actions = document.createElement("td");
                        const btn = document.createElement("button");
                        btn.setAttribute("onclick", "detailedView(" + value["req_no"] + ")");
                        btn.appendChild(document.createTextNode("Manage"));
                        btn.classList.add("btn", "btn-falcon-primary", "btn-sm");
                        req_actions.appendChild(btn);

                        this_row.append(req_no, req_user, req_date, req_branch, req_actions);
                        table_body.appendChild(this_row);
                    });

                }

                function detailedView(req_no) {
                    sessionStorage.setItem('req_no', req_no);
                    window.location.href = "#.php";
                }

                function filterRequisitions() {
                    const formData = new FormData();
                    formData.append("date1", req_date_from.value);
                    formData.append("date2", req_date_to.value);
                    // formData.append("status", r_status.value);
                    formData.append("branch", user_branch);
                    fetch('../includes/#  .php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(result => {
                            console.log('Success:', result);
                            updateTable(result);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
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
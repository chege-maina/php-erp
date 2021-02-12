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
                <h5 class="p-2">Manage Received Goods</h5>
                <div class="card">
                    <div class="card-body fs--1 p-4">
                        <!-- Content is to start here -->
                        <div class="row pb-2 ">
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
                    <div class="m-2 mb-2">
                        <table class="table table-sm table-striped" id="table-main">
                            <thead>
                                <tr>
                                    <th>PO Number</th>
                                    <th>Supplier </th>
                                    <th>Date </th>
                                    <th>Created By</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="table_body">
                            </tbody>
                        </table>
                    </div>
                    <!-- Content ends here -->
                </div>
                <!-- Additional cards can be added here -->
            </div>
            <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
            <!-- body ends here -->
            <!-- =========================================================== -->

            <script>
                const req_date_from = document.querySelector("#req_date_from");
                const req_date_to = document.querySelector("#req_date_to");
                //   const r_status = document.querySelector("#status");
                const table_body = document.querySelector("#table_body");

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


                let updateTable = (data) => {
                    table_body.innerHTML = "";
                    data.forEach(value => {
                        const this_row = document.createElement("tr");

                        const po_number = document.createElement("td");
                        po_number.appendChild(document.createTextNode(value["po_number"]));
                        po_number.classList.add("align-middle");

                        const date = document.createElement("td");
                        date.appendChild(document.createTextNode(value["date"]));
                        date.classList.add("align-middle");

                        const supplier = document.createElement("td");
                        supplier.appendChild(document.createTextNode(value["supplier"]));
                        supplier.classList.add("align-middle");

                        const user = document.createElement("td");
                        user.appendChild(document.createTextNode(value["user"]));
                        user.classList.add("align-middle");

                        const status = document.createElement("td");
                        const tmp_status = value["status"];
                        const badge = document.createElement("span");
                        badge.appendChild(document.createTextNode(tmp_status));
                        badge.classList.add("badge", "rounded-pill");
                        // <span class="badge rounded-pill badge-soft-primary">Primary</span>
                        if (tmp_status == "pending") {
                            badge.classList.add("badge-soft-secondary");
                        } else if (tmp_status == "approved") {
                            badge.classList.add("badge-soft-success");
                        } else if (tmp_status == "rejected") {
                            badge.classList.add("badge-soft-danger");
                        }

                        status.appendChild(badge);
                        status.classList.add("align-middle");

                        const req_actions = document.createElement("td");
                        const btn = document.createElement("button");
                        btn.setAttribute("onclick", "detailedView(" + value["po_number"] + ")");
                        btn.appendChild(document.createTextNode("Receive Goods"));
                        btn.classList.add("btn", "btn-falcon-primary", "btn-sm");
                        req_actions.appendChild(btn);

                        this_row.append(po_number, supplier, date, user, status, req_actions);
                        table_body.appendChild(this_row);
                    });

                }

                function detailedView(req_no) {
                    console.log("Req no: ", req_no);
                    sessionStorage.setItem('req_no', req_no);
                    window.location.href = "manage_pr.php";
                }

                function d_toString(value) {
                    return value < 10 ? '0' + value : String(value);
                }

                window.addEventListener('DOMContentLoaded', (event) => {
                    const date = new Date();
                    let month = d_toString(date.getMonth() + 1);
                    let day = d_toString(date.getDate());
                    let day_to = d_toString(date.getDate() + 1);

                    req_date_from.value = String(date.getFullYear()) + '-' + month + '-' + day;
                    req_date_to.value = String(date.getFullYear()) + '-' + month + '-' + day_to;
                    req_date_to.setAttribute("min", req_date_from.value);

                    fetch('../includes/load_receive_mgnt.php')
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            updateTable(data);
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });
                });

                function filterRequisitions() {
                    const formData = new FormData();
                    formData.append("date1", req_date_from.value);
                    formData.append("date2", req_date_to.value);
                    // formData.append("status", r_status.value);
                    formData.append("supplier", user_branch);
                    fetch('../includes/filter_receive_goods.php', {
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
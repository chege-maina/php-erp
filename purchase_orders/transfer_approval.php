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
                <h5 class="p-2">Transfer Approval</h5>
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
                            <div class="col">
                                <label for="status" class="form-label">Status*</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending">Pending</option>
                                    <option value="approved">Approved</option>
                                </select>
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
                                    <th>Transfer No. </th>
                                    <th>Branch Requesting </th>
                                    <th class="col-lg-1">Date </th>
                                    <th>Branch Transferring</th>
                                    <th>Created By</th>
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
                const r_status = document.querySelector("#status");
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

                        const transfer_no = document.createElement("td");
                        transfer_no.appendChild(document.createTextNode(value["transfer_no"]));
                        transfer_no.classList.add("align-middle");

                        const tr_date = document.createElement("td");
                        tr_date.appendChild(document.createTextNode(value["date"]));
                        tr_date.classList.add("align-middle");

                        const branch = document.createElement("td");
                        branch.appendChild(document.createTextNode(value["branch"]));
                        branch.classList.add("align-middle");

                        const branch_from = document.createElement("td");
                        branch_from.appendChild(document.createTextNode(value["branch_from"]));
                        branch_from.classList.add("align-middle");

                        const po_user = document.createElement("td");
                        po_user.appendChild(document.createTextNode(value["user"]));
                        po_user.classList.add("align-middle");

                        const req_status = document.createElement("td");
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

                        req_status.appendChild(badge);
                        req_status.classList.add("align-middle");

                        const req_actions = document.createElement("td");
                        const btn = document.createElement("button");
                        btn.setAttribute("onclick", "detailedView(" + value["transfer_no"] + ")");
                        btn.appendChild(document.createTextNode("Manage"));
                        btn.classList.add("btn", "btn-falcon-primary", "btn-sm");
                        req_actions.appendChild(btn);

                        this_row.append(transfer_no, branch, tr_date, po_user, branch_from, req_status, req_actions);
                        table_body.appendChild(this_row);
                    });

                }

                function detailedView(transfer_no) {
                    console.log("PO no: ", transfer_no);
                    sessionStorage.setItem('transfer_no', transfer_no);
                    window.location.href = "manage_purchase_order_items.php";
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

                    fetch('../includes/purchase_order_manage.php')
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
                    formData.append("status", r_status.value);
                    formData.append("supplier", user_branch);
                    fetch('../includes/filter_purchaseorder.php', {
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
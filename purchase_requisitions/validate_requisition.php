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
                <h5 class="p-2">Validate Requisition</h5>
                <div class="card">
                    <div class="card-body fs--1 p-4">
                        <!-- Content is to start here -->
                        <div class="row">
                            <div class="col">
                                <label for="requisition_number" class="form-label">Requisition Number*</label>
                                <input type="number" name="requisition_number" id="requisition_number" class="form-control" readonly>
                            </div>
                            <div class="col">
                                <label for="requisition_date" class="form-label">Date</label>
                                <!-- autofill current date  -->
                                <input type="#text" name="#requisition_date" id="#requisition_date" class="form-control" required readonly>
                            </div>
                            <div class="col">
                                <label for="requisition_time" class="form-label">Time</label>
                                <!-- autofill current time  -->
                                <input type="#time" name="#requisition_time" id="#requisition_time" class="form-control" required readonly>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <table class="table table-striped" id="table_id">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Units</th>
                                            <th scope="col" class="w-25">Quantity</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <button class="btn btn-falcon-success" id="submit">
                            <span class="fas fa-save mr-1" data-fa-transform="shrink-3"></span>
                            Approve
                        </button>
                        <button class="btn btn-falcon-danger" id="submit">
                            <span class="fas fa-save mr-1" data-fa-transform="shrink-3"></span>
                            Reject
                        </button>


                        <!-- Content ends here -->
                    </div>
                    <!-- Additional cards can be added here -->
                </div>
                <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
                <!-- body ends here -->
                <!-- =========================================================== -->

                <script>
                    $(document).ready(function() {
                        $('#submit').click(function(e) {
                            e.preventDefault();
                            var requisition_number = $('#requisition_number').val();
                            var requisition_date = $('#requisition_date').val();
                            var requisition_time = $('#requisition_time').val();
                            var requisition_user = user_name;
                            var requisition_branch = user_branch;
                            var data1 = {
                                requisition_number: requisition_number,
                                requisition_date: requisition_date,
                                requisition_time: requisition_time,
                                requisition_user: requisition_user,
                                requisition_branch: requisition_branch
                            }

                            var conf = confirm("Do You Want to Create a Purchases Requisition?")
                            if (conf) {
                                $.ajax({
                                    url: "../includes/create_requisition.php",
                                    method: "POST",
                                    data: data1,
                                    success: function(data) {
                                        if (data == 'Successful') {

                                            alert(data)
                                        }

                                    }

                                    //console.log('response:' + data);
                                })

                                // Send the table data too
                                // TODO:  Move sendTableData here
                            }
                            // Move it to only if success is chosen
                            sendTableData();
                        })


                    })
                </script>


                <script>
                    let all_requisitionable_items = {};
                    let items_in_combobox = {};
                    let items_in_table = {};

                    // const items_in_requisitionable_item
                    const requisitionable_item = document.querySelector("#requisitionable_item");
                    const requisitionable_items_datalist = document.querySelector("#requisitionable_items");
                    const requisition_date = document.querySelector("#requisition_date");
                    const requisition_number = document.querySelector("#requisition_number");
                    const requisition_time = document.querySelector("#requisition_time");
                    const table_body = document.querySelector("#table_body");

                    document.addEventListener('DOMContentLoaded', function() {
                        // console.log(user_name);
                        // Fetch items and balance
                        fetch('../includes/requisition_items.php')
                            .then(response => response.json())
                            .then(data => {
                                data.forEach((value) => {
                                    all_requisitionable_items[value["product_name"]] = {
                                        name: value["product_name"],
                                        code: value["product_code"],
                                        unit: value["unit"],
                                        balance: value["balance"]
                                    };
                                });
                                items_in_combobox = {
                                    ...all_requisitionable_items
                                };
                                updateReqItems();
                            });
                    });

                    function updateReqItems() {
                        // Clear datalist
                        requisitionable_items_datalist.innerHTML = "";
                        requisitionable_item.value = "";
                        for (let item in items_in_combobox) {
                            // console.log(items_in_combobox[item]);
                            let opt = document.createElement("option");
                            opt.appendChild(
                                document.createTextNode(
                                    "Remaining " + items_in_combobox[item]["balance"] +
                                    " " + items_in_combobox[item]["unit"]
                                )
                            );
                            opt.setAttribute("value", items_in_combobox[item]["name"]);
                            requisitionable_items_datalist.appendChild(opt);
                        }
                    }

                    function updateTable() {
                        table_body.innerHTML = "";
                        for (let item in items_in_table) {

                            let tr = document.createElement("tr");
                            // Id will be like 1Tank
                            tr.setAttribute("id", items_in_table[item]["code"] + items_in_table[item]["name"]);

                            let code_td = document.createElement("td");
                            code_td.appendChild(document.createTextNode(items_in_table[item]["code"]));
                            code_td.classList.add("align-middle");

                            let name_td = document.createElement("td");
                            name_td.appendChild(document.createTextNode(items_in_table[item]["name"]));
                            name_td.classList.add("align-middle");

                            let balance_td = document.createElement("td");
                            balance_td.appendChild(document.createTextNode(items_in_table[item]["balance"]));
                            balance_td.classList.add("align-middle");

                            let units_td = document.createElement("td");
                            units_td.appendChild(document.createTextNode(items_in_table[item]["unit"]));
                            units_td.classList.add("align-middle");

                            let quantity = document.createElement("input");
                            quantity.setAttribute("type", "number");
                            quantity.setAttribute("required", "");
                            quantity.classList.add("form-control", "form-control-sm", "align-middle");
                            quantity.setAttribute("data-ref", items_in_table[item]["name"]);
                            quantity.setAttribute("min", 1);
                            // make sure the quantity is always greater than 0
                            quantity.setAttribute("onfocusout", "this.value = this.value <= 0 ? 1 : this.value;");
                            quantity.setAttribute("onkeyup", "addQuantityToReqItem(this.dataset.ref, this.value);");
                            quantity.setAttribute("onclick", "this.select();");
                            items_in_table[item]['quantity'] = 'quantity' in items_in_table[item] ? items_in_table[item]['quantity'] : 1;
                            quantity.value = items_in_table[item]['quantity'];
                            let quantityWrapper = document.createElement("td");
                            quantityWrapper.classList.add("m-2");
                            quantityWrapper.appendChild(quantity);

                            let actionWrapper = document.createElement("td");
                            actionWrapper.classList.add("m-2");
                            let action = document.createElement("button");
                            action.setAttribute("id", items_in_table[item]["name"]);
                            action.setAttribute("onclick", "removeItem(this.id);");
                            let icon = document.createElement("span");
                            icon.classList.add("fas", "fa-minus", "mt-1");
                            action.appendChild(icon);
                            action.classList.add("btn", "btn-falcon-danger", "btn-sm", "rounded-pill");
                            actionWrapper.appendChild(action);

                            tr.append(code_td, name_td, balance_td, units_td, quantityWrapper, actionWrapper);
                            table_body.appendChild(tr);

                        }
                        return;
                    }

                    function addQuantityToReqItem(item, value) {
                        items_in_table[item]['quantity'] = value;
                        console.log(value);
                    }

                    function addItem() {
                        const item_to_add = all_requisitionable_items[requisitionable_item.value];
                        if (!item_to_add) {
                            return;
                        }

                        items_in_table[requisitionable_item.value] = item_to_add;
                        // console.log("Now in table: ", items_in_table);

                        // console.log(item_to_add);

                        delete items_in_combobox[item_to_add["name"]];
                        updateTable();
                        updateReqItems();
                    }

                    function removeItem(item) {
                        items_in_table[item]['quantity'] = 0;
                        delete items_in_table[String(item)];
                        const item_to_add = all_requisitionable_items[item];
                        items_in_combobox[item] = item_to_add;
                        updateTable();
                        updateReqItems();
                    }

                    function clearTable() {
                        items_in_table = {};
                        items_in_combobox = {
                            ...all_requisitionable_items
                        };
                        updateTable();
                        updateReqItems();
                    }

                    function checktable() {
                        if (table_items.length == 0) {
                            const alertVar =
                                `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> Cannot submit empty table.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                            var divAlert = document.querySelector("#alert-div");
                            divAlert.innerHTML = alertVar;
                            divAlert.scrollIntoView();
                            return;
                        }
                    }

                    function sendTableData() {
                        let table_items = [];
                        for (let item in items_in_table) {
                            table_items.push(items_in_table[item]);
                        }
                        if (table_items.length == 0) {
                            const alertVar =
                                `<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> Cannot submit empty table.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                            var divAlert = document.querySelector("#alert-div");
                            divAlert.innerHTML = alertVar;
                            divAlert.scrollIntoView();
                            return;
                        } else {
                            console.log(table_items);
                            const formData = new FormData();
                            formData.append("user_name", user_name);
                            formData.append("user_branch", user_branch);
                            formData.append("requisition_number", requisition_number.value)
                            formData.append("requisition_date", requisition_date.value)
                            formData.append("requisition_time", requisition_time.value)
                            formData.append("table_items", JSON.stringify(table_items));

                            // Send the data
                            fetch('../includes/create_requisition_items.php', {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log("from server", data);
                                    const alertVar =
                                        `<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>${data["message"]}!</strong> Product added to the database.
              <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button>
              </div>`;
                                    var divAlert = document.querySelector("#alert-div");
                                    divAlert.innerHTML = alertVar;
                                    divAlert.scrollIntoView();
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2500);
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        const date = new Date();
                        let month = d_toString(date.getMonth() + 1);
                        let day = d_toString(date.getDate());
                        let hours = d_toString(date.getHours());
                        let minutes = d_toString(date.getMinutes());

                        requisition_date.value = String(date.getFullYear()) + '-' + month + '-' + day;
                        requisition_time.value = hours + ":" + minutes;
                    });
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
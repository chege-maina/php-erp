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
                <h5 class="p-2">Supplier List</h5>
                <div class="card">
                    <div class="card-body fs--1 p-4">
                        <div class="row my-3">
                            <div class="col">
                                <table class="table table-striped" id="table_id">

                                    <thead>
                                        <tr>
                                            <th>Supplier ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Telephone Number</th>
                                            <th>Postal Address</th>
                                            <th>Physical Address</th>
                                            <th>Tax ID</th>
                                            <th>Payment Terms</th>

                                        </tr>
                                    </thead>

                                    <tbody id="data"></tbody>
                                </table>

                                <script>
                                    function getData() {
                                        var ajax = new XMLHttpRequest();
                                        ajax.open("GET", "Http.php?view_all=1", true);
                                        ajax.send();

                                        ajax.onreadystatechange = function() {
                                            if (this.readyState == 4 && this.status == 200) {
                                                var data = JSON.parse(this.responseText);
                                                var html = "";

                                                for (var a = 0; a < data.length; a++) {
                                                    html += "<tr>";
                                                    html += "<td>" + data[a].supplier_id + "</td>";
                                                    html += "<td>" + data[a].name + "</td>";
                                                    html += "<td>" + data[a].email + "</td>";
                                                    html += "<td>" + data[a].tel_no + "</td>";
                                                    html += "<td>" + data[a].postal_address + "</td>";
                                                    html += "<td>" + data[a].physical_address + "</td>";
                                                    html += "<td>" + data[a].tax_id + "</td>";
                                                    html += "<td>" + data[a].payment_terms + "</td>";
                                                    html += "</tr>";
                                                }

                                                document.getElementById("data").innerHTML = html;
                                            }
                                        };
                                    }

                                    getData();
                                </script>
                            </div>
                        </div>
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
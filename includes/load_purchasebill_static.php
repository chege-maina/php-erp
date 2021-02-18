<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lpo_no = $_POST["po_number"];

    $stat = "approved";

    $query = "SELECT * FROM tbl_store WHERE status='$stat' and lpo_number='$lpo_no' ORDER BY receipt_no ASC";

    $result = mysqli_query($conn, $query);
    $response = array();

    if ($row = mysqli_fetch_assoc($result)) {
        $po_number = $row['lpo_number'];
        $supplier = $row['supplier_name'];
        $del_no = $row['invoice_no'];
        $rec_no = $row['recepit_no'];

        $query2 = "SELECT * FROM tbl_store WHERE status='$stat' and lpo_number='$lpo_no' ORDER BY receipt_no ASC";
    }

    echo json_encode($response);

    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}

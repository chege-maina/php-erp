<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier = $_POST["supplier"];

    $stat = "pending";

    $query = "SELECT * FROM tbl_invoice WHERE customer_name='$supplier' and status='$stat' ORDER BY due_date ASC";

    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $due = $row['due_date'];
        $invoice = $row['salesbill_no'];
        $total = $row['total'];

        array_push(
            $response,
            array(
                'due_date' => $due,
                'invoice_no' => $invoice,
                'amount' => $total
            )
        );
    }
    echo json_encode($response);
    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}

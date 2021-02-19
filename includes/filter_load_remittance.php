<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lpo_no = $_POST["supplier"];
    $date = $_POST["date"];
    $all = $_POST["show"];

    $stat = "pending";

    if (strcmp($all, 'Show Bills Dues') == 0) {
        $query = "SELECT * FROM tbl_purchase_bill WHERE status='$stat' and supplier_name='$lpo_no' and due_date<='$date' ORDER BY due_date ASC";
    } else {
        $query = "SELECT * FROM tbl_purchase_bill WHERE supplier_name='$supplier' and status='$stat' ORDER BY due_date ASC";
    }



    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $due = $row['due_date'];
        $invoice = $row['invoice_no'];
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

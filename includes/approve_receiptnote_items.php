<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $receipt_no = $_POST["receipt_no"];

    $query = "SELECT * FROM tbl_store WHERE receipt_no ='$receipt_no'";
    $result = mysqli_query($conn, $query);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {

        $query1 = "SELECT * FROM tbl_store_item WHERE receipt_no ='$receipt_no'";
        $result1 = mysqli_query($conn, $query1);
        $response1 = array();
        while ($row1 = mysqli_fetch_assoc($result1)) {
            array_push(
                $response1,
                array(
                    'code' => $row1['product_code'],
                    'name' => $row1['product_name'],
                    'unit' => $row1['product_unit'],
                    'qty' => $row1['qty']
                )
            );
        }

        array_push(
            $response,
            array(
                'receipt_no' => $row['receipt_no'],
                'supplier' => $row['supplier_name'],
                'po_number' => $row['lpo_number'],
                'invoice' => $row['invoice_no'],
                'date' => $row['date'],
                'time' => $row['time'],
                'products' => $response1
            )
        );
    }

    echo json_encode($response);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
mysqli_close($conn);

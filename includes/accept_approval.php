<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $req_no = $_POST["po_number"];
    $stat = 'done';

    $query = "SELECT * FROM tbl_transfer_items WHERE transfer_no ='$req_no' and status='$stat'";

    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
                'code' => $row['product_code'],
                'name' => $row['product_name'],
                'unit' => $row['product_unit'],
                'qty' => $row['product_quantity']
            )
        );
    }

    echo json_encode($response);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
mysqli_close($conn);

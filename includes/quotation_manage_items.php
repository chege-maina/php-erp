<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $req_no = $_POST["req_no"];
    $stats = 'pending';
    $stats2 = 'approved';

    $query = "SELECT * FROM tbl_quotation_items WHERE quote_no ='$req_no' and (status='$stats' or status = '$stats2')";

    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
                'code' => $row['product_code'],
                'name' => $row['product_name'],
                'unit' => $row['unit'],
                'qty' => $row['qty'],
                'total' => $row['amount'],
                'balance' => $row['price']
            )
        );
    }

    echo json_encode($response);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
mysqli_close($conn);

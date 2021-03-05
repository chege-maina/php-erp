<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $req_no = $_POST["receipt_no"];


    $sql1 = "UPDATE tbl_store_item SET status = 'rejected' WHERE receipt_no = '" . $req_no . "'";
    $sql = "UPDATE tbl_store SET status = 'rejected' WHERE receipt_no = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    $response['message'] = "Selected Receipt Note Rejected..";

    echo json_encode($response);

    mysqli_close($conn);
} else {
    $response['message'] = "Fields Required";
    echo json_encode($response);
}

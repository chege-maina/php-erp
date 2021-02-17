<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checker = $_POST["checker"];
    $req_no = $_POST["transfer_no"];

    $stats = "pending";

    if (strcmp($checker, 'rejected') == 0) {
        $sql = "UPDATE tbl_transfer_items SET status = 'rejected' WHERE transfer_no = '" . $req_no . "'";
        $sql2 = "UPDATE tbl_transfer SET status = 'rejected' WHERE transfer_no = '" . $req_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql2);
        $response['message'] = "Selected Transfer Rejected..";
    } else {
        $sql1 = "UPDATE tbl_transfer_items SET status = 'stored' WHERE transfer_no = '" . $req_no . "' and status='accepted'";
        $sql = "UPDATE tbl_transfer SET status = 'stored' WHERE transfer_no = '" . $req_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql1);
        $response['message'] = "Selected Transfer Items Received...";
    }

    echo json_encode($response);

    mysqli_close($conn);
} else {
    $response['message'] = "Fields Required";
    echo json_encode($response);
}

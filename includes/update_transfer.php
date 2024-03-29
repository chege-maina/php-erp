<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checker = $_POST["checker"];
    $name = $_POST["name"];
    $req_no = $_POST["req_no"];
    $branch = $_POST["branch"];

    $stats = "pending";

    if (strcmp($checker, 'item_rejected') == 0) {
        $sql = "UPDATE tbl_transfer_items SET status = 'rejected' WHERE transfer_no = '" . $req_no . "' and product_name = '" . $name . "'";
        mysqli_query($conn, $sql);
        $response['message'] = "Selected Item Removed From Transfer..";
    } else if (strcmp($checker, 'req_rejected') == 0) {
        $sql = "UPDATE tbl_transfer_items SET status = 'rejected' WHERE transfer_no = '" . $req_no . "'";
        $sql2 = "UPDATE tbl_transfer SET status = 'rejected' WHERE transfer_no = '" . $req_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql2);
        $response['message'] = "Selected Transfer Rejected..";
    } else {
        $sql1 = "UPDATE tbl_transfer_items SET status = 'approved', branch_from='$branch' WHERE transfer_no = '" . $req_no . "' and status='pending'";
        $sql = "UPDATE tbl_transfer SET status = 'approved', branch_from='$branch' WHERE transfer_no = '" . $req_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql1);
        $response['message'] = "Selected Transfer Approved..";
    }

    echo json_encode($response);

    mysqli_close($conn);
} else {
    $response['message'] = "Fields Required";
    echo json_encode($response);
}

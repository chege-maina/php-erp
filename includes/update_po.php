<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $req_no = $_POST["po_number"];
  $checker = $_POST["checker"];

  $stats = "pending";
  if (strcmp($checker, 'rejected') == 0) {
    $sql = "UPDATE tbl_purchaseorder_items SET status = 'rejected' WHERE po_number = '" . $req_no . "'";
    $sql2 = "UPDATE tbl_purchaseorder SET status = 'rejected' WHERE po_number = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql2);
    $response['message'] = "Selected Purchase Order Rejected..";
  } else {

    $sql1 = "UPDATE tbl_purchaseorder_items SET status = 'approved' WHERE po_number = '" . $req_no . "' and status= '$stats'";
    $sql = "UPDATE tbl_purchaseorder SET status = 'approved' WHERE po_number = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    $response['message'] = "Selected Purchase Order Approved..";
  }

  echo json_encode($response);

  mysqli_close($conn);
} else {
  $response['message'] = "Fields Required";
  echo json_encode($response);
}

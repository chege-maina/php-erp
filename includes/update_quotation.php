<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $checker = $_POST["checker"];
  $name = $_POST["name"];
  $qty = $_POST["qty"];
  $price = $_POST["price"];
  $req_no = $_POST["req_no"];

  $stats = "pending";

  if (strcmp($checker, 'item_rejected') == 0) {
    $sql = "UPDATE tbl_quotation_items SET status = 'rejected' WHERE product_name = '" . $name . "' and quote_no = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    $response['message'] = "Selected Item Removed From Requisition..";
  } else if (strcmp($checker, 'item_qty') == 0) {
    $sql = "UPDATE tbl_quotation_items SET qty = '" . $qty . "' WHERE product_name = '" . $name . "' and quote_no = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    $response['message'] = "Selected Item Quantity Changed..";
  } else if (strcmp($checker, 'req_rejected') == 0) {
    $sql = "UPDATE tbl_quotation_items SET status = 'rejected' WHERE quote_no = '" . $req_no . "'";
    $sql2 = "UPDATE tbl_quotation SET status = 'rejected' WHERE quote_no = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql2);
    $response['message'] = "Selected Requisition Rejected..";
  } else {
    $sql1 = "UPDATE tbl_quotation_items SET status = 'approved' WHERE quote_no = '" . $req_no . "' and status= '$stats'";
    $sql = "UPDATE tbl_quotation SET status = 'approved' WHERE quote_no = '" . $req_no . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
    $response['message'] = "Selected Requisition Approved..";
  }

  echo json_encode($response);

  mysqli_close($conn);
} else {
  $response['message'] = "Fields Required";
  echo json_encode($response);
}

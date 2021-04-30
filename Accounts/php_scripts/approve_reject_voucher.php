<?php
session_start();
include_once '../../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function approve($con, $voucher_no)
{
  $query = "UPDATE tbl_voucher SET status = 'approved' WHERE voucher_no = ?;";
  $query2 = "UPDATE tbl_voucher_items SET status = 'approved' WHERE voucher_no = ?;";
  $sttmt = "";
  $sttmt2 = "";
  $message = array();
  if ($sttmt = $con->prepare($query) and ($sttmt2 = $con->prepare($query2))) {
    $sttmt->bind_param('s', $voucher_no);
    $sttmt2->bind_param('s', $voucher_no);
    if ($sttmt->execute() and $sttmt2->execute()) {
      $message = array(
        "message" => "success",
      );
    } else {
      $message = array(
        "message" => "error",
        "desc" => "Could not execute statement",
        "detail" => mysqli_error($con)
      );
    }
  } else {
    $message = array(
      "message" => "error",
      "desc" => "Database error. Could not prepare statement",
      "detail" => mysqli_error($con)
    );
  }

  return $message;
}

function reject($con, $voucher_no)
{
  $query = "UPDATE tbl_voucher SET status = 'rejected' WHERE voucher_no = ?;";
  $query2 = "UPDATE tbl_voucher_items SET status = 'rejected' WHERE voucher_no = ?;";
  $sttmt = "";
  $sttmt2 = "";
  $message = array();
  if ($sttmt = $con->prepare($query) and ($sttmt2 = $con->prepare($query2))) {
    $sttmt->bind_param('s', $voucher_no);
    $sttmt2->bind_param('s', $voucher_no);
    if ($sttmt->execute() and $sttmt2->execute()) {
      $message = array(
        "message" => "success",
      );
    } else {
      $message = array(
        "message" => "error",
        "desc" => "Could not execute statement",
        "detail" => mysqli_error($con)
      );
    }
  } else {
    $message = array(
      "message" => "error",
      "desc" => "Database error. Could not prepare statement",
      "detail" => mysqli_error($con)
    );
  }

  return $message;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 1. Get the post fields
  $voucher_no = sanitize_input($_POST["voucher_no"]);
  $action = sanitize_input($_POST["action"]);

  $query_result = "";

  // 2. Do that, self explanatory :)
  if ($action == 'approve') {
    $query_result = approve($con, $voucher_no);
  } else if ($action == 'reject') {
    $query_result = reject($con, $voucher_no);
  }

  // 3. Return whatever message, be it successful or not
  echo json_encode($query_result);
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}

$con->close();

<?php
session_start();
include_once '../includes/dbconnect.php';

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

function approve_item($con, $code)
{
  $query = "UPDATE tbl_product SET status = 'active' WHERE product_code = ?;";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('s', $code);
    if ($sttmt->execute()) {
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

function reject_item($con, $code)
{
  $query = "UPDATE tbl_product SET status = 'rejected' WHERE product_code = ?;";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('s', $code);
    if ($sttmt->execute()) {
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
  $code = sanitize_input($_POST["code"]);
  $action = sanitize_input($_POST["action"]);

  $query_result = "";

  // 2. Add the ledger to db
  if ($action == 'approve') {
    $query_result = approve_item($con, $code);
  } else if ($action == 'reject') {
    $query_result = reject_item($con, $code);
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

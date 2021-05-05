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

function approve($con, $s_id, $s_td)
{
  $query = "UPDATE tbl_attendance SET status = 'active' WHERE employee_no = ? AND att_date = ?;";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('ss', $s_id, $s_td);
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

function reject($con, $s_id, $s_td)
{
  $query = "UPDATE tbl_attendance SET status = 'rejected' WHERE employee_no = ? AND att_date = ?;";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('ss', $s_id, $s_td);
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
  $s_id = sanitize_input($_POST["s_id"]);
  $s_td = sanitize_input($_POST["s_td"]);
  $action = sanitize_input($_POST["action"]);

  $query_result = "";

  // 2. Do that, self explanatory :)
  if ($action == 'approve') {
    $query_result = approve($con, $s_id, $s_td);
  } else if ($action == 'reject') {
    $query_result = reject($con, $s_id, $s_td);
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

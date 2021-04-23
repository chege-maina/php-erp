<?php
session_start();
include_once '../../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function edit_ledger_entry($con, $ledger_name, $group_code, $prev_name)
{
  $query = "UPDATE tbl_ledger SET ledger_name = ?, group_code = ?  WHERE ledger_name = ?;";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('sss', $ledger_name, $group_code, $prev_name);
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
  $ledger_name = sanitize_input($_POST["ledger_name"]);
  $group_code = sanitize_input($_POST["group_code"]);
  $prev_name = sanitize_input($_POST["prev_name"]);

  // 1. Add the ledger to db
  $add_result = edit_ledger_entry($con, $ledger_name, $group_code, $prev_name);

  // 2. Return whatever message, be it successful or not
  echo json_encode($add_result);
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}

$con->close();

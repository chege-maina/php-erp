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

function add_child_to_db($con, $head_code, $head_name, $account_type, $carrying_forward)
{
  $query = "INSERT INTO tbl_chart_account_details (number, title, type, carrying_forward) VALUES(?, ?, ?, ?);";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('sssi', $head_code, $head_name, $account_type, $carrying_forward);
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
  $head_code = sanitize_input($_POST["head_code"]);
  $head_name = sanitize_input($_POST["head_name"]);
  $account_type = sanitize_input($_POST["account_type"]);
  $carrying_forward = sanitize_input($_POST["carrying_forward"]);

  // 1. Add the node to db
  $add_result = add_child_to_db($con, $head_code, $head_name, $account_type, $carrying_forward);

  // 2. Return whatever message, be it successful or not
  echo json_encode($add_result);
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}

$con->close();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 1. Get the post fields
  $prev_code = sanitize_input($_POST["prev_code"]);
  $head_code = sanitize_input($_POST["head_code"]);
  $head_name = sanitize_input($_POST["head_name"]);
  $account_type = sanitize_input($_POST["account_type"]);
  $carrying_forward = sanitize_input($_POST["carrying_forward"]);

  // 2. Prepare the statement
  $query = "UPDATE tbl_chart_account_details SET number = ?, title = ?, type= ?, carrying_forward = ? WHERE number= ?;";
  $sttmt;
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('sssis', $head_code, $head_name, $account_type, $carrying_forward, $prev_code);
    if ($sttmt->execute()) {
      echo json_encode(array(
        "message" => "success",
      ));
    } else {
      echo json_encode(array(
        "message" => "error",
        "desc" => "Could not execute statement",
        "detail" => mysqli_error($con)
      ));
    }
  } else {
    echo json_encode(array(
      "message" => "error",
      "desc" => "Database error. Could not prepare statement",
      "detail" => mysqli_error($con)
    ));
  }
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}

$con->close();

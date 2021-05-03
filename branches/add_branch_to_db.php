<?php
session_start();
include_once '../includes/dbconnect.php';

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

function add_branch_to_db($con, $branch_name, $email_address, $tel_no, $postal_address, $physical_address)
{
  $query = "INSERT INTO tbl_branch (branch_name, email, tel_no, postal_address, physical_address) VALUES(?, ?, ?, ?, ?);";
  $sttmt = "";
  $message = array();
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('sssss', $branch_name, $email_address, $tel_no, $postal_address, $physical_address);
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
  $branch_name = sanitize_input($_POST["branch_name"]);
  $email_address = sanitize_input($_POST["email_address"]);
  $tel_no = sanitize_input($_POST["tel_no"]);
  $postal_address = sanitize_input($_POST["postal_address"]);
  $physical_address = sanitize_input($_POST["physical_address"]);

  // 1. Add the record to db
  $add_result =  add_branch_to_db($con, $branch_name, $email_address, $tel_no, $postal_address, $physical_address);

  // 2. Return whatever message, be it successful or not
  echo json_encode($add_result);
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}

$con->close();

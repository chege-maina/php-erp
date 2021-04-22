<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
session_start();

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $name = sanitize_input($_POST["name"]);
  $number = sanitize_input($_POST["number"]);
  $tag_no = sanitize_input($_POST["tag_no"]);
  $branch = sanitize_input($_POST["branch"]);
  $asset_group = sanitize_input($_POST["asset_group"]);
  $unit = sanitize_input($_POST["unit"]);
  $descpt = sanitize_input($_POST["descpt"]);
  $weight = sanitize_input($_POST["weight"]);
  $date = sanitize_input($_POST["date"]);
  $dep_rate = sanitize_input($_POST["dep_rate"]);
  $cost = sanitize_input($_POST["cost"]);
  $dep_method = sanitize_input($_POST["dep_method"]);
  $wear_tear = sanitize_input($_POST["wear_tear"]);
  $asset_status = sanitize_input($_POST["asset_status"]);
  $financier = sanitize_input($_POST["financier"]);
  $loan_ref = sanitize_input($_POST["loan_ref"]);

  echo $asset_status;

  $mysql = "INSERT INTO tbl_asset (name, number, tag_no, branch, 
  asset_group, unit, descpt, weight, date, dep_rate, cost, dep_method, wear_tear, asset_status, financier, loan_ref)
   VALUES('$name', '$number', '$tag_no', '$branch', '$asset_group', '$unit', '$descpt', '$weight', '$date',
   '$dep_rate', '$cost', '$dep_method', '$wear_tear', '$asset_status', '$financier', '$loan_ref')";
  mysqli_query($conn, $mysql);

  $message = "Assest " . $number . " Added Successfully..";
  echo json_encode($message);
} else {

  echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
}

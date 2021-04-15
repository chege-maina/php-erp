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

  $type = sanitize_input($_POST["type"]);
  $benefit = sanitize_input($_POST["benefit"]);
  $month = sanitize_input($_POST["month"]);
  $year = sanitize_input($_POST["year"]);
  $table_items = json_decode($_POST["table_items"], true);


  foreach ($table_items as $key => $value) {
    $mysql = "INSERT INTO tbl_bene_deduct (benefit, b_month, b_year, emp_no, name, fixed, qty, rate, total, type)
     VALUES('" . $benefit . "','" . $month . "','" . $year . "','" . $value["emp_no"] . "','" . $value["emp_name"] . "',
  '" . $value["f_amt"] . "','" . $value["qty"] . "','" . $value["rate"] . "','" . $value["earnings"] . "','" . $type . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Created Successfully..";
  echo json_encode($message);
} else {
  $message = "No fields";
  echo json_encode($message);
}

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
  $desc = sanitize_input($_POST["year"]);
  $table_items = json_decode($_POST["table_items"], true);

  foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO tbl_nhif (desc, from, to, 
  rate) VALUES('" . $desc . "','" . $value["from"] . "',
  '" . $value["to"] . "','" . $value["rate"] . "')";
    mysqli_query($conn, $mysql);
  }
  if (strcmp($checker, 'from quote') == 0) {
    $sql1 = "UPDATE tbl_quotation_items SET status = 'done' WHERE quote_no = '" . $quotation_no . "'";
    $sql = "UPDATE tbl_quotation SET status = 'done' WHERE quote_no = '" . $quotation_no . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);
  }
  $message = "Sales Order " . $quote_no . " Created Successfully..";
  echo json_encode($message);
}

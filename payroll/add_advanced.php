<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $year = sanitize_input($_POST["year"]);
  $month = sanitize_input($_POST["month"]);
  $table_items = json_decode($_POST["table_items"], true);

  foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO tbl_advance (fname, lname, amount, 
  nat, job, date_issued, year, month) VALUES('" . $value["fname"] . "','" . $value["lname"] . "','" . $value["amount"] . "','" . $value["nat"] . "','" . $value["job"] . "','" . $value["date_issued"] . "','" . $year . "','" . $month . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Created Successfully..";
  echo json_encode($message);
} else {
  echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
}

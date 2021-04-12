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
  $fname = sanitize_input($_POST["fname"]);
  $lname = sanitize_input($_POST["lname"]);
  $nat = sanitize_input($_POST["nat"]);
  $job = sanitize_input($_POST["job"]);
  $table_items = json_decode($_POST["table_items"], true);

  foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO tbl_emp_leave (fname, lname, 
  nat, job, empleave, num_days, opening_balance) VALUES('" . $fname . "','" . $lname . "','" . $nat . "','" . $job . "','" . $value["empleave"] . "','" . $value["num_days"] . "','" . $value["opening_balance"] . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Created Successfully..";
  echo json_encode($message);
} else {
  // echo "Multiquery failed: " . $mysql;
  echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
}

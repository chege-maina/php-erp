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
  $type = sanitize_input($_POST["type"]);
  $fname = sanitize_input($_POST["fname"]);
  $lname = sanitize_input($_POST["lname"]);
  $nat = sanitize_input($_POST["nat"]);
  $job = sanitize_input($_POST["job"]);
  $table_items = json_decode($_POST["table_items"], true);

  foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO tbl_emp_benefit (fname, lname, type, 
  nat, job, benefit) VALUES('" . $fname . "','" . $lname . "','" . $type . "','" . $nat . "','" . $job . "','" . $value["benefit"] . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Created Successfully..";
  echo json_encode($message);
} else {
  // echo "Multiquery failed: " . $mysql;
  echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
}

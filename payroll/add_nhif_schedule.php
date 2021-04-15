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
    echo $value["from"];
    echo $desc;
    $mysql = "INSERT INTO tbl_nhif (descnhif, fromnhif, tonhif, 
  rate) VALUES('" . $desc . "','" . $value["from"] . "',
  '" . $value["to"] . "','" . $value["rate"] . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Schedule Created Successfully..";
  echo json_encode($message);
} else {
  $message = "No fields";
  echo json_encode($message);
}
<?php
session_start();
include_once '../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$query = "SELECT * FROM `tbl_branch`;";
$result = $conn->query($query);

$data_array = array();
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $data_array[] = $row;
  }
}

echo json_encode($data_array);

$con->close();

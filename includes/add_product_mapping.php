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
  $code = sanitize_input($_POST["code"]);
  $name = sanitize_input($_POST["name"]);
  $table_items = json_decode($_POST["table_items"], true);

  foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO tbl_prdmapping (product_code, product_name, 
  group_code, ledger, status) VALUES('" . $code . "','" . $name . "','" . $value["group_code"] . "',
  '" . $value["ledger"] . "','" . $value["status"] . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Created Successfully..";
  echo json_encode($message);
} else {
  echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
}

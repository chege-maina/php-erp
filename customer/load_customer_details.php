<?php
session_start();
include_once '../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function get_customer($con, $name, $email)
{
  $to_return = "";
  $query = "SELECT * FROM tbl_customer WHERE name = ? AND email = ?;";
  $sttmt = "";
  if ($sttmt = $con->prepare($query)) {
    $sttmt->bind_param('ss', $name, $email);
    if ($sttmt->execute()) {
      // Get result
      $result = $sttmt->get_result();
      if ($result->num_rows > 0) {
        // The result's first row
        $row = $result->fetch_assoc();
        $to_return = array();
        // Return the customer
        $to_return[] = $row;
      } else {
        // Result empty
        $to_return = array(
          "message" => "error",
          "desc" => "No such record found",
        );
      }
    } else {
      $to_return = array(
        "message" => "error",
        "desc" => "Could not execute statement",
        "detail" => mysqli_error($con)
      );
    }
  } else {
    $to_return = array(
      "message" => "error",
      "desc" => "Database error. Could not prepare statement",
      "detail" => mysqli_error($con)
    );
  }
  return $to_return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 1. Get the post fields
  $name = sanitize_input($_POST["name"]);
  $email = sanitize_input($_POST["email"]);

  // Echo whatever is returned from the function
  echo json_encode(get_customer($con, $name, $email));
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}

$con->close();

<?php
session_start();
// Change this to your connection info.
include_once '../includes/dbconnect.php';
// Try and connect using the info above.
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['modal_category_name'])) {
  // Could not get the data that should have been sent.
  die('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty.
if (empty($_POST['modal_category_name'])) {
  // One or more values are empty.
  //header("location: ../Dashboard.php?empppp");
  die('Please enter values in the fields provided..');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT count(*) as total FROM tbl_department WHERE name = ?')) {
  // Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
  $stmt->bind_param('s', $_POST['modal_category_name']);
  $stmt->execute();

  $result = $stmt->get_result();
  $data = $result->fetch_assoc();
  //$admcc = $data['admno'];
  $acc = $data['total'];

  // Store the result so we can check if the account exists in the database.
  if ($acc > 0) {
    // Username already exists
    die('That Record Exists');
  } else {
    // Username doesnt exists, insert new account
    if ($stmt = $con->prepare('INSERT INTO tbl_department (name) VALUES (?)')) {
      $stmt->bind_param('s', $_POST['modal_category_name']);
      $stmt->execute();
      echo "Added Successfully";
    } else {
      // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
      echo "Could not prepare statement!";
    }
  }
  $stmt->close();
} else {
  // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
  echo "Could not prepare statement!";
}

$con->close();

<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $benefit = $_POST["benefit"];
  $type = $_POST["type"];

  $query = "SELECT * FROM tbl_emp_benefit WHERE type='$type' and benefit='$benefit'";


  $result = mysqli_query($conn, $query);
  $response = array();

  while ($row = mysqli_fetch_assoc($result)) {
    array_push(
      $response,
      array(
        'emp_no' => $row['job'],
        'emp_name' => $row['fname'] . " " . $row['lname']
      )
    );
  }

  echo json_encode($response);

  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

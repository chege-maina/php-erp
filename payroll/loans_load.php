<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nat_id = $_POST["nat_id"];

  $stat = "approved";

  $query = "SELECT * FROM tbl_staff WHERE nat_id='$nat_id'";
  $result = mysqli_query($conn, $query);
  $response = array();

  if ($row = mysqli_fetch_assoc($result)) {

    array_push(
      $response,
      array(
        'job_number' => $row['job_no'],
        'section' => $row['department'],
        'job' => $row['job_title']
      )
    );
  }
  echo json_encode($response);
  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

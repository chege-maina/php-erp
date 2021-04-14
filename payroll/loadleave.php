<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();


$query = "SELECT * FROM tbl_emp_leave  WHERE status='approved'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

  array_push(
    $response,
    array(
      'fname' => $row['fname'],
      'lname' => $row['lname'],
      'nat' => $row['nat'],
      'job' => $row['job'],
      'leave' => $row['empleave']
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

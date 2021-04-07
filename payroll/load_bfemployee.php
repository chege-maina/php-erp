<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();


$query = "SELECT * FROM tbl_staff";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

  array_push(
    $response,
    array(
      'fname' => $row['f_name'],
      'lname' => $row['l_name'],
      'nat' => $row['nat_id'],
      'job' => $row['job_no']
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();


$query = "SELECT fname, lname, nat, job FROM tbl_emp_leave  WHERE status='approved' GROUP BY job ASC";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  $emp_id = $row['job'];

  $query2 = "SELECT empleave FROM tbl_emp_leave  WHERE job = $emp_id";

  $result2 = mysqli_query($conn, $query2);
  $response2 = array();
  while ($row2 = mysqli_fetch_assoc($result2)) {
    array_push(
      $response2,
      array(
        'leave' => $row2['empleave']
      )
    );
  }

  array_push(
    $response,
    array(
      'fname' => $row['fname'],
      'lname' => $row['lname'],
      'nat' => $row['nat'],
      'job' => $row['job'],
      'leave' => $response2
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

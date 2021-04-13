<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_emp_leave";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Employee_No' => $row['job'],
      'First_Name' => $row['fname'],
      'Last_Name' => $row['lname'],
      'National_Id' => $row['nat'],
      'Leave_Type' => $row['empleave'],
      'Days' => $row['num_days'],
      'Opening_Balance' => $row['opening_balance'],
      'Status' => $row['status']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

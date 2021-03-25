<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_attendance";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Employee_Name' => $row['employee_name'],
      'Attendance Date' => $row['att_date'],
      'Employee_No' => $row['employee_no'],
      'Branch' => $row['branch'],
      'Designation' => $row['job_title'],
      'Status' => $row['status'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

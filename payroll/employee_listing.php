<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_staff";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Employee_No' => $row['job_no'],
      'Date_Employed' => $row['employ_date'],
      'First_Name' => $row['f_name'],
      'Last_Name' => $row['l_name'],
      'National_Id' => $row['nat_id'],
      'Mobile_No' => $row['mobile_no'],
      'Official_Mail' => $row['off_mail'],
      'Status' => $row['status']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

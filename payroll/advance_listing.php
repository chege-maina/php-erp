<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_advance";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'First_Name' => $row['fname'],
      'Last_Name' => $row['lname'],
      'National_ID' => $row['nat'],
      'Job_NO' => $row['job'],
      'Amount' => $row['amount'],
      'Date_Issued' => $row['date_issued'],
      'Year' => $row['year'],
      'Month' => $row['month'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

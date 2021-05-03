<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_bene_deduct";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Category' => $row['benefit'],
      'Month' => $row['b_month'],
      'Year' => $row['b_year'],
      'Employee_No' => $row['emp_no'],
      'Name' => $row['name'],
      'Fixed' => $row['fixed'],
      'Quantity' => $row['qty'],
      'Rate' => $row['rate'],
      'Total' => $row['total'],
      'Type' => $row['type'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

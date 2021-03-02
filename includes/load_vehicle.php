<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();


$query = "SELECT * FROM tbl_vehicle WHERE type = 'Truck'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

  array_push(
    $response,
    array(
      'reg_no' => $row['vehicle_no']
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

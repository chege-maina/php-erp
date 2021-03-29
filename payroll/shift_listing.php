<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_shift";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Shift' => $row['shift_name'],
      'Start' => $row['start_time'],
      'End' => $row['end_time'],
      'Working_Hours' => $row['work_hours'],
      'Non_Working_Hours' => $row['non_work'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

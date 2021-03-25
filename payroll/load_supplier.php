<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_staff WHERE status='approved'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'national_id' => $row['nat_id'],
      'lname' => $row['l_name'],
      'fname' => $row['f_name'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

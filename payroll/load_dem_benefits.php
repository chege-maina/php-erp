<?php
include_once '../includes/dbconnect.php';
session_start();
$response3 = array();

$query = "SELECT benefit FROM tbl_benefit";

$result = mysqli_query($conn, $query);
$response = array();
$type = "benefit";

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'benefit' => $row['benefit'],
      'type' => $type
    )
  );
}
$query = "SELECT deduction FROM tbl_deduction";

$result = mysqli_query($conn, $query);
$type = "deduction";

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'benefit' => $row['deduction'],
      'type' => $type
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

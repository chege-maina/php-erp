<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT deduction FROM tbl_deduction";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'branch' => $row['deduction'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

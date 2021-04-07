<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT benefit FROM tbl_benefit";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'branch' => $row['benefit'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

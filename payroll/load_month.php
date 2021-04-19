<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT b_month FROM tbl_bene_deduct GROUP BY b_month";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'month' => $row['b_month'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT b_year FROM tbl_bene_deduct GROUP BY b_year";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'year' => $row['b_year'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

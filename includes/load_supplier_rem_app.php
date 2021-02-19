<?php
include_once '../includes/dbconnect.php';
session_start();

$stat = "pending";

$query = "SELECT supplier_name FROM tbl_remittance WHERE status='$stat' GROUP BY supplier_name ASC";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'supplier_name' => $row['supplier_name']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

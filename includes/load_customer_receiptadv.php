<?php
include_once '../includes/dbconnect.php';
session_start();

$stat = "pending";

$query = "SELECT customer_name FROM tbl_invoice WHERE status='$stat' GROUP BY customer_name ASC";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(

      'supplier_name' => $row['customer_name']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_supplier";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Supplier_Code' => $row['supplier_id'],
      'Name' => $row['name'],
      'Email' => $row['email'],
      'Tel' => $row['tel_no'],
      'Address' => $row['postal_address'],
      'Status' => $row['status']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

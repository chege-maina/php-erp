<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_branch";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Branch' => $row['branch_name'],
      'Email' => $row['email'],
      'Telephone_NO' => $row['tel_no'],
      'Postal_Address' => $row['postal_address'],
      'Physical_Address' => $row['physical_address'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

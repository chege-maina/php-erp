<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();


$query = "SELECT * FROM tbl_product";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

  array_push(
    $response,
    array(
      'code' => $row['product_code'],
      'name' => $row['product_name'],
      'unit' => $row['product_unit'],
      'tax' => $row['apllicable_tax'],
      'price' => $row['dsp_price']
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

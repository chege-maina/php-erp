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
      'atomic_unit' => $row['atomic_unit'],
      'tax' => $row['applicable_tax'],
      'bs_price' => $row['bs_price'],
      'conversion' => $row['conversion'],
      'unit' => $row['product_unit'],
      'price' => $row['dsp_price']
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

$query = "SELECT * FROM tbl_voucher";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Voucher_No' => $row['voucher_no'],
      'Voucher_Type' => $row['voucher_type'],
      'Date' => $row['date'],
      'Credit' => $row['credit'],
      'Debit' => $row['debit'],
      'Status' => $row['status']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);

<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$deni = 0;
$date_chk = date("Y-m-d");
$query = "SELECT * FROM tbl_customer";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  $cust_name = $row['name'];
  $terms = $row['payment_terms'];
  $limit = $row['credit_limit'];


  $query2 = "SELECT sum(amount_due) FROM tbl_receiptadv_items WHERE customer_name='$cust_name' and (status='pending' or status='approved')";
  $result2 = mysqli_query($conn, $query2);
  if ($row2 = mysqli_fetch_assoc($result2)) {
    $deni = $row2['sum(amount_due)'];
  }
  $balance = $limit - $deni;
  if ($balance == 0 || $balance < 0) {
    $status = "Limit Reached";
  } else {

    $query3 = "SELECT due_date FROM tbl_receiptadv_items WHERE customer_name='$cust_name' and due_date<'$date_chk' and (status='pending' or status='approved')";
    $result3 = mysqli_query($conn, $query3);
    if ($row3 = mysqli_fetch_assoc($result3)) {
      $status = "Invoice Due";
    } else {
      $status = "Credit Okay";
    }
  }

  array_push(
    $response,
    array(
      'name' => $cust_name,
      'limit' => $limit,
      'terms' => $terms,
      'balance' => $balance,
      'status' => $status
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

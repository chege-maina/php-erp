<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $voucher_no = $_POST["voucher_no"];

  $query = "SELECT * FROM tbl_voucher WHERE voucher_no ='$voucher_no'";

  $result = mysqli_query($conn, $query);
  $response = array();

  if ($row = mysqli_fetch_assoc($result)) {

    $query2 = "SELECT * FROM tbl_voucher_items WHERE voucher_no ='$voucher_no'";

    $result2 = mysqli_query($conn, $query2);
    $response2 = array();

    while ($row2 = mysqli_fetch_assoc($result2)) {
      array_push(
        $response2,
        array(
          'group_code' => $row['group_code'],
          'ledger' => $row['ledger'],
          'amount' => $row['amount'],
          'type' => $row['type']
        )
      );
    }


    array_push(
      $response,
      array(
        'voucher_no' => $voucher_no,
        'voucher_type' => $row['voucher_type'],
        'date' => $row['date'],
        'total_debit' => $row['debit'],
        'total_credit' => $row['credit'],
        'remarks' => $row['remarks'],
        'status' => $row['status'],
        'table_items' => $response2
      )
    );
  }

  echo json_encode($response);

  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

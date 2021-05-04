<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();
$start_date = "2021-04-30"; //$_POST["date1"];
$end_date = "2021-05-30"; //$_POST["date2"];

$opening_bal = 0;
$opening_credit = 0;
$opening_debit = 0;
$credit_now = 0;
$debit_now = 0;

$query = "SELECT * FROM tbl_ledger_amounts WHERE date>='$start_date' and date<= '$end_date' GROUP BY ledger";
$result = mysqli_query($conn, $query);
$response = array();
while ($row = mysqli_fetch_assoc($result)) {
  $ledger_name = $row['ledger'];
  $group_id = $row['group_code'];

  $sum_credit_query = "SELECT sum(amount) FROM tbl_ledger_amounts WHERE date<'$start_date' and status='Credit' and ledger='$ledger_name'";
  $result_opening = mysqli_query($conn, $sum_credit_query);
  if ($row_opening = mysqli_fetch_assoc($result_opening)) {
    $opening_credit = $row_opening['sum(amount)'];
  }

  $sum_debit_query = "SELECT sum(amount) FROM tbl_ledger_amounts WHERE date<'$start_date' and status='Debit' and ledger='$ledger_name'";
  $result_opening = mysqli_query($conn, $sum_debit_query);
  if ($row_opening = mysqli_fetch_assoc($result_opening)) {
    $opening_debit = $row_opening['sum(amount)'];
  }

  $opening_bal = $opening_debit - $opening_credit;

  $sum_credit_query = "SELECT sum(amount) FROM tbl_ledger_amounts WHERE date>='$start_date' and date<= '$end_date' and status='Credit' and ledger='$ledger_name'";
  $result_opening = mysqli_query($conn, $sum_credit_query);
  if ($row_opening = mysqli_fetch_assoc($result_opening)) {
    $credit_now = $row_opening['sum(amount)'];
  }
  $sum_debit_query = "SELECT sum(amount) FROM tbl_ledger_amounts WHERE date>='$start_date' and date<= '$end_date' and status='Debit' and ledger='$ledger_name'";
  $result_opening = mysqli_query($conn, $sum_debit_query);
  if ($row_opening = mysqli_fetch_assoc($result_opening)) {
    $debit_now = $row_opening['sum(amount)'];
  }

  if (is_null($opening_bal)) {
    $opening_bal = 0;
  }
  if (is_null($opening_credit)) {
    $opening_credit = 0;
  }
  if (is_null($opening_debit)) {
    $opening_debit = 0;
  }
  if (is_null($credit_now)) {
    $credit_now = 0;
  }
  if (is_null($debit_now)) {
    $debit_now = 0;
  }
  $closing_bal = $opening_bal + $debit_now - $credit_now;



  array_push(
    $response,
    array(
      'group_id' => $group_id,
      'ledger' => $ledger_name,
      'opening_bal' => $opening_bal,
      'debit' => $debit_now,
      'credit' => $credit_now,
      'closing_bal' => $closing_bal
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

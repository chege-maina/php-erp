<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $code = $_POST["code"];

  // $stat = "pending";

  // $query = "SELECT * FROM tbl_product WHERE product_code='$code' and status='$stat'";
  $query = "SELECT * FROM tbl_product WHERE product_code='$code'";
  $result = mysqli_query($conn, $query);
  $response = array();

  if ($row = mysqli_fetch_assoc($result)) {


    array_push(
      $response,
      array(
        'code' => $code,
        'name' => $row['product_name'],
        'group' => $row['product_category'],
        'sub_group' => $row['sub_category'],
        'weight' => $row['weight'],
        'purchase_unit' => $row['product_unit'],
        'conversion' => $row['conversion'],
        'selling_unit' => $row['atomic_unit'],
        'tax' => $row['applicable_tax'],
        'bf_tax' => $row['amount_before_tax'],
        'default_sp' => $row['dsp_price'],
        'default_sp_bulk' => $row['bs_price'],
        'inc_tax' => $row['dpp_inc_tax'],
        'margin' => $row['profit_margin']
      )
    );
  }
  echo json_encode($response);
  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

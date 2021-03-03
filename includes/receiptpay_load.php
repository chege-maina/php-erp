<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rem_no = $_POST["rem_no"];

  $stat = "approved";

  $query = "SELECT * FROM tbl_receiptadv WHERE rem_no='$rem_no'";
  $result = mysqli_query($conn, $query);
  $response = array();

  if ($row = mysqli_fetch_assoc($result)) {

    array_push(
      $response,
      array(
        'name' => $row['customer-name'],
        'amount' => $row['payable']
      )
    );
  }
  echo json_encode($response);
  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

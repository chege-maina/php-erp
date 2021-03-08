<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();
$start_date = $_POST["date1"];
$end_date = $_POST["date2"];
$status = $_POST["status"];
$date_chk = date("Y-m-d");

$query = "SELECT * FROM tbl_sale WHERE status='$status' and date>='$start_date' and date<= '$end_date'";


$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'req_no' => $row['quote_no'],
      'customer' => $row['customer_name'],
      'date' => $row['date'],
      'branch' => $row['branch_location'],
      'user' => $row['user'],
      'status' => $row['status']
    )
  );
}

echo json_encode($response);

mysqli_close($conn);

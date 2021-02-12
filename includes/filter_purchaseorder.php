<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $start_date = $_POST["date1"];
  $end_date = $_POST["date2"];
  $status = $_POST["status"];


  $query = "SELECT * FROM tbl_purchaseorder WHERE status='$status' and date>='$start_date' and date<= '$end_date'";

  $result = mysqli_query($conn, $query);
  $response = array();

  while ($row = mysqli_fetch_assoc($result)) {
    array_push(
      $response,
      array(
        'po_number' => $row['po_number'],
        'supplier' => $row['supplier_name'],
        'date' => $row['date'],
        'user' => $row['user'],
        'branch' => $row['branch'],
        'status' => $row['status']
      )
    );
  }

  echo json_encode($response);

  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

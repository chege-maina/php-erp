<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $req_no = $_POST["req_no"];


  $query = "SELECT * FROM tbl_quotation WHERE quote_no ='$req_no'";
  $query2 = "SELECT sum(tax), sum(amount) FROM tbl_quotation_items WHERE quote_no ='$req_no'";
  $result = mysqli_query($conn, $query);
  $response = array();

  $result2 = mysqli_query($conn, $query2);
  $row2 = mysqli_fetch_assoc($result2);

  $total = $row2['sum(amount)'];
  $tax = $row2['sum(tax)'];
  $sub_total = $total - $tax;


  while ($row = mysqli_fetch_assoc($result)) {
    array_push(
      $response,
      array(
        'req_no' => $row['quote_no'],
        'date' => $row['date'],
        'branch' => $row['due_date'],
        'user' => $row['user'],
        'customer' => $row['customer_name'],
        'terms' => $row['terms'],
        'tax' => $tax,
        'sub_total' => $sub_total,
        'amount' => $total,
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

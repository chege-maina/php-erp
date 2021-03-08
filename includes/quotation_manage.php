<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $req_no = $_POST["req_no"];


  $query = "SELECT * FROM tbl_quotation WHERE quote_no ='$req_no'";
  $query2 = "SELECT sum(tax), sum(amount) FROM tbl_quotation_items WHERE quote_no ='$req_no'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $response = array();

  $result2 = mysqli_query($conn, $query2);
  $row2 = mysqli_fetch_assoc($result2);

  $customer = $row['customer_name'];

  $deni = 0;
  $date_chk = date("Y-m-d");
  $query3 = "SELECT * FROM tbl_customer WHERE name='$customer'";

  $result3 = mysqli_query($conn, $query3);
  //echo $customer;
  while ($row3 = mysqli_fetch_assoc($result3)) {
    $cust_name = $row3['name'];
    $terms = $row3['payment_terms'];
    $limit = $row3['credit_limit'];
    //echo $limit;

    $query4 = "SELECT sum(amount_due) FROM tbl_receiptadv_items WHERE customer_name='$cust_name' and (status='pending' or status='approved')";
    $result4 = mysqli_query($conn, $query4);
    if ($row4 = mysqli_fetch_assoc($result4)) {
      $deni = $row4['sum(amount_due)'];
    }
    $balance = $limit - $deni;
    //echo $balance;
    if ($balance == 0 || $balance < 0) {
      $statusqq = "Limit Reached";
    } else {

      $query5 = "SELECT due_date FROM tbl_receiptadv_items WHERE customer_name='$cust_name' and due_date<'$date_chk' and (status='pending' or status='approved')";
      $result5 = mysqli_query($conn, $query5);
      if ($row5 = mysqli_fetch_assoc($result5)) {
        $statusqq = "Invoice Due";
      } else {
        $statusqq = "Credit Okay";
      }
    }
    //echo $statusqq;
  }

  $total = $row2['sum(amount)'];
  $tax = $row2['sum(tax)'];
  $sub_total = $total - $tax;

  array_push(
    $response,
    array(
      'req_no' => $row['quote_no'],
      'date' => $row['date'],
      'branch' => $row['due_date'],
      'user' => $row['user'],
      'customer' => $customer,
      'terms' => $row['terms'],
      'tax' => $tax,
      'sub_total' => $sub_total,
      'amount' => $total,
      'status' => $row['status'],
      'credit_status' => $statusqq
    )
  );


  echo json_encode($response);

  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}

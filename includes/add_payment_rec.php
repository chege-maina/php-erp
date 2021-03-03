<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rem_no = $_POST["rem_no"];
  $supplier = $_POST["supplier"];
  $amount = $_POST["amount"];
  $cheque_no = $_POST["cheque_no"];
  $bank = $_POST["bank"];
  $cheque_type = $_POST["cheque_type"];
  $date = $_POST["date"];
  $pay_type = "receipt";


  $mysql = "INSERT INTO tbl_paybill (rem_no, cheque_no, amount, supplier_name, bank_name, date, cheque_type, pay_type) 
            VALUES('" . $rem_no . "','" . $cheque_no . "','" . $amount . "','" . $supplier . "', '" . $bank . "','" . $date . "','" . $cheque_type . "', '" . $pay_type . "')";
  mysqli_query($conn, $mysql);

  $sql = "UPDATE tbl_receiptadv_items SET status = 'done' WHERE rem_no='$rem_no'";
  $sql2 = "UPDATE tbl_receiptadv SET status = 'done' WHERE rem_no='$rem_no'";
  mysqli_query($conn, $sql);
  mysqli_query($conn, $sql2);

  $message = "Payment No." . $rem_no . " Posted Successfully..";
  echo json_encode($message);
}

mysqli_close($conn);

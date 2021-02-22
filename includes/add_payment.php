<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rem_no = $_POST["rem_no"];
  $supplier = $_POST["supplier"];
  $amount = $_POST["amount"];
  $cheque_no = $_POST["cheque_no"];
  $bank = $_POST["bank"];


  $mysql = "INSERT INTO tbl_paybill (rem_no, cheque_no, amount, supplier_name, bank_name) 
            VALUES('" . $rem_no . "','" . $cheque_no . "','" . $amount . "','" . $supplier . "', '" . $bank . "')";
  mysqli_query($conn, $mysql);

  $sql = "UPDATE tbl_remittance_items SET status = 'done' WHERE rem_no='$rem_no'";
  $sql2 = "UPDATE tbl_remittance SET status = 'done' WHERE rem_no='$rem_no'";
  mysqli_query($conn, $sql);
  mysqli_query($conn, $sql2);

  $message = "Payment No." . $rem_no . " Posted Successfully..";
  echo json_encode($message);
}

mysqli_close($conn);

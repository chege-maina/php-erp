
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
  $pay_type = "pay";


  $mysql = "INSERT INTO tbl_paybill (rem_no, cheque_no, amount, supplier_name, bank_name, date, cheque_type, pay_type) 
            VALUES('" . $rem_no . "','" . $cheque_no . "','" . $amount . "','" . $supplier . "', '" . $bank . "','" . $date . "','" . $cheque_type . "', '" . $pay_type . "')";
  mysqli_query($conn, $mysql);

  $mysql1 = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date, status) 
                VALUES('020101', '" . $supplier . "', '" . $amount . "', '" . $date . "', 'Debit')";
  if (mysqli_query($conn, $mysql1)) {
    $mysql2 = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date, status) 
                VALUES('010107', '" . $bank . "', '" . $amount . "', '" . $date . "', 'Credit')";
    mysqli_query($conn, $mysql2);
  }

  $sql = "UPDATE tbl_remittance_items SET status = 'done' WHERE rem_no='$rem_no'";
  $sql2 = "UPDATE tbl_remittance SET status = 'done' WHERE rem_no='$rem_no'";
  mysqli_query($conn, $sql);
  mysqli_query($conn, $sql2);

  $message = "Payment No." . $rem_no . " Posted Successfully..";
  echo json_encode($message);
}

mysqli_close($conn);

<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
session_start();
//mysqli_report(MYSQLI_REPORT_ALL);

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $date = sanitize_input($_POST["date"]);
  $type = sanitize_input($_POST["type"]);
  $remarks = sanitize_input($_POST["remarks"]);
  $debit = sanitize_input($_POST["debit"]);
  $credit = sanitize_input($_POST["credit"]);
  $branch = sanitize_input($_POST["branch"]);
  $table_items = json_decode($_POST["table_items"], true);


  if (strcmp($type, 'Journal') == 0) {
    $prefix = "JV-";
  } elseif (strcmp($type, 'Contra') == 0) {
    $prefix = "CV-";
  } elseif (strcmp($type, 'Credit') == 0) {
    $prefix = "CN-";
  } else {
    $prefix = "DN-";
  }
  $query = "SELECT count(voucher_no) FROM tbl_voucher WHERE voucher_type='$type'";

  $result = mysqli_query($conn, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $code2 = $row['count(voucher_no)'] + 1;
    if ($code2 < 10) {
      $code2 = "00" . $code2;
    } else if ($code2 < 100) {
      $code2 = "0" . $code2;
    }
  }
  $voucher_no = $prefix . $code2;


  $mysql = "INSERT INTO tbl_voucher (voucher_no, voucher_type, debit, credit, remarks, branch, date) VALUES ('" . $voucher_no . "', 
  '" . $type . "', '" . $debit . "', '" . $credit . "', '" . $remarks . "', '" . $branch . "', '" . $date . "');";
  $mysql .= "SELECT voucher_no FROM tbl_voucher ORDER BY id DESC LIMIT 1";

  if (mysqli_multi_query($conn, $mysql)) {
    do {
      /* store first result set */
      if ($result = mysqli_store_result($conn)) {
        while ($row = mysqli_fetch_row($result)) {
          $quote_no = $row[0];
        }
        mysqli_free_result($result);
      }
      /* print divider */
      if (mysqli_more_results($conn)) {
        // echo "-----------------\n";
      }
    } while (mysqli_next_result($conn));

    foreach ($table_items as $key => $value) {

      $mysql = "INSERT INTO tbl_voucher_items (date, voucher_no, ledger, amount, 
  type, group_code) VALUES('" . $date . "','" . $quote_no . "','" . $value["ledger"] . "',
  '" . $value["kes"] . "','" . $value["credit"] . "','" . $value["code"] . "')";
      mysqli_query($conn, $mysql);
      $mysql2 = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date, status) 
                VALUES('" . $value["code"] . "', '" . $value["ledger"] . "', '" . $value["kes"] . "', '" . $date . "', '" . $value["credit"] . "')";
      mysqli_query($conn, $mysql2);

      $message = "Voucher " . $quote_no . " Created Successfully..";
      echo json_encode($message);
    }
  } else {
    // echo "Multiquery failed: " . $mysql;
    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
  }
}

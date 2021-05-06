<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
session_start();

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = date("Y-m-d");
  $customer = "walk-in-customer";
  $sub_total = sanitize_input($_POST["pretax_total"]);
  $tax = sanitize_input($_POST["tax_total"]);
  $user = sanitize_input($_POST["user_name"]);
  $amount = sanitize_input($_POST["grand_total"]);
  $branch = sanitize_input($_POST["user_branch"]);
  $cash = sanitize_input($_POST["cash_paid"]);
  $mpesa = sanitize_input($_POST["mpesa_paid"]);
  $visa = sanitize_input($_POST["visa_paid"]);
  $change = sanitize_input($_POST["balance_amount"]);
  $table_items = json_decode($_POST["table_items"], true);

  $mysql = "INSERT INTO tbl_pos (date, customer, total, tax, cash, visa, mpesa,
 sub_total, branch, user, change_bal) VALUES ('" . $date . "', 
  '" . $customer . "', '" . $amount . "', '" . $tax . "','" . $cash . "','" . $visa . "', '" . $mpesa . "',
   '" . $sub_total . "','" . $branch . "','" . $user . "', '" . $change . "');";
  $mysql .= "SELECT receipt_no FROM tbl_pos ORDER BY receipt_no DESC LIMIT 1";

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
        //
      }
    } while (mysqli_next_result($conn));

    foreach ($table_items as $key => $value) {

      $mysql = "INSERT INTO tbl_pos_items (
        quote_no, 
        product_code, 
        product_name, 
  unit, 
  qty, 
  price, 
  amount, 
  tax, 
  tax_pc, 
  branch_location, 
  conversion, 
  atm_unit, 
  atm_price, 
  selected_unit, 
  entered_price) VALUES('" . $quote_no . "','" . $value["p_code"] . "',
  '" . $value["p_name"] . "','" . $value["p_units"] . "', '" . $value["p_quantity"] . "',
  '" . $value["p_price"] . "','" . $value["p_amount"] . "','" . $value["p_tax"] . "','" . $value["p_tax_pc"] . "','" . $branch . "','" . $value["p_conversion"] . "','" . $value["p_atomic_unit"] . "','" . $value["p_atomic_price"] . "','" . $value["p_selected_unit"] . "','" . $value["p_entered_price"] . "')";

      mysqli_query($conn, $mysql) or die(mysqli_error($conn));
    }

    $message = "Sales " . $quote_no . " Created Successfully..";
    echo json_encode($message);
  } else {

    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
  }
}

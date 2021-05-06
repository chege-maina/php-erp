<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
session_start();
$branch = $_SESSION['branch'];


function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = sanitize_input($_POST["date"]);
  $customer = sanitize_input($_POST["customer"]);
  $sub_total = sanitize_input($_POST["sub_total"]);
  $tax = sanitize_input($_POST["tax"]);
  $terms = sanitize_input($_POST["terms"]);
  $user = sanitize_input($_POST["user"]);
  $amount = sanitize_input($_POST["amount"]);
  $checker = sanitize_input($_POST["checker"]);
  $quotation_no = sanitize_input($_POST["quotation_no"]);
  $table_items = json_decode($_POST["table_items"], true);

  $mysql = "INSERT INTO tbl_sale (date, customer_name, terms, branch_location, 
  user, sub_total, tax, amount) VALUES ('" . $date . "', 
  '" . $customer . "', '" . $terms . "', '" . $branch . "','" . $user . "','" . $sub_total . "', '" . $tax . "', '" . $amount . "');";
  $mysql .= "SELECT quote_no FROM tbl_sale ORDER BY quote_no DESC LIMIT 1";

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

      $mysql = "INSERT INTO tbl_sale_items (
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
    if (strcmp($checker, 'from quote') == 0) {
      $sql1 = "UPDATE tbl_quotation_items SET status = 'done' WHERE quote_no = '" . $quotation_no . "'";
      $sql = "UPDATE tbl_quotation SET status = 'done' WHERE quote_no = '" . $quotation_no . "'";
      mysqli_query($conn, $sql);
      mysqli_query($conn, $sql1);
    }
    $message = "Sales Order " . $quote_no . " Created Successfully..";
    echo json_encode($message);
  } else {

    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
  }
}

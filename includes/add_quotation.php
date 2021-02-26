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
  $time = sanitize_input($_POST["time"]);
  $customer = sanitize_input($_POST["customer"]);
  $sub_total = sanitize_input($_POST["sub_total"]);
  $due_date = sanitize_input($_POST["due_date"]);
  $tax = sanitize_input($_POST["tax"]);
  $terms = sanitize_input($_POST["terms"]);
  $user = sanitize_input($_POST["user"]);
  $amount = sanitize_input($_POST["amount"]);
  $table_items = json_decode($_POST["table_items"], true);

  $mysql = "INSERT INTO tbl_quotation (date, customer_name, terms, due_date, time, 
  user, sub_total, tax, amount, branch_location) VALUES ('" . $date . "', 
  '" . $customer . "', '" . $terms . "', '" . $due_date . "', '" . $time . "', '" . $user . "',
  '" . $sub_total . "', '" . $tax . "', '" . $amount . "', '" . $branch . "');";
  $mysql .= "SELECT quote_no FROM tbl_quotation ORDER BY quote_no DESC LIMIT 1";

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

      $mysql = "INSERT INTO tbl_quotation_items (quote_no, product_code, product_name, 
  unit, qty, price, amount, tax, tax_pc, branch_location) VALUES('" . $quote_no . "','" . $value["p_code"] . "',
  '" . $value["p_name"] . "','" . $value["p_units"] . "', '" . $value["p_quantity"] . "',
  '" . $value["p_price"] . "','" . $value["p_amount"] . "','" . $value["p_tax"] . "','" . $value["p_tax_pc"] . "','" . $branch . "')";
      mysqli_query($conn, $mysql);

      $message = "Quotation " . $quote_no . " Created Successfully..";
      echo json_encode($message);
    }
  } else {
    // echo "Multiquery failed: " . $mysql;
    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
  }
}

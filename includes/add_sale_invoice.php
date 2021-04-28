<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}
session_start();
$user = $_SESSION['name'];


function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sale_order = sanitize_input($_POST["sale_order"]);
  $customer = sanitize_input($_POST["customer"]);
  $date = sanitize_input($_POST["date"]);
  $due_date = sanitize_input($_POST["due_date"]);
  $sub_total = sanitize_input($_POST["sub_total"]);
  $tax = sanitize_input($_POST["tax"]);
  $terms = sanitize_input($_POST["terms"]);
  $amount = sanitize_input($_POST["amount"]);
  $branch = sanitize_input($_POST["branch"]);
  $transport = sanitize_input($_POST["transport"]);
  $vehicle = sanitize_input($_POST["vehicle"]);
  $driver = sanitize_input($_POST["driver"]);
  $table_items = json_decode($_POST["table_items"], true);

  $mysql = "INSERT INTO tbl_invoice (so_number, customer_name, payment_terms, date, 
  due_date, branch, total_bf_tax, tax, transport_cost, total, driver_name, truck_no, user) 
  VALUES ('" . $sale_order . "', 
  '" . $customer . "', '" . $terms . "', '" . $date . "','" . $due_date . "','" . $branch . "', '" . $sub_total . "', '" . $tax . "', '" . $transport . "', '" . $amount . "', '" . $driver . "','" . $vehicle . "','" . $user . "');";
  $mysql .= "SELECT salesbill_no FROM tbl_invoice ORDER BY salesbill_no DESC LIMIT 1";

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
        echo "-----------------\n";
      }
    } while (mysqli_next_result($conn));

    foreach ($table_items as $key => $value) {

      $mysql2 = "SELECT * FROM tbl_prdmapping WHERE product_code='" . $value["p_code"] . "' AND group_code='040101'";
      $result4 = mysqli_query($conn, $mysql2);
      if ($row4 = mysqli_fetch_assoc($result4)) {
        $group_code = $row4['group_code'];
        $ledger = $row4['ledger'];
        $le_date = $date;
        $total_now = $value["p_amount"];
        $mysql = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date, status) 
                VALUES('" . $group_code . "', '" . $ledger . "', '" . $total_now . "', '" . $le_date . "', 'Credit')";
        mysqli_query($conn, $mysql);
      }

      $mysql = "INSERT INTO tbl_invoice_items (salesbill_no, so_number, product_code, product_name, 
  unit, qty, price, total, user, tax, tax_pc, branch) VALUES('" . $quote_no . "', '" . $sale_order . "','" . $value["p_code"] . "',
  '" . $value["p_name"] . "','" . $value["p_units"] . "', '" . $value["p_quantity"] . "',
  '" . $value["p_price"] . "','" . $value["p_amount"] . "','" . $user . "','" . $value["p_tax"] . "','" . $value["p_tax_pc"] . "','" . $branch . "')";
      mysqli_query($conn, $mysql);
    }
    $mysql = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date, status) 
                VALUES('010201', '" . $customer . "', '" . $amount . "', '" . $date . "', 'Debit')";
    mysqli_query($conn, $mysql);
    $mysql = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date, status) 
                VALUES('020203', 'Vat Input Tax', '" . $tax . "', '" . $date . "', 'Credit')";
    mysqli_query($conn, $mysql);
    $sql1 = "UPDATE tbl_sale_items SET status = 'done' WHERE quote_no = '" . $sale_order . "'";
    $sql = "UPDATE tbl_sale SET status = 'done' WHERE quote_no = '" . $sale_order . "'";
    mysqli_query($conn, $sql);
    mysqli_query($conn, $sql1);

    $message = "Sales Invoice " . $quote_no . " Created Successfully..";
    echo json_encode($message);
  } else {
    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
  }
}

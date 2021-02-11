<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $supplier_name = $_POST["supplier_name"];
  $branch = $_POST["branch"];
  $date = $_POST["date"];
  $time = $_POST["time"];
  $user = $_POST["user"];
  $before_tax = $_POST["before_tax"];
  $tax_amount = $_POST["tax_amount"];
  $po_total = $_POST["po_total"];
  $table_items = json_decode($_POST["table_items"], true);

  $mysql = "INSERT INTO tbl_purchaseorder (supplier_name, branch, date, time, user, 
  before_tax, tax_amt, po_total) VALUES ('" . $supplier_name . "', 
  '" . $branch . "', '" . $date . "', '" . $time . "', '" . $user . "', '" . $before_tax . "', '" . $tax_amount . "', '" . $po_total . "');";
  $mysql .= "SELECT po_number FROM tbl_purchaseorder ORDER BY po_number DESC LIMIT 1";

  if (mysqli_multi_query($conn, $mysql)) {
    do {
      /* store first result set */
      if ($result = mysqli_store_result($conn)) {
        while ($row = mysqli_fetch_row($result)) {
          $po_number = $row[0];
        }
        mysqli_free_result($result);
      }
      /* print divider */
      if (mysqli_more_results($conn)) {
        // echo "-----------------\n";
      }
    } while (mysqli_next_result($conn));
    foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO tbl_purchaseorder_items (po_number, product_code, product_name, product_unit, product_quantity, branch, product_cost, total)
      VALUES('" . $po_number . "','" . $value["code"] . "','" . $value["name"] . "','" . $value["unit"] . "',
      '" . $value["quantity"] . "', '" . $branch . "','" . $value["cost"] . "' ,'" . $value["total"] . "')";
        mysqli_query($conn, $mysql);
    
        $sql = "UPDATE tbl_requisition_items SET status = 'done' WHERE status = 'approved' and branch= '$branch' and product_name='" . $value["name"] . "'";
        mysqli_query($conn, $sql);
    }
    
    
     $message ="Requisition Number ".$requisition_number." Created Successfully..";
      echo json_encode($message);
  } else {
    echo "Multiquery failed";
  }

  
}
  
  mysqli_close($conn);
  ?>
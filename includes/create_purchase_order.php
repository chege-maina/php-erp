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
  '" . $branch . "', '" . $date . "', '" . $time . "', '" . $user . "', " . $before_tax . ", " . $tax_amount . ", " . $po_total . ");";
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
      VALUES('" . $po_number . "','" . $value["p_code"] . "','" . $value["p_name"] . "','" . $value["p_units"] . "',
      '" . $value["p_quantity"] . "', '" . $branch . "','" . $value["p_cost"] . "' ,'" . $value["p_total"] . "')";
      mysqli_query($conn, $mysql);

      $sql = "UPDATE tbl_requisition_items SET status = 'done' WHERE status = 'approved' and branch= '$branch' and product_name='" . $value["p_name"] . "'";
      mysqli_query($conn, $sql);
    }

    $sql = "SELECT * from tbl_requisition WHERE status= 'approved' and branch='$branch'";
    $result = mysqli_query($conn, $sql);	
	while($row = mysqli_fetch_assoc($result)){
        $req_no = $row['requisition_No'];

        $sql2 = "SELECT count(*) from tbl_requisition_items WHERE requisition_No='$req_no' and status='done'"; 
        $sql1 = "SELECT count(*) from tbl_requisition_items WHERE requisition_No='$req_no'";
        
        $result1 = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);

        $row1 = mysqli_fetch_assoc($result1);
        $row2 = mysqli_fetch_assoc($result2);

        $all = $row1['count(*)'];
        $done = $row2['count(*)'];

        $bal = $all - $done;

        if($bal<1){
            $sql = "UPDATE tbl_requisition SET status = 'done' WHERE requisition_No = '$req_no'";
      mysqli_query($conn, $sql);

        }

    }


    $message = "Purchase Order number " . $po_number . " Created Successfully..";
    echo json_encode($message);
  } else {
    // echo "Multiquery failed: " . $mysql;
    echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
  }
}

mysqli_close($conn);

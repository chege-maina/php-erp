<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supplier_name = $_POST["supplier_name"];
    $branch = $_POST["branch"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $user = $_POST["user"];
    $invoice = $_POST["invoice"];
    $po_number = $_POST["po_number"];
    $table_items = json_decode($_POST["table_items"], true);

    $mysql = "INSERT INTO tbl_store (supplier_name, branch, date, time, user, 
  invoice_no, lpo_number) VALUES ('" . $supplier_name . "', 
  '" . $branch . "', '" . $date . "', '" . $time . "', '" . $user . "', '" . $invoice . "', " . $po_number . ");";
    $mysql .= "SELECT receipt_no FROM tbl_store ORDER BY receipt_no DESC LIMIT 1";

    if (mysqli_multi_query($conn, $mysql)) {
        do {
            /* store first result set */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result)) {
                    $rec_no = $row[0];
                }
                mysqli_free_result($result);
            }
            /* print divider */
            if (mysqli_more_results($conn)) {
                // echo "-----------------\n";
            }
        } while (mysqli_next_result($conn));
        foreach ($table_items as $key => $value) {

            $mysql = "INSERT INTO tbl_store_item (receipt_no, lpo_number, product_code, product_name, product_unit, qty, branch)
      VALUES('" . $rec_no . "','" . $po_number . "','" . $value["p_code"] . "','" . $value["p_name"] . "','" . $value["p_units"] . "',
      '" . $value["p_quantity_received"] . "', '" . $branch . "')";
            mysqli_query($conn, $mysql);


            if ($value["p_quantity_received"] == $value["p_quantity"]) {
                $sql = "UPDATE tbl_purchaseorder_items SET status = 'done' WHERE po_number = '$po_number' and product_name='" . $value["p_name"] . "'";
                mysqli_query($conn, $sql);
            } else {
                $sql = "UPDATE tbl_purchaseorder_items SET status = 'partial' WHERE po_number = '$po_number' and product_name='" . $value["p_name"] . "'";
                mysqli_query($conn, $sql);
                $sql = "UPDATE tbl_purchaseorder SET status = 'partial' WHERE po_number = '$po_number'";
                mysqli_query($conn, $sql);
            }
        }

        $sql = "SELECT * from tbl_purchaseorder WHERE (status= 'approved' or status='partial') and branch='$branch'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $req_no = $row['po_number'];

            $sql2 = "SELECT count(*) from tbl_purchaseorder_items WHERE po_number='$req_no' and status='done'";
            $sql1 = "SELECT count(*) from tbl_purchaseorder_items WHERE po_number='$req_no'";

            $result1 = mysqli_query($conn, $sql1);
            $result2 = mysqli_query($conn, $sql2);

            $row1 = mysqli_fetch_assoc($result1);
            $row2 = mysqli_fetch_assoc($result2);

            $all = $row1['count(*)'];
            $done = $row2['count(*)'];

            $bal = $all - $done;

            if ($bal < 1) {
                $sql = "UPDATE tbl_purchaseorder SET status = 'done' WHERE po_number = '$req_no'";
                mysqli_query($conn, $sql);
            }
        }


        $message = "Goods Receipt Note " . $po_number . " Created Successfully..";
        echo json_encode($message);
    } else {
        // echo "Multiquery failed: " . $mysql;
        echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
    }
}

mysqli_close($conn);

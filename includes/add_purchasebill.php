<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $po_number = $_POST["po_number"];
    $supplier = $_POST["supplier"];
    $terms = $_POST["terms"];
    $del_no = $_POST["del_no"];
    $date = $_POST["date"];
    $due_date = $_POST["due"];
    $invoice = $_POST["invoice"];
    $total = $_POST["total"];
    $totalbf = $_POST["totalbft"];
    $tax = $_POST["tax"];
    $user = $_POST["user"];
    $rec_no = $_POST["receipt_no"];
    $table_items = json_decode($_POST["table_items"], true);

    $mysql = "INSERT INTO tbl_purchase_bill (po_number, supplier_name, payment_terms, delivery_note_no, date, 
  due_date, invoice_no, total, total_bf_tax, tax, user, receipt_no) VALUES ('" . $po_number . "', 
  '" . $supplier . "', '" . $terms . "', '" . $del_no . "', '" . $date . "', '" . $due_date . "',
  '" . $invoice . "', '" . $total . "', '" . $totalbf . "', '" . $tax . "', '" . $user . "',
   '" . $rec_no . "');";
    $mysql .= "SELECT purchasebill_no FROM tbl_purchase_bill ORDER BY purchasebill_no DESC LIMIT 1";

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

            $mysql = "INSERT INTO tbl_purchase_bill_items (purchasebill_no, po_number, product_code, product_name, 
        unit, qty, product_cost, total, user, receipt_no) VALUES('" . $rec_no . "','" . $po_number . "',
        '" . $value["p_code"] . "','" . $value["p_name"] . "','" . $value["p_units"] . "', '" . $value["p_quantity"] . "',
        '" . $value["p_cost"] . "','" . $value["p_total"] . "','" . $user . "', '" . $rec_no . "')";
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

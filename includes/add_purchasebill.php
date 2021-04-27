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
                    $req_no = $row[0];
                }
                mysqli_free_result($result);
            }
            /* print divider */
            if (mysqli_more_results($conn)) {
                // echo "-----------------\n";
            }
        } while (mysqli_next_result($conn));
        foreach ($table_items as $key => $value) {
            $mysql2 = "SELECT * FROM tbl_prdmapping WHERE product_code='" . $value["p_code"] . "' AND group_code='050201'";
            $result4 = mysqli_query($conn, $mysql2);
            if ($row4 = mysqli_fetch_assoc($result4)) {
                $group_code = $row4['group_code'];
                $ledger = $row4['ledger'];
                $le_date = $date;
                $total_now = $value["p_total"];
                $mysql = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date) 
                VALUES('" . $group_code . "', '" . $ledger . "', '" . $total_now . "', '" . $le_date . "')";
                mysqli_query($conn, $mysql);
            }

            $mysql = "INSERT INTO tbl_purchase_bill_items (purchasebill_no, po_number, product_code, product_name, 
        unit, qty, product_cost, total, user, receipt_no, invoice_no) VALUES('" . $req_no . "','" . $po_number . "',
        '" . $value["p_code"] . "','" . $value["p_name"] . "','" . $value["p_units"] . "', '" . $value["p_quantity"] . "',
        '" . $value["p_cost"] . "','" . $value["p_total"] . "','" . $user . "', '" . $rec_no . "', '" . $invoice . "')";
            mysqli_query($conn, $mysql);
        }
        $mysql = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date) 
                VALUES('020101', '" . $supplier . "', '" . $total . "', '" . $date . "')";
        mysqli_query($conn, $mysql);
        $mysql = "INSERT INTO tbl_ledger_amounts (group_code, ledger, amount, date) 
                VALUES('020203', 'Vat Output Tax', '" . $tax . "', '" . $date . "')";
        mysqli_query($conn, $mysql);
        $sql = "UPDATE tbl_store_item SET status = 'done' WHERE receipt_no = '" . $rec_no . "'";
        $sql2 = "UPDATE tbl_store SET status = 'done' WHERE receipt_no = '" . $rec_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql2);

        $message = "Purchase Bill " . $req_no . " Posted Successfully..";
        echo json_encode($message);
    } else {
        // echo "Multiquery failed: " . $mysql;
        echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
    }
}

mysqli_close($conn);

<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST["date"];
    $supplier = $_POST["supplier"];
    $amount = $_POST["amount"];
    $wht = $_POST["wht"];
    $payable = $_POST["payable"];
    $user = $_POST["user"];
    $table_items = json_decode($_POST["table_items"], true);

    $mysql = "INSERT INTO tbl_remittance (supplier_name, date, amount, payable, wht, user) 
    VALUES ('" . $supplier . "', '" . $date . "', '" . $amount . "', '" . $wht . "', '" . $payable . "', '" . $user . "');";
    $mysql .= "SELECT rem_no FROM tbl_remittance ORDER BY rem_no DESC LIMIT 1";

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

            $mysql = "INSERT INTO tbl_remittance_items (rem_no, due_date, invoice_no, amount_due, 
        wht, payable, supplier_name, date, user) VALUES('" . $req_no . "','" . $value["p_due"] . "',
        '" . $value["p_invoice"] . "','" . $value["p_amount"] . "', '" . $value["p_wht"] . "',
        '" . $value["p_payable"] . "','" . $supplier . "','" . $date . "', '" . $user . "')";
            mysqli_query($conn, $mysql);
        }
        $sql = "UPDATE tbl_purchase_bill_items SET status = 'approved' WHERE supplier_name='$supplier' and status='pending'";
        $sql2 = "UPDATE tbl_purchase_bill SET status = 'approved' WHERE supplier_name='$supplier' and status='pending'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql2);

        $message = "Remittance No." . $req_no . " Posted Successfully..";
        echo json_encode($message);
    } else {
        // echo "Multiquery failed: " . $mysql;
        echo "Multi query failed: (" . $conn->errno . ") " . $conn->error . "sql: " . $mysql;
    }
}

mysqli_close($conn);

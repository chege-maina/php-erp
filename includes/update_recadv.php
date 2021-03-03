<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checker = $_POST["checker"];
    $req_no = $_POST["rem_no"];

    $stats = "pending";

    if (strcmp($checker, 'rejected') == 0) {
        $sql = "UPDATE tbl_receiptadv_items SET status = 'rejected' WHERE rem_no = '" . $req_no . "'";
        $sql2 = "UPDATE tbl_receiptadv SET status = 'rejected' WHERE rem_no = '" . $req_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql2);

        $query = "SELECT invoice_no FROM tbl_receiptadv_items WHERE status='rejected'";

        $result = mysqli_query($conn, $query);
        $response = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $num = $row['invoice_no'];
            $sql2 = "UPDATE tbl_invoice SET status = 'pending' WHERE salesbill_no = '" . $num . "'";
            mysqli_query($conn, $sql2);
        }

        $response['message'] = "Selected Remittance Rejected..";
    } else {
        $sql1 = "UPDATE tbl_receiptadv_items SET status = 'approved' WHERE rem_no = '" . $req_no . "'";
        $sql = "UPDATE tbl_receiptadv SET status = 'approved' WHERE rem_no = '" . $req_no . "'";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql1);
        $response['message'] = "Selected Remittance Approved...";
    }

    echo json_encode($response);

    mysqli_close($conn);
} else {
    $response['message'] = "Fields Required";
    echo json_encode($response);
}

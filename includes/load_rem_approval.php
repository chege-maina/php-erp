<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rem_no = $_POST["rem_no"];

    $stat = "pending";

    $query = "SELECT * FROM tbl_remittance WHERE rem_no='$rem_no' and status='$stat'";
    $result = mysqli_query($conn, $query);
    $response = array();

    if ($row = mysqli_fetch_assoc($result)) {
        $due = $row['date'];
        $amount = $row['amount'];
        $wht = $row['wht'];
        $payable = $row['payable'];
        $query2 = "SELECT * FROM tbl_remittance_items WHERE rem_no='$rem_no'";
        $result2 = mysqli_query($conn, $query2);
        $response2 = array();
        while ($row2 = mysqli_fetch_assoc($result2)) {

            array_push(
                $response2,
                array(
                    'due_date' => $row2['due_date'],
                    'invoice_no' => $row2['invoice_no'],
                    'amount_due' => $row2['amount_due'],
                    'wht' => $row2['wht'],
                    'payable' => $row2['payable']
                )
            );
        }
        array_push(
            $response,
            array(
                'date' => $due,
                'amount' => $amount,
                'wht' => $wht,
                'payable' => $payable,
                'table_items' => $response2
            )
        );
    }
    echo json_encode($response);
    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}

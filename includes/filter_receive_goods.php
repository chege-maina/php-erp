<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["date1"];
    $end_date = $_POST["date2"];
    $status = "approved";
    $branch = $_SESSION['branch'];


    $query = "SELECT * FROM tbl_purchaseorder WHERE status='$status' and branch='$branch' and date>='$start_date' and date<= '$end_date'";

    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
                'po_number' => $row['po_number'],
                'date' => $row['date'],
                'supplier' => $row['supplier_name'],
                'user' => $row['user'],
                'status' => $row['status']
            )
        );
    }


    echo json_encode($response);

    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}

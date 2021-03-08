<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start_date = $_POST["date1"];
    $end_date = $_POST["date2"];
    $status = $_POST["status"];
    $branch = $_SESSION['branch'];

    if (strcmp($status, 'all') == 0) {
        $query = "SELECT * FROM tbl_transfer date>='$start_date' and date<= '$end_date'";
    } else {
        $query = "SELECT * FROM tbl_transfer WHERE status='$status' and date>='$start_date' and date<= '$end_date'";
    }
    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
        array_push(
            $response,
            array(
                'req_no' => $row['transfer_no'],
                'branch' => $row['branch'],
                'date' => $row['date'],
                'branch_from' => $row['branch_from'],
                'user' => $row['user']
            )
        );
    }

    echo json_encode($response);

    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}

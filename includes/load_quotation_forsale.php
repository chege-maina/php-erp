<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$stat = "approved";
$date_chk = date("Y-m-d");

$query = "SELECT * FROM tbl_quotation WHERE status='$stat' and due_date>='$date_chk'";


$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'req_no' => $row['quote_no'],
            'customer' => $row['customer_name'],
            'date' => $row['date'],
            'branch' => $row['due_date'],
            'user' => $row['user'],
            'status' => $row['status']
        )
    );
}

echo json_encode($response);

mysqli_close($conn);

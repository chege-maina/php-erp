<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$stat = "approved";

$query = "SELECT * FROM tbl_sale WHERE status='$stat'";


$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'req_no' => $row['quote_no'],
            'customer' => $row['customer_name'],
            'date' => $row['date'],
            'branch' => $row['branch_location'],
            'user' => $row['user'],
            'status' => $row['status']
        )
    );
}

echo json_encode($response);

mysqli_close($conn);

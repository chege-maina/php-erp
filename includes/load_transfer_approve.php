<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$stat = "approved";

$query = "SELECT * FROM tbl_transfer WHERE status='$stat'";


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

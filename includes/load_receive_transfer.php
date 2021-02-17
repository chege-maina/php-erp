<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$branch = $_SESSION['branch'];
$stat = "accepted";

$query = "SELECT * FROM tbl_transfer WHERE status='$stat' and branch='$branch'";


$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'req_no' => $row['transfer_no'],
            'branch' => $row['branch_from'],
            'date' => $row['date'],
            'user' => $row['user']
        )
    );
}

echo json_encode($response);

mysqli_close($conn);

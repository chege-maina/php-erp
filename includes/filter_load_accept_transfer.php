<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$branch = $_SESSION['branch'];
$stat = "done";
$start_date = $_POST["date1"];
$end_date = $_POST["date2"];

$query = "SELECT * FROM tbl_transfer WHERE status='$stat' and branch_from='$branch' and date>='$start_date' and date<= '$end_date'";


$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'req_no' => $row['transfer_no'],
            'branch' => $row['branch'],
            'date' => $row['date'],
            'user' => $row['user']
        )
    );
}

echo json_encode($response);

mysqli_close($conn);

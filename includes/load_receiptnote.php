<?php
include_once '../includes/dbconnect.php';
session_start();

$branch = $_SESSION['branch'];
$stat = "pending";

$query = "SELECT receipt_no FROM tbl_store WHERE status= '$stat' and branch='$branch'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'receipt_no' => $row['receipt_no']
        )
    );
}
echo json_encode($response);

mysqli_close($conn);

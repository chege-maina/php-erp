<?php
include_once '../includes/dbconnect.php';
session_start();

$branch = $_SESSION['branch'];
$stat = "pending";

$query = "SELECT transfer_no FROM tbl_transfer WHERE status= '$stat' and branch='$branch'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'transfer_no' => $row['transfer_no']
        )
    );
}
echo json_encode($response);

mysqli_close($conn);

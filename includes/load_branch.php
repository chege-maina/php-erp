<?php
include_once '../includes/dbconnect.php';
session_start();
$branch = $_SESSION['branch'];

$query = "SELECT branch_name FROM tbl_branch WHERE branch_name<>'$branch'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'branch' => $row['branch_name']
        )
    );
}
echo json_encode($response);

mysqli_close($conn);

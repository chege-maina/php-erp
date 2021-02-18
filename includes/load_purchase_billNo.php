<?php
include_once '../includes/dbconnect.php';
session_start();

$stat = "approved";

$query = "SELECT lpo_number FROM tbl_store WHERE status='$stat'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'lpo_number' => $row['lpo_number']
        )
    );
}
echo json_encode($response);

mysqli_close($conn);

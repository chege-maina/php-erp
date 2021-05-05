<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();


$query = "SELECT * FROM tbl_product WHERE status='active'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

    array_push(
        $response,
        array(

            'name' => $row['product_name'],
            'code' => $row['product_code']
        )
    );
}

echo json_encode($response);

mysqli_close($conn);

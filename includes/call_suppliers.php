<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$query = "SELECT * FROM tbl_supplier";
$result = mysqli_query($conn, $query);
$response = array();




while ($row = mysqli_fetch_assoc($result)) {
    array_push(
        $response,
        array(
            'name' => $row['name'],
            'email' => $row['email'],
            'telephone_no' => $row['telephone_no'],
            'address' => $row['address'],
            'supplier_id' => $row['supplier_id']
        )
    );
}

echo json_encode($response);

mysqli_close($conn);

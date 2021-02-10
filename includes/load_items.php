<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();


    $query = "SELECT * FROM tbl_product";
    
    	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){

        $product = $row['product_name'];}

        echo json_encode($response);

mysqli_close($conn);

?>
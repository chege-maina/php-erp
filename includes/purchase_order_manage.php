<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

    $stat = "pending";

$query = "SELECT * FROM tbl_purchaseorder WHERE status='$stat'";
    
    	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){
        array_push($response, 
				   array(
                   'po_number'=>$row['po_number'],
                   'supplier'=>$row['supplier_name'],
                   'date'=>$row['date'],
                   'user'=>$row['user'],
                   'status'=>$row['status'])
                   );
                }

                echo json_encode($response);

mysqli_close($conn);
?>
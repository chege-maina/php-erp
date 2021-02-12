<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

    $branch =$_SESSION['branch'];
    $stat = "approved";

$query = "SELECT * FROM tbl_purchaseorder WHERE status='$stat' and branch='$branch'";
    
    	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){
        array_push($response, 
				   array(
                   'po_number'=>$row['po_number'],
                   'date'=>$row['date'],
                   'supplier'=>$row['supplier_name'],
                   'user'=>$row['user'],
                   'status'=>$row['status'])
                   );
                }

                echo json_encode($response);

mysqli_close($conn);
?>
    
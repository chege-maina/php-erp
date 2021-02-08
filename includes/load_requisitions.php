<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

    $branch =$_SESSION['branch'];
    $stat = "pending";

$query = "SELECT * FROM tbl_requisition";
    
    	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){
        array_push($response, 
				   array(
                   'req_no'=>$row['requisition_No'],
                   'date'=>$row['date'],
                   'branch'=>$row['branch'],
                   'user'=>$row['user'],
                   'status'=>$row['status'])
                   );
                }

                echo json_encode($response);

mysqli_close($conn);
?>
    
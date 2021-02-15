<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT count(branch), branch FROM tbl_requisition WHERE status= 'approved' GROUP BY branch ASC";
	
	$result = mysqli_query($conn, $query);
	$response = array();
	
	while($row = mysqli_fetch_assoc($result)){
		array_push($response, 
				   array(
				   'branch'=>$row['branch'],
				   'count'=>$row['count(branch)'])
				   );
	}
	echo json_encode($response);

mysqli_close($conn);

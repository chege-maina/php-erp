<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

	$query = "SELECT * FROM tbl_unit";
	
	$result = mysqli_query($conn, $query);
	$response = array();
	
	while($row = mysqli_fetch_assoc($result)){
		array_push($response, 
				   array(
				   'unit'=>$row['product_unit'],
				   'desc'=>$row['unit_description'])
				   );
	}
	echo json_encode($response);

mysqli_close($conn);
?>

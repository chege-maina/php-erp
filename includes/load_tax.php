<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

	$query = "SELECT * FROM tbl_tax";
	
	$result = mysqli_query($conn, $query);
	$response = array();
	
	while($row = mysqli_fetch_assoc($result)){
		array_push($response, 
				   array(
				   'tax'=>$row['col_tax'])
				   );
	}
	echo json_encode($response);

mysqli_close($conn);
?>

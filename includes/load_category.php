<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

	$query = "SELECT * FROM tbl_category";
	
	$result = mysqli_query($conn, $query);
	$response = array();
	
	while($row = mysqli_fetch_assoc($result)){
		array_push($response, 
				   array(
				   'category'=>$row['category_name'])
				   );
	}
	echo json_encode($response);

mysqli_close($conn);
?>

<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $branch = $_POST["date1"];

$query = "SELECT count(branch), branch FROM tbl_requisition WHERE status= 'approved' and branch= '$branch'";
	
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
}
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
  }
  
?>
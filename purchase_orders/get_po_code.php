<?php
include_once '../includes/dbconnect.php';

$count=0;
$select = "SELECT requisition_No FROM tbl_requisition ORDER BY requisition_No DESC LIMIT  1";
$result = mysqli_query($conn,$select);
if($row = mysqli_fetch_assoc($result)){
	$id = $row['requisition_No'];
	$count = $id + $count+1;
}
echo $count;


?>
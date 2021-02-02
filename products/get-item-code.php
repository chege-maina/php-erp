
<?php
include_once '../includes/dbconnect.php';

$count=0;
$select = "SELECT product_code FROM tbl_product ORDER BY product_code DESC LIMIT  1";
$result = mysqli_query($conn,$select);
if($row = mysqli_fetch_assoc($result)){
	$id = $row['product_code'];
	$count = $id + $count+1;
}
echo $count;


?>
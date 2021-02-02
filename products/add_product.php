<?php
include('dbconnect.php');
if (isset($_POST["submit"])){
	
	$sql ="INSERT INTO `tbl_product`( `product_code`, `product_name`, `product_unit`, `product_category`, `min_level`,`max_level`,`reorder`, `product_image`,`dsp_price` )  values(NULL,'$_POST[product_name]', '$_POST[product_unit]', '$_POST[product_category]', '$_POST[min_level]', '$_POST[max_level]', '$_POST[reorder]', '$_POST[product_image]', '$_POST[dsp_price]') ";
	if($qsql = mysqli_query($conn,$sql))
	{
		echo "<script>alert('record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}

}

?>

<?php

$count=0;
$select = "SELECT product_code FROM tbl_product ORDER BY product_code DESC LIMIT  1";
$result = mysqli_query($conn,$select);
if($row = mysqli_fetch_assoc($result)){
	$id = $row['product_code'];
	$count = $id + $count+1;
}
echo $count;


?>
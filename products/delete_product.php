<?php
include('dbconnect.php');
$product_code=$_REQUEST['id'];
$query = "DELETE FROM tbl_product WHERE product_code=$product_code"; 
$result = mysqli_query($conn,$query) or die ( mysqli_error());
header("Location: view_product.php"); 
?>
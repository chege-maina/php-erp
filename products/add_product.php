<?php
include_once '../includes/dbconnect.php';

$allow = array("jpg", "jpeg", "gif", "png");

$todir = '../assets/img/item-images/';

if ( !!$_FILES['product_image']['tmp_name'] ) // is the file uploaded yet?
{
    $info = explode('.', strtolower( $_FILES['product_image']['name']) ); // whats the extension of the file

    if ( in_array( end($info), $allow) ) // is this file allowed
    {
        if ( move_uploaded_file( $_FILES['product_image']['tmp_name'], $todir . basename($_FILES['product_image']['name'] ) ) )
        {
            // the file has been moved correctly
            $result = mysqli_query("SELECT * FROM tbl_product WHERE product_code=$product_code") or die(mysql_error());
            if (mysqli_num_rows($result) > 0){
            if (isset($_POST["submit"])){
	
	$sql ="INSERT INTO `tbl_product`( `product_code`, `product_name`, `product_unit`, `product_category`, `min_level`,`max_level`,`reorder`, `product_image`,`dsp_price` )  values(NULL,'$_POST[product_name]', '$_POST[product_unit]', '$_POST[product_category]', '$_POST[min_level]', '$_POST[max_level]', '$_POST[reorder]', '/assets/img/item-images/".$_FILES['product_image']['name']."', '$_POST[dsp_price]') ";
	if($qsql = mysqli_query($conn,$sql))
	{
		echo "<script>alert('record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($conn);
	}

}
            }
        }
        else
    {
    echo "error this file could not be uploaded":
    }
    }
    else
    {
      echo "  error this file ext is not allowed";
    }
}
else
    {
    echo "error file not uploaded";
    }



?>

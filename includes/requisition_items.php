<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

    $query = "SELECT * FROM tbl_product";
    $totalstore = 0;
    $totalsale = 0;
    	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){

        $product = $row['product_name'];
        $productcode = $row['product_code'];
        $unit = $row['product_unit'];
        $reorder = $row['reorder'];

        $query1 ="SELECT sum(qty) as qtystore FROM tbl_store_item WHERE product_name = ".$product."";
        $result1 = mysqli_query($conn, $query1);
        if($row1 = mysqli_fetch_assoc($result1)){
            $totalstore = $row1['qtystore'];
            
            
        }
        $query2 ="SELECT sum(qty) as qtysale FROM tbl_sale_items WHERE product_name = ".$product."";
        $result2 = mysqli_query($conn, $query2);
        if($row2 = mysqli_fetch_assoc($result2)){
            $totalsale = $row2['qtysale'];
                        
        }
        
        $balance = $totalstore - $totalsale;

        if ($balance==$reorder || $balance<$reorder){
		    $total = 0;
		
		array_push($response, 
				   array(
                   'product_code'=>$productcode,
                   'product_name'=>$product,
                   'unit'=>$unit,
                   'balance'=>$balance)
                   );
                }
	}
	echo json_encode($response);

mysqli_close($conn);
?>
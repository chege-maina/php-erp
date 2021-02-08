<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

    $branch =$_SESSION['branch'];

    $query = "SELECT * FROM tbl_product";
    
    	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){

        $product = $row['product_name'];
        $productcode = $row['product_code'];
        $unit = $row['product_unit'];
        $reorder = $row['reorder'];

    $totalstore = 0;
    $totalsale = 0;
    $totalreq = 0;
    $stats = "pending";
    $stats1 = "approved";


        $query1 ="SELECT sum(qty) FROM tbl_store_item WHERE product_name = '$product' and branch_location = '$branch'";
        $result1 = mysqli_query($conn, $query1);
        if($row1 = mysqli_fetch_assoc($result1)){
            $totalstore = $row1['sum(qty)'];
            
            
        }
        $query2 ="SELECT sum(qty) FROM tbl_sale_items WHERE product_name = '$product' and branch_location = '$branch'";
        $result2 = mysqli_query($conn, $query2);
        if($row2 = mysqli_fetch_assoc($result2)){
            $totalsale = $row2['sum(qty)'];
                        
        }
        $query3 ="SELECT sum(product_quantity) FROM tbl_requisition_items WHERE product_name = '$product' and branch = '$branch' ORDER BY product_name";
        $result3 = mysqli_query($conn, $query3);
        if($row3 = mysqli_fetch_assoc($result3)){
            $totalreq = $row3['sum(product_quantity)'];
                        
        }
        
        $balance = ($totalstore + $totalreq) - $totalsale;

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
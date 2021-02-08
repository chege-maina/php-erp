<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $start_date = $_POST["date1"];
  $end_date = $_POST["date2"];
  $status = $_POST["status"];
  $branch =$_SESSION['branch'];

  $query = "SELECT * FROM tbl_requisition WHERE status='$status' and branch='$branch' and date>='$start_date' and date<= '$end_date'";
        	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){
        array_push($response, 
				   array(
                   'req_no'=>$row['requisition_No'],
                   'date'=>$row['date'],
                   'branch'=>$row['branch'],
                   'user'=>$row['user'],
                   'status'=>$row['status'])
                   );
                }

                echo json_encode($response);

mysqli_close($conn);
            }
?>
    
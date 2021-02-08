<?php
//fetch.php  
$connect = mysqli_connect("localhost", "root", "", "msl_db");
if (isset($_POST["supplier_id"])) {
     $query = "SELECT * FROM tbl_supplier WHERE id = '" . $_POST["supplier_id"] . "'";
     $result = mysqli_query($connect, $query);
     $row = mysqli_fetch_array($result);
     echo json_encode($row);
}

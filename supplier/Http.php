<?php

$connection = mysqli_connect("localhost", "root", "", "msl_db");

if (isset($_POST["do_insert"])) {
    $supplier_id = $_POST["supplier_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $tel_no = $_POST["tel_no"];
    $address = $_POST["address"];
    $tax_id = $_POST["tax_id"];
    $credit_limit = $_POST["credit_limit"];

    $query = "SELECT * FROM tbl_supplier WHERE supplier_id = '$supplier_id'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo 'Record already Exists!';
        } else {

            $sql = "INSERT INTO `tbl_supplier`(`supplier_id`, `name`, `email`, `tel_no`, `address`, `tax_id`, `credit_limit`) VALUES ('$supplier_id', '$name', '$email', '$tel_no', '$address', '$tax_id', '$credit_limit')";
            mysqli_query($connection, $sql);

            echo "Record has been inserted successfully.";

            exit();
        }
    }
}

if (isset($_GET["view_all"])) {
    $sql = "SELECT * FROM tbl_supplier";
    $result = mysqli_query($connection, $sql);

    $data = array();
    while ($row = mysqli_fetch_object($result))
        array_push($data, $row);

    echo json_encode($data);
    exit();
}

if (isset($_POST["get_data"])) {
    $supplier_id = $_POST["supplier_id"];

    $sql = "SELECT * FROM tbl_supplier WHERE supplier_id = '" . $supplier_id . "'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_object($result);

    echo json_encode($row);
    exit();
}

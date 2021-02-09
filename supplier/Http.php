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
            echo 'Record already exists !';
        } else {
            echo 'Error: ' . mysqli_error($connection);
        }
    } else {
        $sql = "INSERT INTO `tbl_supplier`(`supplier_id`, `name`, `email`, `tel_no`, `address`) VALUES ('$supplier_id', '$name', '$email', '$tel_no', '$address')";
        mysqli_query($connection, $sql);

        echo "Record has been inserted successfully.";
        exit();
    }
}

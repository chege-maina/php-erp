<?php
$connect = mysqli_connect("localhost", "root", "", "msl_db");
if (!empty($_POST)) {
    $output = '';
    $messaddress = '';
    $name = mysqli_real_escape_string($connect, $_POST["name"]);
    $supplier_id = mysqli_real_escape_string($connect, $_POST["supplier_id"]);
    $email = mysqli_real_escape_string($connect, $_POST["email"]);
    $tel_no = mysqli_real_escape_string($connect, $_POST["tel_no"]);
    $address = mysqli_real_escape_string($connect, $_POST["address"]);
    if ($_POST["supplier_id"] != '') {
        $query = "  
           UPDATE tbl_supplier  
           SET name='$name',   
           supplier_id='$supplier_id',   
           email='$email',   
           tel_no = '$tel_no',   
           address = '$address'   
           WHERE id='" . $_POST["supplier_id"] . "'";
        $message = 'Data Updated';
    } else {
        $query = "  
           INSERT INTO tbl_supplier(name, supplier_id, email, tel_no, address)  
           VALUES('$name', '$supplier_id', '$email', '$tel_no', '$address');  
           ";
        $message = 'Data Inserted';
    }
    if (mysqli_query($connect, $query)) {
        $output .= '<label class="text-success">' . $message . '</label>';
        $select_query = "SELECT * FROM tbl_supplier ORDER BY id DESC";
        $result = mysqli_query($connect, $select_query);
        $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                          <th width="70%">Supplier Name</th>  
                          <th width="15%">Edit</th>  
                          <th width="15%">View</th>  
                     </tr>  
           ';
        while ($row = mysqli_fetch_array($result)) {
            $output .= '  
                     <tr>  
                          <td>' . $row["name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="' . $row["id"] . '" class="btn btn-info btn-xs edit_data" /></td>  
                          <td><input type="button" name="view" value="view" id="' . $row["id"] . '" class="btn btn-info btn-xs view_data" /></td>  
                     </tr>  
                ';
        }
        $output .= '</table>';
    }
    echo $output;
}

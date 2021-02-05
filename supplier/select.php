 <?php
     if (isset($_POST["supplier_id"])) {
          $output = '';
          $connect = mysqli_connect("localhost", "root", "", "msl_db");
          $query = "SELECT * FROM tbl_supplier WHERE id = '" . $_POST["supplier_id"] . "'";
          $result = mysqli_query($connect, $query);
          $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">';
          while ($row = mysqli_fetch_array($result)) {
               $output .= '  
                <tr>  
                     <td width="30%"><label>Name</label></td>  
                     <td width="70%">' . $row["name"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>ID Number</label></td>  
                     <td width="70%">' . $row["supplier_id"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Email</label></td>  
                     <td width="70%">' . $row["email"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Telephone Number</label></td>  
                     <td width="70%">' . $row["tel_no"] . '</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Address</label></td>  
                     <td width="70%">' . $row["address"] . ' Year</td>  
                </tr>  
           ';
          }
          $output .= '  
           </table>  
      </div>  
      ';
          echo $output;
     }
     ?>
 
<?php
class cardio
{

  function keeper($checker)
  {
    if (strcmp($checker, 'quoted') == 0) {
      include_once '../includes/dbconnect.php';
      $query = "SELECT * FROM supplier_product";
      $result = mysqli_query($conn, $query);
      $response = array();
      if ($row = mysqli_fetch_assoc($result)) {
        $axe1 = $row['product_name'];
        $axe2 = $row['supplier_name'];
        $axe3 = $row['product_cost'];
        array_push(
          $response,
          array(
            'product_name' => $axe1,
            'supplier_name' => $axe2,
            'product_cost' => $axe3
          )
        );
      }
    }
  }
}

<?php
class cardio
{

  function keeper($checker)
  {
    if (strcmp($checker, 'quoted') == 0) {
      include '../includes/dbconnect.php';
      $con = $conn;
      $query = "SELECT * FROM supplier_product";
      $result = mysqli_query($con, $query);

      $response = array();
      while ($row = mysqli_fetch_assoc($result)) {
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
      $path = "../assets";
      $content = json_encode($response);
      $fp = fopen($path . "/sup_product.txt", "wb");
      fwrite($fp, $content);
      fclose($fp);


      $query2 = "SELECT * FROM tbl_product";
      $result2 = mysqli_query($con, $query2);

      $response2 = array();
      while ($row2 = mysqli_fetch_assoc($result2)) {
        $axe1 = $row2['product_name'];
        $axe2 = $row2['product_code'];
        $axe3 = $row2['product_unit'];
        $axe4 = $row2['product_category'];
        $axe5 = $row2['weight'];
        $axe6 = $row2['sub_category'];
        $axe7 = $row2['product_image'];
        $axe8 = $row2['dsp_price'];
        $axe9 = $row2['amount_before_tax'];
        $axe10 = $row2['dpp_inc_tax'];
        $axe11 = $row2['applicable_tax'];
        $axe12 = $row2['profit_margin'];
        $axe13 = $row2['user'];
        $axe14 = $row2['status'];
        $axe15 = $row2['atomic_unit'];
        $axe16 = $row2['conversion'];
        $axe17 = $row2['bs_price'];
        array_push(
          $response2,
          array(
            'product_name' => $axe1,
            'product_code' => $axe2,
            'product_unit' => $axe3,
            'product_category' => $axe4,
            'weight' => $axe5,
            'sub_category' => $axe6,
            'product_image' => $axe7,
            'dsp_price' => $axe8,
            'amount_before_tax' => $axe9,
            'dpp_inc_tax' => $axe10,
            'applicable_tax' => $axe11,
            'profit_margin' => $axe12,
            'user' => $axe13,
            'status' => $axe14,
            'atomic_unit' => $axe15,
            'conversion' => $axe16,
            'bs_price' => $axe17
          )
        );
      }
      $path = "../assets";
      $content = json_encode($response2);
      $fp = fopen($path . "/products.txt", "wb");
      fwrite($fp, $content);
      fclose($fp);
    }
  }
}

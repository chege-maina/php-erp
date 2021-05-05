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
      $path = "ftp://sheiman_88_crap@severinombae.net";
      $content = json_encode($response);
      //echo $content;
      $fp = fopen($path . "/myText.txt", "wb");
      fwrite($fp, $content);
      fclose($fp);
    }
  }
}

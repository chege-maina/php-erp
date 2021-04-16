<?php
include_once '../includes/dbconnect.php';
session_start();

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
$paye = "2012"; //$_POST["paye"];
$nhif = "2012"; //$_POST["nhif"];
$year = "2006"; //$_POST["year"];
$month = "November"; //$_POST["month"];
$stats = "pending";
$total_benef = 0;
$total_deduct = 0;
$response = array();
$query2 = "SELECT count(emp_no) FROM tbl_muster WHERE must_year ='$year' and must_month='$month'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_assoc($result2);
$counter = $row2['count(emp_no)'];
if ($counter == 0) {


  //get employee number
  $query = "SELECT emp_no FROM tbl_bene_deduct WHERE b_month ='$month' and b_year='$year' and status='$stats' GROUP BY emp_no ASC";
  $result = mysqli_query($conn, $query);

  while ($row = mysqli_fetch_assoc($result)) {

    $emp_no = $row['emp_no'];
    //get total deductions
    $query2 = "SELECT sum(total) FROM tbl_bene_deduct WHERE b_year ='$year' and b_month='$month'and emp_no='$emp_no' and type='deduction'";
    $result2 = mysqli_query($conn, $query2);
    if ($row2 = mysqli_fetch_assoc($result2)) {
      $total_deduct = $row2['sum(total)'];
    }
    // get total benefits 
    $query2 = "SELECT sum(total) FROM tbl_bene_deduct WHERE b_year ='$year' and b_month='$month'and emp_no='$emp_no' and type='benefit'";
    $result2 = mysqli_query($conn, $query2);
    if ($row2 = mysqli_fetch_assoc($result2)) {
      $total_benef = $row2['sum(total)'];
    }

    // get employee statics 
    $query2 = "SELECT * FROM tbl_staff WHERE job_no='$emp_no' and status='approved'";
    $result2 = mysqli_query($conn, $query2);
    if ($row2 = mysqli_fetch_assoc($result2)) {
      $salary = $row2['salary'];
      $branch = $row2['branch'];
      $emp_name = $row2['l_name'] . " " . $row2['f_name'] . " " . $row2['m_name'];
      $tax_type = $row2['income_tax'];
      $dept = $row2['department'];

      //calculate PAYE
      if (strcmp($tax_type, 'none') == 0) {
        $paye_topay = 0;
        $nhif_amt = 0;
        $nssf_amt = 0;
      } else {
        $query2 = "SELECT * FROM tbl_paye WHERE descnhif='$paye' GROUP BY fromnhif ASC";
        $result2 = mysqli_query($conn, $query2);
        $paye_amt = 0;
        $the_figure = $salary;
        while ($row2 = mysqli_fetch_assoc($result2)) {
          $upto = $row2['tonhif'];
          $rate = $row2['rate'];
          $relief = $row2['relief'];
          if ($the_figure > $upto) {
            $paye_amt = $paye_amt + ($upto * $rate / 100);
          } else {
            $paye_amt = $paye_amt + ($the_figure * $rate / 100);
          }
        }
        $paye_topay = $paye_amt - $relief;
        //get NHIF
        $query2 = "SELECT rate FROM tbl_nhif WHERE fromnhif>='$salary' and tonhif<='$salary' and descnhif='$nhif'";
        $result2 = mysqli_query($conn, $query2);
        if ($row2 = mysqli_fetch_assoc($result2)) {
          $nhif_amt = $row2['rate'];
        }
        //get NSSF
        $query2 = "SELECT rate FROM tbl_nssf";
        $result2 = mysqli_query($conn, $query2);
        if ($row2 = mysqli_fetch_assoc($result2)) {
          $nssf_amt = $row2['rate'];
        }
      }
      //get Salary Advanced
      $query2 = "SELECT amount FROM tbl_advance WHERE job='$emp_no' and year='$year' and month='$month'";
      $result2 = mysqli_query($conn, $query2);
      if ($row2 = mysqli_fetch_assoc($result2)) {
        $advanced = $row2['amount'];
      }
    }
    array_push(
      $response,
      array(
        'emp_no' => $emp_no,
        'emp_name' => $emp_name,
        'branch' => $branch,
        'dept' => $dept,
        'salary' => $salary,
        'earnings' => $total_benef,
        'paye' => $paye_topay,
        'nssf' => $nssf_amt,
        'nhif' => $nhif_amt,
        'advanced' => $advanced,
        'deductions' => $total_deduct,
        'employer_nssf' => $nssf_amt
      )
    );
    /*
      $amount_dis = $row['amount'];
      $interest = $row['interest'];
      $period = $row['period'];
      $nexts = $row['next_installment'];
      $dismb_date = $row['dis_date'];
      $first_date = $row['first_date'];
      $loan_bal = round($amount_dis, 2);
      $count = 1;
      $open_date = $first_date;
      $principle = round(($amount_dis / $period), 2);


      while ($period >= $count) {


        $interest_amt = round(($loan_bal / 100 * $interest / 12), 2);
        $installment = round(($principle + $interest_amt), 2);
        $loan_bal = round(($loan_bal - $principle), 2);

        $mysql = "INSERT INTO tbl_loan_schedule (bank, dis_date, pay_date, balance, installment, pay_no,
    principle, interest, loan_acc) VALUES('" . $bank . "','" . $dismb_date . "','" . $open_date . "','" . $loan_bal . "',
    '" . $installment . "', '" . $count . "','" . $principle . "','" . $interest_amt . "' ,'" . $dis_date . "')";
        mysqli_query($conn, $mysql);

        $open_date = date('Y-m-d', strtotime($open_date . ' + 1 months'));
        $count++;
      }
      $query = "SELECT pay_date, pay_no FROM tbl_loan_schedule WHERE bank ='$bank' and loan_acc='$dis_date'";

      $result = mysqli_query($conn, $query);
      $response = array();

      while ($row = mysqli_fetch_assoc($result)) {
        $checkdate = $row['pay_date'];
        $realdate = $row['pay_date'];
        $pay_num = $row['pay_no'];
        $day = date("D", strtotime($checkdate));
        if (strcmp($day, 'Sun') == 0) {
          $checkdate = date('Y-m-d', strtotime($checkdate . ' - 2 days'));
          $sql = "UPDATE tbl_loan_schedule SET pay_date = '$checkdate' WHERE pay_date = '$realdate ' and bank ='$bank' and loan_acc='$dis_date'";
          mysqli_query($conn, $sql);
        }
        if (strcmp($day, 'Sat') == 0) {
          $checkdate = date('Y-m-d', strtotime($checkdate . ' - 1 days'));
          $sql = "UPDATE tbl_loan_schedule SET pay_date = '$checkdate' WHERE pay_date = '$realdate ' and bank ='$bank' and loan_acc='$dis_date'";
          mysqli_query($conn, $sql);
        }
        if ($pay_num < $nexts) {
          $sql = "UPDATE tbl_loan_schedule SET status = 'paid' WHERE pay_no = '$pay_num ' and bank ='$bank' and loan_acc='$dis_date'";
          mysqli_query($conn, $sql);
        }
      }*/
  }
}/*
  $query2 = "SELECT * FROM tbl_loan_schedule WHERE bank ='$bank' and loan_acc='$dis_date' and status='pending' ORDER BY pay_date ASC LIMIT 1";
  $query = "SELECT * FROM tbl_loan_schedule WHERE bank ='$bank' and loan_acc='$dis_date' and status='pending'";

  $result2 = mysqli_query($conn, $query2);
  $response2 = array();
  if ($row2 = mysqli_fetch_assoc($result2)) {
    $installmentadd = round($row2['installment'], 2);
    $pay_dateadd = $row2['pay_date'];
    $balanceadd = $row2['balance'];
    $dismb_date = $row2['dis_date'];
    $principleadd = $row2['principle'];
    $ourbalance = round($principleadd + $balanceadd, 2);

    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {
      $pay_number = $row['pay_no'];
      $pay_date = $row['pay_date'];
      $principledd = round($row['principle'], 2);
      $interestdd = round($row['interest'], 2);
      $installmentdd = round($row['installment'], 2);
      $balance = round($row['balance'], 2);
      $status = $row['status'];

      array_push(
        $response,
        array(
          'payment_no' => $pay_number,
          'payment_date' => $pay_date,
          'principle' => $principledd,
          'interest' => $interestdd,
          'installment' => $installmentdd,
          'balance' => $balance,
          'status' => $status
        )
      );
    }
    array_push(
      $response2,
      array(
        'paymentdate_dd' => $pay_dateadd,
        'installment_dd' => $installmentadd,
        'balance_dd' => $ourbalance,
        'disbur_date' => $dismb_date,
        'table_items' => $response
      )
    );
  }
*/
echo json_encode($response);
/*} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}*/
mysqli_close($conn);

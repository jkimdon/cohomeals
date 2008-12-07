<?php
include_once 'includes/init.php';

print_header();

$meal_id = 0;
$meal_id = mysql_safe( getGetValue( 'meal_id' ), false );

if ( paperwork_done( $id ) ) {

  $sql = "SELECT cal_date, cal_time, cal_suit FROM webcal_meal WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    $row = dbi_fetch_row( $res );
    echo "<h1>Meal finance summary for the " . $row[2] . 
      " meal on " . date_to_str( $row[0], "", true, false, $row[1] ) .
      " at " . display_time( $row[1] ) . "</h1>\n";

    
    //// expenses
    $expenses = 0;

    $sql2 = "SELECT cal_amount FROM webcal_food_expenditures " .
      "WHERE cal_meal_id = $id";
    $shoppers = 0;
    if ( $res2 = dbi_query( $sql2 ) ) {
      while ( $row2 = dbi_fetch_row( $res2 ) ) 
	$shoppers += $row2[0];
    }
    $expenses += $shoppers;


    /// farmer's market
    $sqlID = "SELECT cal_food_id FROM webcal_pantry_food WHERE cal_description = 'farmers market'";
    if ( $resID = dbi_query( $sqlID ) ) {
      if ( $rowID = dbi_fetch_row( $resID ) ) 
	$food_id = $rowID[0];
    }
    $sql2 = "SELECT cal_total_price FROM webcal_pantry_purchases " .
      "WHERE cal_meal_id = $id AND cal_food_id = $food_id";
    $farmer = 0;
    if ( $res2 = dbi_query( $sql2 ) ) {
      if ( $row2 = dbi_fetch_row( $res2 ) ) 
	$farmer += $row2[0];
    }


    /// flat rate
    $sqlID = "SELECT cal_food_id FROM webcal_pantry_food WHERE cal_description = 'flat rate'";
    if ( $resID = dbi_query( $sqlID ) ) {
      if ( $rowID = dbi_fetch_row( $resID ) ) 
	$food_id = $rowID[0];
    }
    $sql2 = "SELECT cal_total_price FROM webcal_pantry_purchases " .
      "WHERE cal_meal_id = $id AND cal_food_id = $food_id";
    $flatrate = 0;
    if ( $res2 = dbi_query( $sql2 ) ) {
      if ( $row2 = dbi_fetch_row( $res2 ) ) 
	$flatrate += $row2[0];
    }


    $sql2 = "SELECT cal_total_price FROM webcal_pantry_purchases " .
      "WHERE cal_meal_id = $id";
    $pantry = 0;
    if ( $res2 = dbi_query( $sql2 ) ) {
      while ( $row2 = dbi_fetch_row( $res2 ) ) 
	$pantry += $row2[0];
    }
    $expenses += $pantry;
    $pantry -= $farmer;
    $pantry -= $flatrate;


    /// income
    $income = get_money_for_meal( $id );

    // walkins part of income
    $walkin_income = 0;
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_walkin = 1 " .
      "AND ( cal_type = 'M' OR cal_type = 'T' )";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
    	$walkin_user = $row[0];
	$walkin_income += get_price( $id, $walkin_user );
      }
    }
    $sql = "SELECT cal_fee FROM webcal_meal_guest " .
      "WHERE cal_meal_id = $id AND cal_walkin = 1";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
    	$fee = $row[0];
	$walkin_income += get_adjusted_price( $id, $fee, true );
      }
    }

    $remaining_income = $income - $walkin_income;


    ////
    $difference = $income - $expenses;


    ////
    ?>
      <table>
	 <tr><td><b>Income</b>:</td><td></td><td></td><td></td></tr>
	 <tr><td></td><td>Regular signups</td><td><?php echo price_to_str($remaining_income);?></td><td></td></tr>
	 <tr><td></td><td>Walkins</td><td><?php echo price_to_str($walkin_income);?></td><td></td></tr>
 	 <tr><td></td><td>Total income</td><td></td><td><?php echo price_to_str( $income );?></td></tr>
         <tr><td><b>Expenses</b>:</td><td></td><td></td><td></td></tr>
         <tr><td></td><td>Shoppers</td><td><?php echo price_to_str($shoppers);?></td><td></td></tr>
         <tr><td></td><td>Farmer`s market</td><td><?php echo price_to_str($farmer);?></td><td></td></tr>
         <tr><td></td><td>Flat rate spices</td><td><?php echo price_to_str($flatrate);?></td><td></td></tr>
         <tr><td></td><td>Pantry purchases</td><td><?php echo price_to_str($pantry);?></td><td></td></tr>
         <tr><td></td><td>Total expenses</td><td></td><td><?php echo price_to_str($expenses);?></td></tr>
	 <tr><td><b>Difference</b>:</td><td></td><td></td><td><?php echo price_to_str($difference);?></td></tr>
      </table>


<p>  *** Remember to submit a reimbursement form to Valerie along with your receipts. Form is below for reference. ***</p>
    <table>
      <tr class="d0">
      <td>Reimbursement form:</td>
      <td><a class="addbutton" href="refs/Reimbursement.pdf">pdf</a></td>
      <td><a class="addbutton" href="refs/Reimbursement.xls">excel</a></td>
      <td><a class="addbutton" href="refs/Reimbursement.doc">doc</a></td>
      </tr>
    </table>
    <?php


  } else {
    echo "error<br>";
  }

} else {
  echo "Paperwork has not yet been done for this meal.<br>";
}


print_trailer ();
?>
</body>
</html>

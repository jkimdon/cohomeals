<?php
include_once 'includes/init.php';

print_header();

$id = 0;
$id = mysql_safe( getValue( 'meal_id' ), false );

if ( !paperwork_done( $id ) ) {

  /// this is a form with a bunch of hidden inputs to pass the info back to the previous page to edit if necessary or to submit if user is happy
  ?>
  <form action="summaryEditOrSubmit.php" method="post">
  <input type="hidden" name="meal_id" value="<?php echo $id;?>"/>

  <?php 
  $names = user_get_users();
  $num_walkins = 0;
  $walkins_adult = 0;
  $walkins_kid = 0;
  $walkins_free = 0;
  $walkin_income = 0;
  $adult_diner_equivalent = 0.0; // for calculating per-adult cost
  foreach ( $names as $name ) {
    $username = $name['cal_login'];
    $value = getValue( $username );
    echo "<input type=\"hidden\" name=\"$username\" value=\"$value\"/>";
    if ( $value ) {
      $num_walkins++;
      $walkin_income += get_price( $id, $username, true );

      $age = get_fee_category( $id, $username );
      if ( $age == 'A' ) { 
	$adult_diner_equivalent += 1.0;
	$walkins_adult++;
      }
      else if ( $age == 'K' ) {
	$adult_diner_equivalent += 0.5;
	$walkins_kid++;
      }
      else $walkins_free++;
    }
  }

  $num_newguests = 0;
  for ( $i=0; $i<7; $i++ ) {
    $key = "newguest$i";
    if ( $guest_name = getValue( $key ) ) {
      $key = "host$i";
      $host = getValue( $key );
      $key = "fee$i";
      $fee_class = getValue( $key );
      echo "<input type=\"hidden\" name=\"newguest$i\" value=\"$guest_name\"/>";
      echo "<input type=\"hidden\" name=\"host$i\" value=\"$host\"/>";
      echo "<input type=\"hidden\" name=\"fee$i\" value=\"$fee_class\"/>";
      $num_newguests++;
      $walkin_income += get_adjusted_price( $id, $fee_class, true );

      if ( $fee_class == 'A' ) {
	$adult_diner_equivalent += 1.0;
	$walkins_adult++;
      }
      else if ( $fee_class == 'K' ) {
	$adult_diner_equivalent += 0.5;
	$walkins_kid++;
      }
      else $walkins_free++;
    }
  }


  $expenses = 0;
  $expenses_shoppers = 0;
  for ( $i=0; $i<4; $i++ ) {
    $key = "shopper$i";
    $shopper = getValue( $key );
    if ( $shopper != 'none' ) {
      $key = "vendor$i";
      $vendor = getValue( $key );
	
      $key = "dollars$i";
      $dollars = getValue( $key );
	
      $key = "cents$i";
      $cents = getValue( $key );

      $amount = 100*$dollars + $cents;
      $expenses += $amount;
      $expenses_shoppers += $amount;

      echo "<input type=\"hidden\" name=\"shopper$i\" value=\"$shopper\"/>";      
      echo "<input type=\"hidden\" name=\"vendor$i\" value=\"$vendor\"/>";
      echo "<input type=\"hidden\" name=\"dollars$i\" value=\"$dollars\"/>";
      echo "<input type=\"hidden\" name=\"cents$i\" value=\"$cents\"/>";
    }
  }

  $farmersDollars = getValue( "farmersDollars" );
  $farmersCents = getValue( "farmersCents" );
  $expenses_farmer = $farmersDollars*100 + $farmersCents;
  $expenses += $expenses_farmer;
  echo "<input type=\"hidden\" name=\"farmersmarket\" value=\"$expenses_farmer\"/>";	



  /// pantry flat rate addition
  $diners = 0;
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $diner_login = $row[0];
      $diners++;
      $age = get_fee_category( $id, $diner_login );
      if ( $age == 'A' ) $adult_diner_equivalent += 1.0;
      else if ( $age == 'K' ) $adult_diner_equivalent += 0.5;
    }
  }
  $sql = "SELECT cal_fee FROM webcal_meal_guest " .
    "WHERE cal_meal_id = $id AND (cal_type = 'M' OR cal_type = 'T')";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $age = $row[0];
      $diners++;
      if ( $age == 'A' ) $adult_diner_equivalent += 1.0;
      else if ( $age == 'K' ) $adult_diner_equivalent += 0.5;
    }
  }
  $diners += $num_walkins;
  $flatrate_cents = 10 * $diners;
  $expenses += $flatrate_cents;
  echo "<input type=\"hidden\" name=\"flatrate\" value=\"$flatrate_cents\"/>";
  

  /// pantry items

  $pantry_description = "";
  $expenses_pantry = 0;
  $sql = "SELECT cal_food_id " . 
	 "FROM webcal_pantry_food WHERE cal_available_meals = 1";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $food_id = $row[0];

      $key = "amount$food_id";
      $amount = getValue( $key );

      if ( $amount != 0 ) {

	$sql2 = "SELECT cal_unit_price, cal_unit, cal_description FROM webcal_pantry_food " .
	  "WHERE cal_food_id = $food_id";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  while ( $row2 = dbi_fetch_row( $res2 ) ) {
	    $price = $row2[0] * $amount;
	    $pantry_description .= $amount . " " . $row2[1] . "(s) " . $row2[2] . ". ";
	    $expenses_pantry += $price;
	    $expenses += $price;

	    echo "<input type=\"hidden\" name=\"amount$food_id\" value=\"$amount\"/>";
	  }
	}

      }
    }
  }



  // end passthrough variables (also are used in the following summary preview)


  $sql = "SELECT cal_date, cal_time, cal_suit, cal_base_price " .
    "FROM webcal_meal WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    $row = dbi_fetch_row( $res );
    $base_price = $row[3];
    echo "<h1><font color=\"#DD0000\">Please confirm</font> this info:</h1>\n";

    echo "<h1>Meal finance summary for the " . $row[2] . 
      " meal on " . date_to_str( $row[0], "", true, false, $row[1] ) .
      " at " . display_time( $row[1] ) . "</h1>\n";





    ///////////    
    //// expenses /////

    /// farmer's market, shoppers, pantry, flat rate purchases calculated above as $expenses


    ///////////
    /// income
    $income = get_money_for_meal( $id );

    $regular_signup_income = $income;
    $income += $walkin_income;





    ///////////
    //// net
    $difference = $income - $expenses;


    ///////////
    /// per person
    $per_person = $expenses / $adult_diner_equivalent;


    ///////////
    //// display
    ?>
      <table>
	 <tr><td><b>Income</b>:</td><td></td><td></td><td></td></tr>
	 <tr><td></td><td>Diners signed up before meal summary</td>
 	     <td><?php echo price_to_str($regular_signup_income);?></td>
             <td>(<?php echo demographics($id);?>)</td></tr>
	 <tr><td></td><td>Walkins signed up during meal summary</td><td><?php echo price_to_str($walkin_income);?></td><td>
	<?php echo "($walkins_adult adults, $walkins_kid older children, $walkins_free younger children)";?></td></tr>
 	 <tr><td></td><td>Total income</td><td></td><td><?php echo price_to_str( $income );?></td></tr>
         <tr><td><b>Expenses</b>:</td><td></td><td></td><td></td></tr>
         <tr><td></td><td>Shoppers</td><td><?php echo price_to_str($expenses_shoppers);?></td><td></td></tr>
         <tr><td></td><td>Farmer`s market cards</td><td><?php echo price_to_str($expenses_farmer);?></td><td></td></tr>
         <tr><td></td><td>Flat rate spices</td><td><?php echo price_to_str($flatrate_cents);?></td><td></td></tr>
         <tr><td></td><td>Pantry purchases</td><td><?php echo price_to_str($expenses_pantry);?></td><td><?php echo $pantry_description;?></td></tr>
         <tr><td></td><td>Total expenses</td><td></td><td><?php echo price_to_str($expenses);?></td></tr>
	 <tr><td><b>Difference</b>:</td><td></td><td></td><td><?php echo price_to_str($difference);?></td></tr>
	 <tr><td><b>Per adult cost</b>:</td><td></td><td><?php echo price_to_str($per_person);?></td><td>(charged <?php echo price_to_str($base_price);?>)</td></tr>
      </table>


    <table>
      <tr class="d0">
      <td><h2><font color="#DD0000">Please select:</font></h2></td>
      <td><input class="addbutton" type="submit" name="editorsubmit" value="Edit"/>
      <td><input class="addbutton" type="submit" name="editorsubmit" value="Submit"/>
      </tr>
    </table>
    <?php


  } else {
    echo "error<br>";
  }
    
} else {
  $nexturl = "display_meal_summary.php?id=$id";
  do_redirect( $nexturl );
}


print_trailer ();
?>
</body>
</html>

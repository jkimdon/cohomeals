<?php
include_once 'includes/init.php';

print_header();

$meal_id = 0;
$meal_id = mysql_safe( getValue( 'meal_id' ), false );


if ( $is_meal_coordinator || is_chef( $meal_id, $login ) ) {
  if ( paperwork_done( $meal_id ) ) {
    echo "Paperwork for this meal has been completed.<br>";
  } else {
    ?><form action="confirm_meal_summary.php" method="post">
      <input type="hidden" name="meal_id" value="<?php echo $meal_id;?>"/>

    <?php



    /// title
    $sql = "SELECT cal_date, cal_time, cal_suit FROM webcal_meal " .
      "WHERE cal_id = $meal_id";
    $res = dbi_query( $sql );
    if ( $row = dbi_fetch_row( $res ) ) {
      $date = $row[0];
      $time = $row[1];
      $suit = $row[2];
      echo "<h1>Meal summary for $suit meal on " . date_to_str( $date, "", true, false, $time ) .
	" at " . display_time( $time ) . "</h1>";
    }



    ///////////
    echo "<h3>Step 1: Who came?</h3>";
    echo "Please put a check next to any walkins.<br>";
    $names = user_get_users();
    $prev_building = 0;


    echo "<table>";
    foreach ( $names as $name ) {
      $username = $name['cal_login'];
      $building = $name['cal_building'];
      if ( $building != $prev_building ) {
	if ( ($building <= 9) && ($building > 0) ) 
	  echo "<tr><td width=\"8%\"></td><td><b>Building " . $building . "</b></td></tr>";
	else 
	  echo "<tr><td></td><td><b>Additional meal plan participants</b></td></tr>";
	$prev_building = $building;
      }

      // check dining status
      $status = is_dining( $meal_id, $username );
      $full_name = $name['cal_fullname'];
      if ( ($status == "M") || ($status == "T") ) {
	echo "<tr><td></td><td>" .
	  "<input type=\"checkbox\" name=\"$username\" disabled>$full_name</input></td></tr>";
      } else {
	// if the user is editing the meal summary, walkin might be checked
	$walkin = getValue( $username );
	if ( $walkin == true ) 
	  echo "<tr><td></td><td>" .
	    "<input type=\"checkbox\" name=\"$username\" checked>$full_name</input></td></tr>";
	else 
	  echo "<tr><td></td><td>" .
	    "<input type=\"checkbox\" name=\"$username\">$full_name</input></td></tr>";
      }

    }
    echo "</table>";



    echo "<p></p>Guests:<br>";

    $sql = "SELECT cal_fullname, cal_host " .
      "FROM webcal_meal_guest " .
      "WHERE cal_meal_id = $meal_id " . 
      "AND (cal_type = 'M' OR cal_type = 'T')";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$guest_name = $row[0];
	$host = $row[1];

	user_load_variables( $host, "temp" );
	echo "$guest_name (guest of $tempfirstname $templastname)";

      }
      dbi_free_result( $res );

      echo "<table>";
      echo "<tr><td width=8%><td>Guest full name</td><td></td><td>Host</td></tr>";
      $count++;
      for ( $i=$count; $i<7; $i++ ) {
	// if editing, guest may be entered already
	$key = "newguest$i";
	if ( $guest_name = mysql_safe( getValue( $key ), true ) ) {
	  $key = "host$i";
	  $host = mysql_safe( getValue( $key ), true );
	  $key = "fee$i";
	  $fee_class = mysql_safe( getValue( $key ), true );
	} else {
	  $host = "none";
	  $fee_class = "A";
	}
	echo "<tr><td></td><td>" .
	  "<input type=\"text\" name=\"newguest$i\" size=\"30\" " .
	  "value=\"$guest_name\" maxlength=\"50\"/></td>";


	echo "<td><select name=\"fee$i\">";

	echo "<option value=\"A\" ";
	if ( $fee_class == "A" ) echo "selected=\"selected\"";
	echo ">Adult</option>";

	echo "<option value=\"F\" ";
	if ( $fee_class == "F" ) echo "selected=\"selected\"";
	echo ">No cost (default for ages 0-9)</option>";

	echo "<option value=\"Q\" ";
	if ( $fee_class == "Q" ) echo "selected=\"selected\"";
	echo ">Quarter-price (optional for kids)</option>";

	echo "<option value=\"K\" ";
	if ( $fee_class == "K" ) echo "selected=\"selected\"";
	echo ">Half-price (default for ages 10-12)</option>";

	echo "<option value=\"T\" ";
	if ( $fee_class == "T" ) echo "selected=\"selected\"";
	echo ">Three-quarters-price (optional for kids)</option>";

	  ?>

        </select></td>

        <?php

	echo "<td><select name=\"host$i\">";
	echo "<option value=\"none\" ";
	if ( $host == 'none' ) echo "selected=\"selected\"";
	echo ">Select host</option>";
	$names = user_get_users();
	foreach ( $names as $name ) {
	  $username = $name['cal_login'];
	  $fullname = $name['cal_fullname'];
	  echo "<option value=\"$username\" ";
	  if ( $host == $username ) echo "selected=\"selected\"";
	  echo ">$fullname</option>\n";
	}
	echo "</select></td>";

	echo "</tr>";
      }
      echo "</table>";

    }


    

    ///////////
    ?>
    <h3>Step 2: What did you spend?</h3>
       
    <p>A) How much was spent by your shopper(s)? (To be reimbursed)</p>
    <table>
    <tr>
    <td width=8%></td>
    <td>Shopper name (sorted by building)</td>
    <td colspan="2">Amount</td>
    <td>Vendor</td>
    </tr>

    <tr>
    <td></td>
    <?php
    for ( $i=0; $i<4; $i++ ) {
      // if editing, enter previously entered values
      $key = "shopper$i";
      $shopper = mysql_safe( getValue( $key ), true );
      if ( $shopper != 'none' ) {
	$key = "vendor$i";
	$vendor = mysql_safe( getValue( $key ), true );
	
	$key = "dollars$i";
	$dollars = mysql_safe( getValue( $key ), true );
	
	$key = "cents$i";
	$cents = mysql_safe( getValue( $key ), true );
	
      } else {
	$vendor = "";
	$dollars = "";
	$cents = "";
      }


      echo "<tr><td></td>";
      echo "<td><select name=\"shopper$i\">";
      if ( $shopper == 'none' ) $selected = "selected=\"selected\"";
      else $selected = "";
      echo "<option value=\"none\" $selected>Select shopper</option>";
      $names = user_get_users();
      foreach ( $names as $name ) {
	$username = $name['cal_login'];
	$fullname = $name['cal_fullname'];
	if ( $shopper == $username ) $selected = "selected=\"selected\"";
	else $selected = "";

	echo "<option value=\"$username\" $selected>$fullname</option>\n";
      }
      echo "</select></td>";
      echo "<td>$<input type=\"text\" name=\"dollars$i\" size=\"2\" value=\"$dollars\" /></td>";
      echo "<td>.<input type=\"text\" name=\"cents$i\" size=\"2\" value=\"$cents\" /></td>";
      echo "<td><input type=\"text\" name=\"vendor$i\" size=\"15\" maxlength=\"50\" value=\"$vendor\" /></td>";
      echo "</tr>";
    }

    ?>
    </table>
    

    <?php // farmers market cards
    $farmersmarket = mysql_safe( getValue( 'farmersmarket' ), false );
    $farmersDollars = 0; // integer
    $farmersCents = 0; // integer
    if ( ($farmersmarket != "") && ($farmersmarket > 0) ) {
      $farmersDollars = (integer) ($farmersmarket / 100);
      $farmersCents = $farmersmarket - ($farmersDollars*100);
    }
    ?>

    <p>B) How much was spent using the Farmer\'s Market cards?
    $<input type="text" name="farmersDollars" size="2" value=<?php echo "\"$farmersDollars\"";?>/>.
    <input type="text" name="farmersCents" size="2" value=<?php echo "\"$farmersCents\"";?>/>

    <p>C) How much of each pantry item did you use? *** Enter in decimal form (NO fractions) ***</p>
    <table>
    

    <?php 
    $sql = "SELECT cal_category, cal_food_id, cal_description, cal_unit " . 
     "FROM webcal_pantry_food WHERE cal_available_meals = 1 " .
     "ORDER BY cal_category, cal_description";
    $prev_category = "";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$category = $row[0];
	$food_id = $row[1];
	$food = $row[2];
	$unit = $row[3];

	if ( $category != $prev_category ) {
	  echo "<tr class=\"n1\"><td>&nbsp;&nbsp;&nbsp;</td><td><b>$category</b></td><td></td></tr>";
	  $prev_category = $category;
	}

	$key = "amount$food_id";
	$amount = getValue( $key ) * 100;
	$amount_safe = mysql_safe( $amount, false ) / 100.00;
	if ( $amount_safe == 0 ) $amount_safe = "";

	echo "<tr><td></td><td></td><td>$food:" .
	  "&nbsp; <input type=\"text\" name=\"amount" . $food_id . "\" value=\"$amount_safe\" size=\"5\" maxlength=\"8\"/>&nbsp;" .
	  $unit . "(s)</td></tr>";
      }
    }
    echo "</table>";


    ///////////
    echo "<h3>Step 3: <input type=\"submit\" value=\"Next page\"/></h3>";


    echo "</form>";
  }
} else { echo "Not authorized<br>"; }

print_trailer ();
?>
</body>
</html>

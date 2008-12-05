<?php
include_once 'includes/init.php';



if ( $is_meal_coordinator ) {

  $temp_change = mysql_safe( getValue( "temp_change" ), false );

  $day_of_week = mysql_safe( getValue( "dayofweek" ), false );
  $which_week = mysql_safe( getValue( "whichweek" ), false );
  $hour = mysql_safe( getValue( "hour" ), false );
  $minute = mysql_safe( getValue( "minute" ), false );
  $ampm = mysql_safe( getValue( "ampm" ), true );
  if ( $ampm == "pm" ) $hour += 12;
  $suit = mysql_safe( getValue( "suit" ), true );
  $base_dollars = mysql_safe( getValue( "base_dollars" ), true );
  $base_cents = mysql_safe( getValue( "base_cents" ), true );
  $base_price = 100*$base_dollars + $base_cents;
  $menu = mysql_safe( getValue( "menu" ), true );
  $head_chef = mysql_safe( getValue( "head_chef" ), true );
  for ( $i=0; $i<7; $i++ ) {
    $j = 2*$i;
    $crew[$j] = "";
    $key = "job$i";
    $crew[$j] = mysql_safe( getValue( $key ), true );
    $j++;
    $crew[$j] = "none";
    $key = "crew$i";
    $crew[$j] = mysql_safe( getValue( $key ), true );
  }
  $all_crew = implode( "&", $crew );



  //// check to see if this is a change or an add
  $sql = "SELECT cal_suit FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
    "AND cal_temp_change = $temp_change";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $sql2 = "UPDATE webcal_standard_meals SET " .
	"cal_time = " . sprintf ( "%02d%02d00, ", $hour, $minute ) .
	"cal_suit = '$suit' " .
	", cal_base_price = $base_price" . 
	", cal_menu = '$menu' " .
	", cal_head_chef = '$head_chef'" .
	", cal_regular_crew = '$all_crew'" . 
	"WHERE cal_day_of_week = $day_of_week " .
	"AND cal_which_week = $which_week " . 
	"AND cal_temp_change = $temp_change";
      $res2 = dbi_query( $sql2 );
    }
    else { // new entry
      $sql2 = "INSERT INTO webcal_standard_meals ( cal_day_of_week, cal_which_week, " .
	"cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, cal_regular_crew, " .
	"cal_temp_change ) " .
	"VALUES ( " .
      	"$day_of_week, $which_week, " . 
      	sprintf ( "%02d%02d00, ", $hour, $minute ) . "'$suit', " .
      	"$base_price, '$menu', '$head_chef', '$all_crew', $temp_change )";
      $res2 = dbi_query( $sql2 );
    }
  }


  if ( $temp_change == 0 ) 
    $nexturl = "add_standard_meals.php";
  else 
    $nexturl = "populate_standard_meals.php?month=$temp_change";

 do_redirect( $nexturl );

 } else {
  echo "Not authorized<br>";
 }



print_header();

print_trailer();
?>
</body>
</html>

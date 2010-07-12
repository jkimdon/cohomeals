<?php
include_once 'includes/init.php';


if ( $is_meal_coordinator ) {

  $day_of_week = mysql_safe( getValue( "day_of_week" ), false );
  $which_week = mysql_safe( getValue( "which_week" ), false );
  $rotation_order = mysql_safe( getValue( "rotation_order" ), false );
  $action = mysql_safe( getValue( "action" ), true );

  if ( $action == 'delete' ) {
    $sql = "DELETE FROM webcal_standard_meals WHERE cal_day_of_week = $day_of_week " .
      "AND cal_which_week = $which_week AND cal_rotation_order = $rotation_order";
    dbi_query( $sql );

    update_rotation_orders( $day_of_week, $which_week );
  } else if ( $action == 'add' ) {
    $this_rotation = 1;
    $sql = "SELECT MAX(cal_rotation_order) FROM webcal_standard_meals " .
      "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
	$this_rotation = $row[0]+1;
      }
    }
    $is_next = 0;
    if ( $this_rotation == 1 ) $is_next = 1;

    $sql = "INSERT INTO webcal_standard_meals " .
      "( cal_day_of_week, cal_which_week, cal_rotation_order, cal_is_next, " .
      " cal_head_chef, cal_time, cal_suit, cal_base_price ) " .
      "VALUES ( $day_of_week, $which_week, $this_rotation, $is_next, " .
      "'none', 180000, 'heart', 350 )";
    dbi_query( $sql );
    
  } else { // 'change'

    $temp_change = mysql_safe( getValue( "temp_change" ), false );

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
    
    
    //// check to see if this meal is actually there
    $sql = "SELECT cal_suit FROM webcal_standard_meals " .
      "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
      "AND cal_rotation_order = $rotation_order " .
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
	  "AND cal_rotation_order = $rotation_order " .
	  "AND cal_temp_change = $temp_change";
	$res2 = dbi_query( $sql2 );
      }
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
?>

<script language="JavaScript" type="text/javascript">
opener.window.location.href = "<?php echo $nexturl;?>";
self.close();
</script>


<?php

function update_rotation_orders( $day_of_week, $which_week ) {
  
  $number_of_meals = 1;
  $sql = "SELECT COUNT(*) FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $number_of_meals = $row[0];
    }
  }

  // make sure there are no skips in the rotation orders
  $sql = "SELECT cal_rotation_order FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
    "ORDER BY cal_rotation_order";
  $rotation_goal = 1;
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $current_rotation = $row[0];
      if ( $current_rotation != $rotation_goal ) { // always setting to a lower number so not overwriting
	$sql = "UPDATE webcal_standard_meals SET cal_rotation_order = $rotation_goal " .
	  "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
	  "AND cal_rotation_order = $current_rotation";
      dbi_query( $sql );
      }      
      $rotation_goal++;
    }
  }


  // make sure some meal is set as next
  $sql = "SELECT cal_head_chef FROM webcal_standard_meals " .
    "WHERE cal_is_next = 1 AND cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
    "AND cal_temp_change = 0";
  $have_next = 0;
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $have_next = 1;
    }
  }
  if ( $have_next == 0 ) {
    $sql = "UPDATE webcal_standard_meals " .
      "SET cal_is_next = 1 " .
      "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
      "AND cal_rotation_order = 1";
    dbi_query( $sql );
  }

}



?>

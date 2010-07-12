<?php
include_once 'includes/init.php';
include_once 'includes/config.php';

load_global_settings();


if ( $is_meal_coordinator ) {

  $day_of_week = mysql_safe( getValue( "day_of_week" ), false );
  $which_week = mysql_safe( getValue( "which_week" ), false );
  $rotation_order = mysql_safe( getValue( "rotation_order" ), false );
  $direction = mysql_safe( getValue( "which_direction" ), true );

  $sql = "SELECT MAX(cal_rotation_order) FROM webcal_standard_meals";
  $max_rotation_order = 1;
  if ( $res = dbi_query( $sql ) ) {
    $row = dbi_fetch_row( $res );
    $max_rotation_order = $row[0];
  }

  $new_rotation_order = $rotation_order;
  if ( $direction == 'earlier' ) $new_rotation_order--;
  else if ( $direction == 'later' ) $new_rotation_order++;
  // else some sort of error, so stay the same
  if ( $new_rotation_order == 0 ) $new_rotation_order = $max_rotation_order;
  if ( $new_rotation_order > $max_rotation_order ) $new_rotation_order = 1;

  $sql = "UPDATE webcal_standard_meals " . 
    "SET cal_rotation_order = 0 " .
    "WHERE cal_which_week = $which_week AND cal_day_of_week = $day_of_week " .
    "AND cal_rotation_order = $rotation_order";
  dbi_query( $sql );

  $sql = "UPDATE webcal_standard_meals " . 
    "SET cal_rotation_order = $rotation_order " .
    "WHERE cal_which_week = $which_week AND cal_day_of_week = $day_of_week " .
    "AND cal_rotation_order = $new_rotation_order";
  dbi_query( $sql );

  $sql = "UPDATE webcal_standard_meals " . 
    "SET cal_rotation_order = $new_rotation_order " .
    "WHERE cal_which_week = $which_week AND cal_day_of_week = $day_of_week " .
    "AND cal_rotation_order = 0";
  dbi_query( $sql );



  $nexturl = "add_standard_meals.php";
  do_redirect( $nexturl );

 } else {
  echo "Not authorized<br>";
 }



print_header();

print_trailer();
?>
</body>
</html>


<?php
include_once 'includes/init.php';
include_once 'includes/config.php';

load_global_settings();


if ( $is_meal_coordinator ) {

  $day_of_week = mysql_safe( getValue( "day_of_week" ), false );
  $which_week = mysql_safe( getValue( "which_week" ), false );
  $rotation_order = mysql_safe( getValue( "rotation_order" ), false );

  $sql = "UPDATE webcal_standard_meals " . 
    "SET cal_is_next = 0 " .
    "WHERE cal_which_week = $which_week AND cal_day_of_week = $day_of_week";
  dbi_query( $sql );

  $sql = "UPDATE webcal_standard_meals " .
    "SET cal_is_next = 1 " .
    "WHERE cal_which_week = $which_week AND cal_day_of_week = $day_of_week " .
    "AND cal_rotation_order = $rotation_order";
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


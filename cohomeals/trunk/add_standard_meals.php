 <?php
include_once 'includes/init.php';

print_header();

if ( $is_meal_coordinator ) {

?>

<h1>Manage regular meals for a month</h1>

<form action="populate_standard_meals.php" method="get">

Manage meals for 
<select name="month">
<?php 
 $m = date( "m" );
 $y = date( "Y" );
 for ( $i=0; $i<10; $i++ ) {
   if ( $m > 12 ) {
     $m = 1;
     $y++;
   }
   $d = mktime ( 3, 0, 0, $m, 1, $y );
   echo "<option value=\"" . date ( "Ymd", $d ) . "\"";
   echo ">";
   echo date_to_str ( date ( "Ymd", $d ), $DATE_FORMAT_MY, false, true );
   echo "</option>\n";
   $m++;
 }
?>
</select>
<input type="submit" value="Go" />
</form>

<hr>
<h3>Regular meals</h3>

<p>Make regular changes here. (Make one-month changes using the above link)</p>





<?php /////////// list of standard meals ////////////////////// 
?>

<table class="bordered_table">
<?php for ( $w=1; $w<6; $w++ ) {
   echo "<tr><td><b>Week $w</td><td></td><td></td></tr>";
   for ( $d=0; $d<7; $d++ ) {
     print_standard_entry( $d, $w );
   }
 }?>
</table>






<?php /////////// form for adding or changing standard meals /////////// 
?>

<p></p><p></p>
<i>Add new or change meal</i><br>
<form action="change_standard_meals_handler.php" method="post">

<input type="hidden" name="temp_change" value="0" />

<?php change_standard_meal_form(); ?>

</form>






<?php

    } else echo "Not authorized";


print_trailer ();
?>
</body>
</html>

<?php 
function print_standard_entry( $thiswday, $which_week ) {

  // get meals for this weekday for this week
  $sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, cal_regular_crew " .
    "FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $thiswday AND cal_which_week = $which_week " .
    "AND cal_temp_change = 0 " .
    "ORDER BY cal_time";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      echo "<tr><td></td><td>" . weekday_short_name ( $thiswday ) . "</td>";
      echo "<td>";

      $time = $row[0];
      $suit = $row[1];
      $price = $row[2];
      $menu = $row[3];
      $head_chef = $row[4];
      $crew = explode( "&", $row[5] );
    
      $suit_img = $suit;
      $suit_img .= "_20x20.png";
      echo "<img width=\"20\" border=\"0\"" . 
	"src=\"images/$suit_img\" />";

      $timestr = "";
      $timestr = display_time ( $time );
      $time_short = preg_replace ("/(:00)/", '', $timestr);
      echo "&nbsp;" . $time_short;
      
      echo "&nbsp;" . price_to_str( $price ) . "<br>";

      echo "<b>chef:</b> ";
      if ( $head_chef != "none" ) {
	user_load_variables( $head_chef, "temp" );
	echo ": " . $GLOBALS[tempfirstname] . " " . $GLOBALS[templastname];
      }
      echo "<br>";

      echo "<b>menu:</b> " . $menu . "<br>";

      echo "<b>crew:</b> <br>";
      for ( $i=0; $i<count($crew); $i++ ) {
	if ( $crew[$i] == "" ) break;
	echo $crew[$i];
	$i++;
	$person = $crew[$i];
	if ( $person != "none" ) {
	  user_load_variables( $person, "temp" );
	  echo " = " . $GLOBALS[tempfirstname] . " " . $GLOBALS[templastname];
	}
	else echo " = ";
	echo "<br>";
      }
      echo "</td></tr>";

    }
  }

}

?>






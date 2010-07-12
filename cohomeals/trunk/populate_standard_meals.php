<?php
include_once 'includes/init.php';

print_header();

if ( $is_meal_coordinator ) {

$month_date = 0;
$month_date = mysql_safe( getValue( "month" ), true );


echo "<h1>Populate regular meals for " .
  date_to_str ( $month_date, $DATE_FORMAT_MY, false ) . 
  "</h1>";

?>

<p>This is what the month looks like. Make changes below first before populating.</p>





<?php /////////// table of current month's modified standard meals /////////// 
?>

<table class="bordered_table">
<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
</tr>
<?php

// We add 2 hours on to the time so that the switch to DST doesn't
// throw us off.  So, all our dates are 2AM for that day.
$thisyear = substr( $month_date, 0, 4 );
$thismonth = substr( $month_date, 4, 2 );
$wkstart = get_sunday_before ( $thisyear, $thismonth, 1 );

// generate values for first day and last day of month
$monthstart = mktime ( 3, 0, 0, $thismonth, 1, $thisyear );
$monthend = mktime ( 3, 0, 0, $thismonth + 1, 0, $thisyear );


$which_week = 1;
$day_count = 0;
for ( $i = $wkstart; date ( "Ymd", $i ) <= date ( "Ymd", $monthend ); $i += ( 24 * 3600 * 7 ) ) {
  print "<tr>\n";

  for ( $j = 0; $j < 7; $j++ ) { // step through a week
    $date = $i + ( $j * 24 * 3600 );
    if ( date ( "Ymd", $date ) >= date ( "Ymd", $monthstart ) &&
         date ( "Ymd", $date ) <= date ( "Ymd", $monthend ) ) {
      if ( $day_count == 7 ) {
	$which_week++;
	$day_count = 0;
      }
      $day_of_week = date ( "w", $date );
      print "<td";
      $class = "";
      if ( date ( "Ymd", $date  ) == date ( "Ymd", $today ) ) {
        $class = "today";
      }
      if ( strlen ( $class ) )  {
      echo " class=\"$class\"";
      }
      echo ">";
      print_standard_entries ( date( "Ymd", $date ), $day_of_week, $which_week );
      print "</td>\n";
      $day_count++;
    } else {
      print "<td>&nbsp;</td>\n";
    }
  }
  print "</tr>\n";
}
?></table>
<br />



<?php /////////// do the populations ///////////

?>

<hr>

<a class="addbutton" href="populate_standard_meals_handler.php?month=<?php echo $month_date;?>&addpeople=0">Populate meals only</a> 
OR 
    <a class="addbutton" href="populate_standard_meals_handler.php?month=<?php echo $month_date;?>&addpeople=1">Populate meals and chefs</a>

<hr>




<?php 

} else echo "Not authorized";

print_trailer ();
?>
</body>
</html>


<?php 

function print_standard_entries( $date, $day_of_week, $which_week ) {

  $day = substr( $date, 6, 2 );
  echo "$day<br />\n";

  // find out if there's a temporary change for this month
  $temp_change = 0;
  $month_regex = substr( $date, 0, 6 );
  $month_regex .= "%";
  $sql = "SELECT cal_temp_change FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
    "AND cal_temp_change LIKE '$month_regex'";

  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $temp_change = $row[0];
    }
  }

  // get meals for this weekday for this week
  $sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, " .
    "cal_regular_crew, cal_rotation_order " .
    "FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = '$day_of_week' AND cal_which_week = $which_week ";
  if ( $temp_change == 0 ) $sql .= "AND cal_temp_change = 0 AND cal_is_next = 1 ";
  else $sql .= "AND cal_temp_change = $temp_change ";
  $sql .= "ORDER BY cal_time";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $time = $row[0];
      $suit = $row[1];
      $price = $row[2];
      $menu = $row[3];
      $head_chef = $row[4];
      $crew = explode( "&", $row[5] );
      $rotation_order = $row[6];
    
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
      if ( $head_chef == "none" ) echo " none";
      else {
	user_load_variables( $head_chef, "temp" );
	echo $GLOBALS[tempfirstname] . " " . $GLOBALS[templastname];
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

      print_change_button( $day_of_week, $which_week, $rotation_order, $temp_change, $date );


    }
  }

}


function print_change_button( $day_of_week, $which_week, $rotation_order, $temp_change, $date ) {

  $nexturl = "change_standard_meal_popup.php?day_of_week=$day_of_week&which_week=$which_week&rotation_order=$rotation_order&prev_temp_change=$temp_change&new_temp_change=$date";
  echo "<a href class=\"addbutton\" " .
    "onclick=\"window.open('$nexturl', 'Change standard meal', " .
    "'width=700,height=600,resizable=yes,scrollbars=yes');\">" .
    "Edit meal</a>&nbsp;&nbsp;&nbsp;";
}

?>

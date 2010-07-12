 <?php
include_once 'includes/init.php';

print_header();

if ( $is_meal_coordinator ) {

  $change_which_day = mysql_safe( getValue( "day_of_week" ), false );
  $change_which_week = mysql_safe( getValue( "which_week" ), false );
  $change_rotation = mysql_safe( getValue( "rotation_order" ), false );

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

<hr/>
<h3>Regular meals</h3>

<p>Make regular changes here. (Make one-month changes using the above link)</p>





<?php /////////// list of standard meals ////////////////////// 
?>

<table class="bordered_table">
<?php for ( $w=1; $w<6; $w++ ) {
   echo "<tr><td><b>Week $w</b></td><td></td><td></td></tr>\n";
   for ( $d=0; $d<7; $d++ ) {
     print_standard_entry( $d, $w );
   }
 }?>
</table>



<p/>

<?php

    } else echo "Not authorized";


print_trailer ();
?>
</body>
</html>

<?php 
function print_standard_entry( $day_of_week, $which_week ) {

  echo "<tr><td></td><td>" . weekday_short_name ( $day_of_week ) . "</td>\n";
  echo "<td>\n<table><tr>";

  // get meals for this weekday for this week
  $sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, " .
    "cal_regular_crew, cal_rotation_order, cal_is_next " .
    "FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
    "AND cal_temp_change = 0 " .
    "ORDER BY cal_rotation_order";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {

      $time = $row[0];
      $suit = $row[1];
      $price = $row[2];
      $menu = $row[3];
      $head_chef = $row[4];
      $crew = explode( "&", $row[5] );
      $rotation_order = $row[6];
      $is_next = $row[7];

      if ( $is_next == 1 ) echo "<td bgcolor=yellow>";
      else echo "<td>";

      print_single_entry( $time, $suit, $price, $menu, $head_chef, $crew );

      if ( $is_next != 1 ) print_make_next( $day_of_week, $which_week, $rotation_order );
      echo "<br/>\n";
      echo "Rotation number = $rotation_order. Set to be:<br/>";
      print_earlier_rotation( $day_of_week, $which_week, $rotation_order );
      print_later_rotation( $day_of_week, $which_week, $rotation_order );

      echo "<br/>\n";
      print_delete_button( $day_of_week, $which_week, $rotation_order );
      echo "<br/>\n";
      
      print_change_button( $day_of_week, $which_week, $rotation_order );
      
      echo "</td>\n";
    }
  }

  echo "<td>";
  print_add_button( $day_of_week, $which_week );
  echo "</td>\n";

  echo "\n</tr>";
  echo "</table>\n</td>\n</tr>\n";

}


function print_single_entry( $time, $suit, $price, $menu, $head_chef, $crew ) {

  $suit_img = $suit;
  $suit_img .= "_20x20.png";
  echo "<img width=\"20\" border=\"0\"" . 
    "src=\"images/$suit_img\" />";
  
  $timestr = "";
  $timestr = display_time ( $time );
  $time_short = preg_replace ("/(:00)/", '', $timestr);
  echo "&nbsp;" . $time_short;
  
  echo "&nbsp;" . price_to_str( $price ) . "<br/>\n";
  
  echo "<b>chef:</b> ";
  if ( $head_chef != "none" ) {
    user_load_variables( $head_chef, "temp" );
    echo ": " . $GLOBALS[tempfirstname] . " " . $GLOBALS[templastname];
  }
  echo "<br/>\n";
  
  echo "<b>menu:</b> " . $menu . "<br/>\n";
  
  echo "<b>crew:</b> <br/>";
  for ( $i=0; $i<count($crew); $i++ ) {
    if ( $crew[$i] == "" ) break;
    echo $crew[$i];
    $i++;
    $person = $crew[$i];
    echo " = ";
    if ( $person != "none" ) {
      if ( user_load_variables( $person, "temp" ) == true ) 
	echo $GLOBALS[tempfirstname] . " " . $GLOBALS[templastname];
      else 
	echo "invalid username";
    }
    echo "<br/>\n";
  }

}


function print_make_next( $day_of_week, $which_week, $rotation_order ) {
  ?>
  <form action="change_standard_meal_next_handler.php" method="post" name="isNextChange">

  <input type="hidden" name="day_of_week" value="<?php echo $day_of_week;?>" />
  <input type="hidden" name="which_week" value="<?php echo $which_week;?>" />
  <input type="hidden" name="rotation_order" value="<?php echo $rotation_order;?>" />  

  <input type="submit" value="Change to be assigned next" />
  </form>
  <?php
}



function print_earlier_rotation( $day_of_week, $which_week, $rotation_order ) {
  ?>
  <form action="change_standard_meal_rotation_handler.php" method="post" name="rotationChange">

  <input type="hidden" name="day_of_week" value="<?php echo $day_of_week;?>" />
  <input type="hidden" name="which_week" value="<?php echo $which_week;?>" />
  <input type="hidden" name="rotation_order" value="<?php echo $rotation_order;?>" />  
  <input type="hidden" name="which_direction" value="earlier" />  

  <input type="submit" value="Earlier" />
  </form>
  <?php
}


function print_later_rotation( $day_of_week, $which_week, $rotation_order ) {
  ?>
  <form action="change_standard_meal_rotation_handler.php" method="post" name="rotationChange">

  <input type="hidden" name="day_of_week" value="<?php echo $day_of_week;?>" />
  <input type="hidden" name="which_week" value="<?php echo $which_week;?>" />
  <input type="hidden" name="rotation_order" value="<?php echo $rotation_order;?>" />  
  <input type="hidden" name="which_direction" value="later" />  

  <input type="submit" value="Later" />
  </form>
  <?php
}



function print_delete_button( $day_of_week, $which_week, $rotation_order ) {
  ?>
  <form action="change_standard_meals_handler.php" method="post" name="rotationChange">

  <input type="hidden" name="day_of_week" value="<?php echo $day_of_week;?>" />
  <input type="hidden" name="which_week" value="<?php echo $which_week;?>" />
  <input type="hidden" name="rotation_order" value="<?php echo $rotation_order;?>" />  
  <input type="hidden" name="action" value="delete" />  

  <input type="submit" value="Delete" />
  </form>
  <?php
}



function print_add_button( $day_of_week, $which_week ) {
  ?>
  <form action="change_standard_meals_handler.php" method="post" name="rotationChange">

  <input type="hidden" name="day_of_week" value="<?php echo $day_of_week;?>" />
  <input type="hidden" name="which_week" value="<?php echo $which_week;?>" />
  <input type="hidden" name="action" value="add" />  

  <input type="submit" value="Add meal" />
  </form>
  <?php
}

function print_change_button( $day_of_week, $which_week, $rotation_order ) {

  $nexturl = "change_standard_meal_popup.php?day_of_week=$day_of_week&which_week=$which_week&rotation_order=$rotation_order&prev_temp_change=0&new_temp_change=0";
  echo "<a href class=\"addbutton\" " .
    "onclick=\"window.open('$nexturl', 'Change standard meal', " .
    "'width=700,height=600,resizable=yes,scrollbars=yes');\">" .
    "Edit meal</a>&nbsp;&nbsp;&nbsp;";
}



?>






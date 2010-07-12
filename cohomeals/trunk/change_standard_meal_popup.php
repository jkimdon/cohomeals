<?php
include_once 'includes/init.php';

$INC = array();
print_header($INC,'','',true);
?>

<h2>Edit the meal information</h2>

<?php 

$day_of_week = mysql_safe( getValue( "day_of_week" ), false );
$which_week = mysql_safe( getValue( "which_week" ), false );
$rotation_order = mysql_safe( getValue( "rotation_order" ), false );
$prev_temp_change = mysql_safe( getValue( "prev_temp_change" ), false );
$new_temp_change = mysql_safe( getValue( "new_temp_change" ), false );


/// if this is a new temp change, create the temp-change meal container
if ( $prev_temp_change != $new_temp_change ) {

  $sql = "INSERT INTO webcal_standard_meals " .
    "(cal_day_of_week, cal_which_week, cal_rotation_order, cal_temp_change ) " .
    "VALUES ($day_of_week, $which_week, $rotation_order, $new_temp_change )";
  dbi_query( $sql );

  $sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, cal_regular_crew " .
    "FROM webcal_standard_meals " .
    "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
    "AND cal_temp_change = 0 AND cal_rotation_order = $rotation_order";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $sql2 = "UPDATE webcal_standard_meals " .
	"SET cal_time = $row[0], cal_suit = '$row[1]', cal_base_price = $row[2], " . 
	"cal_menu = '$row[3]', cal_head_chef = '$row[4]', cal_regular_crew = '$row[5]' " .
	"WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
	"AND cal_temp_change = $new_temp_change";
      dbi_query( $sql2 );
    }
  }
}


// prepare the information from the meal to present for changes
$crew = array();

$sql = "SELECT cal_time, cal_suit, cal_base_price, cal_menu, cal_head_chef, cal_regular_crew " .
 "FROM webcal_standard_meals " . 
 "WHERE cal_day_of_week = $day_of_week AND cal_which_week = $which_week " .
 "AND cal_rotation_order = $rotation_order " .
 "AND cal_temp_change = $new_temp_change";
$res = dbi_query( $sql );
if ( $res ) {
  if ( $row = dbi_fetch_row( $res ) ) {
    $time = $row[0];
    time_to_hour_minute( $time, $hour, $minute );
    if ( $hour > 12 ) {
      $ampm = 'pm';
      $hour -= 12;
    } else {
      $ampm = 'am';
    }
    $suit = $row[1];
    $base_price = $row[2];
    price_to_dollars_cents( $base_price, $base_dollars, $base_cents );
    $menu = $row[3];
    $head_chef = $row[4];
    $jobs_and_crew = explode( "&", $row[5] );
    $j=0;
    for ( $i=0; $i<count($jobs_and_crew); $i++ ) {
      $job[$j] = $jobs_and_crew[$i++];
      $crew[$j] = $jobs_and_crew[$i];
      $j++;
    }
  }
}


/// form for making changes
?>
<form action="change_standard_meals_handler.php" method="post" name="changingStandardMeal">

<input type="hidden" name="temp_change" value="<?php echo $new_temp_change;?>" />
<input type="hidden" name="day_of_week" value="<?php echo $day_of_week;?>" />
<input type="hidden" name="which_week" value="<?php echo $which_week;?>" />
<input type="hidden" name="rotation_order" value="<?php echo $rotation_order;?>" />
<input type="hidden" name="action" value="change" />

<table>
<tr><td></td><td>Suit: </td>
   <td><select name="suit">
   <option value="heart" <?php if ($suit == "heart") echo "selected=\"selected\"";?>>Heart</option>
   <option value="diamond" <?php if ($suit == "diamond") echo "selected=\"selected\"";?>>Diamond</option>
   <option value="wild" <?php if ($suit == "wild") echo "selected=\"selected\"";?>>Wild</option>
</select></td></tr>
<tr><td></td><td>Time: </td>
    <td><input type="text" name="hour" size="2" maxlength="2" <?php if ($hour != '') echo "value=\"$hour\"";?> />:<input type="text" name="minute" size="2" maxlength="2" <?php if ($minute != '') echo "value=\"$minute\"";?> />
     <label><input type="radio" name="ampm" value="am" <?php if ($ampm == "am") echo "checked=\"checked\"";?>/>am</label>
     <label><input type="radio" name="ampm" value="pm" <?php if ($ampm != "am") echo "checked=\"checked\"";?>/>pm</label>
</td></tr>
<tr><td></td><td>Base (adult) price: </td>
  <td>$<input type="text" name="base_dollars" size="2" maxlength="2" <?php if ($base_dollars != '') echo "value=\"$base_dollars\"";?>/>.<input type="text" name="base_cents" size="2" maxlength="2" <?php if ($base_cents != '') echo "value=\"$base_cents\"";?>/></td></tr>
<tr><td></td><td>Head chef: </td>
  <td><select name="head_chef">
      <option value="none" <?php if ($head_chef == "none") echo "selected=\"selected\"";?>>Select head chef</option>
      <?php $names = user_get_users();
        foreach ( $names as $name ) {
	  $username = $name['cal_login'];
	  $fullname = $name['cal_fullname'];
	  echo "<option value=\"$username\"";
	  if ($head_chef == "$username") echo "selected=\"selected\"";
	  echo ">$fullname</option>\n";
	} ?>
</select></td></tr>
<tr><td></td><td>Regular/requested crew: </td>
  <td><table class="bordered_table">
    <tr><td>Crew job description</td><td>Person</td></tr>
    <?php
      for ( $i=0; $i<7; $i++ ) {
	echo "<tr><td><input type=\"text\" name=\"job$i\" size=\"45\" ";
	if ( $job[$i] != '' ) echo "value=\"" . $job[$i] . "\" ";
	echo "maxlength=\"80\"/></td>";
	echo "<td><select name=\"crew$i\">";
	echo "<option value=\"none\" ";
	if ( ($crew[$i] == '') || ($crew[$i] == 'none') ) echo "selected=\"selected\"";
	echo ">Select crew member</option>";
	foreach ( $names as $name ) {
	  $username = $name['cal_login'];
	  $fullname = $name['cal_fullname'];
	  echo "<option value=\"$username\"";
	  if ( $crew[$i] == "$username" ) echo "selected=\"selected\"";
	  echo ">$fullname</option>\n";
	} 
	echo "</select></td></tr>\n";
      }?>
    </table>
</td></tr>
<tr><td></td><td>Regular menu: </td>
    <td><textarea name="menu" rows="5" cols="40" <?php if ($menu != '') echo "value=\"$menu\"";?>></textarea></td>
</tr>

</table>

<input type="submit" value="Save meal" />
</form>




<?php print_trailer ( false, true, true ); ?>
</body>
</html>

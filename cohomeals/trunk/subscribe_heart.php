<?php
/*
 * Description:
 * Manage heart meal subscriptions
 *
 */
include_once 'includes/init.php';

$INC = array('js/popups.php', 'js/subscribe_heart_js.php', 'js/visible.php' );
$BodyX = '';
print_header ( $INC, '', $BodyX );
?>

<form action="subscribe_heart_handler.php" method="post" name="subheartform">

<h2>Heart subscriptions</h2>

<?php 
$sql = "SELECT cal_off_day FROM webcal_subscriptions " .
       "WHERE cal_login = '$login' AND cal_suit = 'heart'";
if ( $res = dbi_query ( $sql ) ) {
  if ( $row = dbi_fetch_row ( $res ) ) {
    $subscribed = true;
    $off_day = $row[0];
  }
  else
    $subscribed = false;
} else {
  echo "Database error: " . dbi_error() . "<br />\n";
}

$meals = array ();
$eating = array ();
$some_meals = false;
$datedone = false;
$today_date = date( "Ymd" );//sprintf( "%04d%02d%02d", $thisyear, $thismonth, $thisday );
$action = 'N';

echo "<b>Current status:</b> ";
if ( $subscribed == true ) {
  echo "Subscribed on an ongoing basis ";
  if ( $off_day > 0 ) {
    echo " except for " . weekday_name ( $off_day ) . "s";
  }
  else {
    echo "for all heart meals.";
  }
} else {
  $sql = "SELECT cal_id, cal_date FROM webcal_meal " .
         "WHERE cal_suit = 'heart' AND cal_date >= $today_date ";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $i = 0;
    while ( $row = dbi_fetch_row ( $res ) ) {
      $id = $row[0];
      $meals[$i] = $row[1];

      if ( $i == 0 ) {
	$j = 0;
	$weekday[$j] = date ( "w", date_to_epoch( $meals[$i] ) );
	$j++;
      }
      else if ( $datedone == false ) {
	$w = date ( "w", date_to_epoch( $meals[$i] ) );
	if ( $w == $weekday[0] ) 
	  $datedone = true;
	else
	  $weekday[$j] = $w;
	$j++;
      }

      $sql2 = "SELECT cal_login FROM webcal_meal_participant " .
	"WHERE cal_login = '$login' AND cal_id = $id " .
	"AND (cal_type = 'M' OR cal_type = 'T')";
      if ( $res2 = dbi_query ( $sql2 ) ) {
	if ( dbi_fetch_row ( $res2 ) ) {
	  $some_meals = true;
	  $eating[$i] = true;
	}
	else 
	  $eating[$i] = false;
      } else
	echo "Database error: " . dbi_error() . "<br />\n";
      $i++;
    }
  } else
    echo "Database error: " . dbi_error() . "<br />\n";

  if ( $some_meals == true )
    echo "Signed up for a limited number of meals.";
  else 
    echo "Unsubscribed.";
}

?>

<br />

<?php if ( $subscribed == false ) { ?>
 <p>
 <b>Sign me up :</b> 
  <select name="subtype" onchange="subtype_handler()">
   <option value="none">not selected</option>
   <option value="ongoing">on an ongoing basis</option>
   <option value="limited">for a limited time</option>
  </select>



<div id=limitedcues>

<table>
<tr>
<td><b>Starting:</b></td>
<td><?php print_date_selection( "substart", $today_date ); ?>
</td></tr>
<td><b>Ending:</b></td>
<td><?php print_date_selection( "subend", $today_date ); ?>
</td></tr>
<tr><td></td>
<td align="right"><input type="button" value="Submit" onclick="check_time_period()" /></td>
</tr>
</table>


</div>



<div id=ongoingcues>

<p>
You may sign up for all meals or you may choose one day of the week for which you will not attend heart meals. 
<p>
<table>
<tr>
<td>Please select the day which you wish to <b>skip</b>:</td>
<td><select name="skipday" >
  <option value="-1">none. Sign me up for all meals.</option>
  <?php for ( $i=0; $i < count( $weekday ); $i++ ) {
    echo "<option value=\"$weekday[$i]\">" . weekday_name( $weekday[$i] ) . "</option>";
  } ?>
</select></td></tr>

<tr>
<td align="right"><b>Starting:</b></td>
<td><?php print_date_selection( "start", $today_date );  ?>
</td></tr>

<?php $action = 'S'; ?>

<tr><td></td>
<td><input type="submit" value="Subscribe me" />
</td></tr>
</table>

</div>     



<?php } else {  // i.e. subscribed == true
  $action = 'U';
  ?>
  <p>
  <table><tr>
  <td>Unsubscribe me, starting: </td>
  <td><?php print_date_selection( "start", $today_date ); 
  $start_date = sprintf( "%04d%02d%02d", $startyear, $startmonth, $startday );?>
  </td>
  </tr><tr><td></td><td><input type="submit" value="Unsubscribe me" /></td></tr>
  </table>
<?php } 

echo "<input type=\"hidden\" name=\"action\" value=\"$action\" />";
?>


</form>  

<script language="JavaScript" type="text/javascript">
subtype_handler();	
</script>


<?php print_trailer(); ?>
</body>
</html>

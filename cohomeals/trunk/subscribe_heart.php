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


$cur_user = mysql_safe( getGetValue( 'user' ), true );
if ( $cur_user == "" || 
     !isset( $cur_user ) || 
     !is_signer( $cur_user ) ) 
  $cur_user = $login;
$signees = get_signees( $login, true );

?>
<h2>Heart subscriptions</h2>

<form action="subscribe_heart.php" method="get" name="subchooseuserform">
<table>
<tr>
  <td>Managing heart subscriptions for the following person:</td>
  <td><select name="user" onchange="document.subchooseuserform.submit()">
  <?php 
  for ( $i=0; $i<count( $signees ); $i++ ) {
    $person = $signees[$i]['cal_login'];
    echo "<option value=\"" . $person . "\"";
    if ( $cur_user == $person ) 
      echo " selected";
    echo ">" . $signees[$i]['cal_fullname'] . "</option>";
  }?></select></td>
</tr>
</table>
</form>
   
<hr>

<form action="subscribe_heart_handler.php" method="post" name="subheartform">
<?php

$eating = array ();
$weekday = array ();
$some_meals = false;
$datedone = false;
$today_date = date( "Ymd" );//sprintf( "%04d%02d%02d", $thisyear, $thismonth, $thisday );
$two_week = get_day( $today_date, 14 );
$action = 'N';


/// find out what days of the week heart meals are
$sql = "SELECT cal_id, cal_date FROM webcal_meal " .
       "WHERE cal_suit = 'heart' AND cal_date >= $today_date ";
$res = dbi_query ( $sql );
if ( $res ) {
  $i = 0;
  $j = 0;
  while ( $row = dbi_fetch_row ( $res ) ) {
    $id = $row[0];
    $meals = $row[1];
 
    if ( $i == 0 ) {
      $j = 0;
      $weekday[$j++] = date ( "w", date_to_epoch( $meals ) );
      $i++;
    }
    else {
      $datedone = false;
      $w = date ( "w", date_to_epoch( $meals ) );
      for ( $k=0; $k<$j; $k++ ) {
	if ( $w == $weekday[$k] ) 
	  $datedone = true;
      }
      if ( $datedone == false ) {
	$weekday[$j++] = $w;
      }
    }
  }
}


/// print current status
$subscribed = false;
$off_day = -1;
$ongoing = 0;
$end_date = $today_date;
$sql = "SELECT cal_off_day, cal_ongoing, cal_end " .
       "FROM webcal_subscriptions " .
       "WHERE cal_login = '$cur_user' AND cal_suit = 'heart' " .
       "AND cal_end > '$today_date' ";
if ( $res = dbi_query ( $sql ) ) {
  while ( $row = dbi_fetch_row ( $res ) ) {
    $subscribed = true;
    $off_day = $row[0];
    $ongoing = $row[1];
    if ( $row[2] > $end_date )
      $end_date = $row[2];
  }
} else {
  echo "Database error: " . dbi_error() . "<br />\n";
}


echo "<b>Current status:</b> ";
$new_start = get_day( $today_date, 14 );
if ( $subscribed == true ) {
  echo "Subscribed until " . date_to_str( $end_date );
  if ( $off_day > 0 ) {
    echo " except for " . weekday_name ( $off_day ) . "s";
  }
  else if ( $off_day == 0 ) {
    echo "for all heart meals.";
  }

  if ( $ongoing == 1 ) 
    echo ".<br>Unless you cancel (button below), subscription will automatically renew for another 3 month block 2 weeks before the expiration of the current block.";

  $new_start = $end_date;

} else {
  echo "Unsubscribed";
}

?>

<br />

<?php if ( $ongoing == 0 ) { ?>
 <p>
 <b>Sign up or extend your subscription :</b> 
  <select name="subtype" onchange="subtype_handler()">
   <option value="none">not selected</option>
   <option value="ongoing">on an ongoing basis</option>
   <option value="limited">for a limited time</option>
  </select>




<div id=limitedcues>

<table>
<tr>
<td><b>Starting:</b></td>
<td><?php print_date_selection( "substart", $new_start ); ?>
</td></tr>
<td><b>Ending:</b></td>
<td><?php print_date_selection( "subend", $new_start ); ?>
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
<td align="right">First 3 month block starting:</td>
<td><?php print_date_selection( "start", $new_start );  ?>
</td></tr>

<?php $action = 'S'; ?>


<tr><td></td>
<td><input type="button" value="Subscribe" onclick="check_start_date(<?php echo $two_week;?>)" />
</td></tr>
</table>

</div>     




<?php } else {  // i.e. ongoing == 1
  $action = 'U';
  ?>
  <p>
  <input type="submit" value="Cancel automatic renewal" />
  </p>
<?php } 

echo "<input type=\"hidden\" name=\"action\" value=\"$action\" />";
echo "<input type=\"hidden\" name=\"user\" value=\"$cur_user\" />";
echo "<input type=\"hidden\" name=\"new_start\" value=\"$new_start\" />";
?>


</form>  

<script language="JavaScript" type="text/javascript">
subtype_handler();	
</script>


<?php print_trailer(); ?>
</body>
</html>

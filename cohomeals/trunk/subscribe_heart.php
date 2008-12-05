<?php
/*
 * Description:
 * Manage heart and diamond meal subscriptions
 *
 */
include_once 'includes/init.php';

$INC = array('js/popups.php', 'js/functions.php', 'js/visible.php' );
$BodyX = '';
print_header ( $INC, '', $BodyX );


$cur_user = mysql_safe( getGetValue( 'user' ), true );
if ( $cur_user == "" || 
     !isset( $cur_user ) || 
     !is_signer( $cur_user ) ) 
  $cur_user = $login;
$signees = get_signees( $login, true );

?>
<h2>Ongoing subscriptions (heart and diamond)</h2>

<form action="subscribe_heart.php" method="get" name="subchooseuserform">
<table>
<tr>
  <td>Managing an ongoing meal subscription for the following person:</td>
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
$action = 'N';


/// find out what days of the week heart meals are
$sql = "SELECT cal_id, cal_date FROM webcal_meal " .
       "WHERE cal_suit = 'heart' AND cal_date > $today_date AND cal_cancelled = 0";
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
$subscribed_heart = false;
$day_of_week = array();
for ( $i=0; $i<7; $i++ ) $day_of_week[$i] = false;
$ongoing = 0;
$end_date = $today_date;
$sql = "SELECT cal_day, cal_ongoing, cal_end " .
       "FROM webcal_subscriptions " .
       "WHERE cal_login = '$cur_user' AND cal_suit = 'heart' " .
       "AND cal_start <= $today_date " .
       "AND (cal_end > $today_date OR cal_ongoing = 1) ";
if ( $res = dbi_query ( $sql ) ) {
  while ( $row = dbi_fetch_row ( $res ) ) {
    $subscribed_heart = true;
    $day_of_week[$row[0]] = true;
    $ongoing = $row[1];
    if ( $row[2] > $end_date )
      $end_date = $row[2];
  }
} else {
  echo "Database error: " . dbi_error() . "<br />\n";
}

$subscribed_diamond = false;
$sql = "SELECT cal_ongoing, cal_end " .
  "FROM webcal_subscriptions " .
  "WHERE cal_login = '$cur_user' AND cal_suit = 'diamond' " .
  "AND cal_start <= $today_date " .
  "AND (cal_end > $today_date OR cal_ongoing = 1) ";
if ( $res = dbi_query ( $sql ) ) {
  if ( $row = dbi_fetch_row ( $res ) ) {
    $subscribed_diamond = true;
    if ( $row[1] > $end_date )
      $end_date = $row[1];
  }
} else {
  echo "Database error: " . dbi_error() . "<br />\n";
}


echo "<b>Current status:</b> ";
$new_start = get_day( $today_date, 14 );
if ( ($subscribed_heart == true) || ($subscribed_diamond == true) ) {
  echo "Subscribed ";
  if ( $ongoing == 0 ) 
    echo "until " . date_to_str( $end_date );
  echo " for meals on ";
  for ( $i=0; $i<7; $i++ ) {
    if ( $day_of_week[$i] == true ) 
      echo weekday_name( $i ) . "s ";
  }
  if ( $subscribed_diamond == true ) echo "Sundays ";
} else {
  echo "Unsubscribed";
}

?>

<br />

<?php if ( $ongoing == 0 ) { ?>
 <p>
     "Subscribing" means that you indicate that you would like to be automatically signed up for heart or Sunday meals. If you are subscribed, your name will be added to a meal when someone signs up to be head chef for that meal. You still have the option of removing yourself from a meal, as long as it is before the signup deadline. 
<p>
  <b>Subscribe for meals on an ongoing basis:</b> 
					     <br>Heart meals on:
     <?php for ( $i=0; $i<7; $i++ ) {
	  $print = false;
	  for ( $j=0; $j<count( $weekday ); $j++ ) {
	    if ( $weekday[$j] == $i ) {
	      $print = true;
	      break;
	    }
	  }
	  if ( $print == true ) {
	    echo "<input type=\"checkbox\" checked=\"checked\" name=\"weekday_" . 
	      $weekday[$j] . "\">" .
	      weekday_name( $weekday[$j] ) . "</input>&nbsp;&nbsp;&nbsp;";
	  }
	}
  echo "<br>Diamond meals on: <input type=\"checkbox\" checked=\"checked\" " . 
    "name=\"weekday_0\">" . weekday_name( 0 ) . "</input>&nbsp;&nbsp;&nbsp;<br>";
  $action = 'S';
?>

<input type="submit" value="Subscribe" />



<?php } else {  // i.e. ongoing == 1
  $action = 'U';
  ?>
  <p>
  <b>Cancellation option:</b>  End my ongoing subscription on: 
  <?php print_date_selection( "entered", $today_date, "subheartform" );?>
  <br>
     <input type="submit" value="Submit cancellation" /> 
     <br>NOTE: This will NOT remove you from meals you're already signed up for. Recall that subscribers are automatically signed up for a meal when someone signs up to be a head chef.
     <br>NOTE: To change the days of the week for which you're subscribed, cancel your subscription and resubscribe.
  </p>
<?php } 

echo "<input type=\"hidden\" name=\"action\" value=\"$action\" />";
echo "<input type=\"hidden\" name=\"user\" value=\"$cur_user\" />";
echo "<input type=\"hidden\" name=\"new_start\" value=\"$new_start\" />";
?>


</form>  

<?php print_trailer(); ?>
</body>
</html>

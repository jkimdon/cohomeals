<?php
include_once 'includes/init.php';

$error = "";
$startyear = getPostValue( 'startyear' );
$startmonth = getPostValue( 'startmonth' );
$startday = getPostValue( 'startday' );
$user = mysql_safe( getPostValue( 'user' ), true );
$action = getPostValue( 'action' );
$skipday = mysql_safe( getPostValue( 'skipday' ), false );


$endtime = mktime ( 3, 0, 0, $startmonth+3, $startday, $startyear );
$end_date = date ( "Ymd", $endtime );
$start_date = sprintf( "%04d%02d%02d", $startyear, $startmonth, $startday ); 

$count = 0;
$description = "Heart meal subscription error";

if ( is_signer( $user ) ) {

  if ( $action == 'S' ) {
    subscribe_ongoing_heart( $user, $skipday, $start_date, $end_date );
  }
  
  else if ( $action == 'U' ) {
    user_load_variables( $user, "temp" );
    $description = $GLOBALS[tempfullname] . 
      " unsubscribing to heart meals";
    
    $sql = "SELECT cal_login FROM webcal_subscriptions " .
      "WHERE cal_login = '$user' AND cal_suit = 'heart' " .
      "AND cal_ongoing = 1";
    $res = dbi_query ( $sql );
    if ( dbi_fetch_row ( $res ) ) {
      $sql = "UPDATE webcal_subscriptions " .
	"SET cal_ongoing = 0 " .
	"WHERE cal_login = '$user' AND cal_suit = 'heart'";
      dbi_query ( $sql );
    }
  }
  
}


// return to heart subscription page
$url = "subscribe_heart.php?user=$user";
do_redirect ( $url );
?>

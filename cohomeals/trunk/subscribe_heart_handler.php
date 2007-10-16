<?php
include_once 'includes/init.php';

$error = "";
$startyear = getPostValue( 'startyear' );
$startmonth = getPostValue( 'startmonth' );
$startday = getPostValue( 'startday' );
$user = mysql_safe( getPostValue( 'user' ), true );
$action = getPostValue( 'action' );
$skipday = mysql_safe( getPostValue( 'skipday' ), false );


$start_date = sprintf( "%04d%02d%02d", $startyear, $startmonth, $startday ); 

$count = 0;
$description = "Heart meal subscription error";

if ( is_signer( $user ) ) {

  user_load_variables( $user, "temp" );

  if ( $action == 'S' ) {
    $description = $GLOBALS[tempfullname] . 
      " subscribing to heart meals";
    
    $sql = "SELECT cal_login FROM webcal_subscriptions " .
      "WHERE cal_login = '$user' AND cal_suit = 'heart'";
    $res = dbi_query ( $sql );
    if ( dbi_fetch_row ( $res ) ) {
      $sql = "DELETE FROM webcal_subscriptions " .
	"WHERE cal_login = '$user' AND cal_suit = 'heart'";
      dbi_query ( $sql );
    }
    $sql = "INSERT INTO webcal_subscriptions ( cal_login, cal_suit, cal_off_day ) " .
      "VALUES ( '$user', 'heart', '$skipday' )";
    if ( ! dbi_query ( $sql ) ) {
      $error = "Database error: " . dbi_error ();
    }
    
    
    /// enter user as in-house diner for all currently entered heart meals 
    $sql = "SELECT cal_id, cal_date FROM webcal_meal " .
      "WHERE cal_suit = 'heart' AND cal_date >= $start_date ";
    $res = dbi_query ( $sql );
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
	$w = date ( "w", date_to_epoch( $row[1] ) );
	if ( $w != $skipday ) {
	  $mod = edit_participation ( $row[0], 'A', 'M', $user );
	  if ( $mod == true ) $count++;
	}
	else {
	  $mod = edit_participation ( $row[0], 'D', 'M', $user );
	  if ( $mod == true ) $count--;
	  $mod = edit_participation ( $row[0], 'D', 'T', $user );
	  if ( $mod == true ) $count--;
	}
      }
    }
    else 
      $error = "Database error: " . dbi_error ();
    dbi_free_result( $res  );
    
  }
  
  else if ( $action == 'U' ) {
    $description = $GLOBALS[tempfullname] . 
      " unsubscribing to heart meals";
    
    $sql = "SELECT cal_login FROM webcal_subscriptions " .
      "WHERE cal_login = '$user' AND cal_suit = 'heart'";
    $res = dbi_query ( $sql );
    if ( dbi_fetch_row ( $res ) ) {
      $sql = "DELETE FROM webcal_subscriptions " .
	"WHERE cal_login = '$user' AND cal_suit = 'heart'";
      dbi_query ( $sql );
    }
    
    /// remove from all relevant heart meals 
    $sql = "SELECT cal_id, cal_date FROM webcal_meal " .
      "WHERE cal_suit = 'heart' AND cal_date >= $start_date ";
    $res = dbi_query ( $sql );
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
	$mod = edit_participation ( $row[0], 'D', 'M', $user );
	if ( $mod == true ) $count--;
	$mod = edit_participation ( $row[0], 'D', 'T', $user );
	if ( $mod == true ) $count--;
      }
    }
    else 
      $error = "Database error: " . dbi_error ();
    dbi_free_result( $res  );
  }
  
  $amount = get_price( 0, $user, true );
  $amount *= $count;
  $billing = get_billing_group( $user );
  add_financial_event( $billing, $amount, $description, 0, "" );
}


// return to heart subscription page
$url = "subscribe_heart.php?user=$user";
do_redirect ( $url );
?>

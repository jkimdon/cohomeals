<?php
include_once 'includes/init.php';

$error = "";

$start_date = sprintf( "%04d%02d%02d", $startyear, $startmonth, $startday ); 

if ( $action == 'S' ) {
  $sql = "SELECT cal_login FROM webcal_subscriptions " .
    "WHERE cal_login = '$login' AND cal_suit = 'heart'";
  $res = dbi_query ( $sql );
  if ( dbi_fetch_row ( $res ) ) {
    $sql = "DELETE FROM webcal_subscriptions " .
      "WHERE cal_login = '$login' AND cal_suit = 'heart'";
    dbi_query ( $sql );
  }
  $sql = "INSERT INTO webcal_subscriptions ( cal_login, cal_suit, cal_off_day ) " .
    "VALUES ( '$login', 'heart', '$skipday' )";
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
	edit_participation ( $row[0], 'A', 'M' );
      }
      else {
	edit_participation ( $row[0], 'D', 'M' );
	edit_participation ( $row[0], 'D', 'T' );
      }
    }
  }
  else 
    $error = "Database error: " . dbi_error ();
}

else if ( $action == 'U' ) {
    $sql = "SELECT cal_login FROM webcal_subscriptions " .
    "WHERE cal_login = '$login' AND cal_suit = 'heart'";
  $res = dbi_query ( $sql );
  if ( dbi_fetch_row ( $res ) ) {
    $sql = "DELETE FROM webcal_subscriptions " .
      "WHERE cal_login = '$login' AND cal_suit = 'heart'";
    dbi_query ( $sql );
  }

  /// remove from all relevant heart meals 
  $sql = "SELECT cal_id, cal_date FROM webcal_meal " .
         "WHERE cal_suit = 'heart' AND cal_date >= $start_date ";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $w = date ( "w", date_to_epoch( $row[1] ) );
      if ( $w != $skipday ) {
	edit_participation ( $row[0], 'D', 'M' );
	edit_participation ( $row[0], 'D', 'T' );
      }
    }
  }
  else 
    $error = "Database error: " . dbi_error ();
  
}


// return to heart subscription page
$url = "subscribe_heart.php";
do_redirect ( $url );

?>

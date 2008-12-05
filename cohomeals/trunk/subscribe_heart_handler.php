<?php
include_once 'includes/init.php';

$error = "";
$enteredyear = getPostValue( 'enteredyear' );
$enteredmonth = getPostValue( 'enteredmonth' );
$enteredday = getPostValue( 'enteredday' );
$user = mysql_safe( getPostValue( 'user' ), true );
$action = getPostValue( 'action' );
$skipday = mysql_safe( getPostValue( 'skipday' ), false );

$weekday = array();
for ( $i=0; $i<7; $i++ ) {
  $weekday[$i] = false;
  $key = "weekday_$i";
  if ( getValue( $key ) ) $weekday[$i] = true;

 }

$entered_date = sprintf( "%04d%02d%02d", $enteredyear, $enteredmonth, $enteredday ); 
if ( $entered_date == 0 ) $entered_date = date( "Ymd" );

$count = 0;
$description = "Ongoing meal subscription error";

if ( is_signer( $user ) ) {

  if ( $action == 'S' ) {
    // remove old heart or diamond subscriptions
    $sql = "DELETE FROM webcal_subscriptions " .
      "WHERE cal_login = '$user' AND (cal_suit = 'heart' OR cal_suit = 'diamond')";
    dbi_query( $sql );

    // enter new subscription
    for ( $i=0; $i<7; $i++ ) {
      if ( $weekday[$i] == true ) 
	subscribe_ongoing_heart( $user, $i, $entered_date );
    }
  }
  
  else if ( $action == 'U' ) {
    user_load_variables( $user, "temp" );
    $description = $GLOBALS[tempfullname] . 
      " unsubscribing to ongoing meals";
    
    $sql = "SELECT cal_login, cal_start FROM webcal_subscriptions " .
      "WHERE cal_login = '$user' AND (cal_suit = 'heart' OR cal_suit = 'diamond')" .
      "AND cal_ongoing = 1";
    $res = dbi_query ( $sql );
    while ( $row = dbi_fetch_row ( $res ) ) {
      $old_start = $row[1];
      $sql = "UPDATE webcal_subscriptions " .
	"SET cal_ongoing = 0, cal_end = $entered_date " .
	"WHERE cal_login = '$user' AND (cal_suit = 'heart' OR cal_suit = 'diamond') " .
	"AND cal_start = $old_start";
      dbi_query ( $sql );
    }
  }
  
}


// return to heart subscription page
$url = "subscribe_heart.php?user=$user";
do_redirect ( $url );





function subscribe_ongoing_heart( $user, $day_of_week, $start_date ) {

  if ( $day_of_week == 0 ) $suit = 'diamond';
  else $suit = 'heart';

  // enter into subscription table
  $sql = "INSERT INTO webcal_subscriptions " .
    "( cal_login, cal_suit, cal_day, cal_start, cal_end, cal_ongoing ) " .
    "VALUES ('$user', '$suit', $day_of_week, $start_date, 0, 1 )";
  if ( !dbi_query( $sql ) ) $error = "Database error: " . dbi_error ();


  $count = 0;
  /// enter user as in-house diner for meals on this day of the week that already have head chefs
  $sql = "SELECT cal_id, cal_date FROM webcal_meal " .
    "WHERE cal_suit = '$suit' " .
    "AND cal_date >= $start_date";
  $res = dbi_query ( $sql );
  $id = 0;
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $id = $row[0];
      $meal_date = $row[1];

      // check for day of the week
      $w = date ( "w", date_to_epoch( $meal_date ) );
      if ( $w == $day_of_week ) {
	
	/// check for head chef
	$sql2 = "SELECT cal_type FROM webcal_meal_participant " .
	  "WHERE cal_type = 'H' AND cal_id = $id";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  if ( dbi_fetch_row( $res2 ) ) {

	    $mod = edit_participation ( $id, 'A', 'M', $user );
	    if ( $mod == true ) $count++;
	  }
	}
      }
    }
  }
  else 
    $error = "Database error: " . dbi_error ();
  dbi_free_result( $res  );
  
}



?>

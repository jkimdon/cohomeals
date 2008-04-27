#!/usr/bin/php -q
<?php


// Load include files.
// If you have moved this script out of the WebCalendar directory,
// which you probably should do since it would be better for security
// reasons, you would need to change $includedir to point to the
// webcalendar include directory.
// We set these twice since config.php unsets these.
$includedir = "../public_html/meals/includes"; // Set again after config.php

include "$includedir/config.php";

$basedir = "../public_html/meals/"; // points to the base WebCalendar directory relative to
                 // current working directory
$includedir = "../public_html/meals/includes";

include "$includedir/php-dbi.php";
include "$includedir/functions.php";
include "$includedir/$user_inc";
include "$includedir/site_extras.php";

// Establish a database connection.
$c = dbi_connect ( $db_host, $db_login, $db_password, $db_database );
if ( ! $c ) {
  echo "Error connecting to database: " . dbi_error ();
  exit;
}

load_global_settings ();

// Assume this is run at 6pm on Wednesday, signup cutoff is on
// the following Friday for eating the following Sunday - Saturday and
// working the next Sunday to Saturday.

$days_until_cutoff = 2;

$signup_cutoff = date ( "U", time() + $days_until_cutoff * 24 * 3600 );
$eat_cutoff_start = date ( "U", $signup_cutoff + 2 * 24 * 3600 );
$eat_cutoff_end = date ( "U", $eat_cutoff_start + 6 * 24 * 3600 ); 
$work_cutoff_start = date ( "U", $eat_cutoff_end + 1 * 24 * 3600 ); 
$work_cutoff_end = date ( "U", $work_cutoff_start + 6 * 24 * 3600 ); 

$body = "This is your reminder to sign up by " . 
  date( "D, F j", $signup_cutoff ) . " to eat for meals \n" . 
  date( "D, F j", $eat_cutoff_start ) . " - " .
  date( "D, F j", $eat_cutoff_end ) .
  " and to work at meals " . 
  date( "D, F j", $work_cutoff_start ) . " - " .
  date( "D, F j", $work_cutoff_end ) . ".\n\n";

$body .= "The following meals need head chefs and/or crews:\n\n";

$events = read_events ( date ( "Ymd", $eat_cutoff_start),
                        date ( "Ymd", $work_cutoff_end ) );

for ( $d = $eat_cutoff_start ;  $d < $work_cutoff_end ; $d = $d + 24 * 3600 ) {
  $ev = get_entries ( date ( "Ymd", $d) );

  for ( $i = 0; $i < count ( $ev ); $i++ ) {
    $viewid = $ev[$i]['cal_id'];

    if ( is_cancelled( $viewid ) == true )
      continue;

    $viewname = $ev[$i]['cal_suit'];

    $need = "";
    $head_chef = "";

    // Check if there is a head chef. 
    $sql = "SELECT cal_login " .
      "FROM webcal_meal_participant " .
      "WHERE cal_id = $viewid " .
      "AND cal_type = 'H'";
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) {
        user_load_variables( $row[0], "temp" );
	$head_chef = $GLOBALS['tempfullname'];
      } else {
	$need = "head chef";
      }
      dbi_free_result( $res );
    }

    if ( $need == "" ) {
      $sql = "SELECT cal_login, cal_notes " .
	"FROM webcal_meal_participant " .
	"WHERE cal_id = $viewid " . 
	"AND cal_type = 'C'";
      if ( $res = dbi_query( $sql ) ) {
	while ( $row = dbi_fetch_row( $res ) ) {
	  if ( ereg( "^none", $row[0] ) ) {
	    if ( $need != "")
	      $need .= ", ";
	    $need .= $row[1];
          }
	}
	dbi_free_result( $res );
      }
    }

    $info = "";
    if ( $need != "" ) {
      $info .= date( "D, M d", $d) . " : ";
      if ( $head_chef != "" ) {
        $info .= "Head chef " . $head_chef . ". ";
      }
      $info .= "Need " . $need . ".\n";
    }
    $info = wordwrap(html_entity_decode($info), 75, "\n              ");
    $body .= $info;
  }
}

$extra_hdrs = "From: David Kimdon <dkimdon@gmail.com>\r\n";

mail( "cohochat@yahoogroups.com, David Demaree <ddemarya@yahoo.com>",
      "Weekly meal signup reminder", $body, $extra_hdrs );

?>

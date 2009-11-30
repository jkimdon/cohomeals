#!/usr/bin/php -q
<?php


/// Run as a cron job every morning. Remind head chefs 1 week before their meal 
//  and regular crew members 1 day before



// Load include files.
// If you have moved this script out of the WebCalendar directory,
// which you probably should do since it would be better for security
// reasons, you would need to change $includedir to point to the
// webcalendar include directory.
// We set these twice since config.php unsets these.
$includedir = "../includes"; // Set again after config.php

include "$includedir/config.php";

$basedir = "../"; // points to the base WebCalendar directory relative to
                 // current working directory
$includedir = "../includes";

include "$includedir/php-dbi.php";
include "$includedir/functions.php";
include "$includedir/$user_inc";
include "$includedir/site_extras.php";

load_global_settings();
include "$includedir/translate.php";

// Establish a database connection.
$c = dbi_connect ( $db_host, $db_login, $db_password, $db_database );
if ( ! $c ) {
  echo "Error connecting to database: " . dbi_error ();
  exit;
}

load_global_settings ();



$extra_hdrs = "From: " . $GLOBALS['weekly_reminder_from'] . "\r\n";

/// Find all meals one week from today (head chef reminder) 
/// or one day from today (crew reminder)
$one_week_later = get_day( date( "Ymd" ), 7 );
$one_day_later = get_day( date( "Ymd" ), 1 );

$events = read_events( $one_week_later, $one_week_later );
$meals = get_entries( $one_week_later );

for ( $i = 0; $i < count ( $meals ); $i++ ) {
  $meal_id = $meals[$i]['cal_id'];
  $meal_date = $meals[$i]['cal_date'];
  $meal_time = $meals[$i]['cal_time'];
  $head_chef = has_head_chef( $meal_id );

  if ( $head_chef != "" ) {

    user_load_variables( $head_chef, "head" );
    $chef_email = $GLOBALS[heademail];
    $chef_name = $GLOBALS[headfirstname];
    
    $subject = "Head chef reminder for " . date_to_str( $meal_date, "", true, true, $meal_time );
    
    $body = "Hi " . $chef_name . " (" . $chef_email . "),\n\n";
    $body .= "This is your friendly automated reminder that you are signed up " .
      "to be head chef in one week, on " . date_to_str( $meal_date, "", true, true, $meal_time );
    $body .= ". If you haven't already, please post your menu on the website: " .
      "https://www.cohoecovillage.org/meals/view_entry.php?id=" . $meal_id . "\n\n";
    $body .= "Thanks so much for supporting our meal program!\n\n";
    $body .= "Bon appetit!\n";
    
    mail( $chef_email, $subject, $body, $extra_hdrs );
  }
 }


$events = read_events( $one_day_later, $one_day_later );
$meals = get_entries( $one_day_later );
for ( $i = 0; $i < count ( $meals ); $i++ ) {
  $meal_id = $meals[$i]['cal_id'];
  $meal_date = $meals[$i]['cal_date'];
  $meal_time = $meals[$i]['cal_time'];
  $head_chef = has_head_chef( $meal_id );
  user_load_variables( $head_chef, "head" );
  $chef_name = $GLOBALS[headfirstname];

  $sql = "SELECT cal_login, cal_notes FROM webcal_meal_participant " .
    "WHERE cal_id = $meal_id AND cal_type = 'C'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $worker = $row[0];
      if ( !ereg( "^none", $worker ) ) {
	$description = $row[1];
	$description = trim( $description );
	$job = mysql_safe( $description );
	if ( $description == "" ) $description = "???";

	user_load_variables( $worker, "worker" );
	$worker_name = $GLOBALS[workerfirstname];
	$worker_email = $GLOBALS[workeremail];
	

	$subject = "Meal crew reminder for " . date_to_str( $meal_date, "", true, true, $meal_time );
	
	$body = "Hi " . $worker_name . ", (" . $worker_email . ")\n\n";
	$body .= "This is your friendly automated reminder that you are signed up " .
	  "to be on a meal crew (" . $description . ") tomorrow, on " . 
	  date_to_str( $meal_date, "", true, true, $meal_time );
	$body .= ". If you are cooking and haven't already heard from your head chef (" .
	  $chef_name . "), please try to contact him/her to confirm cooking times and tasks. ";
	$body .= "You can view the meal here: " . 
	  "https://www.cohoecovillage.org/meals/view_entry.php?id=" . $meal_id . "\n\n";
	$body .= "Thanks so much for supporting our meal program!\n\n";
	$body .= "Bon appetit!\n";
	
	mail( $worker_email, $subject, $body, $extra_hdrs );
      }
    }
  }
  dbi_free_result ( $res );
 }


?>

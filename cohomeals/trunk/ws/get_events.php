<?php
/*
 * $Id: get_events.php,v 1.1 2004/06/24 02:18:30 cknudsen Exp $
 *
 * Description:
 *	Web Service functionality to get events.
 *	Uses XML (but not SOAP at this point since that would be
 *      overkill and require extra packages to install).
 *
 * Comments:
 *	Client apps must use the same authentication as the web browser.
 *	If WebCalendar is setup to use web-based authentication, then
 *	the login.php found in this directory should be used to obtain
 *	a session cookie.
 *
 */

// Load include files.
$basedir = ".."; // points to the base WebCalendar directory relative to
                 // current working directory
$includedir = "../includes";

include "$includedir/config.php";
include "$includedir/php-dbi.php";
include "$includedir/functions.php";
include "$includedir/$user_inc";
include "$includedir/validate.php";
include "$includedir/connect.php";
load_global_settings ();
load_user_preferences ();
include "$includedir/site_extras.php";

include "$includedir/translate.php";

$debug = false; // set to true to print debug info...

//Header ( "Content-type: text/xml" );
Header ( "Content-type: text/plain" );

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<events>\n";

// If login is public user, make sure public can view others...
if ( $login == "__public__" && $login != $user ) {
  if ( $public_access_others != 'Y' ) {
    echo "<error>" . translate("Not authorized") . "</error>\n";
    echo "</events>\n";
    exit;
  }
  echo "<!-- Allowing public user to view other user's calendar -->\n";
}

if ( empty ( $user ) )
  $user = $login;

if ( empty ( $startdate ) )
  $startdate = date ( "Ymd" );
if ( empty ( $enddate ) )
  $enddate = $startdate;

// Read events (for all users)
if ( $debug )
  echo "Checking for events from date $startdate to date $enddate\n";
$events = read_events ( $startdate, $enddate );
if ( $debug )
  echo "Found " . count ( $events ) . " events in time range.\n";



function escapeXml ( $str )
{
  return ( str_replace ( "<", "&lt;", str_replace ( ">", "&gt;", $str ) ) );
}

// Send a single event
function print_event_xml ( $id, $event_date ) {
  global $site_extras, $debug,
    $server_url, $application_name;
  global $EXTRA_TEXT, $EXTRA_MULTILINETEXT, $EXTRA_URL, $EXTRA_DATE,
    $EXTRA_EMAIL, $EXTRA_USER, $EXTRA_REMINDER, $LANGUAGE;

  // get participants first...
 
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id " .
    "ORDER BY cal_login";
  $res = dbi_query ( $sql );
  $participants = array ();
  $num_participants = 0;
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $participants[$num_participants++] = $row[0];
    }
  }

  // get external participants
  $ext_participants = array ();
  $num_ext_participants = 0;
  if ( ! empty ( $allow_external_users ) && $allow_external_users == "Y" &&
    ! empty ( $external_reminders ) && $external_reminders == "Y" ) {
    $sql = "SELECT cal_fullname, cal_email FROM webcal_entry_ext_user " .
      "WHERE cal_id = $id AND cal_email IS NOT NULL " .
      "ORDER BY cal_fullname";
    $res = dbi_query ( $sql );
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
        $ext_participants[$num_ext_participants] = $row[0];
        $ext_participants_email[$num_ext_participants++] = $row[1];
      }
    }
  }

  if ( ! $num_participants && ! $num_ext_participants ) {
    if ( $debug )
      echo "No participants found for event id: $id\n";
    return;
  }


  // get event details
  $res = dbi_query (
    "SELECT cal_date, cal_time, " .
    "cal_suit, cal_notes FROM webcal_meal WHERE cal_id = $id" );
  if ( ! $res ) {
    echo "Db error: could not find event id $id.\n";
    return;
  }


  if ( ! ( $row = dbi_fetch_row ( $res ) ) ) {
    echo "Error: could not find event id $id in database.\n";
    return;
  }

  $suit = $row[2];
  $notes = $row[3];

  echo "<event>\n";
  echo "  <id>$id</id>\n";
  echo "  <name>" . escapeXml ( $suit ) . "</name>\n";
  if ( ! empty ( $server_url ) ) {
    if ( substr ( $server_url, -1, 1 ) == "/" ) {
      echo "  <url>" .  $server_url . "view_entry.php?id=" . $id . "</url>\n";
    } else {
      echo "  <url>" .  $server_url . "/view_entry.php?id=" . $id . "</url>\n";
    }
  }
  echo "  <notes>" . escapeXml ( $notes ) . "</notes>\n";
  echo "  <dateFormatted>" . date_to_str ( $event_date ) . "</dateFormatted>\n";
  echo "  <date>" . $event_date . "</date>\n";
  if ( $row[1] >= 0 ) {
    echo "  <time>" . sprintf ( "%04d", $row[1] / 100 ) . "</time>\n";
    echo "  <timeFormatted>" . display_time ( $row[1] ) . "</timeFormatted>\n";
  }

  // site extra fields
  $extras = get_site_extra_fields ( $id );
  echo "  <siteExtras>\n";
  for ( $i = 0; $i < count ( $site_extras ); $i++ ) {
    $extra_name = $site_extras[$i][0];
    $extra_descr = $site_extras[$i][1];
    $extra_type = $site_extras[$i][2];
    if ( $extras[$extra_name]['cal_name'] != "" ) {
      $tag = preg_replace ( "/[^A-Za-z0-9]+/", "", translate ( $extra_descr ) );
      $tag = strtolower ( $tag );
      $tagname = str_replace ( '"', '', $extra_name );
      echo "    <siteExtra>\n";
      echo "      <number>$i</number>\n";
      echo "      <name>" . escapeXml ( $extra_name ) . "</name>\n";
      echo "      <description>" . escapeXml ( $extra_descr ) . "</description>\n";
      echo "      <type>" . $extra_type . "</type>\n";
      echo "      <value>";
      if ( $extra_type == $EXTRA_DATE ) {
        //echo date_to_str ( $extras[$extra_name]['cal_date'] );
        echo $extras[$extra_name]['cal_date'];
      } else if ( $extra_type == $EXTRA_MULTILINETEXT ) {
        echo escapeXml ( $extras[$extra_name]['cal_data'] );
      } else if ( $extra_type == $EXTRA_REMINDER ) {
        echo ( $extras[$extra_name]['cal_remind'] > 0 ?
          translate("Yes") : translate("No") );
      } else {
        // default method for $EXTRA_URL, $EXTRA_TEXT, etc...
        echo escapeXml ( $extras[$extra_name]['cal_data'] );
      }
      echo "</value>\n    </siteExtra>\n";
    }
  }
  echo "  </siteExtras>\n";
  if ( ! $disable_participants_field ) {
    echo "  <participants>\n";
    for ( $i = 0; $i < count ( $participants ); $i++ ) {
      echo "    <participant>" .  $participants[$i] .
        "</participant>\n";
    }
    for ( $i = 0; $i < count ( $ext_participants ); $i++ ) {
      echo "    <participant>" . $ext_participants[$i] .
        "</participant>\n";
    }
    echo "  </participants>\n";
  }
  echo "</event>\n";
}



// Process an event for a single day.  Check to see if it has
// a reminder, when it needs to be sent and when the last time it
// was sent.
function process_event ( $id, $name, $event_date, $event_time ) {
  global $debug;

  if ( $debug )
    printf ( "Event %d: \"%s\" at %s on %s \n",
      $id, $name, $event_time, $event_date );

  print_event_xml ( $id, $event_date );
}


echo "<!-- events for user \"$user\", login \"$login\" -->\n";
echo "<!-- date range: $startdate - $enddate -->\n";

$startyear = substr ( $startdate, 0, 4 );
$startmonth = substr ( $startdate, 4, 2 );
$startday = substr ( $startdate, 6, 2 );
$endyear = substr ( $enddate, 0, 4 );
$endmonth = substr ( $enddate, 4, 2 );
$endday = substr ( $enddate, 6, 2 );

$starttime = mktime ( 3, 0, 0, $startmonth, $startday, $startyear );
$endtime = mktime ( 3, 0, 0, $endmonth, $endday, $endyear );

for ( $d = $starttime; $d <= $endtime; $d += $ONE_DAY ) {
  $completed_ids = array ();
  $date = date ( "Ymd", $d );
  //echo "Date: $date\n";
  // An event will be included one time for each participant.
  $ev = get_entries ( $date );
  // Keep track of duplicates
  $completed_ids = array ( );
  for ( $i = 0; $i < count ( $ev ); $i++ ) {
    $id = $ev[$i]['cal_id'];
    if ( ! empty ( $completed_ids[$id] ) )
      continue;
    $completed_ids[$id] = 1;
    process_event ( $id, $ev[$i]['cal_suit'], $date, $ev[$i]['cal_time'] );
  }
}

echo "</events>\n";

if ( $debug )
  echo "Done.\n";

?>

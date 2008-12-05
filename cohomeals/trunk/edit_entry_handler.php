<?php
include_once 'includes/init.php';
include_once 'includes/site_extras.php';

$error = "";

$repeats = getPostValue( 'repeats' );
$newevent = getPostValue( 'newevent' );
$uses_endday = getPostValue( 'uses_endday' );
$id = mysql_safe( getPostValue( 'id' ), false );
$suit = mysql_safe( getPostValue( 'suit' ), true );
$day = getPostValue( 'day' );
$month = getPostValue( 'month' );
$year = getPostValue( 'year' );
$endday = getPostValue( 'endday' );
$endmonth = getPostValue( 'endmonth' );
$endyear = getPostValue( 'endyear' );
$deadline = getPostValue( 'deadline' );
$hour = getPostValue( 'hour' );
$minute = getPostValue( 'minute' );
$ampm = getPostValue( 'ampm' );
$menu = mysql_safe( getPostValue( 'menu' ), true );
$max_diners = mysql_safe( getPostValue( 'max_diners' ), false );
$walkins = mysql_safe( getPostValue( 'walkins' ), true );
$notes = mysql_safe( getPostValue( 'notes' ), true );
$base_dollars = getPostValue( 'base_dollars' );
$base_cents = getPostValue( 'base_cents' );

$base_price = 100*$base_dollars + $base_cents;
if ( $newevent == false ) $repeats = false;
//if ( $suit == "heart" ) $deadline = 14;


for ( $i=0; $i<7; $i++ ) {
  $repday[$i] = 0;
  $key = "d$i";
  if ( getPostValue( $key ) == true ) 
    $repday[$i] = 1;
}

$max_jobs=7;
for ( $i=1; $i<$max_jobs; $i++ ) {
  $job[$i] = "";
  $key = "job$i";
  $job[$i] = mysql_safe( getValue( $key ), true );
}

// Make sure this user is really allowed to edit this event.
// Otherwise, someone could hand type in the URL to edit someone else's
// event.
// Can edit if:
//   - user is meal coordinator
//   - user is adding a new spade or wild meal
//   - user is head chef 
$can_edit = false;
if ( $is_meal_coordinator ) {
  $can_edit = true;
} else if ( $newevent == true ) {
  if ( ($suit == 'spade') || ($suit == 'wild') ) {
    $can_edit = true;
  }
} else {
  if ( is_chef( $id ) ) {
    $can_edit = true;
  }
}

if ( $can_edit == false ) {
  $error = "Not authorized.";
  echo "Not authorized<br>";
  return;
}

$current_date = sprintf ( "%04d%02d%02d", $year, $month, $day );
$first_date = $current_date;
$weekday = date ( "w", mktime ( 3, 0, 0, $month, $day, $year ) );
$timestamp = mktime ( 3, 0, 0, $month, $day, $year );

// get situated on the correct starting date
if ( ($repeats == "true") && $repday[$weekday] != 1 ) {
  for ( $i=0; $i<7; $i++ ) {
    $weekday += 1;
    $day += 1;
    if ( $weekday == 7 ) 
      $weekday = 0;
    if ( $repday[$weekday] == 1 ) {
      $timestamp = mktime ( 3, 0, 0, $month, $day, $year );
      $current_date = date ( "Ymd", $timestamp );
      $day = date ( "d", $timestamp );
      $month = date ( "m", $timestamp );
      $year = date ( "Y", $timestamp );
      break;
    }
  }
}

if ( ($suit == "heart") && ($newevent == true) )
  $deadline = 2 + date ( "w", $timestamp );

if ( $uses_endday == 0 ) 
  $end_date = $current_date;
else 
  $end_date = sprintf ( "%04d%02d%02d", $endyear, $endmonth, $endday );


/// prepare a new club id
if ( $suit == "club" ) {
  $res = dbi_query ( "SELECT MAX(cal_club_id) FROM webcal_meal" );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    $club_id = $row[0] + 1;
    dbi_free_result ( $res );
  } else {
    $club_id = 1;
  }
}
else {
  $club_id = 0;
}


/// do the actual adding/editing of each event
while ( $current_date <= $end_date ) {

  $newid = add_or_edit_entry( $newevent, $id, $club_id, 
			      $suit, $day, $month, $year, 
			      $deadline, $base_price,
			      $hour, $minute, $ampm,
			      $menu, $walkins, 
			      $notes, $max_diners, $job );

  $active_timestamp = mktime( 3,0,0, $month, $day, $year );

  if ( $repeats == false ) {
    break;
  } 
  
  for ( $i=0; $i<7; $i++ ) {
    $weekday += 1;
    $day += 1;
    if ( $weekday == 7 ) 
      $weekday = 0;
    if ( $repday[$weekday] == 1 ) {
      $timestamp = mktime ( 3, 0, 0, $month, $day, $year );
      $current_date = date ( "Ymd", $timestamp );
      $day = date ( "d", $timestamp );
      $month = date ( "m", $timestamp );
      $year = date ( "Y", $timestamp );
      break;
    }
  }

  if ( ($suit == "heart") && ($newevent == true) )
    $deadline = 2 + date ( "w", $timestamp );

}





///////////////////////////////////////////////////////
function add_or_edit_entry( $newevent, $id, $club_id, $suit, 
			    $day, $month, $year, 
			    $deadline, $base_price,
			    $hour, $minute, $ampm,
			    $menu, $walkins, 
			    $notes, $max_diners, $job ) {
  global $is_meal_coordinator, $is_meal_coordinator;
  global $LOG_CREATE, $LOG_UPDATE, $max_jobs;


  if ( ! empty ( $hour ) ) {
    // Convert to 24 hour 
    if ( $hour < 12 ) {
      if ( $ampm == 'pm' )
	$hour += 12;
    } elseif ( $hour == '12' && $ampm == 'am' ) {
      $hour = 0;
    }
    $TIME_FORMAT=24;
    if ( $hour < 0 ) {
      $hour += 24;
      // adjust date
      $date = mktime ( 3, 0, 0, $month, $day, $year );
      $date -= $ONE_DAY;
      $month = date ( "m", $date );
      $day = date ( "d", $date );
      $year = date ( "Y", $date );
    }
    if ( $hour >= 24 ) {
      $hour -= 24;
      // adjust date
      $date = mktime ( 3, 0, 0, $month, $day, $year );
      $date += $ONE_DAY;
      $month = date ( "m", $date );
      $day = date ( "d", $date );
      $year = date ( "Y", $date );
    }

  } // end if !empty($hour)


  if ( $hour > 0 ) {
    $ampmt = $ampm;
    //This way, a user can pick am and still
    //enter a 24 hour clock time.
    if ($hour > 12 && $ampm == 'am') {
      $ampmt = 'pm';
    }
    $hour %= 12;
    if ( $ampmt == 'pm' ) {
      $hour += 12;
    }
  }
  
  
  $msg = '';
  
  if ( empty ( $error ) ) {
    // now add the entries
    if ( $newevent == true ) {
      $res = dbi_query ( "SELECT MAX(cal_id) FROM webcal_meal" );
      if ( $res ) {
	$row = dbi_fetch_row ( $res );
	$id = $row[0] + 1;
	dbi_free_result ( $res );
      } else {
	$id = 1;
      }
    }
  }

  if ( empty ( $error ) ) {

    if ( $newevent == true ) {
      $sql = "INSERT INTO webcal_meal ( cal_id, cal_club_id, " .
	"cal_date, cal_time, cal_suit, cal_menu, " .
	"cal_base_price, cal_signup_deadline, cal_walkins, cal_notes, " .
	"cal_max_diners ) " .
	"VALUES ( ";
      
      $sql .= $id . ", ";	
      $sql .= $club_id . ", ";
      $date = mktime ( 3, 0, 0, $month, $day, $year );
      $sql .= date ( "Ymd", $date ) . ", ";
      $sql .= sprintf ( "%02d%02d00, ", $hour, $minute );
      $sql .= "'" . $suit . "', ";
      $sql .= "'" . mysql_safe($menu,true) . "', ";
      $sql .= $base_price . ", ";
      $sql .= $deadline . ", ";
      $sql .= "'" . $walkins . "', ";
      $sql .= "'" . mysql_safe($notes,true) . "', ";
      $sql .= $max_diners . ")";

    }
    else { 
      $sql = "UPDATE webcal_meal " . 
	"SET ";
      
      $date = mktime ( 3, 0, 0, $month, $day, $year );
      $sql .= "cal_date = " . date ( "Ymd", $date ) . ", ";
      $sql .= "cal_time = " . sprintf ( "%02d%02d00, ", $hour, $minute );
      $sql .= "cal_menu = '" . $menu . "', ";
      $sql .= "cal_signup_deadline = " . $deadline . ", ";
      $sql .= "cal_walkins = '" . $walkins . "', ";
      $sql .= "cal_notes = '" . $notes . "', ";
      $sql .= "cal_max_diners = " . $max_diners;
      
      $sql .=	" WHERE cal_id = $id";
    }
    
    if ( ! dbi_query ( $sql ) ) {
      $error = translate("Database error") . ": " . dbi_error ();
      echo "Error = $error<br>";
    }


    $sqla = "DELETE FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_login LIKE 'none%'";
    dbi_query( $sqla );
    for ( $i=1; $i<$max_jobs; $i++ ) {
      if ( $job[$i] != "" ) {
	$none = "none" . $i;
	$sql2 = "SELECT cal_login FROM webcal_meal_participant " .
	  "WHERE cal_id = $id AND cal_type = 'C' " .
	  "AND cal_login = '$none'";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  if ( !dbi_fetch_row( $res2 ) ) {
	    
	    $sql3 = "INSERT INTO webcal_meal_participant " .
	      "( cal_id, cal_login, cal_type, cal_notes ) VALUES ( ";
	    $sql3 .= $id . ", ";
	    $sql3 .= "'none" . $i . "', ";
	    $sql3 .= "'C', ";
	    $sql3 .= "'" . mysql_safe($job[$i],true) . "')";
	    
	  } else {
	    
	    $sql3 = "UPDATE webcal_meal_participant SET ";
	    $sql3 .= "cal_notes = '" . $job[$i] . "' ";
	    $sql3 .= "WHERE cal_id = $id AND cal_login = '$none' " .
	      "AND cal_type = 'C'";

	  }

	  if ( ! dbi_query ( $sql3 ) ) {
	    $error = translate("Database error") . ": " . dbi_error ();
	    echo "Error = $error<br>";
	  }
	}
      }
    }
  }

  
  // log add/update
  activity_log ( $id, $login, $newevent ? $LOG_CREATE : $LOG_UPDATE, "" );
  

 
  if ( !empty( $error ) ) {
    echo "Error = $error<br>";
  }
  return $id; 
}



// If we were editing this event, then go back to the last view (week, day,
// month).  If this is a new event, then go to the preferred view for
// the date range that this event was added to.
if ( $id != 0 ) 
  $nexturl = "view_entry.php?id=$id";
else 
  $nexturl = "view_entry.php?id=$newid";
if ( empty ( $error ) ) {
  do_redirect( $nexturl );
} else {
  echo "error = $error<br>";
}

print_header();

print_trailer();
?>
</body>
</html>

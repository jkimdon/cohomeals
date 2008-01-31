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
$num_crew = mysql_safe( getPostValue( 'num_crew' ), false );
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
			      $menu, $num_crew, $walkins, 
			      $notes, $max_diners );

  $active_timestamp = mktime( 3,0,0, $month, $day, $year );

  if ( ($suit == "heart") && ($newevent == true) ) {
    $added = add_subscribed_diners( $newid, $active_timestamp, $count );
    if ( $added == true ) 
      add_financial_log_for_subscribers( $active_timestamp );
  }


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
}






////////////////////////////////////////////
function add_subscribed_diners( $id, $active_timestamp ) {

  $active_date = date( "Ymd", $active_timestamp );

  $added = false;

  $sql = "SELECT cal_login, cal_off_day FROM webcal_subscriptions " .
    "WHERE cal_suit = 'heart' " . 
    "AND cal_start <= '$active_date' AND cal_end > '$active_date'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $w = $row[1];
      $skipday = date ( "w", $active_timestamp );
      if ( $w != $skipday ) {
	$mod = edit_participation ( $id, 'A', 'M', $row[0] );
	if ( $mod == true ) {
	  $added = true;
	}
      }
    }
    dbi_free_result ( $res );
  } else {
    $error = translate("Database error") . ": " . dbi_error ();
  }

  return $added;
}



////////////////////////////////////////////
/// add the financial log events for subscribers
function add_financial_log_for_subscribers( $active_timestamp ) {

  $active_date = date( "Ymd", $active_timestamp );

  $sql = "SELECT cal_login, cal_off_day FROM webcal_subscriptions " .
    "WHERE cal_suit = 'heart' " .
    "AND cal_start <= '$active_date' AND cal_end > '$active_date'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $user = $row[0];
      $off_day = $row[1];
      $weekday = date( "w", $active_timestamp );
      if ( $off_day == $weekday ) $ct = 0;
      else $ct = 1;

      user_load_variables( $user, "temp" );
      $description = $GLOBALS[tempfullname] . 
	": ongoing heart subscription: new meals added";
      $amount = get_price( 0, $user, true );
      $amount *= $ct;
      add_financial_event( $user, get_billing_group( $user ),
			   $amount, "charge",
			   $description, 0, "" );
    }
    dbi_free_result ( $res );
  } else {
    $error = translate("Database error") . ": " . dbi_error ();
  }

}


///////////////////////////////////////////////////////
function add_or_edit_entry( $newevent, $id, $club_id, $suit, 
			    $day, $month, $year, 
			    $deadline, $base_price,
			    $hour, $minute, $ampm,
			    $menu, $num_crew, $walkins, 
			    $notes, $max_diners ) {
  global $is_meal_coordinator, $is_meal_coordinator;
  global $LOG_CREATE, $LOG_UPDATE;


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
    } else {
      // note old participants for email notification
      $sql = "SELECT cal_login FROM webcal_meal_participant " .
	"WHERE cal_id = $id ";
      $res = dbi_query ( $sql );
      if ( $res ) {
	for ( $i = 0; $tmprow = dbi_fetch_row ( $res ); $i++ ) {
	  $old_meal_participant[$tmprow[0]] = $tmprow[0];
	}
	dbi_free_result ( $res );
      } else {
	$error = "Database error: " . dbi_error ();
      }
    } // end old participants
  }

  if ( empty ( $error ) ) {

    if ( $newevent == true ) {
      $sql = "INSERT INTO webcal_meal ( cal_id, cal_club_id, " .
	"cal_date, cal_time, cal_suit, cal_menu, cal_num_crew, " .
	"cal_base_price, cal_signup_deadline, cal_walkins, cal_notes, " .
	"cal_max_diners ) " .
	"VALUES ( ";
      
      $sql .= $id . ", ";	
      $sql .= $club_id . ", ";
      $date = mktime ( 3, 0, 0, $month, $day, $year );
      $sql .= date ( "Ymd", $date ) . ", ";
      $sql .= sprintf ( "%02d%02d00, ", $hour, $minute );
      $sql .= "'" . $suit . "', ";
      $sql .= "'" . $menu . "', ";
      $sql .= $num_crew . ", ";
      $sql .= $base_price . ", ";
      $sql .= $deadline . ", ";
      $sql .= "'" . $walkins . "', ";
      $sql .= "'" . $notes . "', ";
      $sql .= $max_diners . ")";
    }
    else { 
      $sql = "UPDATE webcal_meal " . 
	"SET ";
      
      $date = mktime ( 3, 0, 0, $month, $day, $year );
      $sql .= "cal_date = " . date ( "Ymd", $date ) . ", ";
      $sql .= "cal_time = " . sprintf ( "%02d%02d00, ", $hour, $minute );
      $sql .= "cal_menu = '" . $menu . "', ";
      $sql .= "cal_num_crew = " . $num_crew . ", ";
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
  }
  
  
  // log add/update
  activity_log ( $id, $login, $newevent ? $LOG_CREATE : $LOG_UPDATE, "" );
  
  
  // now add participants and send out notifications
  if ( ! $newevent && count ( $old_meal_participant ) > 0 ) {  
    while ( list ( $old_participant, $dummy ) = each ( $old_meal_participant ) ) {
      
      $from = $user_email;
      if ( empty ( $from ) && ! empty ( $email_fallback_from ) )
	$from = $email_fallback_from;
      // only send mail if their email address is filled in
      $do_send = get_pref_setting ( $old_participant,
				    $newevent ? "EMAIL_EVENT_ADDED" : "EMAIL_EVENT_UPDATED" );
      user_load_variables ( $old_participant, "temp" );
      if ( $old_participant != $login && 
	   strlen ( $tempemail ) &&
	   $do_send == "Y" && $send_email != "N" ) {
	
	$user_hour = $hour;
	$user_month = $month;
	$user_day = $day;
	$user_year = $year;
	
	$fmtdate = sprintf ( "%04d%02d%02d", $user_year, $user_month, $user_day );
	$msg = translate("Hello") . ", " . $tempfullname . ".\n\n";
	$msg .= translate("A meal has been updated by");
	
	$msg .= " " . $login_fullname .  ". " .
	  "The suit is " . $suit . "\"\n\n" .
	  "Date: " . date_to_str ( $fmtdate ) . "\n" .
	  "Time: " .
	  display_time ( ( $user_hour * 10000 ) + ( $minute * 100 ), true ) . 
	  "\n";
	// add URL to event, if we can figure it out
	if ( ! empty ( $server_url ) ) {
	  $url = $server_url .  "view_entry.php?id=" .  $id;
	  $msg .= "\n\n" . $url;
	}
	if ( strlen ( $from ) ) {
	  $extra_hdrs = "From: $from\r\nX-Mailer: " . translate($application_name);
	} else {
	  $extra_hdrs = "X-Mailer: " . translate($application_name);
	}
	mail ( $tempemail,
	       translate($application_name) . " " . translate("Notification") . ": " . $name,
	       html_to_8bits ($msg), $extra_hdrs );
	activity_log ( $id, $login, $LOG_NOTIFICATION, "" );
      } // end sending email
    } // end loop through participants
  } // end email participants

 
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

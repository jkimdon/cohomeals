<?php
include_once 'includes/init.php';
include_once 'includes/site_extras.php';

$error = "";

$repeats = getPostValue( 'repeats' );
$newevent = getPostValue( 'newevent' );
$id = mysql_safe( getPostValue( 'id' ), false );
$suit = mysql_safe( getPostValue( 'suit' ), true );
$day = getPostValue( 'day' );
$month = getPostValue( 'month' );
$year = getPostValue( 'year' );
$endday = getPostValue( 'endday' );
$endmonth = getPostValue( 'endmonth' );
$endyear = getPostValue( 'endyear' );
$hour = getPostValue( 'hour' );
$minute = getPostValue( 'minute' );
$ampm = getPostValue( 'ampm' );
$menu = mysql_safe( getPostValue( 'menu' ), true );
$head_chef = mysql_safe( getPostValue( 'head_chef' ), true );
$num_cooks = mysql_safe( getPostValue( 'num_cooks' ), false );
$num_setup = mysql_safe( getPostValue( 'num_setup' ), false );
$num_cleanup = mysql_safe( getPostValue( 'num_cleanup' ), false );
$num_other_crew = mysql_safe( getPostValue( 'num_other_crew' ), false );
$walkins = mysql_safe( getPostValue( 'walkins' ), true );
$notes = mysql_safe( getPostValue( 'notes' ), true );


for ( $i=0; $i<7; $i++ ) {
  $repday[$i] = 0;
  $key = "d$i";
  if ( getPostValue( $key ) == true ) 
    $repday[$i] = 1;
}

if ( !$is_meal_coordinator ) {
  $error = "Not authorized.";
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

if ( $endday == 0 ) 
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

$count = array();
for ( $i=0; $i<7; $i++ ) 
  $count[$i] = 0;

while ( $current_date <= $end_date ) {

  $newid = add_or_edit_entry( $newevent, $id, $club_id, 
			      $suit, $day, $month, $year, 
			      $hour, $minute, $ampm,
			      $menu, $head_chef, $num_cooks, 
			      $num_setup, $num_cleanup, 
			      $num_other_crew, $walkins, $notes );

  if ( $suit == "heart" ) {
    add_subscribed_diners( $newid, $day, $month, $year, $count );
  }


  if ( $repeats == "false" ) {
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

if ( $suit == "heart" )
  add_financial_log_for_subscribers( $count );







////////////////////////////////////////////
function add_subscribed_diners( $id, $day, $month, $year, &$count ) {

  $sql = "SELECT cal_login, cal_off_day FROM webcal_subscriptions " .
    "WHERE cal_suit = 'heart'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $w = $row[1];
      $skipday = date ( "w", mktime( 3,0,0, $month, $day, $year ) );
      if ( $w != $skipday ) {
	$mod = edit_participation ( $id, 'A', 'M', $row[0] );
	if ( $mod == true )
	  $count[$skipday]++;
      }
    }
    dbi_free_result ( $res );
  } else {
    $error = translate("Database error") . ": " . dbi_error ();
  }

}



////////////////////////////////////////////
/// add the financial log events for subscribers
function add_financial_log_for_subscribers( $count ) {

  $sql = "SELECT cal_login, cal_off_day FROM webcal_subscriptions " .
    "WHERE cal_suit = 'heart'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $user = $row[0];
      $w = $row[1];
      $ct = 0;
      for ( $i=0; $i<7; $i++ ) {
	if ( $w != $i ) {
	  $ct += $count[$i];
	}
      }

      user_load_variables( $user, "temp" );
      $description = $GLOBALS[tempfullname] . 
	": ongoing heart subscription";
      $amount = get_price( 0, $user, true );
      $amount *= $ct;
      $billing = get_billing_group( $user );
      add_financial_event( $billing, $amount, 
			   $description, 0, "" );
    }
    dbi_free_result ( $res );
  } else {
    $error = translate("Database error") . ": " . dbi_error ();
  }

}


///////////////////////////////////////////////////////
function add_or_edit_entry( $newevent, $id, $club_id, $suit, 
			    $day, $month, $year, $hour, $minute, $ampm,
			    $menu, $head_chef, $num_cooks, $num_setup, 
			    $num_cleanup, $num_other_crew, $walkins, $notes ) {
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

}


// Make sure this user is really allowed to edit this event.
// Otherwise, someone could hand type in the URL to edit someone else's
// event.
// Can edit if:
//   - user is meal coordinator
$can_edit = false;
if ( $is_meal_coordinator ) {
  $can_edit = true;
}
if ( ! $can_edit ) {
  $error = translate ( "You are not authorized" );
}
else {
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


// handle external participants
$ext_names = array ();
$ext_emails = array ();
$matches = array ();
$ext_count = 0;
if ( ! empty ( $allow_external_users ) && 
  $allow_external_users == "Y" &&
  ! empty ( $externalparticipants ) ) {
  $lines = explode ( "\n", $externalparticipants );
  if ( ! is_array ( $lines ) ) {
    $lines = array ( $externalparticipants );
  }
  if ( is_array ( $lines ) ) {
    for ( $i = 0; $i < count ( $lines ); $i++ ) {
      $ext_words = explode ( " ", $lines[$i] );
      if ( ! is_array ( $ext_words ) ) {
        $ext_words = array ( $lines[$i] );
      }
      if ( is_array ( $ext_words ) ) {
        $ext_names[$ext_count] = "";
        $ext_emails[$ext_count] = "";
        for ( $j = 0; $j < count ( $ext_words ); $j++ ) {
          // use regexp matching to pull email address out
          $ext_words[$j] = chop ( $ext_words[$j] ); // remove \r if there is one
          if ( preg_match ( "/<?\\S+@\\S+\\.\\S+>?/", $ext_words[$j],
            $matches ) ) {
            $ext_emails[$ext_count] = $matches[0];
            $ext_emails[$ext_count] = preg_replace ( "/[<>]/", "",
              $ext_emails[$ext_count] );
          } else {
            if ( strlen ( $ext_names[$ext_count] ) ) {
              $ext_names[$ext_count] .= " ";
            }
            $ext_names[$ext_count] .= $ext_words[$j];
          }
        }
        // Test for duplicate Names
        if ( $i > 0 ) {
          for ( $k = $i ; $k > 0 ; $k-- ) {
            if ( $ext_names[$i] == $ext_names[$k] ) { 
              $ext_names[$i]  .= "[$k]";     
            }
          }
        }
        if ( strlen ( $ext_emails[$ext_count] ) &&
          empty ( $ext_names[$ext_count] ) ) {
          $ext_names[$ext_count] = $ext_emails[$ext_count];
        }
        $ext_count++;
      }
    }
  }
}


//Avoid Undefined variable message
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
    // save old participants
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id ";
    $res = dbi_query ( $sql );
    if ( $res ) {
      for ( $i = 0; $tmprow = dbi_fetch_row ( $res ); $i++ ) {
        $old_meal_participant[$tmprow[0]] = $tmprow[0];
      }
      dbi_free_result ( $res );
    } else {
      $error = translate("Database error") . ": " . dbi_error ();
    }
    if ( empty ( $error ) ) {
      dbi_query ( "DELETE FROM webcal_meal WHERE cal_id = $id" );
    }
  }

  $sql = "INSERT INTO webcal_meal ( cal_id, cal_club_id, " .
    "cal_date, cal_time, cal_suit, cal_menu, cal_head_chef, cal_num_cooks, " .
    "cal_num_cleanup, cal_num_setup, cal_num_other_crew, " .
    "cal_walkins, cal_notes ) " .
    "VALUES ( $id, ";

  $sql .= $club_id . ", ";
  $date = mktime ( 3, 0, 0, $month, $day, $year );
  $sql .= date ( "Ymd", $date ) . ", ";
  $sql .= sprintf ( "%02d%02d00, ", $hour, $minute );
  $sql .= "'" . $suit . "', ";
  $sql .= "'" . $menu . "', ";
  $sql .= "'" . $head_chef . "', ";
  $sql .= $num_cooks . ", ";
  $sql .= $num_cleanup . ", ";
  $sql .= $num_setup . ", ";
  $sql .= $num_other_crew . ", ";
  $sql .= empty ( $walkins ) ? "'D', " : "'$walkins', ";
  $sql .= "'" . $notes . "' )";


  if ( empty ( $error ) ) {
    if ( ! dbi_query ( $sql ) ) {
      $error = translate("Database error") . ": " . dbi_error ();
    }
  }

  // log add/update
  activity_log ( $id, $login, $login,
    $newevent ? $LOG_CREATE : $LOG_UPDATE, "" );
  
  // check if participants have been removed and send out emails
  if ( ! $newevent && count ( $old_meal_participant ) > 0 ) {  
    while ( list ( $old_participant, $dummy ) = each ( $old_meal_participant ) ) {
      $found_flag = false;
      for ( $i = 0; $i < count ( $participants ); $i++ ) {
        if ( $participants[$i] == $old_participant ) {
          $found_flag = true;
          break;
        }
      }
      if ( !$found_flag ) {
        // only send mail if their email address is filled in
        $do_send = get_pref_setting ( $old_participant, "EMAIL_EVENT_DELETED" );
        $user_language = get_pref_setting ( $old_participant, "LANGUAGE" );
        user_load_variables ( $old_participant, "temp" );
        if ( $old_participant != $login && strlen ( $tempemail ) &&
          $do_send == "Y" && $send_email != "N" ) {

          $user_hour = $hour;
          if ( $user_hour < 0 ) {
            $user_hour += 24;
            // adjust date
            $user_date = mktime ( 3, 0, 0, $month, $day, $year );
            $user_date -= $ONE_DAY;
            $user_month = date ( "m", $date );
            $user_day = date ( "d", $date );
            $user_year = date ( "Y", $date );
          } elseif ( $user_hour >= 24 ) {
            $user_hour -= 24;
            // adjust date
            $user_date = mktime ( 3, 0, 0, $month, $day, $year );
            $user_date += $ONE_DAY;
            $user_month = date ( "m", $date );
            $user_day = date ( "d", $date );
            $user_year = date ( "Y", $date );
          } else {
            $user_month = $month;
            $user_day = $day;
            $user_year = $year;
          }
          if (($GLOBALS['LANGUAGE'] != $user_language) && 
            ! empty ( $user_language ) && ( $user_language != 'none' )){
            reset_language ( $user_language );
          }
          //do_debug($user_language);    
          $fmtdate = sprintf ( "%04d%02d%02d", $user_year, $user_month, $user_day );
          $msg = translate("Hello") . ", " . $tempfullname . ".\n\n" .
            translate("An appointment has been canceled for you by") .
            " " . $login_fullname .  ". " .
            translate("The subject was") . " \"" . $name . "\"\n\n" .
            translate("The notes were") . " \"" . $notes . "\"\n" .
            translate("Date") . ": " . date_to_str ( $fmtdate ) . "\n" .
            ( ( empty ( $user_hour ) && empty ( $minute ) ) ? "" :
            translate("Time") . ": " .
              display_time ( ( $user_hour * 10000 ) + ( $minute * 100 ), true ) ) .
            "\n\n\n";
          // add URL to event, if we can figure it out
          if ( ! empty ( $server_url ) ) {
            $url = $server_url .  "view_entry.php?id=" .  $id;
            $msg .= $url . "\n\n";
          }
         
          if ( strlen ( $login_email ) ) {
            $extra_hdrs = "From: $login_email\r\nX-Mailer: " . translate($application_name);
          } else {
            $extra_hdrs = "From: $email_fallback_from\r\nX-Mailer: " . translate($application_name);
          }
          mail ( $tempemail,
            translate($application_name) . " " . translate("Notification") . ": " . $name,
            html_to_8bits ($msg), $extra_hdrs );
          activity_log ( $id, $login, $old_participant, $LOG_NOTIFICATION,
     "User removed from participants list" );
        }
      }
    }
  }

  // now add participants and send out notifications
  for ( $i = 0; $i < count ( $participants ); $i++ ) {

    // Some users report that they get an error on duplicate keys
    // on the following add... As a safety measure, delete any
    // existing entry with the id.  Ignore the result.
    $participants[$i] = mysql_safe( $participants[$i], true );
    dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_id = $id " .
      "AND cal_login = '$participants[$i]'" );
    $sql = "INSERT INTO webcal_meal_participant " .
      "( cal_id, cal_login ) VALUES ( $id, '$participants[$i]' )";
    if ( ! dbi_query ( $sql ) ) {
      $error = translate("Database error") . ": " . dbi_error ();
      break;
    } else {
      $from = $user_email;
      if ( empty ( $from ) && ! empty ( $email_fallback_from ) )
	$from = $email_fallback_from;
      // only send mail if their email address is filled in
      $do_send = get_pref_setting ( $participants[$i],
	         $newevent ? "EMAIL_EVENT_ADDED" : "EMAIL_EVENT_UPDATED" );
      $user_language = get_pref_setting ( $participants[$i], "LANGUAGE" );
      user_load_variables ( $participants[$i], "temp" );
      if ( $participants[$i] != $login && 
	   strlen ( $tempemail ) &&
	   $do_send == "Y" && $send_email != "N" ) {

	$user_hour = $hour;
	if ( $user_hour < 0 ) {
	  $user_hour += 24;
	  // adjust date
	  $user_date = mktime ( 3, 0, 0, $month, $day, $year );
	  $user_date -= $ONE_DAY;
	  $user_month = date ( "m", $date );
	  $user_day = date ( "d", $date );
	  $user_year = date ( "Y", $date );
	} elseif ( $user_hour >= 24 ) {
	  $user_hour -= 24;
	  // adjust date
	  $user_date = mktime ( 3, 0, 0, $month, $day, $year );
	  $user_date += $ONE_DAY;
	  $user_month = date ( "m", $date );
	  $user_day = date ( "d", $date );
	  $user_year = date ( "Y", $date );
	} else {
	  $user_month = $month;
	  $user_day = $day;
	  $user_year = $year;
	}
	if (($GLOBALS['LANGUAGE'] != $user_language) && 
            ! empty ( $user_language ) && ( $user_language != 'none' )) {
	  reset_language ( $user_language );
	}
	//do_debug($user_language);
	$fmtdate = sprintf ( "%04d%02d%02d", $user_year, $user_month, $user_day );
	$msg = translate("Hello") . ", " . $tempfullname . ".\n\n";
	if ( $newevent || ( empty ( $old_meal_participant[$participants[$i]] ) ) ) {
	  $msg .= translate("A new appointment has been made for you by");
	} else {
	  $msg .= translate("An appointment has been updated by");
	}
	$msg .= " " . $login_fullname .  ". " .
	  translate("The subject is") . " \"" . $name . "\"\n\n" .
	  translate("The notes are") . " \"" . $notes . "\"\n" .
	  translate("Date") . ": " . date_to_str ( $fmtdate ) . "\n" .
	  ( ( empty ( $user_hour ) && empty ( $minute ) ) ? "" :
            translate("Time") . ": " .
            display_time ( ( $user_hour * 10000 ) + ( $minute * 100 ), true ) . "\n" ) .
	  translate("Please look on") . " " . translate($application_name) . " " .
	  translate("to view this appointment") . ".";
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
	activity_log ( $id, $login, $participants[$i], $LOG_NOTIFICATION, "" );
      }
    }
  }
  
  // add external participants
  // send notification if enabled.
  if ( is_array ( $ext_names ) && is_array ( $ext_emails ) ) {
    for ( $i = 0; $i < count ( $ext_names ); $i++ ) {
      if ( strlen ( $ext_names[$i] ) ) {
	$ext_names[$i] = mysql_safe( $ext_names[$i], true );
	$ext_emails[$i] = mysql_safe( $ext_emails[$i], true );
        $sql = "INSERT INTO webcal_entry_ext_user " .
          "( cal_id, cal_fullname, cal_email ) VALUES ( " .
          "$id, '$ext_names[$i]', ";
        if ( strlen ( $ext_emails[$i] ) ) {
          $sql .= "'$ext_emails[$i]' )";
        } else {
          $sql .= "NULL )";
        }
        if ( ! dbi_query ( $sql ) ) {
          $error = translate("Database error") . ": " . dbi_error ();
        }
        // send mail notification if enabled
        // TODO: move this code into a function...
        if ( $external_notifications == "Y" && $send_email != "N" &&
          strlen ( $ext_emails[$i] ) > 0 ) {
          $fmtdate = sprintf ( "%04d%02d%02d", $year, $month, $day );
          // Strip [\d] from duplicate Names before emailing
          $ext_names[$i] = trim(preg_replace( '/\[[\d]]/', "", $ext_names[$i]) );
          $msg = translate("Hello") . ", " . $ext_names[$i] . ".\n\n";
          if ( $newevent ) {
            $msg .= translate("A new appointment has been made for you by");
          } else {
            $msg .= translate("An appointment has been updated by");
          }
          $msg .= " " . $login_fullname .  ". " .
            translate("The subject is") . " \"" . $name . "\"\n\n" .
            translate("The notes are") . " \"" . $notes . "\"\n" .
            translate("Date") . ": " . date_to_str ( $fmtdate ) . "\n" .
            ( ( empty ( $hour ) && empty ( $minute ) ) ? "" :
            translate("Time") . ": " .
            display_time ( ( $hour * 10000 ) + ( $minute * 100 ) ) . "\n" ) .
            translate("Please look on") . " " . translate($application_name) .
            ".";
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
          mail ( $ext_emails[$i],
            translate($application_name) . " " .
            translate("Notification") . ": " . $name,
            html_to_8bits ($msg), $extra_hdrs );
        
        }
      }
    }
  }
}
}
 return $id; 
}

// If we were editing this event, then go back to the last view (week, day,
// month).  If this is a new event, then go to the preferred view for
// the date range that this event was added to.
if ( empty ( $error ) ) {
  do_redirect( "month.php" );
}

print_header();

print_trailer();
?>
</body>
</html>

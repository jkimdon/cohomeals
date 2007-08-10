<?php
include_once 'includes/init.php';
include_once 'includes/site_extras.php';

$error = "";

if ( empty ( $TZ_OFFSET ) ) {
  $TZ_OFFSET = 0;
}

if ( empty ( $endhour ) ) {
  $endhour = 0;
}
// Modify the time to be server time rather than user time.
if ( ! empty ( $hour ) && ( $timetype == 'T' ) ) {
  // Convert to 24 hour before subtracting TZ_OFFSET so am/pm isn't confused.
  // Note this obsoltes any code in the file below that deals with am/pm
  // so the code can be deleted
  if ( $TIME_FORMAT == '12' && $hour < 12 ) {
    if ( $ampm == 'pm' )
     $hour += 12;
  } elseif ($TIME_FORMAT == '12' && $hour == '12' && $ampm == 'am' ) {
    $hour = 0;
  }
  if ( $GLOBALS['TIMED_EVT_LEN'] == 'E') {
    if ( isset ( $endhour ) && $TIME_FORMAT == '12' ) {
      // Convert end time to a twenty-four hour time scale.
      if ( $endampm == 'pm' && $endhour < 12 ) {
        $endhour += 12;
      } elseif ( $endampm == 'am' && $endhour == 12 ) {
        $endhour = 0;
      }
    }
  }
  $TIME_FORMAT=24;
  $hour -= $TZ_OFFSET;
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

  // Must adjust $endhour too
  if ($TZ_OFFSET) {
    $endhour -= $TZ_OFFSET;
    if ( $endhour < 0 )   $endhour += 24;
    if ( $endhour >= 24 ) $endhour -= 24;
  }
}

// Make sure this user is really allowed to edit this event.
// Otherwise, someone could hand type in the URL to edit someone else's
// event.
// Can edit if:
//   - new event
//   - user is admin
//   - user is participant
$can_edit = false;
if ( empty ( $id ) ) {
  // New event...
  $can_edit = true;
}
if ( $is_admin ) {
  $can_edit = true;
}
if ( empty ( $error ) && ! $can_edit ) {
  // is user a participant of that event ?
  $sql = "SELECT cal_id FROM webcal_meal_participant WHERE cal_id = '$id' " .
    "AND cal_login = '$login'";
  $res = dbi_query ( $sql );
  if ($res) {
    $row = dbi_fetch_row ( $res );
    if ( ! empty( $row[0] ) )
      $can_edit = true; // is participant
    dbi_free_result ( $res );
  } else
    $error = translate("Database error") . ": " . dbi_error ();
}

if ( ! $can_edit && empty ( $error ) ) {
  $error = translate ( "You are not authorized" );
}

// If display of participants is disabled, set the participant list
// to the event creator.  This also works for single-user mode.
// Basically, if no participants were selected (because there
// was no selection list available in the form or because the user
// refused to select any participant from the list), then we will
// assume the only participant is the current user.
if ( empty ( $participants[0] ) ) {
  $participants[0] = $login;
  // There might be a better way to do this, but if Admin sets this value,
  // WebCalendar should respect it
  if ( ! empty ( $public_access_default_selected ) &&
    $public_access_default_selected == "Y" ) {
    $participants[1] = "__public__";     
  }
}
// If "all day event" was selected, then we set the event time
// to be 12AM with a duration of 24 hours.
// We don't actually store the "all day event" flag per se.  This method
// makes conflict checking much simpler.  We just need to make sure
// that we don't screw up the day view (which normally starts the
// view with the first timed event).
// Note that if someone actually wants to create an event that starts
// at midnight and lasts exactly 24 hours, it will be treated in the
// same manner.

$duration_h = getValue ( "duration_h" );
$duration_m = getValue ( "duration_m" );

if ( $timetype == "A" ) {
  $duration_h = 24;
  $duration_m = 0;
  $hour = 0;
  $minute = 0;
}

$duration = ( $duration_h * 60 ) + $duration_m;
if ( $hour > 0 && $timetype != 'U' ) {
  if ( $TIME_FORMAT == '12' ) {
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
}
//echo "SERVER HOUR: $hour $ampm";

if ( $GLOBALS['TIMED_EVT_LEN'] == 'E' && $timetype == "T" ) {
    if ( ! isset ( $endhour ) ) {
        $duration = 0;
    } else {
      // Calculate duration.
      $endmins = ( 60 * (int) ( $endhour ) ) + $endminute;
      $startmins = ( 60 * $hour ) + $minute;
      $duration = $endmins - $startmins;
    }
    if ( $duration < 0 ) {
        $duration = 0;
    }
}

// handle external participants
$ext_names = array ();
$ext_emails = array ();
$matches = array ();
$ext_count = 0;
if ( $single_user == "N" &&
  ! empty ( $allow_external_users ) && 
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

if ( strlen ( $hour ) > 0 && $timetype != 'U' ) {
  $date = mktime ( 3, 0, 0, $month, $day, $year );
  $str_cal_date = date ( "Ymd", $date );
  if ( strlen ( $hour ) > 0 ) {
    $str_cal_time = sprintf ( "%02d%02d00", $hour, $minute );
  }
  $endt = 'NULL';
  $dayst = "nnnnnnn";
}
//Avoid Undefined variable message
$msg = '';
if ( empty ( $error ) ) {
  $newevent = true;
  // now add the entries
  if ( empty ( $id ) ) {
    $res = dbi_query ( "SELECT MAX(cal_id) FROM webcal_meal" );
    if ( $res ) {
      $row = dbi_fetch_row ( $res );
      $id = $row[0] + 1;
      dbi_free_result ( $res );
    } else {
      $id = 1;
    }
  } else {
    $newevent = false;
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
      dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_id = $id" );
      dbi_query ( "DELETE FROM webcal_entry_ext_user WHERE cal_id = $id" );
      dbi_query ( "DELETE FROM webcal_site_extras WHERE cal_id = $id" );
    }
  }

  $sql = "INSERT INTO webcal_meal ( cal_id, " .
    "cal_date, " .
    "cal_time, cal_duration, " .
    "cal_walkins, cal_suit, cal_description ) " .
    "VALUES ( $id, ";
    
  $date = mktime ( 3, 0, 0, $month, $day, $year );
  $sql .= date ( "Ymd", $date ) . ", ";
  if ( strlen ( $hour ) > 0 && $timetype != 'U' ) {
    $sql .= sprintf ( "%02d%02d00, ", $hour, $minute );
  } else {
    $sql .= "-1, ";
  }
  $sql .= sprintf ( "%d, ", $duration );
  $sql .= empty ( $walkins ) ? "'D', " : "'$walkins', ";

  if ( strlen ( $name ) == 0 ) {
    $name = translate("Unnamed Event");
  }
  $sql .= "'" . $name .  "', ";
  if ( strlen ( $description ) == 0 ) {
    $description = $name;
  }
  $sql .= "'" . $description . "' )";
  
  if ( empty ( $error ) ) {
    if ( ! dbi_query ( $sql ) ) {
      $error = translate("Database error") . ": " . dbi_error ();
    }
  }

  // log add/update
  activity_log ( $id, $login, ($is_assistant || $is_nonuser_admin ? $user : $login),
    $newevent ? $LOG_CREATE : $LOG_UPDATE, "" );
  
  if ( $single_user == "Y" ) {
    $participants[0] = $single_user_login;
  }

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
     $is_nonuser_admin = user_is_nonuser_admin ( $login, $old_participant );
      // Don't send mail if we are editing a non-user calendar
      // and we are the admin
      if ( !$found_flag && !$is_nonuser_admin) {
        // only send mail if their email address is filled in
        $do_send = get_pref_setting ( $old_participant, "EMAIL_EVENT_DELETED" );
        $user_TZ = get_pref_setting ( $old_participant, "TZ_OFFSET" );
        $user_language = get_pref_setting ( $old_participant, "LANGUAGE" );
        user_load_variables ( $old_participant, "temp" );
        if ( $old_participant != $login && strlen ( $tempemail ) &&
          $do_send == "Y" && $send_email != "N" ) {

          // Want date/time in user's timezone
          $user_hour = $hour + $user_TZ;
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
            translate("The description is") . " \"" . $description . "\"\n" .
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
    // Is the person adding the nonuser calendar admin
    $is_nonuser_admin = user_is_nonuser_admin ( $login, $participants[$i] );

    // Some users report that they get an error on duplicate keys
    // on the following add... As a safety measure, delete any
    // existing entry with the id.  Ignore the result.
    dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_id = $id " .
      "AND cal_login = '$participants[$i]'" );
    $sql = "INSERT INTO webcal_meal_participant " .
      "( cal_id, cal_login ) VALUES ( $id, '$participants[$i]' )";
    if ( ! dbi_query ( $sql ) ) {
      $error = translate("Database error") . ": " . dbi_error ();
      break;
    } else {
      // Don't send mail if we are editing a non-user calendar
      // and we are the admin
      if (!$is_nonuser_admin) {
        $from = $user_email;
        if ( empty ( $from ) && ! empty ( $email_fallback_from ) )
          $from = $email_fallback_from;
        // only send mail if their email address is filled in
        $do_send = get_pref_setting ( $participants[$i],
           $newevent ? "EMAIL_EVENT_ADDED" : "EMAIL_EVENT_UPDATED" );
        $user_TZ = get_pref_setting ( $participants[$i], "TZ_OFFSET" );
        $user_language = get_pref_setting ( $participants[$i], "LANGUAGE" );
        user_load_variables ( $participants[$i], "temp" );
        if ( $participants[$i] != $login && 
          boss_must_be_notified ( $login, $participants[$i] ) && 
          strlen ( $tempemail ) &&
          $do_send == "Y" && $send_email != "N" ) {

          // Want date/time in user's timezone
          $user_hour = $hour + $user_TZ;
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
            translate("The description is") . " \"" . $description . "\"\n" .
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
  }

  // add external participants
  // send notification if enabled.
  if ( is_array ( $ext_names ) && is_array ( $ext_emails ) ) {
    for ( $i = 0; $i < count ( $ext_names ); $i++ ) {
      if ( strlen ( $ext_names[$i] ) ) {
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
            translate("The description is") . " \"" . $description . "\"\n" .
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

  // add site extras
  for ( $i = 0; $i < count ( $site_extras ) && empty ( $error ); $i++ ) {
    $sql = "";
    $extra_name = $site_extras[$i][0];
    $extra_type = $site_extras[$i][2];
    $extra_arg1 = $site_extras[$i][3];
    $extra_arg2 = $site_extras[$i][4];
    $value = $$extra_name;
    //echo "Looking for $extra_name... value = " . $value . " ... type = " .
    // $extra_type . "<br />\n";
    if ( strlen ( $$extra_name ) || $extra_type == $EXTRA_DATE ) {
      if ( $extra_type == $EXTRA_URL || $extra_type == $EXTRA_EMAIL ||
        $extra_type == $EXTRA_TEXT || $extra_type == $EXTRA_USER ||
        $extra_type == $EXTRA_MULTILINETEXT ||
        $extra_type == $EXTRA_SELECTLIST  ) {
        $sql = "INSERT INTO webcal_site_extras " .
          "( cal_id, cal_name, cal_type, cal_data ) VALUES ( " .
          "$id, '$extra_name', $extra_type, '$value' )";
      } else if ( $extra_type == $EXTRA_REMINDER && $value == "1" ) {
        if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_DATE ) > 0 ) {
          $yname = $extra_name . "year";
          $mname = $extra_name . "month";
          $dname = $extra_name . "day";
          $edate = sprintf ( "%04d%02d%02d", $$yname, $$mname, $$dname );
          $sql = "INSERT INTO webcal_site_extras " .
            "( cal_id, cal_name, cal_type, cal_remind, cal_date ) VALUES ( " .
            "$id, '$extra_name', $extra_type, 1, $edate )";
        } else if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_OFFSET ) > 0 ) {
          $dname = $extra_name . "_days";
          $hname = $extra_name . "_hours";
          $mname = $extra_name . "_minutes";
          $minutes = ( $$dname * 24 * 60 ) + ( $$hname * 60 ) + $$mname;
          $sql = "INSERT INTO webcal_site_extras " .
            "( cal_id, cal_name, cal_type, cal_remind, cal_data ) VALUES ( " .
            "$id, '$extra_name', $extra_type, 1, '" . $minutes . "' )";
        } else {
          $sql = "INSERT INTO webcal_site_extras " .
          "( cal_id, cal_name, cal_type, cal_remind ) VALUES ( " .
          "$id, '$extra_name', $extra_type, 1 )";
        }
      } else if ( $extra_type == $EXTRA_DATE )  {
        $yname = $extra_name . "year";
        $mname = $extra_name . "month";
        $dname = $extra_name . "day";
        $edate = sprintf ( "%04d%02d%02d", $$yname, $$mname, $$dname );
        $sql = "INSERT INTO webcal_site_extras " .
          "( cal_id, cal_name, cal_type, cal_date ) VALUES ( " .
          "$id, '$extra_name', $extra_type, $edate )";
      }
    }
    if ( strlen ( $sql ) && empty ( $error ) ) {
      //echo "SQL: $sql<BR>\n";
      if ( ! dbi_query ( $sql ) ) {
        $error = translate("Database error") . ": " . dbi_error ();
      }
    }
  }

}

// If we were editing this event, then go back to the last view (week, day,
// month).  If this is a new event, then go to the preferred view for
// the date range that this event was added to.
if ( empty ( $error ) ) {
  $xdate = sprintf ( "%04d%02d%02d", $year, $month, $day );
  $user_args = ( empty ( $user ) ? '' : "user=$user" );
  send_to_preferred_view ( $xdate, $user_args );
}

print_header();

print_trailer();
?>
</body>
</html>

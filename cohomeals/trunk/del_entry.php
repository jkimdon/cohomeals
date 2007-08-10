<?php
include_once 'includes/init.php';

$my_event = false;
$can_edit = false;

// First, check to see if this user should be able to delete this event.
if ( $id > 0 ) {
  // first see who has access to edit this entry
  if ( $is_admin ) {
    $can_edit = true;
  } else if ( $readonly == "Y" ) {
    $can_edit = false;
  } else {
    $can_edit = false;
    $sql = "SELECT webcal_meal.cal_id FROM webcal_meal, " .
      "webcal_meal_participant WHERE webcal_meal.cal_id = " .
      "webcal_meal_participant.cal_id AND webcal_meal.cal_id = $id " .
      "AND webcal_meal_participant.cal_login = '$login'";
    $res = dbi_query ( $sql );
    if ( $res ) {
      $row = dbi_fetch_row ( $res );
      if ( $row && $row[0] > 0 )
        $can_edit = true;
      dbi_free_result ( $res );
    }
  }
}


if ( $readonly == 'Y' )
  $can_edit = false;

if ( ! $can_edit ) {
  $error = translate ( "You are not authorized" );
}

if ( $id > 0 && empty ( $error ) ) {
  if ( ! empty ( $date ) ) {
    $thisdate = $date;
  } else {
    $res = dbi_query ( "SELECT cal_date FROM webcal_meal WHERE cal_id = $id" );
    if ( $res ) {
      // date format is 19991231
      $row = dbi_fetch_row ( $res );
      $thisdate = $row[0];
    }
  }

  // Only allow delete of webcal_meal
  // if owner or admin, not participant.
  if ( $is_admin || $my_event ) {

    // Email participants that the event was deleted
    // First, get list of participants 
    $sql = "SELECT cal_login FROM webcal_meal_participant WHERE cal_id = $id ";
    $res = dbi_query ( $sql );
    $partlogin = array ();
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
        if ( $row[0] != $login )
   $partlogin[] = $row[0];
      }
      dbi_free_result($res);
    }

    // Get event name
    $sql = "SELECT cal_suit, cal_date, cal_time " .
      "FROM webcal_meal WHERE cal_id = $id";
    $res = dbi_query($sql);
    if ( $res ) {
      $row = dbi_fetch_row ( $res );
      $name = $row[0];
      $eventdate = $row[1];
      $eventtime = $row[2];
      dbi_free_result ( $res );
    }
    $TIME_FORMAT=24;
    for ( $i = 0; $i < count ( $partlogin ); $i++ ) {
      // Log the deletion
      activity_log ( $id, $login, $partlogin[$i], $LOG_DELETE, "" );

      $do_send = get_pref_setting ( $partlogin[$i], "EMAIL_EVENT_DELETED" );
      $user_TZ = get_pref_setting ( $partlogin[$i], "TZ_OFFSET" );
      $user_language = get_pref_setting ( $partlogin[$i], "LANGUAGE" );
      user_load_variables ( $partlogin[$i], "temp" );
      // Want date/time in user's timezone
      if ( $eventtime != '-1' ) { 
        $eventtime += ( $user_TZ * 10000 );
        if ( $eventtime < 0 ) {
          $eventtime += 240000;
        } else if ( $eventtime >= 240000 ) {
          $eventtime -= 240000;
        }
      }            
      if ( $partlogin[$i] != $login && $do_send == "Y" && boss_must_be_notified ( $login, $partlogin[$i] ) && 
        strlen ( $tempemail ) && $send_email != "N" ) {
         if (($GLOBALS['LANGUAGE'] != $user_language) && ! empty ( $user_language ) && ( $user_language != 'none' )){
          reset_language ( $user_language );
        }
        $msg = translate("Hello") . ", " . $tempfullname . ".\n\n" .
          translate("An appointment has been canceled for you by") .
          " " . $login_fullname .  ".\n" .
          translate("The subject was") . " \"" . $name . "\"\n" .
          translate("Date") . ": " . date_to_str ($thisdate) . "\n";
          if ( $eventtime != '-1' ) $msg .= translate("Time") . ": " . display_time ($eventtime, true);
          $msg .= "\n\n";
        if ( strlen ( $login_email ) )
          $extra_hdrs = "From: $login_email\r\nX-Mailer: " .
            translate($application_name);
        else
          $extra_hdrs = "From: $email_fallback_from\r\nX-Mailer: " .
            translate($application_name);
        mail ( $tempemail,
          translate($application_name) . " " .
   translate("Notification") . ": " . $name,
          html_to_8bits ($msg), $extra_hdrs );
      }
    }

    // Now, mark event as deleted for all users.
    dbi_query ( "DELETE FROM webcal_meal_participant " .
      "WHERE cal_id = $id" );

  } else {
    // Not the owner of the event and are not the admin.
    // Just delete the event from this user's calendar.
    // We could just set the status to 'D' instead of deleting.
    // (but we would need to make some changes to edit_entry_handler.php
    // to accomodate this).
    dbi_query ( "DELETE FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_login = '$login'" );
    activity_log ( $id, $login, $login, $LOG_REJECT, "" );
  }
}

$ret = getValue ( "ret" );
$url = get_preferred_view ( "", empty ( $user ) ? "" : "user=$user" );

if ( empty ( $error ) ) {
  do_redirect ( $url );
  exit;
}
print_header();
?>

<h2><?php etranslate("Error")?></h2>
<blockquote>
<?php echo $error; ?>
</blockquote>

<?php print_trailer(); ?>

</body>
</html>

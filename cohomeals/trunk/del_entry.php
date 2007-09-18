<?php
include_once 'includes/init.php';

$can_edit = false;

// First, check to see if this user should be able to delete this event.
if ( $id > 0 ) {
  // first see who has access to edit this entry
  if ( $is_admin || $is_meal_coordinator ) {
    $can_edit = true;
  }
}

if ( ! $can_edit ) {
  $error = "You are not authorized";
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
  for ( $i = 0; $i < count ( $partlogin ); $i++ ) {
    // Log the deletion
    activity_log ( $id, $login, $partlogin[$i], $LOG_DELETE, "" );

    $do_send = get_pref_setting ( $partlogin[$i], "EMAIL_EVENT_DELETED" );
    user_load_variables ( $partlogin[$i], "temp" );
    if ( $partlogin[$i] != $login && $do_send == "Y" && 
	 strlen ( $tempemail ) && $send_email != "N" ) {
      $msg = "Hello " . $tempfullname . ".\n\n" .
	"A meal you were signed up for has been canceled by " .
	$login_fullname .  ".\n" .
	"The suit was " . $name . "\n" .
	"Date: " . date_to_str ($thisdate) . "\n";
      if ( $eventtime != '-1' ) $msg .= "Time: " . display_time ($eventtime, true);
      $msg .= "\n\n";
      if ( strlen ( $login_email ) )
	$extra_hdrs = "From: $login_email\r\nX-Mailer: " . $application_name;
      else
	$extra_hdrs = "From: $email_fallback_from\r\nX-Mailer: " . $application_name;
      mail ( $tempemail,
	     $application_name . " " .
	     "Notification: " . $name,
	     html_to_8bits ($msg), $extra_hdrs );
    }
  }

  // Now, mark event as deleted for all users.
  dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_id = $id" );
  dbi_query ( "DELETE FROM webcal_meal WHERE cal_id = $id" );
  
}

$ret = getValue ( "ret" );
$url = get_preferred_view ( "", "" );

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

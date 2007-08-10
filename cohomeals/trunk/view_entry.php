<?php
/*
 * $Id: view_entry.php,v 1.68.2.2 2005/08/10 14:35:15 cknudsen Exp $
 *
 * Description:
 * Presents page to view an event with links to edit, delete
 * confirm, copy, add event
 *
 * Input Parameters:
 * id (*) - cal_id of requested event
 * date  - yyyymmdd format of requested event
 * user  - user to display
 * (*) required field
 */
include_once 'includes/init.php';
include_once 'includes/site_extras.php';

// make sure this user is allowed to look at this calendar.
$can_view = false;
$is_my_event = false;

if ( $is_admin || $is_nonuser_admin || $is_assistant ) {
  $can_view = true;
} 

$error = '';

if ( empty ( $id ) || $id <= 0 || ! is_numeric ( $id ) ) {
  $error = translate ( "Invalid entry id" ) . "."; 
}

if ( empty ( $error ) ) {
  // is this user a participant or the creator of the event?
  $sql = "SELECT webcal_meal.cal_id FROM webcal_meal, " .
    "webcal_meal_participant WHERE webcal_meal.cal_id = " .
    "webcal_meal_participant.cal_id AND webcal_meal.cal_id = $id " .
    "AND webcal_meal_participant.cal_login = '$login'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( $row && $row[0] > 0 ) {
      $can_view = true;
      $is_my_event = true;
    }
    dbi_free_result ( $res );
  }

  if ( ($login != "__public__") && ($public_access_others == "Y") ) {
    $can_view = true;
  }

  if ( ! $can_view ) {
    $check_group = false;
    // if not a participant in the event, must be allowed to look at
    // other user's calendar.
    if ( $login == "__public__" ) {
      if ( $public_access_others == "Y" ) {
        $check_group = true;
      }
    } else {
      if ( $allow_view_other == "Y" ) {
        $check_group = true;
      }
    }
    // If $check_group is true now, it means this user can look at the
    // event only if they are in the same group as some of the people in
    // the event.
    // This gets kind of tricky.  If there is a participant from a different
    // group, do we still show it?  For now, the answer is no.
    // This could be configurable somehow, but how many lines of text would
    // it need in the admin page to describe this scenario?  Would confuse
    // 99.9% of users.
    // In summary, make sure at least one event participant is in one of
    // this user's groups.
    $my_users = get_my_users ();
    if ( is_array ( $my_users ) ) {
      $sql = "SELECT webcal_meal.cal_id FROM webcal_meal, " .
        "webcal_meal_participant WHERE webcal_meal.cal_id = " .
        "webcal_meal_participant.cal_id AND webcal_meal.cal_id = $id " .
        "AND webcal_meal_participant.cal_login IN ( ";
      for ( $i = 0; $i < count ( $my_users ); $i++ ) {
        if ( $i > 0 ) {
          $sql .= ", ";
        }
        $sql .= "'" . $my_users[$i]['cal_login'] . "'";
        }
      $sql .= " )";
      $res = dbi_query ( $sql );
      if ( $res ) {
        $row = dbi_fetch_row ( $res );
        if ( $row && $row[0] > 0 ) {
          $can_view = true;
        }
        dbi_free_result ( $res );
      }
    }
    // If we didn't indicate we need to check groups, then this user
    // can't view this event.
    if ( ! $check_group ) {
      $can_view = false;
    }
  }
}

// If they still cannot view, make sure they are not looking at a nonuser
// calendar event where the nonuser is the _only_ participant.
if ( empty ( $error ) && ! $can_view && ! empty ( $nonuser_enabled ) &&
  $nonuser_enabled == 'Y' ) {
  $nonusers = get_nonuser_cals ();
  $nonuser_lookup = array ();
  for ( $i = 0; $i < count ( $nonusers ); $i++ ) {
    $nonuser_lookup[$nonusers[$i]['cal_login']] = 1;
  }
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id";
  $res = dbi_query ( $sql );
  $found_nonuser_cal = false;
  $found_reg_user = false;
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      if ( ! empty ( $nonuser_lookup[$row[0]] ) ) {
        $found_nonuser_cal = true;
      } else {
        $found_reg_user = true;
      }
    }
    dbi_free_result ( $res );
  }
  // Does this event contain only nonuser calendars as participants?
  // If so, then grant access.
  if ( $found_nonuser_cal && ! $found_reg_user ) {
    $can_view = true;
  }
}
  
if ( empty ( $error ) && ! $can_view ) {
  $error = translate ( "You are not authorized" );
}

if ( ! empty ( $year ) ) {
  $thisyear = $year;
}
if ( ! empty ( $month ) ) {
  $thismonth = $month;
}
$pri[1] = translate("Low");
$pri[2] = translate("Medium");
$pri[3] = translate("High");

$unapproved = FALSE;

// Make sure this is not a continuation event.
// If it is, redirect the user to the original event.
$ext_id = -1;
if ( empty ( $error ) ) {
  $res = dbi_query ( "SELECT cal_ext_for_id FROM webcal_meal " .
    "WHERE cal_id = $id" );
  if ( $res ) {
    if ( $row = dbi_fetch_row ( $res ) ) {
      $ext_id = $row[0];
    }
    dbi_free_result ( $res );
  } else {
    // db error... ignore it, I guess.
  }
}
if ( $ext_id > 0 ) {
  $url = "view_entry.php?id=$ext_id";
  if ( $date != "" ) {
    $url .= "&amp;date=$date";
  }
  if ( $user != "" ) {
    $url .= "&amp;user=$user";
  }
  do_redirect ( $url );
}

print_header();

if ( ! empty ( $error ) ) {
  echo "<h2>" . translate ( "Error" ) .
    "</h2>\n" . $error;
  print_trailer ();
  echo "</body>\n</html>";
  exit;
}

// Load event info now.
$sql = "SELECT cal_date, cal_time, " .
  "cal_duration, " .
  "cal_suit, cal_description, cal_walkins FROM webcal_meal WHERE cal_id = $id";
$res = dbi_query ( $sql );
if ( ! $res ) {
  echo translate("Invalid entry id") . ": $id";
  exit;
}

$row = dbi_fetch_row ( $res );
if ( $row ) { 
  $orig_date = $row[0];
  $event_time = $row[1];
  $suit = $row[3];
  $description = $row[4];
  $walkins = $row[5];
} else {
  echo "<h2>" . 
    translate("Error") . "</h2>" . 
    translate("Invalid entry id") . ".\n";
  print_trailer ();
  echo "</body>\n</html>";
  exit;
}

// Timezone Adjustments
if ( $event_time >= 0 && ! empty ( $TZ_OFFSET )  && $TZ_OFFSET != 0 ) { 
  // -1 = no time specified
  $adjusted_time = $event_time + $TZ_OFFSET * 10000;
  $year = substr($row[0],0,4);
  $month = substr($row[0],4,2);
  $day = substr($row[0],-2);
  if ( $adjusted_time > 240000 ) {
    $gmt = mktime ( 3, 0, 0, $month, $day, $year );
    $gmt += $ONE_DAY;
  } else if ( $adjusted_time < 0 ) {
    $gmt = mktime ( 3, 0, 0, $month, $day, $year );
    $gmt -= $ONE_DAY;
  }
}
// Set alterted date
$tz_date = ( ! empty ( $gmt ) ) ? date ( "Ymd", $gmt ) : $row[0];

// save date so the trailer links are for the same time period
$thisyear = (int) ( $tz_date / 10000 );
$thismonth = ( $tz_date / 100 ) % 100;
$thisday = $tz_date % 100;
$thistime = mktime ( 3, 0, 0, $thismonth, $thisday, $thisyear );
$thisdow = date ( "w", $thistime );

// $subject is used for mailto URLs
$subject = translate($application_name) . ": " . $name;
// Remove the '"' character since it causes some mailers to barf
$subject = str_replace ( "\"", "", $subject );
$subject = htmlspecialchars ( $subject );

/* calculate end time */
if ( $event_time >= 0 && $row[2] > 0 )
  $end_str = "-" . display_time ( add_duration ( $row[1], $row[2] ) );
else
  $end_str = "";


$is_private = false;

$event_date = $row[0];

// TODO: don't let someone view another user's private entry
// by hand editing the URL.

?>
<h2><?php echo htmlspecialchars ( $name ); ?></h2>
<table style="border-width:0px;">

<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Suit")?>:</td><td>
 <?php echo $suit; ?>
</td></tr>

<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Description")?>:</td><td>
 <?php
  if ( ! empty ( $allow_html_description ) &&
    $allow_html_description == 'Y' ) {
    $str = str_replace ( '&', '&amp;', $description );
    $str = str_replace ( '&amp;amp;', '&amp;', $str );
    // If there is no html found, then go ahead and replace
    // the line breaks ("\n") with the html break.
    if ( strstr ( $str, "<" ) && strstr ( $str, ">" ) ) {
      // found some html...
      echo $str;
    } else {
      echo nl2br ( activate_urls ( $str ) );
    }
  } else {
    echo nl2br ( activate_urls ( htmlspecialchars ( $description ) ) );
  }
?></td></tr>

<?php if ( $event_status != 'A' && ! empty ( $event_status ) ) { ?>
<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Status")?>:</td><td>
 <?php
     if ( $event_status == 'W' )
       etranslate("Waiting for approval");
     if ( $event_status == 'D' )
       etranslate("Deleted");
     else if ( $event_status == 'R' )
       etranslate("Rejected");
      ?>
</td></tr>
<?php } ?>

<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Date")?>:</td><td>
 <?php
  echo date_to_str ( $row[0], "", true, false, ( $row[2] == ( 24 * 60 ) ? "" : $event_time ) );
  ?>
</td></tr>
<?php if ( $event_time >= 0 ) { ?>
<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Time")?>:</td><td>
 <?php
    if ( $row[2] == ( 24 * 60 ) ) {
      etranslate("All day event");
    } else {
      echo display_time ( $row[1] ) . $end_str;
    }
  ?>
</td></tr>
<?php } ?>
<?php
// Display who originally created event
// useful if assistant or Admin
$proxy_fullname = '';  
if ( !empty ( $DISPLAY_CREATED_BYPROXY ) && $DISPLAY_CREATED_BYPROXY == "Y" ) {
  $res = dbi_query ( "SELECT wu.cal_firstname, wu.cal_lastname " .
    "FROM webcal_user wu INNER JOIN webcal_entry_log wel ON wu.cal_login = wel.cal_login " .
    "WHERE wel.cal_entry_id = $id " .
    "AND wel.cal_type = 'C'" );
  if ( $res ) {
    $row3 = dbi_fetch_row ( $res ) ;
   $proxy_fullname = $row3[0] . " " . $row3[1];
   $proxy_fullname = ($createby_fullname == $proxy_fullname ? ""  :
      " ( by " . $proxy_fullname . " )");
  }
}
?>
<?php
// load any site-specific fields and display them
$extras = get_site_extra_fields ( $id );
for ( $i = 0; $i < count ( $site_extras ); $i++ ) {
  $extra_name = $site_extras[$i][0];
  $extra_type = $site_extras[$i][2];
  $extra_arg1 = $site_extras[$i][3];
  $extra_arg2 = $site_extras[$i][4];
  if ( ! empty ( $extras[$extra_name]['cal_name'] ) ) {
    echo "<tr><td style=\"vertical-align:top; font-weight:bold;\">\n" .
      translate ( $site_extras[$i][1] ) .
      ":</td><td>\n";
    if ( $extra_type == $EXTRA_URL ) {
      if ( strlen ( $extras[$extra_name]['cal_data'] ) ) {
        echo "<a href=\"" . $extras[$extra_name]['cal_data'] . "\">" .
          $extras[$extra_name]['cal_data'] . "</a>\n";
      }
    } else if ( $extra_type == $EXTRA_EMAIL ) {
      if ( strlen ( $extras[$extra_name]['cal_data'] ) ) {
        echo "<a href=\"mailto:" . $extras[$extra_name]['cal_data'] .
          "?subject=$subject\">" .
          $extras[$extra_name]['cal_data'] . "</a>\n";
      }
    } else if ( $extra_type == $EXTRA_DATE ) {
      if ( $extras[$extra_name]['cal_date'] > 0 ) {
        echo date_to_str ( $extras[$extra_name]['cal_date'] );
      }
    } else if ( $extra_type == $EXTRA_TEXT ||
      $extra_type == $EXTRA_MULTILINETEXT ) {
      echo nl2br ( $extras[$extra_name]['cal_data'] );
    } else if ( $extra_type == $EXTRA_USER ) {
      echo $extras[$extra_name]['cal_data'];
    } else if ( $extra_type == $EXTRA_REMINDER ) {
      if ( $extras[$extra_name]['cal_remind'] <= 0 ) {
        etranslate ( "No" );
      } else {
        etranslate ( "Yes" );
        if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_DATE ) > 0 ) {
          echo "&nbsp;&nbsp;-&nbsp;&nbsp;";
          echo date_to_str ( $extras[$extra_name]['cal_date'] );
        } else if ( ( $extra_arg2 & $EXTRA_REMINDER_WITH_OFFSET ) > 0 ) {
          echo "&nbsp;&nbsp;-&nbsp;&nbsp;";
          $minutes = $extras[$extra_name]['cal_data'];
          $d = (int) ( $minutes / ( 24 * 60 ) );
          $minutes -= ( $d * 24 * 60 );
          $h = (int) ( $minutes / 60 );
          $minutes -= ( $h * 60 );
          if ( $d > 1 ) {
            echo $d . " " . translate("days") . " ";
          } else if ( $d == 1 ) {
            echo $d . " " . translate("day") . " ";
          }
          if ( $h > 1 ) {
            echo $h . " " . translate("hours") . " ";
          } else if ( $h == 1 ) {
            echo $h . " " . translate("hour") . " ";
          }
          if ( $minutes > 1 ) {
            echo $minutes . " " . translate("minutes");
          } else if ( $minutes == 1 ) {
            echo $minutes . " " . translate("minute");
          }
          echo " " . translate("before event" );
        }
      }
    } else if ( $extra_type == $EXTRA_SELECTLIST ) {
      echo $extras[$extra_name]['cal_data'];
    }
    echo "\n</td></tr>\n";
  }
}
?>

<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Menu")?>:
</td></tr>



<?php // participants
// Only ask for participants if we are multi-user.
$allmails = array ();
$show_participants = ( $disable_participants_field != "Y" );
if ( $is_admin ) {
  $show_participants = true;
}
if ( $public_access == "Y" && $login == "__public__" &&
  ( $public_access_others != "Y" || $public_access_view_part == "N" ) ) {
  $show_participants = false;
}
if ( $single_user == "N" && $show_participants ) { ?>
  <tr><td style="vertical-align:top; font-weight:bold;">
  <?php etranslate("On-site diners")?>:</td><td>
  <?php
  if ( $is_private ) {
    echo "[" . translate("Confidential") . "]";
  } else {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id";
    //echo "$sql\n";
    $res = dbi_query ( $sql );
    $first = 1;
    $num_app = $num_wait = $num_rej = 0;
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
        $pname = $row[0];
	$approved[$num_app++] = $pname;
      }
      dbi_free_result ( $res );
    } else {
      echo translate ("Database error") . ": " . dbi_error() . "<br />\n";
    }
  }
  for ( $i = 0; $i < $num_app; $i++ ) {
    user_load_variables ( $approved[$i], "temp" );
    if ( strlen ( $tempemail ) ) {
      echo "<a href=\"mailto:" . $tempemail . "?subject=$subject\">" . 
        $tempfullname . "</a><br />\n";
      $allmails[] = $tempemail;
    } else {
      echo $tempfirstname . "<br />\n";
    }
  }
  // show external users here...
  if ( ! empty ( $allow_external_users ) && $allow_external_users == "Y" ) {
    $external_users = event_get_external_users ( $id, 1 );
    $ext_users = explode ( "\n", $external_users );
    if ( is_array ( $ext_users ) ) {
      for ( $i = 0; $i < count( $ext_users ); $i++ ) {
        if ( ! empty ( $ext_users[$i] ) ) {
          echo $ext_users[$i] . " (" . translate("External User") . 
            ")<br />\n";
        }
      }
    }
  }
?>
</td></tr>
<?php
 } // end participants
?>

<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Take-home plates")?>:
</td></tr>


<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Walk-ins welcome?")?>:
</td>
<td>
<?php 
if ( $walkins == "W" ) {
  echo "Welcome";
} else if ( $walkins == "E" ) {
  echo "Encouraged";
} else {
  echo "Discouraged";
}
?>
</td>
</tr>



<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Food preferences based on current participants")?>:
</td></tr>


<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Head cooks")?>:
</td></tr>


<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Cooks")?>:
</td></tr>

<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Cleanup crew")?>:
</td></tr>

<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("Notes")?>:
</td></tr>


</table>

<br /><?php


if ( ! empty ( $user ) && $login != $user ) {
  $u_url = "&amp;user=$user";
} else {
  $u_url = "";
}

$can_edit = ( $is_admin || $is_nonuser_admin && ($user == $create_by) || 
  ( $is_assistant && ! $is_private && ($user == $create_by) ) ||
  ( $readonly != "Y" && ( $login == $create_by || $single_user == "Y" ) ) );
if ( $public_access == "Y" && $login == "__public__" ) {
  $can_edit = false;
}
if ( $readonly == 'Y' ) {
  $can_edit = false;
}

if ( $can_edit ) {
  echo "<a title=\"" .
    translate("Edit entry") . "\" class=\"nav\" " .
    "href=\"edit_entry.php?id=$id$u_url\">" .
    translate("Edit entry") . "</a><br />\n";
  echo "<a title=\"" . 
    translate("Delete entry") . "\" class=\"nav\" " .
    "href=\"del_entry.php?id=$id$u_url\" onclick=\"return confirm('" . 
    translate("Are you sure you want to delete this entry?") . "\\n\\n" . 
    translate("This will delete this entry for all users.") . "');\">" . 
    translate("Delete entry") . "</a><br />\n";
} elseif ( $readonly != "Y" && $is_my_event && $login != "__public__" )  {
  echo "<a title=\"" . 
    translate("Delete entry") . "\" class=\"nav\" " .
    "href=\"del_entry.php?id=$id$u_url\" onclick=\"return confirm('" . 
    translate("Are you sure you want to delete this entry?") . "\\n\\n" . 
    translate("This will delete the entry from your calendar.") . "');\">" . 
    translate("Delete entry") . "</a><br />\n";
}
if ( $readonly != "Y" && ! $is_my_event && ! $is_private && 
  $login != "__public__" )  {
  echo "<a title=\"" . 
    translate("Add to My Calendar") . "\" class=\"nav\" " .
    "href=\"add_entry.php?id=$id\" onclick=\"return confirm('" . 
    translate("Do you want to add this entry to your calendar?") . "\\n\\n" . 
    translate("This will add the entry to your calendar.") . "');\">" . 
    translate("Add to My Calendar") . "</a><br />\n";
}

if ( count ( $allmails ) > 0 ) {
  echo "<a title=\"" . 
    translate("Email all participants") . "\" class=\"nav\" " .
    "href=\"mailto:" . implode ( ",", $allmails ) .
    "?subject=" . rawurlencode($subject) . "\">" . 
    translate("Email all participants") . "</a><br />\n";
}

$show_log = false;

if ( $is_admin ) {
  if ( empty ( $log ) ) {
    echo "<a title=\"" . 
      translate("Show activity log") . "\" class=\"nav\" " .
      "href=\"view_entry.php?id=$id&amp;log=1\">" . 
      translate("Show activity log") . "</a><br />\n";
  } else {
    echo "<a title=\"" . 
      translate("Hide activity log") . "\" class=\"nav\" " .
      "href=\"view_entry.php?id=$id\">" . 
       translate("Hide activity log") . "</a><br />\n";
    $show_log = true;
  }
}

if ( $show_log ) {
  echo "<h3>" . translate("Activity Log") . "</h3>\n";
  echo "<table class=\"embactlog\">\n";
  echo "<tr><th class=\"usr\">\n";
  echo translate("User") . "</th><th class=\"cal\">\n";
  echo translate("Calendar") . "</th><th class=\"date\">\n";
  echo translate("Date") . "/" . 
   translate("Time") . "</th><th class=\"action\">\n";
  echo translate("Action") . "\n</th></tr>\n";

  $res = dbi_query ( "SELECT cal_login, cal_user_cal, cal_type, " .
    "cal_date, cal_time " .
    "FROM webcal_entry_log WHERE cal_entry_id = $id " .
    "ORDER BY cal_log_id DESC" );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      echo "<tr><td>\n";
      echo $row[0] . "</td><td>\n";
      echo $row[1] . "</td><td>\n" . 
        date_to_str ( $row[3] ) . "&nbsp;" .
        display_time ( $row[4] ) . "</td><td>\n";
      if ( $row[2] == $LOG_CREATE ) {
        etranslate("Event created");
      } else if ( $row[2] == $LOG_APPROVE ) {
        etranslate("Event approved");
      } else if ( $row[2] == $LOG_REJECT ) {
        etranslate("Event rejected");
      } else if ( $row[2] == $LOG_UPDATE ) {
        etranslate("Event updated");
      } else if ( $row[2] == $LOG_DELETE ) {
        etranslate("Event deleted");
      } else if ( $row[2] == $LOG_NOTIFICATION ) {
        etranslate("Notification sent");
      } else if ( $row[2] == $LOG_REMINDER ) {
        etranslate("Reminder sent");
      }
      echo "</td></tr>\n";
    }
    dbi_free_result ( $res );
  }
  echo "</table>\n";
}

?>

<?php
 print_trailer ( empty ($friendly) );
?>
</body>
</html>

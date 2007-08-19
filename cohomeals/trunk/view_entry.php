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
 * (*) required field
 */
include_once 'includes/init.php';
include_once 'includes/site_extras.php';

$error = '';

if ( empty ( $id ) || $id <= 0 || ! is_numeric ( $id ) ) {
  $error = translate ( "Invalid entry id" ) . "."; 
}

if ( ! empty ( $year ) ) {
  $thisyear = $year;
}
if ( ! empty ( $month ) ) {
  $thismonth = $month;
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
    "cal_suit, cal_menu, cal_head_chef, cal_num_cooks, " .
    "cal_num_cleanup, cal_num_setup, cal_num_other_crew, " . 
    "cal_walkins, cal_notes " .
    "FROM webcal_meal WHERE cal_id = $id";
$res = dbi_query ( $sql );
if ( ! $res ) {
  echo translate("Invalid entry id") . ": $id";
  exit;
}

$row = dbi_fetch_row ( $res );
if ( $row ) { 
  $orig_date = $row[0];
  $event_time = $row[1];
  $suit = $row[2];
  $menu = $row[3];
  $head_chef = $row[4];
  $num_cooks = $row[5];
  $num_cleanup = $row[6];
  $num_setup = $row[7];
  $num_other_crew = $row[8];
  $walkins = $row[9];
  $notes = $row[10];
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

$is_private = false;

$event_date = $row[0];

?>
<h2><?php echo htmlspecialchars ( $name ); ?></h2>
<table style="border-width:0px;">

<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Suit")?>:</td><td>
 <?php echo $suit; ?>
</td></tr>


<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Date")?>:</td><td>
 <?php
  echo date_to_str ( $row[0], "", true, false, $event_time );
  ?>
</td></tr>
<?php if ( $event_time >= 0 ) { ?>
<tr><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Time")?>:</td><td>
 <?php
   echo display_time ( $row[1] );
  ?>
</td></tr>
<?php } ?>
<?php
// Display who originally created event
// useful if Admin
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

<tr><td style="vertical-align:top; font-weight:bold;">Menu:</td>
 <td>
 <?php
  if ( ! empty ( $allow_html_description ) &&
    $allow_html_description == 'Y' ) {
    $menu_str = str_replace ( '&', '&amp;', $menu );
    $menu_str = str_replace ( '&amp;amp;', '&amp;', $str );
    // If there is no html found, then go ahead and replace
    // the line breaks ("\n") with the html break.
    if ( strstr ( $menu_str, "<" ) && strstr ( $menu_str, ">" ) ) {
      // found some html...
      echo $menu_str;
    } else {
      echo nl2br ( activate_urls ( $menu_str ) );
    }
  } else {
    echo nl2br ( activate_urls ( htmlspecialchars ( $menu ) ) );
  }
?></td></tr>

<tr><td style="vertical-align:top; font-weight:bold;">Head chef:</td>
<td>
<?php 
  $sql = "SELECT cal_firstname, cal_lastname " .
         "FROM webcal_user " .
	 "WHERE cal_login = '" . $head_chef . "'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    echo $row[0] . " " . $row[1];
  }
  else {
    echo "Database error: " . dbi_error() . "<br />\n";
  }
?>
</td></tr>


<?php if ( $num_cooks != 0 ) { ?>
 <tr><td style="vertical-align:top; font-weight:bold;">Cooks:</td>
    <td> <?php for ( $i = 1; $i <= $num_cooks; $i++ ) {
      echo $i . ". ???<br>";
    } ?>
    <td>
</td></tr>
<?php } ?>

<?php if ( $num_setup != 0 ) { ?>
 <tr><td style="vertical-align:top; font-weight:bold;">Setup:</td>
    <td> <?php for ( $i = 1; $i <= $num_setup; $i++ ) {
      echo $i . ". ???<br>";
    } ?>
    <td>
</td></tr>
<?php } ?>

<?php if ( $num_cleanup != 0 ) { ?>
 <tr><td style="vertical-align:top; font-weight:bold;">Cleanup:</td>
    <td> <?php for ( $i = 1; $i <= $num_cleanup; $i++ ) {
      echo $i . ". ???<br>";
    } ?>
    <td>
</td></tr>
<?php } ?>

<?php if ( $num_other_crew != 0 ) { ?>
 <tr><td style="vertical-align:top; font-weight:bold;">Other crew (see notes):</td>
    <td> <?php for ( $i = 1; $i <= $num_other_crew; $i++ ) {
      echo $i . ". ???<br>";
    } ?>
    <td>
</td></tr>
<?php } ?>




<?php // participants
$allmails = array ();
?>
<tr><td style="vertical-align:top; font-weight:bold;">
<?php etranslate("On-site diners")?>:</td><td>
<?php
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
 <?php etranslate("Notes")?>:</td><td>
 <?php
  if ( ! empty ( $allow_html_description ) &&
    $allow_html_description == 'Y' ) {
    $str = str_replace ( '&', '&amp;', $notes );
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
    echo nl2br ( activate_urls ( htmlspecialchars ( $notes ) ) );
  }
?></td></tr>


</table>

<br /><?php


if ( ! empty ( $user ) && $login != $user ) {
  $u_url = "&amp;user=$user";
} else {
  $u_url = "";
}

$can_edit = ( $is_admin || $is_meal_coordinator );
if ( $login == "__public__" ) {
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

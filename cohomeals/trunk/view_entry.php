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

$id = mysql_safe( getValue( 'id' ), false );
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

$base_price = 400;
// Load event info now.
$sql = "SELECT cal_date, cal_time, " .
    "cal_suit, cal_menu, cal_num_crew, " .
    "cal_signup_deadline, cal_base_price, " .
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
  $num_crew = $row[4];
  $deadline = $row[5];
  $base_price = $row[6];
  $walkins = $row[7];
  $notes = $row[8];
} else {
  echo "<h2>" . 
    translate("Error") . "</h2>" . 
    translate("Invalid entry id") . ".\n";
  print_trailer ();
  echo "</body>\n</html>";
  exit;
}

$event_date = $orig_date;

// $subject is used for mailto URLs
$subject = translate($application_name) . ": " . $suit;
// Remove the '"' character since it causes some mailers to barf
$subject = str_replace ( "\"", "", $subject );
$subject = htmlspecialchars ( $subject );



?>

<h2>Meal details</h2>

<?php
$signup_deadline = get_day( $event_date, -1*$deadline );
echo "<p>Signup deadline: " . date_to_str( $signup_deadline );
$past_deadline = false;
if ( $signup_deadline < date("Ymd") ) $past_deadline = true;
$can_signup = !$past_deadline;
if ( $is_meal_coordinator || $is_beancounter ) $can_signup = true;

if ( $past_deadline == true ) 
  echo "<br>This meal is in <font color=\"#DD0000\">walkin status</font> (i.e. past signup deadline)</p>";
else echo "</p>";
?>

<p>
<table class="bordered_table">
<tr>
  <td>Prices:</td>
  <td class="number">adult</td>
  <td class="number">child</td>
  <td class="number">walkin/guest</td>
</tr>
<tr>
  <td>Signing up now costs:</td>
  <td class="number">
    <?php echo price_to_str( get_price( $id, "adult" ));?>
  </td>
  <td class="number">
    <?php echo price_to_str( get_price( $id, "child" ));?>
  </td>
  <td class="number">
    <?php echo price_to_str( get_price( $id, "walkin" ));?>
  </td>
</tr>
<tr>
  <td>Cancelling now refunds:</td>
  <?php $refund = get_refund_percentage( $id, $past_deadline ); ?>
  <td class="number"><?php echo $refund;?>%</td>
  <td class="number"><?php echo $refund;?>%</td>
  <td class="number"><?php echo $refund;?>%</td>
</tr>
</table>
</p>
<p></p>

<table style="border-width:0px;">

<?php $row_num = 1; ?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Suit:</td>
<td><?php echo $suit; ?>
</td>
</tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>


<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Date:</td>
<td>
 <?php
  echo date_to_str ( $event_date, "", true, false, $event_time );
  ?>
</td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>


<?php if ( $event_time >= 0 ) { ?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">
 <?php etranslate("Time")?>:</td><td>
 <?php
   echo display_time ( $row[1] );
  ?>
</td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>
<?php } ?>




<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Menu:</td>
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
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



<?php 
  display_crew( "Head chef", 'H', 1, $row_num );
  $row_num = ( $row_num == 1 ) ? 0:1; 
?>



<?php 
if ( $num_crew != 0 ) {
  display_crew( "Crew", 'C', $num_crew, $row_num );
  $row_num = ( $row_num == 1 ) ? 0:1;
}
?>




<?php //////////////////////
//////// participants //////////////////////
$allmails = array ();
$sql = "SELECT cal_login FROM webcal_meal_participant " .
       "WHERE cal_login = '$login' AND cal_id = $id " .
       "AND (cal_type = 'M' OR cal_type = 'T')";
$res = dbi_query ( $sql );
if ( $res ) {
  if ( dbi_fetch_row ( $res ) )
    $already_eating = true;
  else
    $already_eating = false;
}
?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;height:20px;">On-site diners:</td>
  <td>
  <?php
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = 'M'";
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

    if ( $can_signup == true ) {
      if ( $already_eating == false ) {
	echo "<a name=\"participation\" class=\"addbutton\"" .
	  "href=\"edit_participation_handler.php?user=$login&id=$id&type=M&action=A\">" .
	  "Add me</a>";
	echo "&nbsp;&nbsp;&nbsp;";
      }
      $nexturl = "signup_buddy.php?id=$id&type=M&action=A";
	?>
	<a href class="addbutton" onclick="window.open('<?php echo $nexturl;?>', 'Buddies', 'width=300,height=300,resizable=yes,scrollbars=yes');">Add buddy</a><br>
    <?php } 
    echo "<br>";
    for ( $i = 0; $i < $num_app; $i++ ) {
      user_load_variables ( $approved[$i], "temp" );
      if ( strlen ( $tempemail ) ) 
	$allmails[] = $tempemail;
      echo $tempfirstname . " " . $templastname;
      $person = $approved[$i];
      if ( is_signer( $person ) || ($person == $login) ) {
	if ( $can_signup == true ) {
	  echo "&nbsp;&nbsp;&nbsp;<a name=\"participation\" class=\"addbutton\"" . 
	    "href=\"edit_participation_handler.php?user=$person&id=$id&type=M&action=D\">" . 
	    "Remove</a>";
	}
	echo "&nbsp;&nbsp;&nbsp;<a name=\"participation\" class=\"addbutton\"" . 
	  "href=\"edit_participation_handler.php?user=$person&id=$id&type=M&action=C\">" . 
	  "Change to take-home plate</a><br>";
      }
      echo "<br />\n";
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
<br></td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;height:20px;">Take-home plates:</td>
<td>
<?php
$sql = "SELECT cal_login FROM webcal_meal_participant " .
"WHERE cal_id = $id AND cal_type = 'T'";
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

if ( $can_signup == true ) {
  if ( $already_eating == false ) {
    echo "<a name=\"participation\" class=\"addbutton\" href=\"edit_participation_handler.php?user=$login&id=$id&type=T&action=A\">Add me</a>";
    echo "&nbsp;&nbsp;&nbsp;";
  }
  $nexturl = "signup_buddy.php?id=$id&type=T&action=A";
    ?>
    <a href class="addbutton" onclick="window.open('<?php echo $nexturl;?>', 'Buddies', 'width=300,height=300,resizable=yes,scrollbars=yes');">Add buddy</a><br>
<?php } 
echo "<br>";

for ( $i = 0; $i < $num_app; $i++ ) {
  user_load_variables ( $approved[$i], "temp" );
  echo $tempfirstname . " " . $templastname;
  $person = $approved[$i];
  if ( is_signer( $person ) || ($person == $login) ) {
    if ( $can_signup == true ) {
      echo "&nbsp;&nbsp;&nbsp;<a name=\"participation\" class=\"addbutton\"" . 
	"href=\"edit_participation_handler.php?user=$person&id=$id&type=T&action=D\">" . 
	"Remove</a>";
    }
    echo "&nbsp;&nbsp;&nbsp;<a name=\"participation\" class=\"addbutton\"" . 
      "href=\"edit_participation_handler.php?user=$person&id=$id&type=T&action=C\">" . 
      "Change to on-site dining</a><br>";
  }
  echo "<br />\n";
}
?>
<br></td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Walk-ins welcome?:</td>
<td>
<?php 
switch ( $walkins ) {
 case 'C':
   echo "Check with head chef ASAP";
   break;
 case 'W':
   echo "Welcome";
   break;
 case 'Y':
   echo "Needed";
   break;
 case 'N':
   echo "No";
   break;
}
?>
</td>
</tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Food restrictions:</td>
<td>
 <table>
  <tr><td>Food</td><td>Names (level)</td></tr>

  <?php
  $sql = "SELECT DISTINCT cal_food FROM webcal_food_prefs";
  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $food = $row[0];
      $first = true;
      $sql2 = "SELECT cal_login, cal_level " .
	"FROM webcal_food_prefs " .
	"WHERE cal_food = '$food'";
      if ( $res2 = dbi_query( $sql2 ) ) {
	while ( $row2 = dbi_fetch_row( $res2 ) ) {
	  $user = $row2[0];
	  $level = $row2[1];

	  $sql3 = "SELECT cal_login " .
	    "FROM webcal_meal_participant " .
	    "WHERE cal_login = '$user' " .
	    "AND cal_id = $id " . 
	    "AND (cal_type = 'M' " .
	    "OR cal_type = 'T')";
	  if ( $res3 = dbi_query( $sql3 ) ) {
	    if ( dbi_fetch_row( $res3 ) ) {
	      if ( $first == true ) {
		echo "<tr><td>$food</td><td>";
		$first = false;
	      } else echo ", ";
	      user_load_variables( $user, "temp" );
	      echo $GLOBALS['tempfullname'] . "(" . $level . ") ";
	    }
	    dbi_free_result( $res3 );
	  }
	}
	dbi_free_result( $res2 );
      }
      echo "</td></tr>\n";
    }
    dbi_free_result( $res );
  }
  ?>
  </table>

</td>
</tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Notes:</td>
<td>
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
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



</table>

<br>
<a class="addbutton" href="meal_summary.php?id=<?php echo $id;?>">
Printer-friendly meal summary sheet</a>
<p />

<?php

if ( ! empty ( $user ) && $login != $user ) {
  $u_url = "&amp;user=$user";
} else {
  $u_url = "";
}

$can_edit = ( $is_meal_coordinator );
if ( is_head_chef( $id ) ) 
  $can_edit = true;

if ( $can_edit ) {
  echo "<a title=\"Edit entry\" class=\"nav\" " .
    "href=\"edit_entry.php?id=$id$u_url\">Edit entry</a><br />\n";
  echo "<a title=\"Delete entry\" class=\"nav\" " .
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

if ( $is_meal_coordinator ) {
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


<?php
function display_crew( $title, $type, $number, $rowcolor ) {
  global $login, $can_signup;

  $id = mysql_safe( $GLOBALS['id'], false );
  $type = mysql_safe( $type, true );

  echo "<tr class=\"d" . $rowcolor . "\"><td style=\"vertical-align:top; font-weight:bold;\">$title:</td>";
  echo "<td>";
  $sql = "SELECT cal_login, cal_notes FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = '$type'";
  $res = dbi_query ( $sql );
  $im_working = false;
  $i = 1;
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      if ( $i > $number ) 
	echo "Error: Too many crew members.<br />\n";
      else { 
	$person = $row[0];
	$notes = $row[1];
	$notes = trim( $notes );
	user_load_variables ( $person, "temp" );
	echo $i . ". " . $GLOBALS[tempfirstname] . 
	  " " . $GLOBALS[templastname];
	if ( $notes != "" ) {
	  echo " (" . $notes . ")";
	}
	if ( $person == $login ) {
	  $im_working = true;
	}
	if ( (is_signer( $person ) || ($person == $login))
	     && ($can_signup == true) ) {
	  echo "&nbsp;&nbsp;&nbsp;<a name=\"participation\" class=\"addbutton\"" . 
	    "href=\"edit_participation_handler.php?user=$person&id=$id&type=$type&action=D\">" . 
	    "Remove</a>";
	  $notes = htmlspecialchars( $notes );
	  $nexturl = "crew_notes.php?user=$person&id=$id&notes=$notes";
	  echo "&nbsp;&nbsp;&nbsp;<a href class=\"addbutton\" " .
	    "onclick=\"window.open('$nexturl', 'Crew notes', " .
	    "'width=300,height=200,resizable=yes,scrollbars=yes');\">" .
	    "Edit notes</a><br>";
	}
	echo "<br />\n";
	$i += 1;
      }
    }
  }
  else 
    echo "Database error: " . dbi_error() . "<br />\n";

  if ( ($i <= $number) && ($im_working == false) ) {
    echo $i . ". ";
    if ( $can_signup == true ) {
      echo "<a name=\"participation\" class=\"addbutton\"" . 
	"href=\"edit_participation_handler.php?user=$login&id=$id&type=$type&action=A\">" . 
	"Add me</a>";
      $nexturl = "signup_buddy.php?id=$id&type=$type&action=A";
	?>&nbsp;&nbsp;&nbsp;
	<a href class="addbutton" onclick="window.open('<?php echo $nexturl;?>', 'Buddies', 'width=300,height=300,resizable=yes,scrollbars=yes');">Add buddy</a><br>
    <?php } else echo "???<br>";
    $i += 1;
  }
  if ( ($im_working == true) && ($i <= $number) ) {
    echo "<br>" . $i . ". ";
    if ( $can_signup == true ) {
      $nexturl = "signup_buddy.php?id=$id&type=$type&action=A";
	?><a href class="addbutton" onclick="window.open('<?php echo $nexturl;?>', 'Buddies', 'width=300,height=300,resizable=yes,scrollbars=yes');">Add buddy</a><br><?php
    }
    $i += 1;
  }
  if ( $i <= $number ) {
    for ( $i = $i; $i <= $number; $i++ ) {
      echo $i . ". ???<br>";
    } 
  }
  echo "<br></td></tr>";
}
?>

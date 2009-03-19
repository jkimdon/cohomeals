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
$showones = getValue('showones');


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
    "cal_suit, cal_menu, " .
    "cal_signup_deadline, cal_base_price, " .
    "cal_walkins, cal_notes, cal_max_diners " .
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
  $deadline = $row[4];
  $base_price = $row[5];
  $walkins = $row[6];
  $notes = $row[7];
  $max_diners = $row[8];
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




/////////////////////////////////
//// display meal details

?>

<h2>Meal details for <?php echo date_to_str( $event_date, "", true, false, $event_time )?></h2>

<?php
if ( is_cancelled( $id ) == true ) echo "<h2>***** This meal has been <font color=\"#DD0000\">cancelled</font> *****</h2>";

$signup_deadline = get_day( $event_date, -1*$deadline );
echo "<p>Signup deadline: " . date_to_str( $signup_deadline );
$past_deadline = false;
if ( $signup_deadline < date("Ymd") ) $past_deadline = true;
$can_signup = !$past_deadline;
if ( $is_meal_coordinator ) $can_signup = true;

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
  <td class="number">walkin</td>
</tr>
<tr>
  <td>Signing up now costs:</td>
  <td class="number">
    <?php echo price_to_str( get_adjusted_price( $id, "A" ));?>
  </td>
  <td class="number">
    <?php echo price_to_str( get_adjusted_price( $id, "K" ));?>
  </td>
  <td class="number">
  <?php echo price_to_str( get_adjusted_price( $id, "A", true ));?>
  </td>
</tr>
</table>
</p>
<p></p>

<?php 
  if ( has_head_chef( $id ) == "" ) {
    echo "<p>***Note: If you (or a buddy) are subscribed to meals on this day of the week and you want want to prevent yourself (or a buddy) from being automatically signed up for this meal only, click <a href=\"block_diner.php?id=$id\">here</a>.</p>";
  }

?>

<table style="border-width:0px;">

<?php $row_num = 1; ?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Suit:</td>
<td><?php echo $suit; ?>
</td>
</tr>
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
<?php echo $menu; ?>
</td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>


<?php ////////notes
?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Notes:</td>
<td>
<?php echo $notes; ?>
</td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>



<?php 
  display_head_chef( $row_num );
  $row_num = ( $row_num == 1 ) ? 0:1; 
?>



<?php 
display_crew( 'C', $row_num );
$row_num = ( $row_num == 1 ) ? 0:1;
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

/////////////////////////////////
// count how many there are in case there's a limit
if ( $max_diners > 0 ) {
  $max_diner_count = 0;
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND ( cal_type = 'M' OR cal_type = 'T' )";
  $res = dbi_query( $sql );
  while ( dbi_fetch_row( $res ) ) 
    $max_diner_count++;
  dbi_free_result( $res );
  if ( $max_diner_count >= $max_diners ) $can_signup = false;
}


?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;height:20px;">On-site diners:</td>
  <td>
  <?php
    if ( $can_signup == true ) {
      if ( $already_eating == false ) 
	add_me_button( "M" );

      signup_buddy_button( "M", $id );
      signup_guest_button( "M", $id );
      echo "<br>";
    } 
    echo "<br>";


    $onsite_adults = 0;
    $onsite_children = 0;
    $onsite_free = 0;

    $names = user_get_users();
    $prev_building = 0;
    foreach ( $names as $name ) {
      $username = $name['cal_login'];
      $building = $name['cal_building'];
      if ( $building != $prev_building ) {
	if ( ($building <= 9) && ($building > 0) ) 
	  echo "<b>Building " . $building . "</b><br>";
	else 
	  echo "<b>Additional meal plan participants</b><br>";
	$prev_building = $building;
      }

      // check dining status
      if ( is_dining( $id, $username ) == "M" ) {
	$age = get_fee_category( $name['cal_birthdate'], $event_date );
	if ( $age == "K" ) $onsite_children++;
	else if ( $age == "F" ) $onsite_free++;
	else $onsite_adults++; // $age == "A"
	echo $name['cal_fullname'];
	if ( is_signer( $username ) || ($username == $login) ) {
	  if ( $can_signup == true ) {
	    remove_button( $username, $id, "M" );
	  }
	  echo "&nbsp;&nbsp;&nbsp;";
	  change_button( $username, $id, "M" );
	}
	echo "<br />\n";
      }

    }
      

    // show guests
    echo "<b>Guests</b><br>";
    $sql = "SELECT cal_fullname, cal_host, cal_fee " .
       "FROM webcal_meal_guest " .
       "WHERE cal_meal_id = $id " . 
       "AND cal_type = 'M'";
    if ( $res = dbi_query( $sql ) ) {
      while ( $row = dbi_fetch_row( $res ) ) {
	$guest_name = $row[0];
	$host = $row[1];
	$age = $row[2];
	if ( $age == "K" ) $onsite_children++;
	else if ( $age == "F" ) $onsite_free++;
	else $onsite_adults++; // $age == "A"

	user_load_variables( $host, "temp" );
	echo "$guest_name (guest of $tempfirstname $templastname)";

	if ( ($host == $login) || ($is_meal_coordinator) ) {
	  echo "&nbsp;&nbsp;&nbsp;";
	  remove_guest_button( $guest_name, "M", $id );
	  echo "&nbsp;&nbsp;&nbsp;";
	  change_guest_button( $guest_name, "M", $id );
	} else
	  echo "<br>";

      }
      dbi_free_result( $res );
    }


  ?>
  <br></td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>




<?php /////////// take-home plates 
?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;height:20px;">Take-home plates:</td>
<td>
<?php
$sql = "SELECT cal_login FROM webcal_meal_participant " .
"WHERE cal_id = $id AND cal_type = 'T'";
$res = dbi_query ( $sql );
$first = 1;
$num_app = 0;
$takehome_adults = 0;
$takehome_children = 0;
$takehome_free = 0;
if ( $res ) {
  while ( $row = dbi_fetch_row ( $res ) ) {
    $pname = $row[0];
    $approved[$num_app++] = $pname;
    user_load_variables( $pname, "temp" );
    $age = get_fee_category( $GLOBALS[tempbirthdate], $event_date );
    if ( $age == "K" ) $takehome_children++;
    else if ( $age == "F" ) $takehome_free++;
    else $takehome_adults++; // $age == "A"
  }
  dbi_free_result ( $res );
} else {
  echo translate ("Database error") . ": " . dbi_error() . "<br />\n";
}

if ( $can_signup == true ) {
  if ( $already_eating == false ) {
    add_me_button( "T" );
  }
  signup_buddy_button( "T", $id );
  signup_guest_button( "T", $id );
  echo "<br>";
} 
echo "<br>";

for ( $i = 0; $i < $num_app; $i++ ) {
  user_load_variables ( $approved[$i], "temp" );
  echo $tempfirstname . " " . $templastname;
  $person = $approved[$i];
  if ( is_signer( $person ) || ($person == $login) ) {
    if ( $can_signup == true ) {
      remove_button( $person, $id, "T" );
    }
    echo "&nbsp;&nbsp;&nbsp;";
    change_button( $person, $id, "T" );
  }
  echo "<br />\n";
}

//// show guests
$sql = "SELECT cal_fullname, cal_host, cal_fee " .
"FROM webcal_meal_guest " .
"WHERE cal_meal_id = $id " . 
"AND cal_type = 'T'";
if ( $res = dbi_query( $sql ) ) {
  while ( $row = dbi_fetch_row( $res ) ) {
    $guest_name = $row[0];
    $host = $row[1];
    $age = $row[2];
    if ( $age == "K" ) $takehome_children++;
    else if ( $age == "F" ) $takehome_free++;
    else $takehome_adults++; // $age == "A"

    user_load_variables( $host, "temp" );
    echo "$guest_name (guest of $tempfirstname $templastname)";
    
    if ( ($host == $login) || ($is_meal_coordinator) ) {
      echo "&nbsp;&nbsp;&nbsp;";
      remove_guest_button( $guest_name, "T", $id );
      echo "&nbsp;&nbsp;&nbsp;";
      change_guest_button( $guest_name, "T", $id );
    } else
      echo "<br>";
    
  }
  dbi_free_result( $res );
}

?>
<br></td></tr>
<?php $row_num = ( $row_num == 1 ) ? 0:1; ?>


<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Total diners:</td>
<td><?php 
$adults = $onsite_adults + $takehome_adults;
$children = $onsite_children + $takehome_children;
$free = $onsite_free + $takehome_free;
echo $adults + $children + $free . " people: ";
echo $adults . " adults, " . $children . " older children, " . $free . " younger children";
echo " (" . price_to_str( get_money_for_meal( $id )) . " income)";
?>
</td>
</tr>
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




<?php ///////////////// food restrictions   
?>
<tr class="d<?php echo $row_num;?>"><td style="vertical-align:top; font-weight:bold;">Food restrictions:<p>
<?php if ( $showones == 0 ) { ?>
    <a class="addbutton" href="view_entry.php?id=<?php echo $id;?>&date=<?php echo $event_date;?>&showones=1">Show level 1</a></p></td>
<?php } else { ?>
    <a class="addbutton" href="view_entry.php?id=<?php echo $id;?>&date=<?php echo $event_date;?>&showones=0">Hide level 1</a></p></td>
<?php } ?>
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
	  if ( ($level != 1) || ($showones == 1) ) {

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





</table>

<?php //////// meal crew summary/paperwork
?>
<br>
<table>
<tr><td width="68%">

<h4>For the head chef</h4>

<p>When your meal is complete, please complete the online summary then submit your receipts and reimbursement form to Valerie (in her CH cubby or in the purple box on her porch).</p>
<?php 
if ( paperwork_done( $id ) ) 
  echo "<p>Online summary for this meal has been completed. Click <a class=\"addbutton\" href=\"display_meal_summary.php?id=$id\">here</a> to view.</p>";
else  
  echo "Click <a class=\"addbutton\" href=\"meal_summary.php?meal_id=$id\">here</a> to begin the process.</p>";
?>


<p>The following documents are available for your reference. An updated pantry price list is posted in the pantry.<br>
<table>
<tr class="d0">
  <td>Meal signup sheet:</td>
  <td><a class="addbutton" href="print_signup.php?id=<?php echo $id;?>">pdf</a></td>
  <td></td>
</tr><tr class="d0">
  <td>Pantry price list:</td>
  <td><a class="addbutton" href="print_pantry.php">pdf</a></td>
  <td></td>
</tr><tr class="d0">
  <td>Reimbursement form:</td>
  <td><a class="addbutton" href="refs/Reimbursement.pdf">pdf</a></td>
  <td><a class="addbutton" href="refs/Reimbursement.xls">excel</a></td>
  <td><a class="addbutton" href="refs/Reimbursement.doc">doc</a></td>
  <td></td>
</tr>
</table>



<?php
$can_edit = ( $is_meal_coordinator );
if ( is_chef( $id ) ) 
  $can_edit = true;

if ( $can_edit ) {
  echo "<p><a title=\"Edit meal\" class=\"nav\" " .
    "href=\"edit_entry.php?id=$id\">Edit meal</a></p>\n";
}
?>

</td><td align="center">

<?php
$event_epoch = date_to_epoch( $event_date );
$thismonth = date( "m", $event_epoch );
$thisyear = date( "Y", $event_epoch );
$startdate = sprintf ( "%04d%02d01", $thisyear, $thismonth );
$enddate = sprintf ( "%04d%02d31", $thisyear, $thismonth );
$events = read_events ( $startdate, $enddate );
echo "Jump to other meals:<br>";
display_small_month( $thismonth, $thisyear, true, "nextmonth" );
?>

</td></tr>
</table>



<?php /////////////////////////////////

if ( $is_meal_coordinator ) {
  echo "<a title=\"Delete meal\" class=\"nav\" " .
    "href=\"del_entry.php?id=$id\" onclick=\"return confirm('" . 
    translate("Are you sure you want to delete this meal?") . "\\n\\n" . 
    translate("This will delete this meal for all users.") . "');\">" . 
    translate("Delete meal") . "</a><br />\n";
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

function add_me_button( $type, $job="" ) {
  global $login, $id;

  $olduser = "";
  if ( $type == 'C' ) {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_type = 'C' " .
      "AND cal_login LIKE 'none%'";
    if ( $job != "" ) 
      $sql .= " AND cal_notes = '$job'";
    
    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) 
	$olduser = $row[0];
    }
  }

  echo "<a name=\"participation\" class=\"addbutton\"" .
    "href=\"edit_participation_handler.php?user=$login&id=$id&type=$type&action=A&" .
    "olduser=$olduser\">" .
  "Add me</a>";
  echo "&nbsp;&nbsp;&nbsp;";
}

function remove_button( $person, $id, $type ) {

  echo "&nbsp;&nbsp;&nbsp;<a name=\"participation\" class=\"addbutton\"" . 
    "href=\"edit_participation_handler.php?user=$person&id=$id&type=$type&action=D&olduser=$person\">" . 
    "Remove</a>";
}

function change_button( $person, $id, $old_type ) {
  echo "<a name=\"participation\" class=\"addbutton\"" . 
    "href=\"edit_participation_handler.php" .
    "?user=$person&id=$id&type=$old_type&action=C\">";
  if ( $old_type == "M" ) 
    echo "Change to take-home plate</a><br>";
  else 
    echo "Change to on-site dining</a><br>";
}


function signup_buddy_button( $type, $id, $job="" ) {
  $olduser = "";
  if ( $type == 'C' ) {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_type = 'C' " .
      "AND cal_login LIKE 'none%'";
    if ( $job != "" ) 
      $sql .= " AND cal_notes = '$job'";

    if ( $res = dbi_query( $sql ) ) {
      if ( $row = dbi_fetch_row( $res ) ) 
	$olduser = $row[0];
    }
  }

  $nexturl = "signup_buddy.php?id=$id&type=$type&action=A&olduser=$olduser"; 
  echo "<a href class=\"addbutton\" " .
    "onclick=\"window.open('$nexturl', 'Buddies', " .
    "'width=300,height=300,resizable=yes,scrollbars=yes');\">" .
    "Add buddy</a>&nbsp;&nbsp;&nbsp;";
}


function signup_guest_button( $type, $id ) {
  $nexturl = "signup_guest.php?id=$id&type=$type&action=A";
  echo "<a href class=\"addbutton\" " .
    "onclick=\"window.open('$nexturl', 'Guest', " .
    "'width=300,height=300,resizable=yes,scrollbars=yes');\">" .
    "Add guest</a>";
}

function remove_guest_button( $guest_name, $type, $id ) {
  echo "<a name=\"participation\" class=\"addbutton\"" .
    "href=\"signup_guest_handler.php" .
    "?guest_name=" . trim($guest_name) .
    "&id=$id&type=$type&action=D\">" .
    "Remove</a>";
}

function change_guest_button( $guest_name, $old_type, $id ) {
  echo "<a name=\"participation\" class=\"addbutton\"" .
    "href=\"signup_guest_handler.php" .
    "?id=$id&type=$old_type&action=C" .
    "&guest_name=" . trim($guest_name) . 
    "\">";
  if ( $old_type == "M" ) 
    echo "Change to take-home plate</a><br>";
  else 
    echo "Change to on-site dining</a><br>";
  echo "<br>";
}



function display_head_chef( $rowcolor ) {
  global $login;

  $id = mysql_safe( $GLOBALS['id'], false );

  echo "<tr class=\"d" . $rowcolor . "\"><td style=\"vertical-align:top; font-weight:bold;\">Head chef:</td>";
  echo "<td>";
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = 'H'";
  $res = dbi_query ( $sql );
  $im_working = false;
  $filled = false;
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $person = $row[0];
      $filled = true;
      user_load_variables ( $person, "temp" );
      echo $GLOBALS[tempfirstname] . " " . $GLOBALS[templastname];
      if ( $person == $login ) {
	$im_working = true;
      }
      if ( (is_signer( $person ) || ($person == $login)) ) {
	remove_button( $person, $id, 'H' );
      }
      echo "\n";
    }
  }
  else 
    echo "Database error: " . dbi_error() . "<br />\n";

  if ( ($filled == false) && ($im_working == false) ) {
    add_me_button( 'H' );
    signup_buddy_button( 'H', $id );
  }
  if ( ($filled == false) && ($im_working == true) ) {
    signup_buddy_button( 'H', $id );
  }
  echo "<br></td></tr>";
}




function display_crew( $type, $rowcolor ) {
  global $login;

  $id = mysql_safe( $GLOBALS['id'], false );
  $type = mysql_safe( $type, true );

  echo "<tr class=\"d" . $rowcolor . "\"><td style=\"vertical-align:top; font-weight:bold;\">Crew:</td><td>";

  ?>
  <table class="bordered_table">
     <tr><td>Desired crew description</td><td>Volunteer</td></tr>
  <?php 

  /// find out if working
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
     "WHERE cal_id = $id AND cal_login = '$login' " .
     "AND (cal_type = 'C' OR cal_type = 'H')";
  if ( $res = dbi_query( $sql ) ) {
    if ( dbi_fetch_row( $res ) ) $im_working = true;
    else $im_working = false;
    dbi_free_result( $res );
  }


  $sql = "SELECT cal_login, cal_notes FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = 'C'";
  $res = dbi_query ( $sql );
  if ( $res ) {
    while ( $row = dbi_fetch_row ( $res ) ) {
      $person = $row[0];
      $description = $row[1];
      $description = trim( $description );
      $job = $description;
      if ( $description == "" ) $description = "???";

      echo "<tr><td>$description</td>";

      if ( ereg( "^none", $person ) ) {
	echo "<td> none yet "; 
	if ( $im_working == false ) add_me_button( 'C', $job );
	signup_buddy_button( 'C', $id, $job );
      } else {
	user_load_variables ( $person, "temp" );
	echo "<td> " . $GLOBALS[tempfirstname] . 
	" " . $GLOBALS[templastname];
	if ( (is_signer( $person ) || ($person == $login)) ) {
	  remove_button( $person, $id, $type );
	  echo "</td>";
	}
      }

      echo "</tr>";
    }
  }
  else 
    echo "Database error: " . dbi_error() . "<br />\n";

  echo "</table></td></tr>";
}
?>

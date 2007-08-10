<?php
/*
 * $Id: edit_entry.php,v 1.91.2.2 2006/03/15 03:14:54 umcesrjones Exp $
 *
 * Description:
 * Presents page to edit/add an event
 *
 * Notes:
 * If htmlarea is installed, users can use WYSIWYG editing.
 * SysAdmin must enable HTML for event full descriptions.
 * The htmlarea files should be installed so that the htmlarea.php
 * file is in ../includes/htmlarea/htmlarea.php
 * The htmlarea code can be downloaded from:
 *  http://www.htmlarea.com
 * TODO
 * This file will not pass XHTML validation with HTMLArea enabled
 */
include_once 'includes/init.php';
include_once 'includes/site_extras.php';

// Default for using tabs is enabled
if ( empty ( $EVENT_EDIT_TABS ) )
  $EVENT_EDIT_TABS = 'Y'; // default
$useTabs = ( $EVENT_EDIT_TABS == 'Y' );

// make sure this is not a read-only calendar
$can_edit = false;

// Public access can only add events, not edit.
if ( $login == "__public__" && $id > 0 ) {
  $id = 0;
}

$external_users = "";
$participants = array ();

if ( $readonly == 'Y' ) {
  $can_edit = false;
} else if ( ! empty ( $id ) && $id > 0 ) {
  // first see who has access to edit this entry
  if ( $is_admin ) {
    $can_edit = true;
  } else {
    $can_edit = false;
    if ( $readonly == "N" || $is_admin ) {
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
  $sql = "SELECT cal_date, cal_time, " .
    "cal_duration, " .
    "cal_suit, cal_description FROM webcal_meal WHERE cal_id = " . $id;
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( ! empty ( $date ) ) {
      // Leave $cal_date to what was set in URL with date=YYYYMMDD
      $cal_date = $date;
    } else {
      $cal_date = $row[0];
    }
    
    $year = (int) ( $cal_date / 10000 );
    $month = ( $cal_date / 100 ) % 100;
    $day = $cal_date % 100;
    $time = $row[1];
    // test for AllDay event, if so, don't adjust time
    if ( $time > 0  || ( $time == 0 &&  $row[2] != 1440 ) ) { /* -1 = no time specified */
      $time += ( ! empty ( $TZ_OFFSET )?$TZ_OFFSET : 0)  * 10000;
      if ( $time > 240000 ) {
        $time -= 240000;
        $gmt = mktime ( 3, 0, 0, $month, $day, $year );
        $gmt += $ONE_DAY;
        $month = date ( "m", $gmt );
        $day = date ( "d", $gmt );
        $year = date ( "Y", $gmt );
      } else if ( $time < 0 ) {
        $time += 240000;
        $gmt = mktime ( 3, 0, 0, $month, $day, $year );
        $gmt -= $ONE_DAY;
        $month = date ( "m", $gmt );
        $day = date ( "d", $gmt );
        $year = date ( "Y", $gmt );
      }
      // Set alterted date
      $cal_date = sprintf("%04d%02d%02d",$year,$month,$day);
    }
    if ( $time >= 0 ) {
      $hour = floor($time / 10000);
      $minute = ( $time / 100 ) % 100;
      $duration = $row[2];
    } else {
      $duration = "";
      $hour = -1;
    }
    $suit = $row[3];
    $description = $row[4];
  }
  if ( ! empty ( $allow_external_users ) && $allow_external_users == "Y" ) {
    $external_users = event_get_external_users ( $id );
  }
} else {
  // New event.
  $id = 0; // to avoid warnings below about use of undefined var
  // Anything other then testing for strlen breaks either hour=0 or no hour in URL
  if ( strlen ( $hour ) ) {
    $time = $hour * 100;
  } else {
    $time = -1;
    $hour = 0;
  }
  if ( ! empty ( $defusers ) ) {
    $tmp_ar = explode ( ",", $defusers );
    for ( $i = 0; $i < count ( $tmp_ar ); $i++ ) {
      $participants[$tmp_ar[$i]] = 1;
    }
  }
  if ( $readonly == "N" ) {
    // If public, then make sure we can add events
    if ( $login == '__public__' ) {
      if ( $public_access_can_add )
        $can_edit = true;
    } else {
      // not public user
        $can_edit = true;
    }
  }
}
if ( ! empty ( $year ) && $year )
  $thisyear = $year;
if ( ! empty ( $month ) && $month )
  $thismonth = $month;
if ( ! empty ( $day ) && $day )
  $thisday = $day;

// avoid error for using undefined vars
if ( ! isset ( $hour ) )
  $hour = -1;
if ( empty ( $duration ) )
  $duration = 0;
if ( $duration == ( 24 * 60 ) ) {
  $hour = $minute = $duration = "";
  $allday = "Y";
} else
  $allday = "N";
if ( empty ( $name ) )
  $name = "";
if ( empty ( $description ) )
  $description = "";

if ( ( empty ( $year ) || ! $year ) &&
  ( empty ( $month ) || ! $month ) &&
  ( ! empty ( $date ) && strlen ( $date ) ) ) {
  $thisyear = $year = substr ( $date, 0, 4 );
  $thismonth = $month = substr ( $date, 4, 2 );
  $thisday = $day = substr ( $date, 6, 2 );
  $cal_date = $date;
} else {
  if ( empty ( $cal_date ) )
    $cal_date = date ( "Ymd" );
}
if ( empty ( $thisyear ) )
  $thisdate = date ( "Ymd" );
else {
  $thisdate = sprintf ( "%04d%02d%02d",
    empty ( $thisyear ) ? date ( "Y" ) : $thisyear,
    empty ( $thismonth ) ? date ( "m" ) : $thismonth,
    empty ( $thisday ) ? date ( "d" ) : $thisday );
}
if ( empty ( $cal_date ) || ! $cal_date )
  $cal_date = $thisdate;

if ( $allow_html_description == "Y" ){
  // Allow HTML in description
  // If they have installed the htmlarea widget, make use of it
  $textareasize = 'rows="15" cols="50"';
  if ( file_exists ( "includes/htmlarea/htmlarea.php" ) ) {
    $BodyX = 'onload="initEditor();timetype_handler()"';
    $INC = array ( 'htmlarea/htmlarea.php', 'js/edit_entry.php',
      'js/visible.php', 'htmlarea/core.php' );
  } else {
    // No htmlarea files found...
    $BodyX = 'onload="timetype_handler()"';
    $INC = array ( 'js/edit_entry.php', 'js/visible.php' );
  }
} else {
  $textareasize = 'rows="5" cols="40"';
  $BodyX = 'onload="timetype_handler()"';
  $INC = array('js/edit_entry.php','js/visible.php');
}

print_header ( $INC, '', $BodyX );
?>


<h2><?php if ( $id ) echo translate("Edit Entry"); else echo translate("Add Entry"); ?>&nbsp;<img src="help.gif" alt="<?php etranslate("Help")?>" class="help" onclick="window.open ( 'help_edit_entry.php<?php if ( empty ( $id ) ) echo "?add=1"; ?>', 'cal_help', 'dependent,menubar,scrollbars,height=400,width=400,innerHeight=420,outerWidth=420');" /></h2>

<?php
 if ( $can_edit ) {
?>
<form action="edit_entry_handler.php" method="post" name="editentryform">

<?php
if ( ! empty ( $id ) && ( empty ( $copy ) || $copy != '1' ) ) echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
// we need an additional hidden input field
echo "<input type=\"hidden\" name=\"entry_changed\" value=\"\" />\n";

// if assistant, need to remember boss = user
if ( $is_assistant || $is_nonuser_admin || ! empty ( $user ) )
   echo "<input type=\"hidden\" name=\"user\" value=\"$user\" />\n";

// if has cal_group_id was set, need to send parent = $parent
if ( ! empty ( $parent ) )
   echo "<input type=\"hidden\" name=\"parent\" value=\"$parent\" />\n";

?>

<!-- TABS -->
<?php if ( $useTabs ) { ?>
<div id="tabs">
 <span class="tabfor" id="tab_details"><a href="#tabdetails" onclick="return showTab('details')"><?php etranslate("Details") ?></a></span>
</div>
<?php } ?>

<!-- TABS BODY -->
<?php if ( $useTabs ) { ?>
<div id="tabscontent">
 <!-- DETAILS -->
 <a name="tabdetails"></a>
 <div id="tabscontent_details">
<?php } ?>
  <table style="border-width:0px;">
   <tr><td style="width:23%;" class="tooltip" title="<?php etooltip("brief-description-help")?>">
    <label for="entry_brief"><?php etranslate("Meal suit")?>:</label></td><td>
    <input type="text" name="name" id="entry_brief" size="25" value="<?php 
     echo htmlspecialchars ( $name );
    ?>" /></td><td style="width:35%;">
   </td></tr>
   <tr><td style="vertical-align:top;" class="tooltip" title="<?php etooltip("full-description-help")?>">
    <label for="entry_full"><?php etranslate("Description")?>:</label></td><td>
    <textarea name="description" id="entry_full" <?php
     echo $textareasize;
    ?>><?php
     echo htmlspecialchars ( $description );
    ?></textarea></td><td style="vertical-align:top;">

  </td></tr>
  <tr><td class="tooltip" title="<?php etooltip("date-help")?>">
   <?php etranslate("Date")?>:</td><td colspan="2">
   <?php
    print_date_selection ( "", $cal_date );
   ?>
  </td></tr>
  <tr><td>&nbsp;</td><td colspan="2">
   <select name="timetype" onchange="timetype_handler()">
    <option value="U" <?php if ( $allday != "Y" && $hour == -1 ) echo " selected=\"selected\""?>><?php etranslate("Untimed event"); ?></option>
    <option value="T" <?php if ( $allday != "Y" && $hour >= 0 ) echo " selected=\"selected\""?>><?php etranslate("Timed event"); ?></option>
    <option value="A" <?php if ( $allday == "Y" ) echo " selected=\"selected\""?>><?php etranslate("All day event"); ?></option>
   </select>
  </td></tr>
  <tr id="timeentrystart"><td class="tooltip" title="<?php etooltip("time-help")?>">
   <?php echo translate("Time") . ":"; ?></td><td colspan="2">
<?php
$h12 = $hour;
$amsel = " checked=\"checked\""; $pmsel = "";
if ( $TIME_FORMAT == "12" ) {
  if ( $h12 < 12 ) {
    $amsel = " checked=\"checked\""; $pmsel = "";
  } else {
    $amsel = ""; $pmsel = " checked=\"checked\"";
  }
  $h12 %= 12;
  if ( $h12 == 0 ) $h12 = 12;
}
if ( $time < 0 )
  $h12 = "";
?>
   <input type="text" name="hour" size="2" value="<?php 
    if ( $time >= 0 && $allday != 'Y' ) echo $h12;
   ?>" maxlength="2" />:<input type="text" name="minute" size="2" value="<?php 
    if ( $time >= 0 && $allday != "Y" ) printf ( "%02d", $minute );
   ?>" maxlength="2" />
<?php
if ( $TIME_FORMAT == "12" ) {
  echo "<label><input type=\"radio\" name=\"ampm\" value=\"am\" $amsel />&nbsp;" .
    translate("am") . "</label>\n";
  echo "<label><input type=\"radio\" name=\"ampm\" value=\"pm\" $pmsel />&nbsp;" .
    translate("pm") . "</label>\n";
}
?>

<?php
  $dur_h = (int)( $duration / 60 );
  $dur_m = $duration % 60;

if ($GLOBALS['TIMED_EVT_LEN'] != 'E') { ?>
   </td></tr>
  <tr id="timeentryduration"><td>
  <span class="tooltip" title="<?php 
   etooltip("duration-help")
  ?>"><?php 
   etranslate("Duration")
  ?>:&nbsp;</span></td><td colspan="2">
  <input type="text" name="duration_h" id="duration_h" size="2" maxlength="2" value="2"/>:<input type="text" name="duration_m" id="duration_m" size="2" maxlength="2" value="00"/>&nbsp;(<label for="duration_h"><?php 
   echo translate("hours")
  ?></label>: <label for="duration_m"><?php 
   echo translate("minutes")
  ?></label>)
 </td></tr>
<?php } else {
if ( $id ) {
  $t_h12 = $h12;
  if ( $TIME_FORMAT == "12" ) {
    // Convert to a twenty-four hour time scale
    if ( !empty ( $amsel ) && $t_h12 == 12 )
      $t_h12 = 0;
    if ( !empty ( $pmsel ) && $t_h12 < 12 )
      $t_h12 += 12;
  } //end 12-hour time format

  // Add duration
  $endhour = $t_h12 + $dur_h;
  $endminute = $minute + $dur_m;
  $endhour = $endhour + (int)( $endminute / 60 );
  $endminute %= 60;

  if ( $TIME_FORMAT == "12" ) {
    // Convert back to a standard time format
    if ( $endhour < 12 ) {
      $endamsel = " checked=\"checked\""; $endpmsel = "";
    } else {
      $endamsel = ""; $endpmsel = " checked=\"checked\"";
    } //end if ( $endhour < 12 )
    $endhour %= 12;
    if ( $endhour == 0 ) $endhour = 12;
  } //end if ( $TIME_FORMAT == "12" )
} else {
  $endhour = $h12;
  $endminute = $minute;
  $endamsel = $amsel;
  $endpmsel = $pmsel;
} //end if ( $id )
if ( $allday != "Y" && $hour == -1 ) {
  $endhour = "";
  $endminute = "";
} //end if ( $allday != "Y" && $hour == -1 )
?>
 <span id="timeentryend" class="tooltip" title="<?php etooltip("end-time-help")?>">&nbsp;-&nbsp;
  <input type="text" name="endhour" size="2" value="<?php 
   if ( $allday != "Y" ) echo $endhour;
  ?>" maxlength="2" />:<input type="text" name="endminute" size="2" value="<?php 
   if ( $time >= 0 && $allday != "Y" ) printf ( "%02d", $endminute );
  ?>" maxlength="2" />
  <?php
   if ( $TIME_FORMAT == "12" ) {
    echo "<label><input type=\"radio\" name=\"endampm\" value=\"am\" $endamsel />&nbsp;" .
     translate("am") . "</label>\n";
    echo "<label><input type=\"radio\" name=\"endampm\" value=\"pm\" $endpmsel />&nbsp;" .
     translate("pm") . "</label>\n";
   }
  ?>
 </span>
</td></tr>
<?php } ?>

<tr><td class="tooltip">
<?php etranslate("Menu")?>:</td></tr>

<tr><td class="tooltip">
<?php etranslate("Walk-ins welcome?")?>:</td>
<td>
  <select name="walkins">
    <option value="D" selected="selected">Discouraged</option>
    <option value="W">Welcome</option>
    <option value="E">Encouraged</option>
  </select>
</td>
</tr>



<tr><td class="tooltip">
<?php etranslate("Number of head cooks")?>:</td></tr>

<tr><td class="tooltip">
<?php etranslate("Number of other cooks")?>:</td></tr>

<tr><td class="tooltip">
<?php etranslate("Number of cleaners")?>:</td></tr>

<tr><td class="tooltip">
<?php etranslate("Notes")?>:</td></tr>

</table>



<?php if ( $useTabs ) { ?>
</div>
<?php } /* $useTabs */ ?>


</div> <!-- End tabscontent -->
<table  style="border-width:0px;">
<tr><td>
 <script type="text/javascript">
<!-- <![CDATA[
  document.writeln ( '<input type="button" value="<?php etranslate("Save")?>" onclick="validate_and_submit()" />' );
//]]> -->
 </script>
 <noscript>
  <input type="submit" value="<?php etranslate("Save")?>" />
 </noscript>
</td></tr>
</table>
<input type="hidden" name="participant_list" value="" />
</form>

<?php if ( $id > 0 && ( $login == $create_by || $single_user == "Y" || $is_admin ) ) { ?>
 <a href="del_entry.php?id=<?php echo $id;?>" onclick="return confirm('<?php etranslate("Are you sure you want to delete this entry?")?>');"><?php etranslate("Delete entry")?></a><br />
<?php 
 } //end if clause for delete link
} else { 
  echo translate("You are not authorized to edit this entry") . ".";
} //end if ( $can_edit )
?>

<?php print_trailer(); ?>
</body>
</html>

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

$can_edit = false;
if ( $is_meal_coordinator || $is_admin ) {
  $can_edit = true;
}

$external_users = "";
$participants = array ();
$repeats = false;

if ( ! empty ( $id ) && $id > 0 ) { 
  // edit existing event
  $newevent = false;
  $repeats = false;
  $sql = "SELECT cal_date, cal_time, " .
    "cal_suit, cal_menu, cal_head_chef, cal_num_cooks, " .
    "cal_num_cleanup, cal_num_setup, cal_num_other_crew, " . 
    "cal_walkins, cal_notes " .
    "FROM webcal_meal WHERE cal_id = " . $id;
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    $cal_date = $row[0];
    
    $year = (int) ( $cal_date / 10000 );
    $month = ( $cal_date / 100 ) % 100;
    $day = $cal_date % 100;
    $time = $row[1];
    $hour = floor($time / 10000);
    $minute = ( $time / 100 ) % 100;
    $suit = $row[2];
    $menu = $row[3];
    $head_chef = $row[4];
    $num_cooks = $row[5];
    $num_cleanup = $row[6];
    $num_setup = $row[7];
    $num_other_crew = $row[8];
    $walkins = $row[9];
    $notes = $row[10];
  }
  if ( ! empty ( $allow_external_users ) && $allow_external_users == "Y" ) {
    $external_users = event_get_external_users ( $id );
  }
} else {
  // New event.
  $newevent = true;
  $id = 0; // to avoid warnings below about use of undefined var
  $hour = 18;
  $minute = 0;
  $time = $hour * 100 + $minute;

  // defaults
  $suit="wild";
  $head_chef="not selected";
  $menu="";
  $num_cooks=2;
  $num_cleanup=2;
  $num_setup=2;
  $num_other_crew=0;
  $walkins="D";
  $notes="";
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
if ( empty ( $suit ) )
  $suit = "";

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
    $BodyX = 'onload="initEditor();"';
    $INC = array ( 'htmlarea/htmlarea.php', 'js/edit_entry.php',
      'js/visible.php', 'htmlarea/core.php' );
  } else {
    // No htmlarea files found...
    $BodyX = 'onload=""';
    $INC = array ( 'js/edit_entry.php', 'js/visible.php' );
  }
} else {
  $textareasize = 'rows="5" cols="40"';
  $BodyX = 'onload=""';
  $INC = array('js/edit_entry.php','js/visible.php');
}


print_header ( $INC, '', $BodyX );
?>


<h2>
<?php 
  if ( $id ) echo translate("Edit Meal"); 
  else echo translate("Add Meal"); 
?>
&nbsp;
<img src="help.gif" alt="Help" class="help" onclick="window.open ( 'help_edit_entry.php
<?php if ( empty ( $id ) ) echo "?add=1"; ?>
', 'cal_help', 'dependent,menubar,scrollbars,height=400,width=400,innerHeight=420,outerWidth=420');" />
</h2>

<?php
 if ( $can_edit ) {
?>
<form action="edit_entry_handler.php" method="post" name="editentryform">

<?php
if ( ! empty ( $id ) && ( empty ( $copy ) || $copy != '1' ) ) echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
// additional hidden input fields
echo "<input type=\"hidden\" name=\"repeats\" value=\"$repeats\" />\n";
echo "<input type=\"hidden\" name=\"newevent\" value=\"$newevent\" />\n";

// if has cal_group_id was set, need to send parent = $parent
if ( ! empty ( $parent ) )
   echo "<input type=\"hidden\" name=\"parent\" value=\"$parent\" />\n";

?>

<input type="button" value="<?php etranslate("Save")?>" onclick="validate_and_submit()" />
<p />
<!-- TABS BODY -->
<?php if ( $useTabs ) { ?>
<div id="tabscontent">
 <!-- DETAILS -->
 <a name="tabdetails"></a>
 <div id="tabscontent_details">
<?php } ?>

<table style="border-width:0px;">

  <tr><td class="tooltip">Suit:</td>
  <td>
    <select name="suit" onchange="suittype_handler()">
      <?php
        if ( $newevent == true ) {
	  select_option( "wild", $suit );
	  select_option( "spade", $suit );
	  select_option( "heart", $suit );
	  select_option( "club", $suit );
	  select_option( "diamond", $suit );
	}
        else {
	  echo "<option value=\"$suit\">$suit</option>\n";
	}
      ?>
    </select>
  </td></tr>



  </td></tr>
  <tr><td class="tooltip" title="<?php etooltip("date-help")?>">Date:</td><td colspan="2">
   <?php
    print_date_selection ( "", $cal_date );
   ?>
  </td></tr>

  <?php if ( $newevent == true ) { ?>
  <tr id="suitenddate">
    <td class="tooltip">Create meals until:</td>
    <td><?php print_date_selection ( "end", $end_date ); ?>
  </td></tr>
  <?php } ?>

  
  <?php if ( $newevent == true ) { ?>
  <tr id="suitdayofweek">
    <td class="tooltip">Day(s) of the week:</td>
    <td><input type="checkbox" name="onSun" checked>Sun</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="onMon" checked>Mon</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="onTue" checked>Tue</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="onWed" checked>Wed</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="onThurs" checked>Thu</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="onFri" checked>Fri</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="onSat" checked>Sat</input></td>
  </td></tr>
  <?php } ?>

  <tr><td class="tooltip" title="<?php etooltip("time-help")?>">
   <?php echo translate("Time") . ":"; ?></td><td colspan="2">
<?php
$h12 = $hour;
$pmsel = " checked=\"checked\""; $amsel = "";
if ( $TIME_FORMAT == "12" ) {
  if ( ($h12 < 12) && ($h12 > 0) ) {
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

if ( $id ) {
  $t_h12 = $h12;
  if ( $TIME_FORMAT == "12" ) {
    // Convert to a twenty-four hour time scale
    if ( !empty ( $amsel ) && $t_h12 == 12 )
      $t_h12 = 0;
    if ( !empty ( $pmsel ) && $t_h12 < 12 )
      $t_h12 += 12;
  } //end 12-hour time format
}
?>
</td></tr>

<tr id="menubox"><td style="vertical-align:top;" class="tooltip">Menu:</td><td>
  <textarea name="menu" 
  <?php echo $textareasize; ?>><?php echo htmlspecialchars ( $menu );?></textarea>
</td></tr>

<tr id="headchef"><td class="tooltip">Head chef:</td>
  <td>
  <select name="head_chef">
    <option value="not selected"
      <?php if ( $head_chef == "not selected" ) echo "selected=\"selected\""; ?>
      >not selected</option>
  <?php
    $adult_cutoff = sprintf( "%04d%02d%02d", date( "Y" )-15, date( "m" ), date( "d" ) );
    $sql = "SELECT cal_login, cal_firstname, cal_lastname " .
           "FROM webcal_user " .
	   "WHERE cal_birthdate <= $adult_cutoff " . 
           "ORDER BY cal_firstname";
    $res = dbi_query ( $sql );
    if ( $res ) {
      while ( $row = dbi_fetch_row ( $res ) ) {
        echo "<option value=" . $row[0];
	if ( $row[0] == $head_chef ) echo " selected=\"selected\"";
	echo ">" . $row[1] . " " . $row[2] . "</option>";
      } 
    }
  ?>
  </select>
</td></tr>

<tr><td class="tooltip">Number of other cooks:</td>
  <td>
  <select name="num_cooks">
  <?php
    for ( $i=0; $i<11; $i++ )
      select_option( $i, $num_cooks );
  ?>
  </select>
</td></tr>

<tr><td class="tooltip">Number of people for setup:</td>
  <td>
  <select name="num_setup">
  <?php
    for ( $i=0; $i<11; $i++ )
      select_option( $i, $num_setup );
  ?>
  </select>
</td></tr>

<tr><td class="tooltip">Number of people for cleanup:</td>
  <td>
  <select name="num_cleanup">
  <?php
    for ( $i=0; $i<11; $i++ )
      select_option( $i, $num_cleanup );
  ?>
  </select>
</td></tr>

<tr><td class="tooltip">Number of other crew members:</td>
  <td>
  <select name="num_other_crew">
  <?php
    for ( $i=0; $i<11; $i++ )
      select_option( $i, $num_other_crew );
  ?>
  </select>
</td></tr>

<tr><td class="tooltip">Walk-ins welcome?:</td>
<td>
  <select name="walkins">
    <?php
    select_option( "D", $walkins, "Discouraged" );
    select_option( "W", $walkins, "Welcome" );
    select_option( "E", $walkins, "Encouraged" );
    ?>
  </select>
</td>
</tr>


<tr><td style="vertical-align:top;" class="tooltip">Notes:</td><td>
  <textarea name="notes" 
  <?php echo $textareasize; ?>><?php echo htmlspecialchars ( $notes );?></textarea>
</td></tr>

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

<?php if ( $id > 0 && $is_admin ) { ?>
 <a href="del_entry.php?id=<?php echo $id;?>" onclick="return confirm('<?php etranslate("Are you sure you want to delete this entry?")?>');"><?php etranslate("Delete entry")?></a><br />
<?php 
 } //end if clause for delete link
} else { 
  echo translate("You are not authorized to edit this entry") . ".";
} //end if ( $can_edit )
?>


<script language="JavaScript" type="text/javascript">
suittype_handler();	
</script>



<?php print_trailer(); ?>
</body>
</html>


<?php 
function select_option( $option, $selected, $text="" ) {
  if ( $text == "" ) $text = $option;
  if ( $option == $selected )
    echo "<option value=\"$option\" selected=\"selected\">$text</option>\n";
  else
    echo "<option value=\"$option\">$text</option>\n";
}
?> 

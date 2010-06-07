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

$id = mysql_safe( getValue('id'), false );


$edit_special = false;
$can_edit = false;
if ( $id ) {
  if ( is_chef( $id ) ) {
    $can_edit = true;
  }
} else {
  $can_edit = true;
}
if ( $is_meal_coordinator ) {
  $edit_special = true;
  $can_edit = true;
}


$external_users = "";
$participants = array ();
$repeats = false;
$newevent = false;
$uses_endday = false; 


if ( ! empty ( $id ) && $id > 0 ) { 
  // edit existing event
  $newevent = false;
  $repeats = false;
  $sql = "SELECT cal_date, cal_time, " .
    "cal_suit, cal_menu, " .
    "cal_walkins, cal_signup_deadline, " .
    "cal_base_price, cal_notes, cal_max_diners " .
    "FROM webcal_meal WHERE cal_id = " . $id;
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    $cal_date = $row[0];
    
    $year = (int) ( $cal_date / 10000 );
    $month = ( $cal_date / 100 ) % 100;
    $day = $cal_date % 100;
    $time = $row[1];
    time_to_hour_minute( $time, $hour, $minute );
    $suit = $row[2];
    $menu = $row[3];
    $walkins = $row[4];
    $deadline = $row[5];
    $base_price = $row[6];
    $notes = $row[7];
    $max_diners = $row[8];
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
  $cal_date = date( "Ymd" );
  $menu="";
  $walkins="C";
  $deadline = 2;
  $base_price = 400;
  $notes="";
  $max_diners=0;
}


if ( $allow_html_description == "Y" ){
  // Allow HTML in description
  // If they have installed the htmlarea widget, make use of it
  $textareasize = 'rows="15" cols="50"';
  if ( file_exists ( "includes/htmlarea/htmlarea.php" ) ) {
    $BodyX = 'onload="initEditor();"';
    $INC = array ( 'htmlarea/htmlarea.php', 'js/edit_entry.php',
		   'js/visible.php', 'js/functions.php', 'htmlarea/core.php' );
  } else {
    // No htmlarea files found...
    $BodyX = 'onload=""';
    $INC = array ( 'js/edit_entry.php', 'js/visible.php', 'js/functions.php' );
  }
} else {
  $textareasize = 'rows="5" cols="40"';
  $BodyX = 'onload=""';
  $INC = array('js/edit_entry.php','js/visible.php', 'js/functions.php' );
}


print_header ( $INC, '', $BodyX );
?>


<h2>
<?php 
  if ( $id ) echo "Edit Meal"; 
  else echo "Add Meal"; 
?>
</h2>

<?php
 if ( $can_edit ) {
?>
<form action="edit_entry_handler.php" method="post" name="editentryform">

<input type="button" value="Save" onclick="validate_and_submit()" />
     <?php if ( $is_meal_coordinator ) {
     echo " OR <a class=\"addbutton\" href=\"add_standard_meals.php\">Add standard meals</a>";
   } ?>
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
	  if ( $edit_special == true ) {
	    select_option( "heart", $suit );
	    select_option( "club", $suit );
	    select_option( "diamond", $suit );
	  }
	}
        else {
	  echo "<option value=\"$suit\">$suit</option>\n";
	}
      ?>
    </select>
  </td></tr>



  </td></tr>
  <tr><td class="tooltip" title="date">Date:</td><td colspan="2">
   <?php
	print_date_selection ( "", $cal_date, "editentryform" );
   ?>
  </td></tr>

  <?php if ( $newevent == true ) { 
    $uses_endday = true; ?>
  <tr id="suitenddate">
    <td class="tooltip">Create meals until:</td>
     <td><?php print_date_selection ( "end", $end_date, "editentryform" ); ?>
  </td></tr>
  <?php } ?>

  
  <?php if ( $newevent == true ) { ?>
  <tr id="suitdayofweek">
    <td class="tooltip">Day(s) of the week:</td>
    <td><input type="checkbox" name="d0" checked>Sun</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="d1">Mon</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="d2">Tue</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="d3">Wed</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="d4">Thu</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="d5">Fri</input>&nbsp;&nbsp;&nbsp;
    <input type="checkbox" name="d6">Sat</input></td>
  </td></tr>
  <?php } ?>

  <tr><td class="tooltip">Time:</td>
      <td colspan="2">
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
    "am" . "</label>\n";
  echo "<label><input type=\"radio\" name=\"ampm\" value=\"pm\" $pmsel />&nbsp;" .
    "pm" . "</label>\n";
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

<tr><td class="tooltip">Desired crew</td><td></td></tr>
<tr><td style="vertical-align:top;"> (in addition to head chef):</td>
    <td><p>Please fill in job descriptions only for the number of crew you are requesting. Leave the rest of the slots blank. (Note that you cannot edit job descriptions once someone has signed up for that slot.)</p>

  <table class="bordered_table">
  <tr><td>Crew number</td><td>Job description (e.g. chopping help from 4:30-6pm on Wed)</td></tr>

  <?php 
 $sql = "SELECT cal_notes, cal_login FROM webcal_meal_participant " .
         "WHERE cal_id = $id AND cal_type = 'C'";
 $count = 0;
 if ( $res = dbi_query( $sql ) ) {
   while ( $row = dbi_fetch_row( $res ) ) {
     $count++;
     $job = $row[0];
     $person = $row[1];
     echo "<tr><td class=\"number\">$count</td>";
     if ( ereg( "^none", $person ) ) 
       echo "<td><input type=\"text\" name=\"job$count\" size=\"45\" value=\"$job\" maxlength=\"80\"/></td>";       
     else {
       if ( $job == "" ) $job = "???";
       echo "<td>$job</td>";
     }
   }
 }

 $count++;
 for ( $i=$count; $i<7; $i++ ) {
   echo "<tr><td class=\"number\">$i</td>";
   echo "<td><input type=\"text\" name=\"job$i\" size=\"45\" value=\"\" maxlength=\"80\"/></td>";
 }

  ?>
  </table>

</td></tr>


<tr><td class="tooltip">Max number of diners:</td>
  <td>
  <select name="max_diners">
  <?php
    select_option( "no limit", $max_diners );
    for ( $i=1; $i<51; $i++ )
      select_option( $i, $max_diners );
  ?>
  </select>
</td></tr>



<?php 
price_to_dollars_cents( $base_price, $base_dollars, $base_cents );
?>
<tr><td class="tooltip">Base price:</td>
<td colspan="2">
  <?php if ( $newevent == true ) { ?>
    $<input type="text" name="base_dollars" size="2" 
      value="<?php echo $base_dollars;?>" maxlength="2" />.
      <input type="text" name="base_cents" size="2"
      value="<?php printf( "%02d", $base_cents );?>" maxlength="2" />
  <?php } else {
    printf( "\$%d.%02d", $base_dollars, $base_cents ); 
    echo "<input type=\"hidden\" name=\"base_dollars\" value=\"$base_dollars\" />\n";
    echo "<input type=\"hidden\" name=\"base_cents\" value=\"$base_cents\" />\n";
 }?>
</td>
</tr>


<tr id="signup_deadline"><td class="tooltip">Signup deadline:</td>
<td>
   <input type="text" name="deadline" size="2" 
   value="<?php echo $deadline;?>" maxlength="2" /> days before meal
</td>
</tr>



<tr><td class="tooltip">Walk-ins welcome?:</td>
<td>
  <select name="walkins">
    <?php
    select_option( "C", $walkins, "Check with head chef ASAP" );
    select_option( "W", $walkins, "Welcome" );
    select_option( "Y", $walkins, "Needed" );
    select_option( "N", $walkins, "No" );
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
  document.writeln ( '<input type="button" value="Save" onclick="validate_and_submit()" />' );
//]]> -->
 </script>
 <noscript>
  <input type="submit" value="Save" />
 </noscript>
</td></tr>
</table>

<?php
if ( ! empty ( $id ) ) echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
// additional hidden input fields
echo "<input type=\"hidden\" name=\"repeats\" value=\"$repeats\" />\n";
echo "<input type=\"hidden\" name=\"newevent\" value=\"$newevent\" />\n";
echo "<input type=\"hidden\" name=\"uses_endday\" value=\"$uses_endday\" />\n";
?>

</form>

<?php if ( $id > 0 && $is_meal_coordinator ) { ?>
 <a href="del_entry.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete this entry?');">Delete entry</a><br />
<?php 
 } //end if clause for delete link
} else { 
  echo "You are not authorized to edit this entry" . ".";
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

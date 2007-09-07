<?php
include_once 'includes/init.php';


$next = mktime ( 3, 0, 0, $thismonth + 1, 1, $thisyear );
$nextyear = date ( "Y", $next );
$nextmonth = date ( "m", $next );
//$nextdate = date ( "Ymd" );

$prev = mktime ( 3, 0, 0, $thismonth - 1, 1, $thisyear );
$prevyear = date ( "Y", $prev );
$prevmonth = date ( "m", $prev );
//$prevdate = date ( "Ymd" );

if ( ! empty ( $bold_days_in_year ) && $bold_days_in_year == 'Y' ) {
  $boldDays = true;
  $startdate = sprintf ( "%04d%02d01", $prevyear, $prevmonth );
  $enddate = sprintf ( "%04d%02d31", $nextyear, $nextmonth );
} else {
  $boldDays = false;
  $startdate = sprintf ( "%04d%02d01", $thisyear, $thismonth );
  $enddate = sprintf ( "%04d%02d31", $thisyear, $thismonth );
}

$HeadX = '';
if ( $auto_refresh == "Y" && ! empty ( $auto_refresh_time ) ) {
  $refresh = $auto_refresh_time * 60; // convert to seconds
  $HeadX = "<meta http-equiv=\"refresh\" content=\"$refresh; url=month.php?$u_url" .
    "year=$thisyear&amp;month=$thismonth" . 
    ( ! empty ( $friendly ) ? "&amp;friendly=1" : "") . "\" />\n";
}
$INC = array('js/popups.php');
print_header($INC,$HeadX);

/* Pre-load the events for quicker access */
$events = read_events ( $startdate, $enddate );

$monthURL = 'month.php?';
display_small_month ( $prevmonth, $prevyear, true, true, "prevmonth",
  $monthURL );
display_small_month ( $nextmonth, $nextyear, true, true, "nextmonth",
  $monthURL );
?>
<div class="title">
<span class="date"><br /><?php
  echo date_to_str ( sprintf ( "%04d%02d01", $thisyear, $thismonth ),
    $DATE_FORMAT_MY, false, false );
?></span>
<span class="user"><?php
  echo "<br />\n";
  echo $user_fullname;
?></span>
</div>

<table class="main" style="clear:both;" cellspacing="0" cellpadding="0">
<tr>
 <?php if ( $WEEK_START == 0 ) { ?>
  <th><?php etranslate("Sun")?></th>
 <?php } ?>
 <th><?php etranslate("Mon")?></th>
 <th><?php etranslate("Tue")?></th>
 <th><?php etranslate("Wed")?></th>
 <th><?php etranslate("Thu")?></th>
 <th><?php etranslate("Fri")?></th>
 <th><?php etranslate("Sat")?></th>
 <?php if ( $WEEK_START == 1 ) { ?>
  <th><?php etranslate("Sun")?></th>
 <?php } ?>
</tr>
<?php

// We add 2 hours on to the time so that the switch to DST doesn't
// throw us off.  So, all our dates are 2AM for that day.
//$sun = get_sunday_before ( $thisyear, $thismonth, 1 );
if ( $WEEK_START == 1 ) {
  $wkstart = get_monday_before ( $thisyear, $thismonth, 1 );
} else {
  $wkstart = get_sunday_before ( $thisyear, $thismonth, 1 );
}
// generate values for first day and last day of month
$monthstart = mktime ( 3, 0, 0, $thismonth, 1, $thisyear );
$monthend = mktime ( 3, 0, 0, $thismonth + 1, 0, $thisyear );

// debugging
//echo "<p>sun = " . date ( "D, m-d-Y", $sun ) . "</p>\n";
//echo "<p>monthstart = " . date ( "D, m-d-Y", $monthstart ) . "</p>\n";
//echo "<p>monthend = " . date ( "D, m-d-Y", $monthend ) . "</p>\n";

// NOTE: if you make HTML changes to this table, make the same changes
// to the example table in pref.php.
for ( $i = $wkstart; date ( "Ymd", $i ) <= date ( "Ymd", $monthend );
  $i += ( 24 * 3600 * 7 ) ) {
  print "<tr>\n";
  for ( $j = 0; $j < 7; $j++ ) {
    $date = $i + ( $j * 24 * 3600 );
    if ( date ( "Ymd", $date ) >= date ( "Ymd", $monthstart ) &&
      date ( "Ymd", $date ) <= date ( "Ymd", $monthend ) ) {
      $thiswday = date ( "w", $date );
      print "<td";
      $class = "";
      if ( date ( "Ymd", $date  ) == date ( "Ymd", $today ) ) {
        $class = "today";
      }
      if ( strlen ( $class ) )  {
      echo " class=\"$class\"";
      }
      echo ">";
      //echo date ( "D, m-d-Y H:i:s", $date ) . "<br />";
      print_date_entries ( date ( "Ymd", $date ),
        false );
      print "</td>\n";
    } else {
      print "<td>&nbsp;</td>\n";
    }
  }
  print "</tr>\n";
}
?></table>
<br />
<?php
 if ( ! empty ( $eventinfo ) ) echo $eventinfo;
?>

<br />
<?php  // date navigation 
$next = mktime ( 3, 0, 0, $thismonth + 1, $thisday, $thisyear );
$prev = mktime ( 3, 0, 0, $thismonth - 1, $thisday, $thisyear );
?>

<div id="monthnav">

<span id="arrow">
<a title="Previous month" class="prev" href="month.php?date=<?php echo date("Ymd", $prev );?>">
  <img src="leftarrow.gif" alt="Previous month" /></a>
</span>

<span id="arrow">
<a title="Next month" class="next" href="month.php?date=<?php echo date ("Ymd", $next );?>">
<img src="rightarrow.gif" alt="Next month" /></a>
</span>

<form action="month.php" method="get" name="SelectMonth" id="monthform">
<label for="monthselect">Month:&nbsp;</label>
<select name="date" id="monthselect" onchange="document.SelectMonth.submit()">
<?php
  if ( ! empty ( $thisyear ) && ! empty ( $thismonth ) ) {
    $m = $thismonth;
    $y = $thisyear;
  } else {
    $m = date ( "m" );
    $y = date ( "Y" );
  }
  $d_time = mktime ( 3, 0, 0, $m, 1, $y );
  $thisdate = date ( "Ymd", $d_time );
  $y--;
  for ( $i = 0; $i < 25; $i++ ) {
    $m++;
    if ( $m > 12 ) {
      $m = 1;
      $y++;
    }
    $d = mktime ( 3, 0, 0, $m, 1, $y );
    echo "<option value=\"" . date ( "Ymd", $d ) . "\"";
    if ( date ( "Ymd", $d ) == $thisdate ) {
      echo " selected=\"selected\"";
    }
    echo ">";
    echo date_to_str ( date ( "Ymd", $d ), $DATE_FORMAT_MY, false, true );
    echo "</option>\n";
  }
?>
</select>
<input type="submit" value="Go" />
</form>

<form action="year.php" method="get" name="SelectYear" id="yearform">
<label for="yearselect">Year:&nbsp;</label>
<select name="year" id="yearselect" onchange="document.SelectYear.submit()">
<?php
  if ( ! empty ( $thisyear ) ) {
    $y = $thisyear;
  } else {
    $y = date ( "Y" );
  }
  for ( $i = $y - 4; $i < $y + 4; $i++ ) {
    echo "<option value=\"$i\"";
    if ( $i == $y ) {
      echo " selected=\"selected\"";
    }
    echo ">$i</option>\n";
  }
?>
</select>
<input type="submit" value="Go" />
</form>

</div>
<br />

<?php
 print_trailer ();
?>
</body>
</html>

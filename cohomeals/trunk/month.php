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

$startdate = sprintf ( "%04d%02d01", $prevyear, $prevmonth );
$enddate = sprintf ( "%04d%02d31", $nextyear, $nextmonth );

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

display_small_month ( $prevmonth, $prevyear, true, "prevmonth" );
display_small_month ( $nextmonth, $nextyear, true, "nextmonth" );
?>
<div class="title">
<span class="user"><?php
  echo "<br />\n";
  echo $user_fullname;
?></span>

<p>
<span class="title"><br /><?php
  $billing = get_billing_group( $login );
  echo "Your account balance is " . price_to_str( get_balance( $billing ) );
?></span>
</p>

<p>
<span class="title"><br /><?php
  $sql = "SELECT cal_id FROM webcal_meal_participant WHERE cal_type = 'H' AND cal_login = '$login'";
  $first = true;
  $today = date( "Ymd" );
  $three_months_ago_month = substr ( $today, 4, 2 ) - 3;
  if ( $three_months_ago_month <= 0 ) {
    $three_months_ago_month += 12;
  }
  if ( $three_months_ago_month > 9 ) {
    $three_months_ago_year = substr( $today, 0, 4 ) - 1;
  }
  else {
    $three_months_ago_year = substr( $today, 0, 4 );
    $three_months_ago_month = sprintf( "%s%s", "0", $three_months_ago_month );
  }
  $three_months_ago = sprintf( "%s%s%s", $three_months_ago_year, $three_months_ago_month, "00" );

  if ( $res = dbi_query( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {
      $meal_id = $row[0];

      if ( (paperwork_done( $meal_id ) == false) && (is_cancelled( $meal_id ) == false) ) {
	$sql2 = "SELECT cal_date, cal_time, cal_suit FROM webcal_meal WHERE cal_id = $meal_id " . 
	  "AND cal_date >= $three_months_ago AND cal_date <= $today";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  if ( $row2 = dbi_fetch_row( $res2 ) ) {
	    $day = $row2[0];
	    $time = $row2[1];
	    $suit = $row2[2];
	    
	    if ( $first == true ) {
	      echo "Please complete meal summaries for the following meals:<br>";
	      $first = false;
	    }
	    
	    $identifying_text = $suit . " meal on " . date_to_str( $day, "", true, false, $time ) .
	      " at " . display_time( $time );
	    $meal_url = "view_entry.php?id=$meal_id";
	    echo "<a href=$meal_url> $identifying_text </a><br>";
	  }
	}
      }
    }
  }
?>
</span></p>
</div>

<hr>
<p class="month_name"><?php
  echo date_to_str ( sprintf ( "%04d%02d01", $thisyear, $thismonth ),
    $DATE_FORMAT_MY, false, false );
?>
</p>


<table class="main" style="clear:both;" cellspacing="0" cellpadding="0">
<tr>
 <?php if ( $WEEK_START == 0 ) { ?>
  <th>Sun</th>
 <?php } ?>
 <th>Mon</th>
 <th>Tue</th>
 <th>Wed</th>
 <th>Thu</th>
 <th>Fri</th>
 <th>Sat</th>
 <?php if ( $WEEK_START == 1 ) { ?>
  <th>Sun</th>
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
      if ( date ( "Ymd", $date  ) == date ( "Ymd" ) ) {
        $class = "today";
      }
      if ( strlen ( $class ) )  {
      echo " class=\"$class\"";
      }
      echo ">";
      print_date_entries ( date ( "Ymd", $date ) );
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

<p class="printer" align="center">E = you are signed up to eat that meal, W = you are signed up to work</p>

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

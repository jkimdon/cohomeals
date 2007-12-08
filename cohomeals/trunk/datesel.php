<?php
/* $Id: datesel.php,v 1.31 2005/03/11 13:59:51 cknudsen Exp $ */
include_once 'includes/init.php';

// month and year are being overwritten so we will copy vars to fix.
// this will make datesel.php still work where ever it is called from.
// The values $fday, $fmonth and $fyear hold the form variable names
// to update when the user selects a date.  (This is needed in
// the js/datesel.php file that gets included below.)
$date = "";
$date = getGetValue( "date" );
$fday = "";
$fday = getGetValue ( "fday" );
$fmonth = "";
$fmonth = getGetValue ( "fmonth" );
$fyear = "";
$fyear = getGetValue ( "fyear" );
$form = "";
$form = getGetValue ( "form" );
$fid = 0;
$fid = getGetValue ( "mealid" );
$sendid = false;
$sendid = getGetValue ( "sendid" );

$INC = array('js/datesel.php');
print_header($INC,'','',true);

if ( strlen ( $date ) > 0 ) {
  $thisyear = substr ( $date, 0, 4 );
  $thismonth = substr ( $date, 4, 2 );
} else {
  $thismonth = date("m");
  $thisyear = date("Y");
}

$next = mktime ( 3, 0, 0, $thismonth + 1, 1, $thisyear );
$nextyear = date ( "Y", $next );
$nextmonth = date ( "m", $next );
$nextdate = date ( "Ym", $next ) . "01";

$prev = mktime ( 3, 0, 0, $thismonth - 1, 1, $thisyear );
$prevyear = date ( "Y", $prev );
$prevmonth = date ( "m", $prev );
$prevdate = date ( "Ym", $prev ) . "01";

?>

<div style="text-align:center;">
<table align="center" class="minical">
<tr>
<td><a title="Previous"  class="prev" href="datesel.php?form=<?php echo $form?>&amp;sendid=<?php echo $sendid?>&amp;fday=<?php echo $fday?>&amp;fmonth=<?php echo $fmonth?>&amp;fyear=<?php echo $fyear?>&amp;date=<?php echo $prevdate?>"><img src="leftarrowsmall.gif"  alt="Previous" /></a></td>
<th colspan="5"><?php echo month_name ( $thismonth - 1 ) . " " . $thisyear;?></th>
<td><a title="Next"class="next"  href="datesel.php?form=<?php echo $form?>&amp;sendid=<?php echo $sendid?>&amp;fday=<?php echo $fday?>&amp;fmonth=<?php echo $fmonth?>&amp;fyear=<?php echo $fyear?>&amp;date=<?php echo $nextdate?>"><img src="rightarrowsmall.gif"  alt="Next" /></a></td>
</tr>
<?php
echo "<tr class=\"day\">\n";
if ( $WEEK_START == 0 ) echo "<td>" .
  weekday_short_name ( 0 ) . "</td>\n";
for ( $i = 1; $i < 7; $i++ ) {
  echo "<td>" .
    weekday_short_name ( $i ) . "</td>\n";
}
if ( $WEEK_START == 1 ) echo "<td>" .
  weekday_short_name ( 0 ) . "</td>\n";
echo "</tr>\n";
if ( $WEEK_START == "1" )
  $wkstart = get_monday_before ( $thisyear, $thismonth, 1 );
else
  $wkstart = get_sunday_before ( $thisyear, $thismonth, 1 );
$monthstart = mktime ( 3, 0, 0, $thismonth, 1, $thisyear );
$monthend = mktime ( 3, 0, 0, $thismonth + 1, 0, $thisyear );
for ( $i = $wkstart; date ( "Ymd", $i ) <= date ( "Ymd", $monthend );
  $i += ( 24 * 3600 * 7 ) ) {
  echo "<tr>\n";
  for ( $j = 0; $j < 7; $j++ ) {
    $date = $i + ( $j * 24 * 3600 );
    $formatted_date = date ( "Ymd", $date );
    if ( $formatted_date >= date ( "Ymd", $monthstart ) &&
      $formatted_date <= date ( "Ymd", $monthend ) ) {
      $suit = "empty";
      $sql = "SELECT cal_suit, cal_id FROM webcal_meal " .
	"WHERE cal_date = $formatted_date";
      $id = 0;
      if ( $res = dbi_query( $sql ) ) {
	if ( $row = dbi_fetch_row( $res ) ) {
	  $suit = $row[0];
	  $id = $row[1];
	}
	dbi_free_result( $res );
      }
      echo "<td>";
      if ( $sendid == false )
	echo "<a href=\"javascript:sendDate('" .
	  date ( "Ymd", $date ) . "')\">";
      else 
	echo "<a href=\"javascript:sendID('" .
	  $id . "', '" . $suit . "', '" . 
	  date ( "Ymd", $date ) . "')\">";

      $suit .= ".png";
      echo date ( "j", $date ) . "<br>" . 
	"<img width=\"15\" border=\"0\" src=\"images/$suit\" /></a></td>\n";
    } else {
      echo "<td></td>\n";
    }
  }
  echo "</tr>\n";
}
?>
</table>
</div>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>

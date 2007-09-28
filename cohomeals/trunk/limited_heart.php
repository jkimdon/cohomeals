<?php
/*
 * Description:
 * Manage heart meal subscriptions
 *
 */
include_once 'includes/init.php';

$INC = array( 'js/subscribe_heart_js.php' );
print_header($INC,'','',true);
?>

<?php 
$user = mysql_safe( getValue( 'user' ) );

$drawyear = getValue( 'startyear' );
$drawmonth = getValue ( 'startmonth' );
$drawday = getValue( 'startday' );
$drawdate = sprintf( "%04d%02d%02d", $drawyear, $drawmonth, $drawday );
$startdate = $drawdate;

$endyear = getValue( 'endyear' );
$endmonth = getValue ( 'endmonth' );
$endday = getValue( 'endday' );
$enddate = sprintf( "%04d%02d%02d", $endyear, $endmonth, $endday );

$sql = "SELECT cal_date, cal_id FROM webcal_meal " .
       "WHERE cal_suit = 'heart' AND cal_date >= '$drawdate' AND cal_date <= '$enddate' " .
       "ORDER BY cal_date";
if ( ! ($res = dbi_query ( $sql )) ) {
  echo "Database error: " . dbi_error() . "<br />\n";
}

$row = dbi_fetch_row ( $res );
$nextdate = $row[0];
$nextid = $row[1];
$minid = $nextid;
$maxid = $nextid;
?>

<form action="limited_heart_handler.php" method="post" name="limitedheartform">
Select the dates you will be attending heart meals.<p />
Press "submit" when you are finished selecting dates.<p />
<hr><p />

<?php

$count = 0;
while ( $drawdate <= $enddate ) {
?>

 <div style="text-align:center;">
    <table align="center" class="heartsubcal">
    <tr>
    <th colspan="7"><?php echo month_name ( $drawmonth - 1 ) . " " . $drawyear;?></th>
    </tr>

   <?php
   echo "<tr class=\"day\">\n";
   echo "<td>" . weekday_short_name ( 0 ) . "</td>\n";
   for ( $i = 1; $i < 7; $i++ ) {
     echo "<td>" .
       weekday_short_name ( $i ) . "</td>\n";
   }
   echo "</tr>\n";
   $wkstart = get_sunday_before ( $drawyear, $drawmonth, 1 );
   $monthstart = mktime ( 3, 0, 0, $drawmonth, 1, $drawyear );
   $monthend = mktime ( 3, 0, 0, $drawmonth + 1, 0, $drawyear );
   for ( $i = $wkstart; date ( "Ymd", $i ) <= date ( "Ymd", $monthend );
	 $i += ( 24 * 3600 * 7 ) ) {
     echo "<tr>\n";
     for ( $j = 0; $j < 7; $j++ ) {
       $date = $i + ( $j * 24 * 3600 );
       $formatted_date = date ( "Ymd", $date );
       if ( date ( "Ymd", $date ) >= date ( "Ymd", $monthstart ) &&
	    date ( "Ymd", $date ) <= date ( "Ymd", $monthend ) ) {
	 if ( $nextdate == $formatted_date ) {
	   if ( $nextid < $minid ) $minid = $nextid;
	   if ( $nextid > $maxid ) $maxid = $nextid;
	   print_checked_day ( $date, $nextid );
	   $count++;
	   $row = dbi_fetch_row ( $res );
	   $nextdate = $row[0];
	   $nextid = $row[1];
	 } else {
	   print_unchecked_day ( $date );
	 }
       } else {
	 echo "<td></td>\n";
       }
     }
     echo "</tr>\n";
   }
   ?>
   </table>
 </div>

 <?php 
 $drawmonth += 1;
 if ( $drawmonth > 12 ) {
   $drawmonth -= 12;
   $drawyear += 1;
 }
 $drawdate = sprintf( "%04d%02d%02d", $drawyear, $drawmonth, $drawday );
} ?>


<input type="hidden" name="user" value="<?php echo $user;?>" />
<input type="hidden" name="startdate" value="<?php echo $startdate;?>" />
<input type="hidden" name="enddate" value="<?php echo $enddate;?>" />

<p align="center"><input type="button" value="Submit" onclick="check_number_meals(<?php echo $minid . "," . $maxid . ", " . $count;?>)" />
</p>

</form>

<?php print_trailer ( false, true, true ); ?>

</body>
</html>


<?php 

function print_unchecked_day ( $date ) {

  echo "<td>" . 
    "<input type=\"checkbox\" name=\"d$date\" disabled></input><br>" .
    date ( "j", $date ) . "</td>\n";

}


function print_checked_day ( $date, $id ) {

  $formatted_date = date ( "Ymd", $date );

  $sql2 = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = '$id'";
  $res2 = dbi_query ( $sql2 );
  if ( !$res2 ) echo "Database error: " . dbi_error() . "<br />\n";
  else if ( $row2 = dbi_fetch_row ( $res2 ) ) 
    $check = true;
  else
    $check = false;


  echo "<td>" . 
    "<input type=\"checkbox\" name=\"d$id\" ";
  if ( $check == true )
    echo "checked";
  echo "></input><br>" . date ( "j", $date ) . "</td>\n";

}


?>

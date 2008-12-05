<?php
include_once 'includes/init.php';

$INC = array( 'js/functions.php' );
$BodyX = '';
print_header( $INC, '', $BodyX );

if ( $is_meal_coordinator ) {

  $today = date( "Ymd" );

  $startday = "";
  $startday = mysql_safe( getGetValue( 'startday' ), false );
  $startmonth = "";
  $startmonth = mysql_safe( getGetValue( 'startmonth' ), false );
  $startyear = "";
  $startyear = mysql_safe( getGetValue( 'startyear' ), false );
  if ( $startday == "" || $startmonth == "" || $startyear == "" )
    $startdate = "";
  else 
    $startdate = sprintf ( "%04d%02d%02d", $startyear, $startmonth, $startday );

  $meal_id = 0;
  $meal_id = mysql_safe( getGetValue( 'meal_id' ), false );

?>
  <h2>Meal refunds (particularly for after signup deadline)</h2>

<?php  
  if ( $meal_id == 0 ) {
?>
    <form action="meal_refunds.php" method="get" name="datechooserform">

      Select meal date: <?php print_date_selection( "start", $startdate, "datechooserform" );?>
      <input type="submit" value="Go" /><br>
    </form>
<?php 
  } 
  if ( $startdate != "" ) {
?>
    <form action="meal_refunds.php" method="get" name="mealchooserform">
    <?php 
    echo "Select meal: ";
    echo "<select name=\"meal_id\">";
	
    $sql = "SELECT cal_id, cal_suit, cal_time FROM webcal_meal " .
      "WHERE cal_date = $startdate";
    if ( $res = dbi_query( $sql ) ) { 
      while ( $row = dbi_fetch_row( $res ) ) {
	$id = $row[0];
	$identifying_text = $row[1] . " meal at " . $row[2];
	echo "<option value=\"$id\">$identifying_text</option>\n";
      }
    } 
    dbi_free_result( $res );
    echo "</select>";
    echo "<input type=\"submit\" value=\"Go\" /><br>";
    echo "</form>";
  }

 if ( $meal_id != 0 ) {
   ?> <form action="meal_refunds_handler.php" method="post"><?php
     echo "<input type=\"hidden\" name=\"meal_id\" value=\"$meal_id\"\>";


   echo "Meal selected: ";

   $sql = "SELECT cal_suit, cal_date, cal_time FROM webcal_meal " .
     "WHERE cal_id = $meal_id";
   if ( $res = dbi_query( $sql ) ) { 
     if ( $row = dbi_fetch_row( $res ) ) {
       $suit = $row[0];
       $identifying_text = $suit . " meal on " . date_to_str( $row[1], "", true, false, $row[2] ) .
	 " at " . display_time( $row[2] );
       echo $identifying_text . "<br>";

       if ( $suit == "club" ) {  // locate all dates of this club
	 echo "The meal is a club. Please select the club dates you wish to refund<br>";

	 $sql2 = "SELECT cal_club_id FROM webcal_meal WHERE cal_id = $meal_id";
	 $res2 = dbi_query( $sql2 );
	 $row2 = dbi_fetch_row( $res2 );
	 $club_id = $row2[0];
	 echo "<input type=\"hidden\" name=\"club_id\" value=\"$club_id\"\>";

	 $sql3 = "SELECT cal_id, cal_date FROM webcal_meal " .
	   "WHERE cal_suit = 'club' AND cal_club_id = $club_id " .
	   "AND cal_cancelled = 0";
	 $res3 = dbi_query( $sql3 );
	 while( $row3 = dbi_fetch_row( $res3 ) ) {
	   $new_id = $row3[0];
	   $new_date = $row3[1];
	   echo "<input type=\"checkbox\" checked name=\"$new_id\"\>" . date_to_str( $new_date ) .
	     "</input><br>";
	 }
		

       }
     }
   } 
   dbi_free_result( $res );

   echo "<h3>Choose people to refund:</h3>";

   $sql = "SELECT cal_login FROM webcal_meal_participant " . 
     "WHERE (cal_type = 'M' OR cal_type = 'T') AND cal_id = $meal_id";
   if ( $res = dbi_query( $sql ) ) { 
     while ( $row = dbi_fetch_row( $res ) ) {
       $username = $row[0];
       user_load_variables( $username, "temp" );
       $name = $GLOBALS[tempfullname];
       echo "<input type=\"checkbox\" name=\"$username\">$name</input><br>";

     }
   }
   ?>
   <p><input type="submit" value="Submit"/></p>
   </form>
   <?php
 } 
?>





<?php
    } else { echo "Not authorized<br>"; }

print_trailer ();
?>
</body>
</html>

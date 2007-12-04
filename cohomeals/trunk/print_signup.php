<?php
include_once 'includes/init.php';


$id = mysql_safe( getValue( 'id' ), false );
if ( empty ( $id ) || $id <= 0 || ! is_numeric ( $id ) ) {
  $error = translate ( "Invalid entry id" ) . "."; 
}

print_header();


//// load meal date/time/price
$event_date = 0;
$event_time = 0;
$menu = "";
$price = 0;
$sql = "SELECT cal_date, cal_time, cal_menu, cal_base_price " .
 "FROM webcal_meal " .
 "WHERE cal_id = $id";
if ( $res = dbi_query( $sql ) ) {
  if ( $row = dbi_fetch_row( $res ) ) {
    $event_date = $row[0];
    $event_time = $row[1];
    $menu = $row[2];
    $price = $row[3];
  }
  dbi_free_result( $res );
} else {
  echo "error<br>";
  exit;
}


/// load head chef
$head_chef = "";
$sql = "SELECT cal_login " .
 "FROM webcal_meal_participant " .
 "WHERE cal_id = $id AND cal_type = 'H'";
if ( $res = dbi_query( $sql ) ) {
  if ( $row = dbi_fetch_row( $res ) ) {
    $user = $row[0];
    user_load_variables( $user, "temp" );
    $head_chef = $GLOBALS['tempfullname'];
  }
  dbi_free_result( $res );
}


//// load crew
$crew = array();
$count = 0;
$sql = "SELECT cal_login " .
 "FROM webcal_meal_participant " .
 "WHERE cal_id = $id AND cal_type = 'C'";
if ( $res = dbi_query( $sql ) ) {
  while ( $row = dbi_fetch_row( $res ) ) {
    $user = $row[0];
    user_load_variables( $user, "temp" );
    $crew[$count++] = $GLOBALS['tempfullname'];
  }
  dbi_free_result( $res );
}

?>

<table><?php // class="printer">?>
<tr>
 <td><?php echo display_time( $event_time );?> <?php echo date_to_str( $event_date,"",true,true );?></td>
</tr>
<tr>
 <td>Lead: <?php echo $head_chef;?></td>
</tr>
<tr>
 <td>Crew: 
   <?php 
   for( $i=0; $i<count($crew); $i++ ) {
     echo $crew[$i] . ", ";
   }?>
 </td>
</tr>
<tr>
 <td>Price (Adult): <?php echo price_to_str( $price );?></td>
</tr>
</table>



<?php ////// begin names
$names = user_get_users();
?>
<table><tr><td>
<table class="printer_table">
<?php print_title();
$prev_building = 0;
foreach( $names as $name ) {
  echo "<tr>";
  $username = $name['cal_login'];
  $building = $name['cal_building'];
  if ( $building != $prev_building ) {
    if ( ($building == 5) || ($building == 9) ) {
      echo "</table></td><td class=\"label\">|</td><td>\n";
      echo "<table class=\"printer_table\"><tr><td>";
      print_title();
    }
    if ( $building <= 9 ) 
      echo "<td colspan=6 align=center class=\"light_label\">Building $building</td>";
    else 
      echo "<td colspan=6 align=center class=\"light_label\">Friends</td>";
    echo "</tr>\n<tr>";
    $prev_building = $building;
  }
  if ( is_dining( $id, $username ) ) 
    echo "<td>X</td>";
  else 
    echo "<td></td>";
  echo "<td></td>";
  echo "<td>" . $name['cal_unit'] . "</td>";
  echo "<td>" . $name['cal_fullname'] . "</td>";
  echo "<td>" . get_fee_category( $name['cal_birthdate'], $event_date ) . "</td>";
  echo "<td></td>";
  echo "</tr>\n";
}
?>
</table>
</td></tr></table>


<?php print_trailer( false ); ?>

</body>
</html>



<?php
function print_title() { ?>
<tr>
 <td class="label">D</td>
 <td class="label">W</td>
 <td class="label">Unit</td>
 <td class="label">Name</td>
 <td class="label">A</td>
 <td class="label">L</td>
</tr>

<?php }
?>

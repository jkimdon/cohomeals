<?php
include_once 'includes/init.php';


$id = mysql_safe( getValue( 'id' ), false );
if ( empty ( $id ) || $id <= 0 || ! is_numeric ( $id ) ) {
  $error = translate ( "Invalid entry id" ) . "."; 
}

print_header();


//// load meal date/time
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

<table class="printer">
<tr>
 <td><?php echo display_time( $event_time );?> <?php echo date_to_str( $event_date,"",true,true );?></td>
</tr>
<tr id="light_border">
 <td>Lead: <?php echo $head_chef;?></td>
</tr>
<tr>
 <td>Crew: 
   <?php 
   for( $i=0; $i<count($crew); $i++ ) {
     echo $crew[$i] . " ";
   }?>
 </td>
</tr>
<tr id="light_border">
 <td>Price (Adult): <?php echo $base_price;?></td>
</tr>
</table>



<?php ////// begin names
?>
<table class="printer">
<tr>
 <td></td>
 <td>W</td>
 <td>Name</td>
 <td>$L</td>
</tr>
<tr>
 <td>X</td>
 <td></td>
 <td>Joey Kimdon</td>
 <td></td>
</tr>

</table>



<?php print_trailer( false ); ?>

</body>
</html>



<?php
include_once 'includes/init.php';

print_header('','','',true);
?>

<form action="edit_food_restrictions_handler.php" method="post">

<?php
$food = getValue( 'food' );
?>

<textarea name="food_comments" rows="4" cols="40">

<?php 
$sql = "SELECT cal_comments FROM webcal_food_prefs " .
  "WHERE cal_food LIKE '$food' AND cal_login LIKE '$login'";
if ( $res = dbi_query( $sql ) ) {
  if ( $row = dbi_fetch_row( $res ) ) {
    $food_comments = $row[0];
  }
}
  
  echo htmlspecialchars ( $food_comments );
?>

</textarea>


<input type="hidden" name="action" value="edit" />
<input type="hidden" name="food" value="<?php echo $food;?>" />

<input type="submit" value="Submit"/>
</form>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>

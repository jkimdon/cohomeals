 <?php
include_once 'includes/init.php';

print_header();

$mealid = getGetValue( 'mealid' );

$can_edit = false;
if ( $mealid ) {
  if ( is_chef( $mealid ) ) {
    $can_edit = true;
  }
  if ( $is_meal_coordinator ) {
    $can_edit = true;
  }
}

if ( $can_edit ) {

?>
  <form action="edit_base_price_handler.php" method="post" name="editBasePrice">
    <p><H1>Change Base Price of Meal</h1></p>
    <p>Please use this feature sparingly. It can be difficult for people to pay a different price than they were expecting. Plus it clutters up the financial log. Consider setting the appropriate price before creating the meal.</p>
    <input type="checkbox" name="sendmail" value="unchecked"/> Send email notification (with the following optional notes)<br>
    <input type="text" name="price_notes" id="price_notes" size="50" value="" maxlength="150"/><br>
    <?php echo "<input type=\"hidden\" name=\"mealid\" value=\"$mealid\" />";?>

    New price:&nbsp;&nbsp;
    $<input type="text" name="base_dollars" size="2" 
      value="<?php echo $base_dollars;?>" maxlength="2" />.
      <input type="text" name="base_cents" size="2"
      value="<?php printf( "%02d", $base_cents );?>" maxlength="2" />

    <p><input type="submit" value="Change price" /></p>

  </form>


<?php


} else echo "Not authorized";


print_trailer ();
?>
</body>
</html>

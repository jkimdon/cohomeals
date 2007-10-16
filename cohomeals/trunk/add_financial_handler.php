<?php
include_once 'includes/init.php';
$error = "";

$billing = "";
$billing = mysql_safe( getPostValue( 'billing' ), true );
$dollars = 0;
$dollars = mysql_safe( getPostValue( 'dollars' ), false );
$cents = 0;
$cents = mysql_safe( getPostValue( 'cents' ), false );
$type = "credit";
$type = getPostValue( 'type' );
$description = "";
$description = mysql_safe( getPostValue( 'description' ), true );
$meal_id = 0;
$meal_id = mysql_safe( getPostValue( 'mealid'), false );
$notes = "";
$notes = mysql_safe( getPostValue( 'notes' ), true );

$id = 1;

if ( $is_meal_coordinator || $is_beancounter ) {

  $amount = 100*$dollars + $cents;
  if ( ($type == credit) && ($amount < 0) ) $amount *= -1;
  else if ( ($type == debit) && ($amount > 0) ) $amount *= -1;

  add_financial_event( $billing, $amount, $description, 
		       $meal_id, $notes );

} else {
  $error = "Not authorized";
}




if ( empty( $error ) ) {
  do_redirect( "admin_financial.php?billing=all" ); // go back to where we were
}

print_header();
print_trailer();
?>
</body>
</html>


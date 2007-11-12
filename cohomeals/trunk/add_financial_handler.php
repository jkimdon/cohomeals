<?php
include_once 'includes/init.php';
$error = "";

$user = "";
$user = mysql_safe( getPostValue( 'user' ), true );
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

  user_load_variables( $user, "temp" );
  $full_descr = "user " . $GLOBALS['tempfullname'] . ": " . $description;

  $amount = 100*$dollars + $cents;
  $print_type = "charge";
  if ( $type == credit ) $print_type = "credit";
  else if ( $type == debit ) $print_type = "charge";

  add_financial_event( $user, $amount, $print_type, 
		       $full_descr, $meal_id, $notes );

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


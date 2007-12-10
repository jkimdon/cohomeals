<?php
include_once 'includes/init.php';
$error = "";

$group_new = array();
$group_new = getPostValue( 'group_new' );
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

  for( $i=0; $i<count($group_new); $i++ ) {
    $amount = 100*$dollars + $cents;
    $print_type = "charge";
    if ( $type == credit ) $print_type = "credit";
    else if ( $type == debit ) $print_type = "charge";
    add_financial_event( '', mysql_safe( $group_new[$i], true), 
			 $amount, $print_type, 
			 $description, $meal_id, $notes );
  }

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


<?php
include_once 'includes/init.php';

$id = getIntValue( 'id' );
$date = getIntValue( 'date' );

$can_edit = false;
$thisdate = '';

// First, check to see if this user should be able to delete this event.
if ( $id > 0 ) {
  // first see who has access to edit this entry
  if ( $is_meal_coordinator ) {
    $can_edit = true;
  }
}

if ( ! $can_edit ) {
  $error = "You are not authorized";
}

$id = mysql_safe( $id, false );
if ( $id > 0 && empty ( $error ) ) {


  // log the deletion, possibly through activity_log
  activity_log( $id, $login, 'D' );


  // process refunds
  /// for each group, calculate and refund amount billed for the cancelled meal
  $sql = "SELECT DISTINCT cal_billing_group " .
    "FROM webcal_user";
  $res = dbi_query( $sql );
  while ( $row = dbi_fetch_row( $res ) ) {
    $billing = $row[0];
    $total = 0;

    $sql2 = "SELECT cal_amount " .
      "FROM webcal_financial_log " .
      "WHERE cal_meal_id = $id AND cal_billing_group = '$billing'";
    $res2 = dbi_query( $sql2 );
    while( $row2 = dbi_fetch_row( $res2 ) ) 
      $total += $row2[0];
    if ( $total < 0 ) 
      add_financial_event( '', $billing, $total, "credit", "refund for cancelled meal", 
			   $id, '' );
    
  }

  


  // Do the deletion
  dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_id = $id" );
  dbi_query ( "DELETE FROM webcal_meal WHERE cal_id = $id" );
  
}

if ( empty ( $error ) ) {
  do_redirect ( "month.php" );
  exit;
}
print_header();
?>

<h2>Error</h2>
<blockquote>
<?php echo $error; ?>
</blockquote>

<?php print_trailer(); ?>

</body>
</html>

<?php
include_once 'includes/init.php';

$id = getIntValue( 'id' );

$can_edit = false;

// First, check to see if this user should be able to delete this event.
if ( $id > 0 ) {
  if ( $is_meal_coordinator ) {
    $can_edit = true;
  }
}

if ( ! $can_edit ) {
  $error = "You are not authorized";
}


$reason = "";
$reason = mysql_safe( getValue( 'reason' ), true );

if ( $reason == "" ) { ?>
  <form action="del_entry.php" method="get" name="deleteReasonForm">
    Reason for deleting the meal: 
    <input type="text" name="reason" id="reason" size="25" value="" maxlength="80"/><br>
    <input type="checkbox" name="sendmail" value="unchecked"/> Send email notification<br>
    <?php echo "<input type=\"hidden\" name=\"id\" value=\"$id\" />";?>
  </form>
  <form action="del_entry.php" method="post" name="deleteReasonForm">
<?php } else {


$id = mysql_safe( $id, false );
if ( $id > 0 && empty ( $error ) ) {


  // log the deletion, possibly through activity_log
  activity_log( $id, $login, 'D', $reason );


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

  

  // Take people off 
  dbi_query ( "DELETE FROM webcal_meal_participant WHERE cal_id = $id" );
  dbi_query ( "DELETE FROM webcal_meal_guest WHERE cal_meal_id = $id" );

  /// mark as cancelled 
  $sql = "UPDATE webcal_meal SET " .
    "cal_notes = 'Cancelled due to: $reason', " .
    "cal_cancelled = 1 " .
    "WHERE cal_id = $id";
  dbi_query ( $sql );
  
  $sql = "SELECT cal_date, cal_time FROM webcal_meal WHERE cal_id = $id";
  if ( ( $res = dbi_query( $sql ) ) &&
       ( $row = dbi_fetch_row( $res ) ) ) {

    $meal_time = date_to_str( $row[0] ) . ", " . display_time ( $row[1] );

    $subject = "$meal_time meal canceled ($reason)";
    $body = "The meal scheduled for $meal_time has been canceled (due to $reason)";
    load_global_settings();
    $extra_hdrs = "From: " . $GLOBALS['email_from'] . "\r\n";

    $sendmail = false;
    $sendmail = getValue( "sendmail" );
    if ( $sendmail == true ) 
      mail( $GLOBALS['deleted_meal_notification_to'], $subject, $body, $extra_hdrs );
  }
}


if ( empty ( $error ) ) {
  do_redirect ( "month.php" );
  exit;
}


}
print_header();


if ( $error ) { ?>

<h2>Error</h2>
<blockquote>
<?php echo $error; ?>
</blockquote>
<?php } ?>

<?php print_trailer(); ?>

</body>
</html>

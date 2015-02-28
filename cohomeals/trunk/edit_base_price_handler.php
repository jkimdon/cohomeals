<?php
include_once 'includes/init.php';

$error = '';

$id = getValue( 'mealid' );
$base_dollars = getValue( 'base_dollars' );
$base_cents = getValue( 'base_cents' );
$newprice = 100*$base_dollars + $base_cents;
$sendmail = false;
$sendmail = getValue( 'sendmail' );
$email_notes = mysql_safe( getValue( 'price_notes' ), true );

if ( !isset( $user ) ) $user = $login;
if ( $user == "" ) $user = $login;

if ( is_chef( $id, $login ) || $is_meal_coordinator ) {

  /// update meal price
  $sql = "UPDATE webcal_meal SET cal_base_price = " . $newprice .
    " WHERE cal_id = $id";

  if ( ! dbi_query ( $sql ) ) {
    $error = "Database error: " . dbi_error ();
    echo "Error = $error<br>";
  }

  $pretty_baseprice = $newprice/100;


  //// find diners
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND (cal_type = 'M' OR cal_type = 'T')";

  if ( $res = dbi_query ( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {

      /// find new meal price
      $current_diner = $row[0];
      $new_price = get_price( $id, $current_diner );

      /// check what previously paid for meal and update as necessary
      $previous_payment = -1*get_refund_price( $id, $current_diner, false );

      /// make the additional charge
      $cost_difference = $new_price - $previous_payment;
      $charge_or_credit = 'charge';
      if ( $cost_difference < 0 ) $charge_or_credit = 'credit';
      $current_billing_group = get_billing_group( $current_diner );
      user_load_variables( $current_diner, 'diner_' );
      $fin_log_message = 'chef changed meal price to $' . 
	$pretty_baseprice . ', ' . $GLOBALS['diner_fullname'] . ' dining';
      add_financial_event( $current_diner, $current_billing_group, $cost_difference, 
			   $charge_or_credit, $fin_log_message, $id, '' );
      
    }
  }
  dbi_free_result( $res );

  //// find guest diners
  $sql = "SELECT cal_fullname, cal_host FROM webcal_meal_guest " .
    "WHERE cal_meal_id = $id AND (cal_type = 'M' OR cal_type = 'T')";

  if ( $res = dbi_query ( $sql ) ) {
    while ( $row = dbi_fetch_row( $res ) ) {

      /// find new meal price
      $current_diner = $row[0];
      $current_host = $row[1];
      $new_price = get_guest_price( $id, $current_diner );

      /// check what previously paid for meal and update as necessary
      $previous_payment = -1*get_refund_price( $id, $current_diner, false );

      /// make the additional charge
      $cost_difference = $new_price - $previous_payment;
      $charge_or_credit = 'charge';
      if ( $cost_difference < 0 ) $charge_or_credit = 'credit';
      $current_billing_group = get_billing_group( $current_host );
      $fin_log_message = 'chef changed meal price to $' . 
	$pretty_baseprice . ', ' . $current_diner . ' dining';
      add_financial_event( $current_diner, $current_billing_group, $cost_difference, 
			   $charge_or_credit, $fin_log_message, $id, '' );
      
    }
  }
  dbi_free_result( $res );

  
  /// email cohochat about the price change.
  if ( $sendmail == true ) {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_type = 'H'";
    if ( ( $res = dbi_query( $sql ) ) && ( $row = dbi_fetch_row( $res ) ) ) {
      $head_chef = $row[0];
    }
    user_load_variables( $head_chef, 'chef_' );
    $chef_fullname = $GLOBALS['chef_fullname'];
    dbi_free_result( $res );

    $sql = "SELECT cal_date, cal_time FROM webcal_meal WHERE cal_id = $id";
    if ( ( $res = dbi_query( $sql ) ) &&
	 ( $row = dbi_fetch_row( $res ) ) ) {
      
      $meal_time = date_to_str( $row[0] ) . ", " . display_time ( $row[1] );
      
      $subject = "$meal_time meal price change";
      $body = "The price for the meal scheduled for $meal_time, with head chef
$chef_fullname has been changed to \$ $pretty_baseprice. Notes: $email_notes";
      load_global_settings();
      $extra_hdrs = "From: " . $GLOBALS['email_from'] . "\r\n";

      mail( $GLOBALS['deleted_meal_notification_to'], $subject, $body, $extra_hdrs );
    }

    dbi_free_result( $res );
  }


}

///////
// send back to the meal page
$url = "view_entry.php?id=$id";
do_redirect( $url );

?>
</body>
</html>

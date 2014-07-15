<?php
include_once 'includes/init.php';

$child_login = getValue( 'child_login' );
$new_fee_category = getValue( 'new_fee_category' );

/// check to make sure this user is authorized
$is_authorized_for_child = 0;
if ( $is_meal_coordinator ) $is_authorized_for_child = 1;
else {
  $user_billing_group = get_billing_group( $login );
  $sql = "SELECT cal_login FROM webcal_user " . 
    "WHERE cal_login = '$child_login' AND cal_billing_group = '$user_billing_group'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $is_authorized_for_child = 1;
    }
  }
}

if ( $is_authorized_for_child == 1 ) {


  // if the change is to the default value, delete the altered entry in the webcal_user_prefs table
  $default_category = get_fee_category( 0, $child_login, true );
  if ( $new_fee_category == $default_category ) {
    $sql = "DELETE FROM webcal_user_pref WHERE cal_login = '$child_login' AND cal_setting = 'kid_price'";
  } else {  // otherwise, enter or alter the altered entry in the webcal_user_prefs table
    $sql = "INSERT INTO webcal_user_pref ( cal_login, cal_setting, cal_value ) " .
      "VALUES ( '$child_login', 'kid_price', '$new_fee_category' ) " .
      "ON DUPLICATE KEY UPDATE cal_value=VALUES(cal_value)";
  }
  if ( !dbi_query( $sql ) ) {
    $error = "Database error: " . dbi_error ();
  }



  $nextURL = "users.php#tabkidprices";

} else {
  $error = "Not authorized";
}

if ( ! empty ( $error ) ) {
  print_header( '', '', '', true );

?>

<h2>Error</h2>
<blockquote>
<?php echo $error;?>
</blockquote>
</body>
</html>
<?php } else if ( empty ($error) ) {
?><html><head></head><body onload="alert('Change successfully saved'); window.parent.location.href='<?php echo $nextURL;?>';">
</body></html><?php } ?>

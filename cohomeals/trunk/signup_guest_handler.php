<?php 
include_once 'includes/init.php';

$id = mysql_safe( getValue( 'id' ), false );
$action = getValue( 'action' );
$type = mysql_safe( getValue( 'type' ), true );
$guest_name = mysql_safe( getValue( 'guest_name' ), true );
$host = mysql_safe( getValue( 'host' ), true );
$fee_class = mysql_safe( getValue( 'age' ), true );
$miniwindow = false;
$miniwindow = getValue( 'miniwindow' );

$error = "";


if ( $action == 'A' ) {
  
  // add to the database
  $sql = "INSERT INTO webcal_meal_guest " .
    "( cal_meal_id, cal_fullname, cal_host, cal_fee, cal_type ) " .
    "VALUES ( $id, '$guest_name', '$host', '$fee_class', '$type' )";
  if ( !dbi_query( $sql ) ) {
    $error = "Database entry failed";
  }


  // charge host's account
  $amount = get_adjusted_price( $id, $fee_class, false, true );
  $billing = get_billing_group( $host );
  $description = "Guest: $guest_name dining";
  add_financial_event( $host, $billing, $amount, "charge",
		       $description, $id, "" );

} else if ( $action == 'D' ) {

  $host = "";
  $fee_class = "A";
  $ok_to_delete = false;
  // find host name and fee class for credit
  $sql = "SELECT cal_host, cal_fee " .
    "FROM webcal_meal_guest " .
    "WHERE cal_fullname = '$guest_name' " .
    "AND cal_type = '$type' " .
    "AND cal_meal_id = $id " . 
    "AND cal_host != ''";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $host = $row[0];
      $fee_class = $row[1];
      if ( ($host == $login) || $is_meal_coordinator ) 
	$ok_to_delete = true;
    }
    dbi_free_result( $res );
  }



  // delete
  if ( $ok_to_delete == true ) {
    $sql = "DELETE FROM webcal_meal_guest " .
      "WHERE cal_fullname = '$guest_name' " .
      "AND cal_type = '$type' " . 
      "AND cal_meal_id = $id";
    if ( !dbi_query( $sql ) ) {
      $error = "deletion error";
    } else {
      // credit the appropriate account
      $amount = get_guest_refund_price( $id, $host, $guest_name );
      $billing = get_billing_group( $host );
      $description = "$guest_name cancelled dining";
      add_financial_event( $host, $billing, $amount, 
			   "credit", $description, $id, "" );
    }
  }

} else if ( $action == 'C' ) {

  $ok_to_change = false;
  $sql = "SELECT cal_host " .
    "FROM webcal_meal_guest " .
    "WHERE cal_fullname = '$guest_name' " .
    "AND cal_type = '$type' " .
    "AND cal_meal_id = $id " . 
    "AND cal_host != ''";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $host = $row[0];
      if ( ($host == $login) || $is_meal_coordinator ) 
	$ok_to_change = true;
    }
    dbi_free_result( $res );
  }


  if ( $type == 'M' ) $new_type = 'T';
  else $new_type = 'M';

  if ( $ok_to_change == true ) {
    $sql = "UPDATE webcal_meal_guest " .
      "SET cal_type = '$new_type' " .
      "WHERE cal_meal_id = $id " .
      "AND cal_host = '$host' " .
      "AND cal_fullname = '$guest_name'";
    dbi_query( $sql );
  }
}


if ( $miniwindow == true ) {
  $nexturl = "view_entry.php?id=$id";  
    ?>

    <script language="JavaScript" type="text/javascript">
       opener.window.location.href = "<?php echo $nexturl;?>";
  self.close();
  </script>
<?php } else {
  $url = "view_entry.php?id=$id";
  do_redirect( $url );
}
?>

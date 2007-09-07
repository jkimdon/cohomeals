<?php
include_once 'includes/init.php';

$error = '';


//// un/subscribe
if ( $action == 'A' ) {
  $sql = "INSERT INTO webcal_subscriptions ( cal_login, cal_suit, cal_club_id ) " .
    "VALUES ( '$login', 'club', '$club_id' )"; 
  if ( ! dbi_query ( $sql ) ) {
    $error = translate("Database error") . ": " . dbi_error ();
  }
} else {
  $sql = "DELETE FROM webcal_subscriptions " .
    "WHERE cal_login = '$login' AND cal_suit = 'club' AND cal_club_id = '$club_id'";
  if ( ! dbi_query ( $sql ) ) {
    $error = translate("Database error") . ": " . dbi_error ();
  }
}
  


/// add or remove diner from meals
$sql = "SELECT cal_id FROM webcal_meal WHERE cal_club_id = '$club_id'";
$res = dbi_query ( $sql );
if ( $res ) {
  while ( $row = dbi_fetch_row ( $res ) ) {
    $cal_id = $row[0];
    if ( $action == 'A' ) {
      edit_participation ( $cal_id, 'A' );
    }
    else {
      edit_participation ( $cal_id, 'D', 'M' );
      edit_participation ( $cal_id, 'D', 'F' );
    }
  }
}

// return to club subscription page
$url = "subscribe_club.php";
do_redirect ( $url );


?>

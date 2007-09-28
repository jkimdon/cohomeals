<?php
include_once 'includes/init.php';

$error = "";
$removebuddy = "";
$addbuddy = "";

$removebuddy = mysql_safe( getGetValue( 'removebuddy' ), true );

if ( $removebuddy != "" ) {
  $sql = "DELETE FROM webcal_buddy " .
    "WHERE cal_signer = '$removebuddy' " .
    "AND cal_signee = '$login'";
  if ( !dbi_query( $sql ) ) {
    $error = "Database error: " . dbi_error ();
  }
} else {
  $addbuddy = mysql_safe( getPostValue( 'newbuddy' ), true );
  if ( $addbuddy != "" ) {
    $sql = "INSERT INTO webcal_buddy ( cal_signer, cal_signee ) " .
      "VALUES ( '$addbuddy', '$login' )";
    if ( !dbi_query( $sql ) ) {
      $error = "Database error: " . dbi_error ();
    }
  }
}



// return to heart subscription page
$url = "users.php";
do_redirect ( $url );

?>

<?php
include_once 'includes/init.php';

$action = getValue( 'action' );
$food = getValue( 'food' );

if ( $action == "add" ) {

  $sql = "INSERT INTO webcal_food_prefs ( cal_login, cal_food ) " .
    "VALUES ( '$login', '$food' )";
  if ( !dbi_query( $sql ) ) {
    $error = "Database error: " . dbi_error ();
  }

} else if ( $action == "remove" ) {

  $sql = "DELETE FROM webcal_food_prefs " .
    "WHERE cal_login = '$login' AND cal_food = '$food'";
  if ( !dbi_query( $sql ) ) {
    $error = "Database error: " . dbi_error ();
  }

} else if ( $action == "edit" ) {

  $comments = mysql_safe( getPostValue( 'food_comments' ) );
  $sql = "UPDATE webcal_food_prefs SET cal_comments = '$comments' " . 
    "WHERE cal_login = '$login' AND cal_food = '$food'";
  if ( !dbi_query( $sql ) ) {
    $error = "Database error: " . dbi_error ();
  }

}

$nextURL = "users.php";

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
?><html><head></head><body onload="alert('Changes successfully saved'); window.parent.location.href='<?php echo $nextURL;?>';">
</body></html><?php } ?>

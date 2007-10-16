<?php
include_once 'includes/init.php';

$error = '';

$id = getGetValue( 'id' );
$action = getGetValue( 'action' );
$type = getGetValue( 'type' );
$user = getGetValue( 'user' );
if ( !isset( $user ) ) $user = $login;


if ( is_signer( $user ) == true ) {

  $modified = edit_participation ( $id, $action, 
				   $type, $user );
  if ( $modified == true ) 
    auto_financial_event ( $id, $action, $type, $user );

} else {
  $error = "Not authorized";
}



///////
// send back to the meal page
$url = "view_entry.php?id=$id";
do_redirect( $url );

?>
</body>
</html>

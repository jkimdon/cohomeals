<?php
include_once 'includes/init.php';

$id = getGetValue( 'id' );
$action = getGetValue( 'action' );
$type = getGetValue( 'type' );
$user = getGetValue( 'user' );
if ( !isset( $user ) ) $user = $login;


edit_participation ( $id, $action, $type, $user );


///////
// send back to the meal page
$url = "view_entry.php?id=$id";
do_redirect( $url );

?>
</body>
</html>

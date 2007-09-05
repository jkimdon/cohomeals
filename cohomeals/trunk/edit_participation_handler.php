<?php
include_once 'includes/init.php';

edit_participation ( $id, $action, $type );


///////
// send back to the meal page
$url = "view_entry.php?id=$id";
do_redirect( $url );

?>
</body>
</html>

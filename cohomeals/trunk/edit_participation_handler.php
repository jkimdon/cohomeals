<?php
include_once 'includes/init.php';

$error = '';

$id = getGetValue( 'id' );
$action = getGetValue( 'action' );
$type = getGetValue( 'type' );
$user = getGetValue( 'user' );
$olduser = getGetValue( 'olduser' );
$added_dining = false;
if ( !isset( $user ) ) $user = $login;

if ( is_signer( $user ) == true ) {

  if ( $type != 'C' ) {
    $modified = edit_participation ( $id, $action, 
				     $type, $user );
  }
  else {
    $sql = "SELECT cal_notes FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_login = '$olduser' AND cal_type = 'C'";
    $res = dbi_query( $sql );
    $row = dbi_fetch_row( $res );
    $job = $row[0];
    $modified = edit_crew_participation ( $id, $action, $user, $job, $olduser );
  }

  if ( ($type == 'H') && ($action == 'A') ) {
    $added_dining = edit_participation ( $id, 'A', 'M', $user, 0 );
  }


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

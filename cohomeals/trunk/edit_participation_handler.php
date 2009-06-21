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
if ( $user == "" ) $user = $login;

if ( (is_signer( $user ) == true ) || (is_chef( $id, $login ) ) ) {

  if ( $type == 'H' ) {
    $modified = edit_head_chef_participation( $id, $action, $user );
  } else if ( $type != 'C' ) {
    $modified = edit_participation ( $id, $action, $type, $user );
  }
  else {
    $sql = "SELECT cal_notes FROM webcal_meal_participant " .
      "WHERE cal_id = $id AND cal_login = '$olduser' AND cal_type = 'C'";
    $res = dbi_query( $sql );
    $row = dbi_fetch_row( $res );
    $job = $row[0];
    $modified = edit_crew_participation ( $id, $action, $user, $job, $olduser );
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

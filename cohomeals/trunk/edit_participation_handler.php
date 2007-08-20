<?php
include_once 'includes/init.php';

// admin is not a real person so cannot be a participant
if ( $login == $admin ) 
  return;

// make sure input is reasonable
if ( ($action != 'D') && ($action != 'A') )
  return;
if ( ($type != 'M') && ($type != 'T') && ($type != 'C') && ($type != 'S') &&
     ($type != 'L') && ($type != 'O') )
  return;



/////////
// check if we should change the status so as not to have duplicates

if ( $action == 'D' ) 
  $can_change = false;
else
  $can_change = true;

// find out the current status of the user for this meal
$sql = "SELECT cal_type FROM webcal_meal_participant " .
       "WHERE (cal_id = $id) AND (cal_login = '$login') AND (cal_type = '$type')";
$res = dbi_query ( $sql );
if ( !$res ) {
  if ( $action == 'D' )
    $can_change = false; // already not participating so no need to delete
  else 
    $can_change = true; // can add since there was no previous participation
} else {
  while ( $row = dbi_fetch_row ( $res ) ) {
    if ( $action == 'D' )
      $can_change = true; // is there so is ok to delete
    else
      $can_change = false; // already there
  }
}
  

///////
// make the change
if ( $can_change == true ) {
  if ( $action == 'A' ) {
    $sql = "INSERT INTO webcal_meal_participant ( cal_id, cal_login, cal_type ) " . 
           "VALUES ( $id, '$login', '$type' )";
    if ( ! dbi_query ( $sql ) ) 
      $error = translate("Database error") . ": " . dbi_error ();

    // dining in and taking out are mutually exclusive
    if ( ($type == 'M') || ($type == 'T') ) {
      if ( $type == 'M' )
	$delete_type = 'T';
      else
	$delete_type = 'M';
      $sql = "DELETE FROM webcal_meal_participant " .
	     "WHERE cal_id = $id AND cal_login = '$login' AND cal_type = '$delete_type'";
    if ( !dbi_query( $sql ) ) 
      $error = translate("Database error") . ": " . dbi_error ();
    }

  }
  else { // delete
    $sql = "DELETE FROM webcal_meal_participant " .
           "WHERE cal_id = $id AND cal_login = '$login' AND cal_type = '$type'";
    if ( !dbi_query( $sql ) ) 
      $error = translate("Database error") . ": " . dbi_error ();
  }
}


///////
// send back to the meal page
$url = "view_entry.php?id=$id";
do_redirect( $url );

?>
</body>
</html>

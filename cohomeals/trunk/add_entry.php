<?php
include_once 'includes/init.php';

$error = "";

// Only proceed if id was passed
if ( $id > 0 ) {

  // double check to make sure user doesn't already have the event
  $is_my_event = false;
  $sql = "SELECT cal_id FROM webcal_meal_participant " .
    "WHERE cal_login = '$login' AND cal_id = $id";
  $res = dbi_query ( $sql );
  if ( $res ) {
    $row = dbi_fetch_row ( $res );
    if ( $row[0] == $id ) {
      $is_my_event = true;
      echo "Event # " . $id . " is already on your calendar.";
      exit;
    }
    dbi_free_result ( $res );
  }

  // add the event
  if ( $readonly == "N" && ! $is_my_event )  {
    if ( ! dbi_query ( "INSERT INTO webcal_meal_participant ( cal_id, cal_login ) VALUES ( $id, '$login' )") ) {
      $error = translate("Error adding event") . ": " . dbi_error ();
    }
  }
}

send_to_preferred_view ();
exit;
?>

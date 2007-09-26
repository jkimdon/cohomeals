<?php
include_once 'includes/init.php';

$id = getPostValue( 'id' );
$action = getPostValue( 'action' );
$type = getPostValue( 'type' );

/// figure out if there is a limit to the number we can sign up
$limited = false;
if ( ($type == "C") || ($type == "S") || ($type == "L") || ($type == "O") ) {
  $limited = true;
  switch( $type ) {
  case "C":
    $sql = "SELECT cal_num_cooks ";
    break;
  case "L":
    $sql = "SELECT cal_num_cleanup ";
    break;
  case "S":
    $sql = "SELECT cal_num_setup ";
    break;
  case "O":
    $sql = "SELECT cal_num_other_crew ";
    break;
  }
  $sql .= "FROM webcal_meal WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $number = $row[0];
    }
  }
  dbi_free_result( $res );
}


/// if there is a limit, find out how many are already signed up
$ct = 0;
if ( $limited == true ) {
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_type = '$type' AND cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    while ( dbi_fetch_row( $res ) ) 
      $ct++;;
  }
}



/// do the signing up

$signees = get_signees( $login, true );

for ( $i=0; $i<count( $signees ); $i++ ) {

  $user = $signees[$i]['cal_login'];
  if ( getPostValue( $user ) == true ) {
    $ct++;
    if ( $type == "B" ) {
      edit_club_subscription( $id, $user, $action );
    } else if ( ($limited == false) || ($ct <= $number) ) 
      edit_participation( $id, $action, $type, $user );
  }
}


if ( ($limited == true) && ($ct > $number) ) {
  ?>
  <script language="JavaScript" type="text/javascript">
     alert( "Warning: There are not enough crew slots for the number of buddies you entered, so not all were signed up. Please double-check that the signed-up crew is satisfactory."); 
  </script>
  <?php 
}

$nexturl = "";  
if ( $type == "B" ) {
  $nexturl = "subscribe_club.php";
} else {
  $nexturl = "view_entry.php?id=$id";
}
?>

<script language="JavaScript" type="text/javascript">
opener.window.location.href = "<?php echo $nexturl;?>";
self.close();
</script>


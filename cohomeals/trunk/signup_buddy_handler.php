<?php
include_once 'includes/init.php';

$id = mysql_safe( getPostValue( 'id' ), false );
$action = getPostValue( 'action' );
$type = mysql_safe( getPostValue( 'type' ), true );
$placeholder = mysql_safe( getPostValue( 'placeholder' ), true );

/// figure out if there is a limit to the number we can sign up
$limited = false;
$number = 1;
if ( $type == "C" ) {
  $limited = true;
  $sql = "SELECT COUNT(*) FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = 'C'";
  $res = dbi_query( $sql );
  $row = dbi_fetch_row( $res );
  $number = $row[0];
} else if ( $type == 'H' ) {
  $limited = true;
  $number = 1;
} else {
  $sql = "SELECT cal_max_diners FROM webcal_meal WHERE cal_id = $id";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      if ( $row[0] > 0 ) {
	$limited = true;
	$number = $row[0];
      }
    }
  }
  dbi_free_result( $res );
}



/// if there is a limit, find out how many are already signed up
$ct = 0;
if ( $limited == true ) {
  $sql = "SELECT cal_login FROM webcal_meal_participant " .
    "WHERE cal_type = '$type' AND cal_id = $id " .
    "AND cal_login NOT LIKE 'none%'";
  if ( $res = dbi_query( $sql ) ) {
    while ( dbi_fetch_row( $res ) ) 
      $ct++;;
  }
}



/// do the signing up

$signees = get_signees( $login, true );

for ( $i=0; $i<count( $signees ); $i++ ) {

  $user = $signees[$i]['cal_login'];
  $user_status = getPostValue( $user );

  if ( ($user_status == "pre") || ($user_status == "walkin") ||
       ($user_status == true) ) {
    $ct++;
    if ( $type == "B" ) {
      edit_club_subscription( $id, $user, $action );
    } else if ( ($limited == false) || ($ct <= $number) ) {
      $walkin = 0;
      if ( $user_status == "walkin" ) $walkin = 1;
      if ( $type != 'C' ) 
	$modified = edit_participation( $id, $action, $type, $user, $walkin );
      else {
	$sql = "SELECT cal_notes FROM webcal_meal_participant " .
	  "WHERE cal_id = $id AND cal_login = '$placeholder' AND cal_type = 'C'";
	if ( $res = dbi_query( $sql ) ) {
	  if ( $row = dbi_fetch_row( $res ) ) 
	    $job = $row[0];
	  dbi_free_result( $res );
	}
	$modified = edit_crew_participation( $id, $action, $user, $job, $placeholder );
      }
      if ( $modified == true )
	auto_financial_event ( $id, $action, $type, $user );
    }
  }
}


if ( ($limited == true) && ($ct > $number) ) {
  ?>
  <script language="JavaScript" type="text/javascript">
     alert( "Warning: There are not enough slots for the number of buddies you entered, so not all were signed up. Please double-check that the signed-up crew is satisfactory."); 
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


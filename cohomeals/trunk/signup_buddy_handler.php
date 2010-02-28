<?php
include_once 'includes/init.php';

$id = mysql_safe( getPostValue( 'id' ), false );
$action = getPostValue( 'action' );
$type = mysql_safe( getPostValue( 'type' ), true );
$placeholder = mysql_safe( getPostValue( 'placeholder' ), true );

// identify the job 
$job = '';
if ( $type == 'C' ) {
  $sql = "SELECT cal_notes FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_login = '$placeholder' AND cal_type = 'C'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) 
      $job = $row[0];
    dbi_free_result( $res );
  }
}


/// figure out if there is a limit to the number we can sign up
$limited = false;
$number = 1;
if ( $type == "C" ) {
  $limited = true;
  $sql = "SELECT COUNT(*) FROM webcal_meal_participant " .
    "WHERE cal_id = $id AND cal_type = 'C' AND cal_notes = '$job'";
  $res = dbi_query( $sql );
  $row = dbi_fetch_row( $res );
  $number = $row[0];
} else if ( $type == 'H' ) {
  $limited = true;
  $number = 1;
} else { // diners
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
  if ( $type == 'C' ) {
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE cal_type = '$type' AND cal_id = $id " .
      "AND cal_notes = '$job' " . 
      "AND cal_login NOT LIKE 'none%'";
    if ( $res = dbi_query( $sql ) ) {
      while ( dbi_fetch_row( $res ) ) 
	$ct++;;
    }
  } else if ( $type == 'H' ) {
    if ( has_head_chef( $id ) != "" )
      $ct = 1;
  } else { // diners
    $sql = "SELECT cal_login FROM webcal_meal_participant " .
      "WHERE (cal_type = 'M' OR cal_type = 'T') AND cal_id = $id " .
      "AND cal_login NOT LIKE 'none%'";
    if ( $res = dbi_query( $sql ) ) {
      while ( dbi_fetch_row( $res ) ) 
	$ct++;;
    }
    // count guests too 
    $sql2 = "SELECT COUNT(*) FROM webcal_meal_guest " . 
      "WHERE cal_meal_id = $id";
    if ( $res2 = dbi_query( $sql2 ) ) {
      if ( $row2 = dbi_fetch_row( $res2 ) ) 
	$ct += $row2[0];
      else $ct += 0;
    }
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
      if ( $type == 'H' ) {
	edit_head_chef_participation( $id, $action, $user );
      } else if ( $type != 'C' ) {
	edit_participation( $id, $action, $type, $user, $walkin );
      }
      else {
	edit_crew_participation( $id, $action, $user, $job, $placeholder );
	// move to next placeholder for the identical job
	$sql2 = "SELECT cal_login FROM webcal_meal_participant " .
	  "WHERE cal_id = $id AND cal_type = 'C' " .
	  "AND cal_notes = '$job' AND cal_login LIKE 'none%'";
	if ( $res2 = dbi_query( $sql2 ) ) {
	  if ( $row2 = dbi_fetch_row( $res2 ) ) {
	    $placeholder = $row2[0];
	  }
	  dbi_free_result( $res2 );
	}
      }
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


<?php
include_once 'includes/init.php';

$user = getValue( 'user' );
$startdate = getValue( 'startdate' );
$enddate = getValue( 'enddate' );

if ( is_signer( $user ) ) {

  // put into subscription table
  $sql = "INSERT INTO webcal_subscriptions ( cal_login, cal_suit, cal_off_day, cal_start, cal_end, cal_ongoing ) " .
    "VALUES ( '$user', 'heart', -1, $startdate, $enddate, 0 )";
  if ( !dbi_query( $sql ) ) 
    echo "Database error: " . dbi_error() . "<br />\n";
    


  // subscribe to each selected meal
  $sql = "SELECT cal_date, cal_id FROM webcal_meal " .
    "WHERE cal_suit = 'heart' AND cal_date >= '$startdate' AND cal_date <= '$enddate' " .
    "ORDER BY cal_date";
  if ( ! ($res = dbi_query ( $sql )) ) {
    echo "Database error: " . dbi_error() . "<br />\n";
  }
  $i=0;
  $count = 0;
  while ( $row = dbi_fetch_row ( $res ) ) {
    $date = $row[0];
    $id = $row[1];
    $checkedname = "d" . $id;
    $checkedvalue = getValue( $checkedname );
    
    if ( $checkedvalue == true ) {
      $mod = edit_participation ( $id, 'A', 'M', $user );
      if ( $mod == true ) {
	$count++;
      }
    } else {
      $mod = edit_participation ( $id, 'D', 'M', $user );
      if ( $mod == true ) {
	$count--;
      }
      $mod = edit_participation ( $id, 'D', 'T', $user );
      if ( $mod == true ) {
	$count--;
      }
    }
    
  }
  dbi_free_result( $res );
}

?>
<script language="JavaScript" type="text/javascript">
opener.window.location.href = "subscribe_heart.php";
self.close();
</script>

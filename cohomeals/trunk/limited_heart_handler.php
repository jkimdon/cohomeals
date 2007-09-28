<?php
include_once 'includes/init.php';

$user = getValue( 'user' );
$startdate = getValue( 'startdate' );
$enddate = getValue( 'enddate' );

$sql = "SELECT cal_date, cal_id FROM webcal_meal " .
       "WHERE cal_suit = 'heart' AND cal_date >= '$startdate' AND cal_date <= '$enddate' " .
       "ORDER BY cal_date";
if ( ! ($res = dbi_query ( $sql )) ) {
  echo "Database error: " . dbi_error() . "<br />\n";
}
$i=0;
while ( $row = dbi_fetch_row ( $res ) ) {
  $date = $row[0];
  $id = $row[1];
  $checkedname = "d" . $id;
  $checkedvalue = getValue( $checkedname );

  if ( $checkedvalue == true )
    echo "value = true";
  else
    echo "value = false";
  
  if ( $checkedvalue == true ) 
    edit_participation ( $id, 'A', 'M', $user );
  else {
    edit_participation ( $id, 'D', 'M', $user );
    edit_participation ( $id, 'D', 'T', $user );
  }

}

?>
<script language="JavaScript" type="text/javascript">
opener.window.location.href = "subscribe_heart.php";
self.close();
</script>

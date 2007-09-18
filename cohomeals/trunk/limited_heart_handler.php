<?php
include_once 'includes/init.php';


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
  $checkedvalue = "d" . $id;

  
  if ( $$checkedvalue == true ) 
    edit_participation ( $id, 'A', 'M' );
  else {
    edit_participation ( $id, 'D', 'M' );
    edit_participation ( $id, 'D', 'T' );
  }

}

?>

<script language="JavaScript" type="text/javascript">
opener.window.location.href = "subscribe_heart.php";
self.close();
</script>


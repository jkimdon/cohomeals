<?php
include_once 'includes/init.php';

$id = mysql_safe( getPostValue( 'id' ), false );
$user = mysql_safe( getPostValue( 'user' ), true );
$notes = mysql_safe( getPostValue( 'notes' ), true );
if ( !isset( $user ) ) $user = $login;

if ( is_signer( $user ) == true ) {

  $sql = "UPDATE webcal_meal_participant " .
    "SET cal_notes = '$notes' " .
    "WHERE cal_login = '$user' " .
    "AND cal_id = $id";
  if ( !dbi_query( $sql ) ) {
    $error = "Database error";
  }

} else {
  $error = "Not authorized";
}


$nexturl = "view_entry.php?id=$id";
?>

<script language="JavaScript" type="text/javascript">
opener.window.location.href = "<?php echo $nexturl;?>";
self.close();
</script>


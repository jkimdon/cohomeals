<?php
include_once 'includes/init.php';

$id = mysql_safe( getValue( 'id' ), false );
$user = mysql_safe( getValue( 'user' ), true );
$notes = mysql_safe( getValue( 'newCrew' ), true );
$whoadd = getValue( 'whoadd' );
if ( !isset( $user ) ) $user = $login;
if ( $user == "" ) $user = $login;

if ( is_signer( $user ) == true ) {

  // find unused "none" label
  $sql = "SELECT COUNT(*) FROM webcal_meal_participant " .
         "WHERE cal_id = $id AND cal_type = 'C'";
  if ( $res = dbi_query( $sql ) ) {
    if ( $row = dbi_fetch_row( $res ) ) {
      $count = $row[0];
    }
  }
  $count++;


  $olduser = "none" . $count;

  $sql = "INSERT INTO webcal_meal_participant " .
    "( cal_id, cal_login, cal_type, cal_notes ) VALUES ( ";
  $sql .= $id . ", ";
  $sql .= "'" . $olduser . "', ";
  $sql .= "'C', ";
  $sql .= "'" . mysql_safe( $notes ) . "')";

  if ( !dbi_query( $sql ) ) {
    $error = "Database error";
  }

  

  if ( $whoadd == "Add me" ) {
    $nexturl = "edit_participation_handler.php?user=$user&id=$id&type=C&action=A&olduser=$olduser";
    do_redirect( $nexturl );
  } else if ( $whoadd == "Add buddy" ) {
    $nexturl = "signup_buddy.php?id=$id&type=C&action=A&olduser=$olduser"; 
    ?><script language="JavaScript" type="text/javascript">
    window.open('<?php echo $nexturl;?>', 'Buddies', 'width=300,height=300,resizable=yes,scrollbars=yes');
    </script><?php
  } else { // just add description, done above, so just redirect
    $nexturl = "view_entry.php?id=$id";
    do_redirect( $nexturl );
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


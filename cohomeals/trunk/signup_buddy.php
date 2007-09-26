<?php
include_once 'includes/init.php';

$INC = array();
print_header($INC,'','',true);
?>

<form action="signup_buddy_handler.php" method="post">

<?php
$action = getGetValue( 'action' );
$type = getGetValue( 'type' );
$id = getGetValue( 'id' );


$signees = get_signees( $login, true );
$count = 0;			   
for ( $i=0; $i<count( $signees ); $i++ ) {
  $user = $signees[$i]['cal_login'];
  $partic = is_participating( $id, $user, $type );
  if ( ( !$partic && ($action == 'A')) ||
       ( $partic && ($action == 'D') ) ) {
    echo "<label><input type=\"checkbox\" name=\"" . $user . "\">" .
	  $signees[$i]['cal_fullname'] . "</input><br>";
    $count++;
  }
}

if ( $count == 0 )
  echo "No one has given you permission to sign them up for meals or else all of your buddies are already signed up.\n";
?>


<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="hidden" name="action" value="<?php echo $action;?>" />
<input type="hidden" name="type" value="<?php echo $type;?>" />

<p align="center"><input type="submit" value="Submit"/></p>
</form>

<?php print_trailer ( false, true, true ); ?>
</body>
</html>
